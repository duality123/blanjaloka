import './bootstrap';
import '../css/app.css'; 

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { InertiaProgress } from '@inertiajs/progress'
 
createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
    //set mixins
    // .mixin({
    //     methods: {

    //       //method "hasAnyPermission"
    //       hasAnyPermission: function (permissions) {

    //         //get permissions from props
    //         let allPermissions = this.$page.props.auth.permissions;

    //         let hasPermission = false;
    //         permissions.forEach(function(item){
    //           if(allPermissions[item]) hasPermission = true;     
    //         });

    //         return hasPermission;
    //       }

    //     },
    //   })
      .use(plugin)
      .mount(el)
  },
});

InertiaProgress.init()


