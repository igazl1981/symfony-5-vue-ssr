import createApp from './main';
import renderToString from 'vue-server-renderer/basic'
import router from "./router";

const app = createApp();

// 'context' is added by $renderer->context($ssrData)
const urlFromBackend = context.url || '/';
// pushing url from backend to the router to match the rendered page on backend the same as on the frontend
router.push(urlFromBackend);

// rendering the vue part for the server
renderToString(app, (err, res) => {
    // print(err);
    if (err) {
        throw new Error(err);
    }
    print(res);
});
