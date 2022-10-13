<template>
    <Layout>
        <div class="container-sm text-center">
            <div class="row">
                <div class="col"></div>
                <div class="col-7">
                    <img src="../../assets/images/verifikasi_email/email_success.png" alt="">
                    <h2>Verifikasi Email Anda Berhasil</h2>
                    <p>Silakan lanjutkan pengisian data Anda.</p>
                    <div class="d-flex justify-content-center my-2">
                        <button class="btn btn-send-email btn-primary-blue-6 text-white px-4 py-2" @click="handleButtonLanjut">Lanjutkan</button>
                    </div>
                </div>
                <div class="col"></div>
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
    
    setup(){
        const handleButtonLanjut = () => {
            Inertia.get('/');
      }

      return {handleButtonLanjut}
    }
    
    
};
</script>

<style scoped>
.link-change-email{
    list-style: none;
    text-decoration: none;
}
</style>