<template>
    <AuthLayout title="Login">
        <div class="row justify-content-center my-5 mt-2">
            <div class="col-lg-8">
                <img src="../../assets/images/blanjaloka_logo_blue.png" alt="blanjaloka logo" id='logo' >
                <h1 class="text-neutral-black">Masuk</h1>
                <p class="text-neutral-gray-4">Ayo lakukan pendanaan UMKM sekarang juga!</p>
                <form @submit.prevent="handleSubmit">
                    <div class="mb-4">
                        <label for="email" class="form-label text-neutral-gray-5">Email</label>
                        <input type="email" v-model="form.email" class="form-control" id="email"
                            placeholder="Masukkan email Anda">
                        <small class="text-danger" v-if="errors.email">Pastikan email atau password yang anda ketikkan itu benar !</small>

                    </div>
                    <div class="mb-4">
                        <label for="kata_sandi" class="form-label text-neutral-gray-5">Kata Sandi</label>
                        <div class="position-relative">
                            <input :type="passwordInputType" v-model="form.password" class="form-control"
                                id="kata_sandi" placeholder="Masukkan kata sandi Anda">
                            <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                class="position-absolute text-primary-blue-6 icon_eye" />
                        </div>
                        <small class="text-danger" v-if="errors.password">Harap diisi password anda !</small>

                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" v-model="form.remember" id="ingat_saya">
                            <label class="form-check-label text-neutral-gray-4" for="ingat_saya">
                                Ingat Saya
                            </label>
                        </div>
                        <Link href="/forgot-password" class="text-primary-blue-6 text-decoration-none">Lupa kata sandi?</Link>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" :disabled="isButtonDisable"
                            class="btn btn-primary-blue-5 text-neutral-white py-2">Masuk</button>
                    </div>
                    <div class="d-flex justify-content-center mt-2 gap-1">
                        <p class="text-neutral-gray-4">Belum punya akun?</p>
                        <Link href="/register" class="text-primary-blue-6 text-decoration-none">Daftar sekarang</Link>
                    </div>
                </form>
                <div class="oauth_choose mt-4">
                    <div class="line"></div>
                    <p class="text-neutral-gray-3">atau masuk dengan</p>
                    <div class="line"></div>
                </div>
                <div class="d-flex justify-content-center gap-4 mt-4">
                    <a href="#">
                        <img src="../../assets/icons/icon_facebook.png" alt="oauth facebook">
                    </a>
                    <a href="/auth/google/redirect">

                        <img src="../../assets/icons/icon_google.png" alt="oauth google">
                    </a>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>


<script setup>
import AuthLayout from '../../Layouts/Auth.vue'
import { ref, computed,onMounted,onUnmounted } from 'vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { reactive } from 'vue'
import { Inertia } from "@inertiajs/inertia";

const isPasswordVisible = ref(false);
const passwordInputType = ref('password');
const passwordEyeType = ref('fa-solid fa-eye-slash');


const form = reactive({

    email: '',
    password: '',
    remember: false,
});

var i = 0;
var multiple = 10;

var delay = false;
const props = defineProps({errors: Object});

const makeAnimations = (e) =>{
    /*
      if(delay){
                let start = Date.now();
                let current = 0;
                while(current - start != 500){
                        current = Date.now();
                    }
                delay = false;
                }
             document.getElementById('logo').style.transform = 'rotate(0deg)';
        */
            if(i >= 300 ){
                document.getElementById('logo').style.transform = 'rotate(20deg)'; 
                multiple *= -1;
                delay = true
            }
            else if(i <= 0 ){
                document.getElementById('logo').style.transform = 'rotate(0deg)';
                multiple += 10;
            }
            i+= multiple;
            document.getElementById('logo').style.marginLeft = i+'px';
}
let intervalId;
onMounted(()=>{
   intervalId = setInterval(()=>{
        makeAnimations(); 
  }, 100);
})

onUnmounted(() => clearInterval(intervalId))
const handleTogglePassword = (e) => {
    isPasswordVisible.value = !isPasswordVisible.value;
    passwordInputType.value = isPasswordVisible.value ? 'text' : 'password';
    passwordEyeType.value = isPasswordVisible.value ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
}

const handleSubmit = () => {

  Inertia.post('/login',{
                  email : form.email,
                  password : form.password,
                  remember : form.remember,
  });

  return {
    form,
    handleSubmit
  }
}


const isButtonDisable = computed(() => {
    if (form.email != '' && form.password != '') return false;
    return true;
});
</script>
