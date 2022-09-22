<template>
    <AuthLayout title="Login">
        <div class="row justify-content-center my-5">
            <div class="col-lg-8">
                <img src="../../assets/images/blanjaloka_logo.png" alt="blanjaloka logo">
                <h1 class="text-neutral-black">Masuk</h1>
                <p class="text-neutral-gray-4">Ayo lakukan pendanaan UMKM sekarang juga!</p>
                <form @submit.prevent="handleSubmit">
                    <div class="mb-3">
                        <label for="email" class="form-label text-neutral-gray-5">Email</label>
                        <input type="email" v-model="form.email" @keyup="handleDisableButton" class="form-control"
                            id="email" placeholder="Masukkan email Anda">
                        <small class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</small>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="kata_sandi" class="form-label text-neutral-gray-5">Kata Sandi</label>
                        <input :type="passwordInputType" v-model="form.password" @keyup="handleDisableButton"
                            class="form-control" id="kata_sandi" placeholder="Masukkan kata sandi Anda">
                        <small class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</small>
                        <font-awesome-icon @click="handleTogglePassword" :icon="passwordEyeType"
                            class="position-absolute text-primary-blue-6 icon_eye" />
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" v-model="form.remember" id="ingat_saya">
                            <label class="form-check-label text-neutral-gray-4" for="ingat_saya">
                                Ingat Saya
                            </label>
                        </div>
                        <a href="#" class="text-primary-blue-6 text-decoration-none">Lupa kata sandi?</a>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" :disabled="isButtonDisable"
                            class="btn btn-primary-blue-5 text-neutral-white py-2">Masuk</button>
                    </div>
                    <div class="d-flex justify-content-center mt-2 gap-1">
                        <p class="text-neutral-gray-4">Belum punya akun?</p>
                        <a href="#" class="text-primary-blue-6 text-decoration-none">Daftar sekarang</a>
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


<script setup>
import AuthLayout from '../../Layouts/Auth.vue'
import { ref, computed } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

const isPasswordVisible = ref(false);
const passwordInputType = ref('password');
const passwordEyeType = ref('fa-solid fa-eye-slash');

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const handleTogglePassword = (e) => {
    isPasswordVisible.value = !isPasswordVisible.value;
    passwordInputType.value = isPasswordVisible.value ? 'text' : 'password';
    passwordEyeType.value = isPasswordVisible.value ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
}

const handleSubmit = () => {
    form.post('/login');
}

const isButtonDisable = computed(() => {
    if (form.email != '' && form.password != '') return false;
    return true;
});
</script>

<style scoped>
h1 {
    font-size: 24px;
    font-weight: 600;
    margin-top: 3rem;
}

p {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 0;
}

form {
    margin-top: 1.5rem;
}

.form-label {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 0;
}

.form-control {
    border: none;
    border-radius: 0;
    border-bottom: 2px solid #AEAEAE;
    padding-left: 0;
}

.form-control:focus {
    box-shadow: none;
}

.icon_eye {
    bottom: 0.8rem;
    right: 0;
    cursor: pointer;
}

.oauth_choose {
    display: grid;
    grid-template-columns: 1fr 1.5fr 1fr;
    align-items: center;
    justify-items: center;
    column-gap: 0.5rem;
}

.line {
    width: 100%;
    height: 2px;
    background-color: #AEAEAE;
}

@media (max-width: 575.98px) {
    .oauth_choose {
        grid-template-columns: 1fr 2fr 1fr;
    }
}
</style>
