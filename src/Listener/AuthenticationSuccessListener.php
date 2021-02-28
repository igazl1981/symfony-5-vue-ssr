<?php

namespace App\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationSuccessListener
{
    /**
     * @var bool set it to true when we are on PRD
     */
    private $securityCookie = false;

    private $httpOnlyCookie = true;

    private $tokenTtl;

    /**
     * AuthenticationSuccessListener constructor.
     * @param int $tokenTtl TTL value from the Lexik configuration
     */
    public function __construct(int $tokenTtl)
    {
        $this->tokenTtl = $tokenTtl;
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $response = $event->getResponse();
        $data = $event->getData();
        $token = $data['token'];

        // unset token to remove from the response
        unset($data['token']);
        $event->setData($data);

        $expirationTime = new \DateTime();
        $expirationTime->add(
            new \DateInterval('PT' . $this->tokenTtl . 'S')
        );

        $response->headers->setCookie(
            new Cookie('BEARER', $token,
                $expirationTime,
                '/',
                null,
                $this->securityCookie,
                $this->httpOnlyCookie)
        );

    }
}
