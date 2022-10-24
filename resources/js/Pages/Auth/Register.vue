<template>
    <AuthLayout title="Register">
        <div class="row justify-content-center my-5">
            <div class="col-lg-8">
                <img src="../../assets/images/blanjaloka_logo.png" alt="blanjaloka logo">
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
                        <label for="no_telepon" class="form-label text-neutral-gray-5">No. Handphone</label>
                        <input type="number" v-model="form.no_telepon" class="form-control" id="no_telepon"
                        placeholder="Masukkan no. handphone aktif Anda">
                        <small class="text-danger" v-if="form.errors.no_telepon">{{ form.errors.no_telepon
                        }}</small>
                    </div>
                    <div class="mb-4 position-relative">
                        <label for="kata_sandi" class="form-label text-neutral-gray-5">Kata Sandi</label>
                        <input :type="passwordInputType" v-model="form.password" class="form-control" id="kata_sandi"
                        placeholder="Masukkan kata sandi Anda">
                        <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small>
                        <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                        class="position-absolute text-primary-blue-6 icon_eye" />
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" :disabled="isButtonDisable"
                        class="btn btn-primary-blue-5 text-neutral-white py-2">Daftar</button>
                    </div>
                    <div class="d-flex justify-content-center mt-2 gap-1">
                        <p class="text-neutral-gray-4">Sudah punya akun?</p>
                        <a href="#" class="text-primary-blue-6 text-decoration-none">Masuk</a>
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
                    <a href="#">
                        <img src="../../assets/icons/icon_google.png" alt="oauth google">
                    </a>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>


<script>
import AuthLayout from '../../Layouts/Auth.vue'
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default{
    components:{
        AuthLayout
    },
    
    setup(){
        const isPasswordVisible = ref(false);
        const passwordInputType = ref('password');
        const passwordEyeType = ref('fa-solid fa-eye-slash');
        
        const form = useForm({
            email: '',
            no_telepon: '',
            password: '',
        });
        
        const handleTogglePassword = (e) => {
            isPasswordVisible.value = !isPasswordVisible.value;
            passwordInputType.value = isPasswordVisible.value ? 'text' : 'password';
            passwordEyeType.value = isPasswordVisible.value ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
        }
        
        const handleSubmit = () => {
            form.post('/register');
        }
        
        const isButtonDisable = computed(() => {
            if (form.email != '' && form.no_telepon != '' && form.password != '' ) return false;
            return true;
        });

        return {isPasswordVisible, passwordInputType, passwordEyeType, handleTogglePassword, handleSubmit, isButtonDisable, form}
    }
    
}

</script>
