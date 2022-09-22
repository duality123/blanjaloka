<template>
    <AuthLayout title="Login">
        <div class="row justify-content-center ">
            <div class="col-lg-8">
                <img src="../../assets/images/blanjaloka_logo.png" alt="blanjaloka logo">
                <h1 class="mt-3">Daftar</h1>
                <p class="text-secondary">Ayo lakukan pendanaan UMKM sekarang juga!</p>
                <form @submit.prevent="handleSubmit">
                    <div class="mb-3 position-relative">
                        <label for="name" class="form-label">Username</label>
                        <input type="name" v-model="form.name" class="form-control"
                            id="name" placeholder="Masukkan username Anda">
                        <small class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</small>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" v-model="form.email" class="form-control"
                            id="email" placeholder="Masukkan email Anda">
                        <small class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</small>
                    </div>
                    <div class="position-relative">
                        <label for="kata_sandi" class="form-label">Kata Sandi</label>
                        <input :type="passwordInputType" v-model="form.password" 
                            class="form-control" id="kata_sandi" placeholder="Masukkan kata sandi Anda">
                        <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                            class="position-absolute icon_eye" />
                    </div>
                    <div class="mb-3 position-relative">
                    <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small>
                    </div>
                    <div class="position-relative">
                        <label for="kata_sandi_ulang" class="form-label">Kata Sandi</label>
                        <input :type="passwordInputType" v-model="form.password_confirmation" 
                            class="form-control" id="kata_sandi_ulang" placeholder="Ketikkan ulang kata sandi Anda">
                        <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                            class="position-absolute icon_eye" />
                    </div>
                    <div class="mb-3 position-relative">
                    <small class="text-danger" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</small>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" :disabled="isButtonDisable"
                            class="btn btn-primary text-white py-2">Masuk</button>
                    </div>
                    <div class="d-flex justify-content-center mt-2 gap-1">
                        <p>Sudah punya akun?</p>
                        <a href="#" class="text-primary text-decoration-none">Login sekarang</a>
                    </div>
                </form>
                <div class="oauth_choose">
                    <div class="line"></div>
                    <p>atau masuk dengan</p>
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


<script setup>
import AuthLayout from '../../Layouts/Auth.vue'
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

const isPasswordVisible = ref(false);
const passwordInputType = ref('password');
const passwordEyeType = ref('fa-solid fa-eye-slash');

const form = useForm({
    name:'',
    email: '',
    password: '',
    password_confirmation:'',
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
    if (form.email != '' && form.password != '' && form.name != '' && fotm.password_confirmation != '') return false;
    return true;
});
</script>

<style scoped>

</style>
