<template>
   <Layout>
<div class="container" >
<h1 align="center">Kode verifikasi telah dikirim ke email anda :). Token akan kadaluwarsa dalam 24 jam.</h1>
<small>Klik link berikut untuk resend :)</small>
</form>
    </div>

</div>
</Layout>
</template>

<script>
//import layout

//import reactive
import { reactive } from "vue";

//import inertia adapter
import { Inertia } from "@inertiajs/inertia";

//import Heade and useForm from Inertia
import { Link } from "@inertiajs/inertia-vue3";

import Layout from "../../Layouts/Layout.vue";

export default {
    
    //register component
    components: {
        Layout,
        Link,
        
    },


   
};
</script>