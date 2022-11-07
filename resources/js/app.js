import { InertiaProgress } from "@inertiajs/progress";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faEye, faEyeSlash, faLock, faAt, faUser, faBell, faCamera, faFileArrowUp, faCalendarDays, faExclamation, faDisplay} from "@fortawesome/free-solid-svg-icons";
import { faCalendar } from "@fortawesome/free-regular-svg-icons";
import VueVideoPlayer from '@videojs-player/vue'
import 'video.js/dist/video-js.css'
import "bootstrap";

library.add(faEye, faEyeSlash, faCalendar, faBell, faUser, faLock, faAt, faCamera, faFileArrowUp, faCalendarDays, faExclamation, faDisplay);

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component("font-awesome-icon", FontAwesomeIcon)
            .component("vue-video-player", VueVideoPlayer)
            .use(plugin)
            .mount(el);
    },
});

InertiaProgress.init();
