<?php


namespace App\Controller;


use Exception;
use Psr\Log\LoggerInterface;
use Spatie\Ssr\Engines\V8;
use Spatie\Ssr\Renderer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use V8Js;

class LuckyController extends AbstractController
{
    public function number(): Response
    {

        $number = random_int(0, 100);

        return $this->render('number.html.twig', ['number' => $number]);
    }

    public function numberSsr(): Response
    {

        $number = random_int(0, 100);

        $ssrData = [
            'number' => $number,
            'url' => '/numberSsr'
        ];
        $renderedJs = $this->renderJs($ssrData);

//        $logger->info("Rendered: $renderedJs");

        return $this->render('numberSsr.html.twig', ['ssr' => $renderedJs]);
    }

    function greetings(): Response
    {

        $ssrData = [
            'url' => '/layout/greetings'
        ];
        $renderedJs = $this->renderJs($ssrData);

        return $this->render('numberSsr.html.twig', ['ssr' => $renderedJs]);
    }

    function greetingsSecure(): Response
    {

        $ssrData = [
            'url' => '/layout/greetings/secure'
        ];
        $renderedJs = $this->renderJs($ssrData);

        return $this->render('numberSsr.html.twig', ['ssr' => $renderedJs]);
    }

    function apiGreetings(Request $request): JsonResponse
    {
        $name = $request->get('name');
        return $this->json(['greeting' => "Hello $name"]);
    }

    function apiGreetingsSecure(Request $request): JsonResponse
    {
        $name = $request->get('name');
        return $this->json(['greeting' => "Hello $name"]);
    }

    function apiNumber(): JsonResponse
    {
        $number = random_int(0, 100);

        return $this->json(['number' => $number]);
    }

    /**
     * @param array $ssrData
     * @return mixed|string
     * @throws Exception
     */
    public function renderJs(array $ssrData)
    {
        $v8Js = new V8Js('PHP', $ssrData);
        $engine = new V8($v8Js);

        $renderer = new Renderer($engine);

        $projectDir = $this->getParameter('kernel.project_dir');

        $jsFilePath = $projectDir . '/public/build/server.js';

        $renderedJs = $renderer
            ->debug(true)
            ->context($ssrData)
            ->entry($jsFilePath)
            ->render();
        return $renderedJs;
    }

}
