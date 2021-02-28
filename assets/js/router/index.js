import Vue from "vue";
import Router from "vue-router";

import DefaultLayout from "../Layout/DefaultLayout";
import HomePage from "../components/HomePage";
import NumberPage from "../components/NumberPage";
import GreetingsPage from "../components/GreetingsPage";
import GreetingsSecurePage from "../components/GreetingsSecurePage";

Vue.use(Router);

const router = new Router({
    base: process.env.BASE_URL,
    mode: "history",
    routes: [
        {
            path: "/",
            name: 'home',
            component: HomePage
        },
        {
            path: "/numberSsr",
            name: 'numberSsr',
            component: NumberPage
        },
        {
            path: "/layout",
            component: DefaultLayout,
            children: [
                {
                    path: "greetings",
                    name: 'layoutGreetings',
                    component: GreetingsPage
                },
                {
                    path: "greetings/secure",
                    name: 'layoutGreetingsSecure',
                    component: GreetingsSecurePage
                }
            ]
        }
    ]
});

export default router;
