import { InertiaProgress } from "@inertiajs/progress";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { library } from "@fortawesome/fontawesome-svg-core";
import vSelect from "vue-select";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faEye,
    faEyeSlash,
    faArrowRightFromBracket,
    faChevronRight,
    faChevronUp,
    faChevronLeft,
    faPlus,
    faEllipsis,
    faTimes,
    faEllipsisVertical,
    faBars
} from "@fortawesome/free-solid-svg-icons";

import "bootstrap";
import '../css/app.scss'
import "vue-select/dist/vue-select.css";

library.add(
    faEye,
    faEyeSlash,
    faArrowRightFromBracket,
    faChevronRight,
    faChevronLeft,
    faChevronUp,
    faPlus,
    faTimes,
    faEllipsis,
    faEllipsisVertical,
    faBars
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
            .component("v-select", vSelect)
            .use(plugin)
            .mount(el);
    },
});

InertiaProgress.init();
