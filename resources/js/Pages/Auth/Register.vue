<template>
    <AuthLayout title="Register">
        <div class="row justify-content-center my-5">
            <div class="col-lg-8">
                 <img src="../../assets/images/blanjaloka_logo_blue.png" alt="blanjaloka logo" id='logo'>
                <h1 class="text-neutral-black">Daftar</h1>
                <p class="text-neutral-gray-4">
                    Mulai pendanaan UMKM Anda di
                    <a href="#" class="text-primary-blue-6 text-decoration-none">Blanjaloka</a> <br>
                    sekarang juga!
                </p>
                <form @submit.prevent="handleSubmit">
                    <div class="mb-4">
                        <label for="email" class="form-label text-neutral-gray-5">Email</label>
                        <input type="email" v-model="form.email" class="form-control" id="email"
                            placeholder="Masukkan email Anda">
                        <small class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="no_handphone" class="form-label text-neutral-gray-5">No. Handphone</label>
                        <div class="input-group">
                          <span :class="[ hover ? 'numberHover':'numberCasual','input-group-text bg-white']">+62</span>
                          <input  v-model="form.no_telepon" @focusout="changeHoverState()" @focusin="changeHoverState()" type="number" class="form-control " placeholder=" Masukkan no handphone anda"  id="no_telepon">
                        </div>
                        <small class="text-danger" v-if="form.errors.no_telepon">{{ form.errors.no_telepon
                        }}</small>
                    </div>
                    <div class="mb-4">
                    <label class="form-label text-neutral-gray-5">Anda adalah ?</label>
                      <div class="form-check">
                        <input  v-model="form.investor" class="form-check-input" type="checkbox" id="investor" :checked="isInvestor">
                        <label class="form-check-label" for="investor">
                          Investor
                        </label>
                      </div>
                      <div class="form-check">
                        <input v-model="form.umkm" class="form-check-input" type="checkbox" id="umkm" :checked="isUMKM">
                        <label  class="form-check-label" for="umkm">
                          UMKM
                        </label>
                      </div>
                      </div>
                    <div class="mb-4 position-relative">
                        <label for="kata_sandi" class="form-label text-neutral-gray-5">Kata Sandi</label>
                        <div class="position-relative">
                            <input :type="passwordInputType" v-model="form.password" class="form-control"
                                id="kata_sandi" placeholder="Masukkan kata sandi Anda">
                            <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                                class="position-absolute text-primary-blue-6 icon_eye" />
                        </div>
                        <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" :disabled="isButtonDisable"
                            class="btn btn-primary-blue-5 text-neutral-white py-2">Daftar</button>
                    </div>
                    <div class="d-flex justify-content-center mt-2 gap-1">
                        <p class="text-neutral-gray-4">Sudah punya akun?</p>
                        <Link href="/login" class="text-primary-blue-6 text-decoration-none">Masuk</Link>
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
import { ref, computed,watch,onMounted,onUnmounted } from 'vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'

const isPasswordVisible = ref(false);
const hover = ref(false);
const passwordInputType = ref('password');
const passwordEyeType = ref('fa-solid fa-eye-slash');
const form = useForm({
    email: '',
    password: '',
    no_telepon: '',
    umkm:false,
    investor:false
});
const isInvestor = ref(false);
const isUMKM = ref(false);
watch(() => form.umkm,
  (newState,oldState) => {
    if(newState == true){
        form.investor = false; 
        isUMKM.value = true
        isInvestor.value = false
    }
    else{
        form.investor = true;
        isUMKM.value = false
        isInvestor.value = true
    }
  }
)

watch(() => form.investor,
  (newState,oldState) => {
    if(newState == true){
        form.umkm = false;
        isUMKM.value = false
        isInvestor.value = true
    }
    else{
        form.umkm = true;
        isUMKM.value = true
        isInvestor.value = false
    }
  }
)
const changeHoverState = () => {
  hover.value = !hover.value;
}

const handleTogglePassword = (e) => {
    isPasswordVisible.value = !isPasswordVisible.value;
    passwordInputType.value = isPasswordVisible.value ? 'text' : 'password';
    passwordEyeType.value = isPasswordVisible.value ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
}
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
let intervalId
onMounted(()=>{
  intervalId=  setInterval(()=>{
        makeAnimations(); 
  }, 100);
})
onUnmounted(() => clearInterval(intervalId))
const handleSubmit = () => {
    form.post('/register');
}

const isButtonDisable = computed(() => {
    if (form.email != '' && form.no_handphone != '' && form.password != '') return false;
    return true;
});
</script>

<style scoped>
.numberCasual {
  border:0px;
  border-radius:0px;
  border-bottom: 2px solid #AEAEAE;

}
.numberHover
{
  border:0px;
  border-radius:0px;
  border-bottom: 2px solid #7BB1D0;


}
</style>
