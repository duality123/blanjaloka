import { InertiaProgress } from "@inertiajs/progress";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faEye,
    faEyeSlash,
    faArrowRightFromBracket,
    faChevronRight,
    faChevronUp,
    faPlus,
    faEllipsis,
    faEllipsisVertical,
} from "@fortawesome/free-solid-svg-icons";
import "bootstrap";

library.add(
    faEye,
    faEyeSlash,
    faArrowRightFromBracket,
    faChevronRight,
    faChevronUp,
    faPlus,
    faEllipsis,
    faEllipsisVertical
);

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component("font-awesome-icon", FontAwesomeIcon)
            .use(plugin)
            .mount(el);
    },
});

InertiaProgress.init();
