# Symfony 5 with Vuejs 2 and SSR

Learning project for trying out the combination of Symfony and Vuejs with SSR and see how it works.

## What is installed


On top of the default Symfony 5 the `spatie/server-side-rendering` module is installed for handling SSR rendering.

The frontend uses `vue-server-renderer` to support SSR in Vue.

## What is changed for a normal SPA

1. The frontend is using `client.js` and `server.js` too instead loading only the `main.js` in the html.
   1.a. `server.js` should now the current url path to render the same page as the `client.js` would
2. The backend controllers use the `Spatie\Ssr\Renderer` for rendering the server side javascript.
   2.a. The controller has to add the `'url' => '/numberSsr'` param to the context to get the right url in the `server.js`

## What is needed on the server

The server should be installed with

* PHP 7.(2|4)
* v8js (for rendering backend, I used https://github.com/stesie/docker-v8js for creating my own dev docker image)
* npm (for compiling frontend)


