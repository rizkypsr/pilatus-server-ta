require("./bootstrap");

// Import modules...
import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import VueSweetalert2 from "vue-sweetalert2";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Pilatus";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(VueSweetalert2)
            .component("Link", Link)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
