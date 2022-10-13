<template>
  <Layout>
    <div class="container-sm text-center">
      <div class="row">
        <div class="col"></div>
        <div class="col-7">
          <img src="../../assets/images/verifikasi_email/email.png" alt="">
          <p>Kami telah mengirimkan email verifikasi akun ke <b>{{ $page.props.auth.user.email }}</b>. 
            Silakan cek kotak masuk Anda untuk melakukan proses verifikasi. <span>(00:{{countdown}})</span></p>
            <div class="d-flex justify-content-center flex-column flex-md-row">
              <p>Tidak merupakan email Anda?</p>
              <a href="#" class="link-change-email ms-2">Ganti email</a>
            </div>
            <div class="d-flex justify-content-center my-2">
              <button class="btn btn-send-email btn-primary-blue-6 text-white px-4 py-2" :disabled="toggleButtonLanjut" @click="handleButtonLanjut">Kirim Ulang Email</button>
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
  import { onMounted, reactive, ref, watch } from "vue";
  
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
      
      const countdown = ref(30);
      const toggleButtonLanjut = ref(true);
      
      const countDownTimer = () =>{
        const timer = setInterval(() => {
          if (countdown.value > 0) {
            countdown.value--;
          } else {
            clearInterval(timer);
            toggleButtonLanjut.value = false;
          }
        }, 1000);
        
      }
      
      const handleButtonLanjut = () => {
        Inertia.post('/email/verification-notification');
      }
      
      
      onMounted(() => {
        countDownTimer();
      })
      
      
      return {countdown, toggleButtonLanjut, handleButtonLanjut}
    }
    
    
    
  };
</script>

<style scoped>
.link-change-email{
  list-style: none;
  text-decoration: none;
}

.btn-send-email{
  width: 70%;
}
</style>