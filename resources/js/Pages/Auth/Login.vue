<template>
   <Layout>
    <div class="form-login">
        <div class="d-flex justify-content-evenly">
            <div class="col-lg-6 d-lg-block d-none">
                <img
                    class="hero-images"
                    src="/images/hero.png"
                    alt="hero images"
                />
            </div>
            <div class="col-12 col-lg-4 col-md-8 p-4">
                <div class="logo-login mb-default">
                    <img src="/images/logo.png" alt="logo" />
                </div>
                <h3 class="text-4xl fw-semibold">Masuk</h3>
                <p class="text-secondary mb-4 fs-6">
                    Ayo lakukan pendanaan UMKM sekarang juga!
                </p>
                <div v-if="session.status" class="alert alert-success mt-2">
                    {{ session.status }}
                </div>
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label
                            class="fw-semibold"
                            for="exampleFormControlInput1"
                            >Email</label
                        >
                        <input
                            type="email"
                            class="form-control border-bottom border-0 rounded-0 px-0 text-sm"
                            v-model="form.email"
                            id="exampleFormControlInput1"
                            :class="{ 'is-invalid': errors.email }"
                            placeholder="Masukkan email Anda"
                        />
                    </div>
                    <div v-if="errors.email" class="alert alert-danger">
                        {{ errors.email }}
                    </div>
                    <div class="mb-3">
                        <label
                            class="fw-semibold"
                            for="exampleFormControlInput1"
                            >Kata Sandi</label
                        >
                        <input
                            type="password"
                            class="form-control border-bottom border-0 rounded-0 px-0 text-sm"
                            id="exampleFormControlInput1"
                            v-model="form.password"
                            :class="{ 'is-invalid': errors.password }"
                            placeholder="Masukkan kata sandi Anda"
                        />
                    </div>
                    <div v-if="errors.password" class="alert alert-danger">
                        {{ errors.password }}
                    </div>
                    <div
                        class="d-flex align-items-center justify-content-between"
                    >
                        <div class="form-check">
                            <input
                                class="form-check-input scale-1"
                                type="checkbox"
                                value=""
                                id="flexCheckDefault"
                            />
                            <label
                                class="form-check-label text-sm"
                                for="flexCheckDefault"
                            >
                                Ingat Saya
                            </label>
                        </div>
                        <a class="text-sm" href="#">Lupa Kata Sandi?</a>
                    </div>
                    <div v-if="biruin">
                        <button
                            type="submit"
                            class="btn col-12 btn-primary">
                            Daftar
                        </button>
                    </div>
                    <div v-else>
                         <button
                            type="submit"
                            class="btn btn-default col-12 btn-primary">
                            Daftar
                        </button>
                    </div>
                    <div
                        class="d-flex mb-3 align-items-center gap-2 justify-content-center"
                    >
                        <p class="text-sm mb-0">Belum punya akun?</p>
                        <a class="text-sm" href="/register">Daftar Sekarang</a>
                    </div>
                    <div class="line-center position-relative text-center">
                        <span
                            class="line bg-default text-center text-sm text-gray-100 px-3"
                            >atau masuk dengan</span
                        >
                    </div>
                    <div
                        class="social-media mt-4 d-flex gap-3 align-items-center justify-content-center"
                    >
                        <a href="">
                            <img
                                class="icon-facebook"
                                src="/images/icon-facebook.png"
                                alt="facebook"
                            />
                        </a>
                        <a href="auth/google/redirect">
                            <img
                                class="icon-google"
                                src="/images/icon-google.png"
                                alt=""
                            />
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</Layout>
</template>

<script>
//import layout

import { reactive } from "vue";


import { Inertia } from "@inertiajs/inertia";

import { Link } from "@inertiajs/inertia-vue3";

import Layout from "../../Layouts/Layout.vue";

export default {
    
    //register component
    components: {
        Layout,
        Link,
        
    },


    props: {
        errors: Object,
        session: Object,
    },

    //define composition API
    setup() {
        //define form state
        const form = reactive({
            email: "",
            password: "",
        });

        //submit method
        const submit = () => {
            //send data to server
            Inertia.post("/login", {
                email: form.email,
                password: form.password,
            });
        };

        //return form state and submit method
        return {
            form,
            submit,
        };
    },
     computed:{
        biruin(){
            if (this.form.email && this.form.name && this.form.password && this.form.password_confirmation){
                return true;
            }
        },
    }
}
</script>

<style>
.logo-login {
    cursor: pointer;
    width: 120px;
}

img {
    width: 100%;
}

.icon-facebook,
.icon-google {
    cursor: pointer;
    width: 45px;
}

.text-sm {
    font-size: 0.9rem !important;
}

.text-base {
    font-size: 1rem;
}

.text-4xl {
    font-size: 1.4rem;
}

.scale-1 {
    transform: scale(0.8);
}

textarea:hover,
input:hover,
textarea:active,
input:active,
textarea:focus,
input:focus,
button:focus,
button:active,
button:hover,
label:focus,
.btn:active,
.btn.active {
    outline: 0px !important;
    box-shadow: none !important;
}

.btn-default {
    padding: 0.6rem 0.5rem !important;
    opacity: 0.3;
}

.btn-default:hover {
    opacity: 0.9;
}

.text-gray-100 {
    color: #aeaeae !important;
}

::placeholder {
    color: #aeaeae !important;
}

.bg-default {
    background-color: #fff !important;
}

.line-center::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(50%);
    width: 100%;
    height: 0.3px;
    background-color: hsla(0, 0%, 68%, 1);
    z-index: -999;
}

.mb-default {
    margin-bottom: 5rem !important;
}

a {
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.mt-default {
    margin-top: 2.5rem !important;
}

.hero-images {
    width: 100%;
    height: 100%;
    object-fit: cover !important;
}

/* custom scrolbar */
::-webkit-scrollbar {
    width: 14px;
}
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 3px rgba(0 0 0 / 0.15);
}
::-webkit-scrollbar-thumb {
    background: linear-gradient(125deg, #333, #293462);
    border-radius: 10px;
}

.text-down {
    width: 350px;
    /* border: 1px solid red; */
}
</style>
