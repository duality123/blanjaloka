<template>
    <nav class="navbar fixed-top navbar-expand-lg ">
            <a class="navbar-brand" href="#">
                <img src="../../assets/images/blanjaloka_logo.png" alt="blanjaloka logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blanjaloka_navbar"
            aria-controls="blanjaloka_navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="blanjaloka_navbar">
            <div class="navbar-nav ms-auto">
                <a href="#" class="nav-link text-neutral-gray-4">Beranda</a>
                <a href="#" class="nav-link text-neutral-gray-4">Tentang Program</a>
                <a href="#" class="nav-link text-neutral-gray-4">Panduan</a>
            </div>
            <div class="navbar-nav gap-3 ms-auto" v-if="!$page.props.auth.is_authenticated">
                <Link href="/login"
                class="btn btn-outline-primary-blue-6 text-primary-blue-6 px-4 py-2 border-5 btn_custom_outline">
                Masuk</Link>
                <Link href="/kebijakan" class="btn btn-primary-blue-6 text-white px-4 py-2">Daftar</Link>
            </div>
            <div class="navbar-nav ms-auto profile-menu" v-else>
                <img src="../../assets/images/user_profile_img.png" alt="">
                <div class="dropdown">
                    <button class="btn btn-profile" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../assets/icons/icon_menu.png" alt="">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile-saya/">Profile Saya</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
    
</nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
//import inertia adapter
import { Inertia } from "@inertiajs/inertia";
export default {
    data() {
        return {
            user: this.$page.props.auth.user
        }
    },
    components: {
        Link
    },
    methods: {
        submitLogout() {
            Inertia.post("/logout", {
                _token: this.$page.props.csrf_token,
            });
        }
    }
}
</script>

<style scoped>
.nav-link,
a.btn {
    font-weight: 600;
}

.navbar{
    margin-left: 80px;
    margin-right: 80px;
}
.btn_custom_outline {
    border-width: 2px !important;
}

.btn_custom_outline:hover {
    color: #FFFFFF !important;
}

.btn-profile{
    border: none;
}

.btn-profile:hover{
    border: none;
}

.profile-menu{
    background: #FFFFFF;
    border-radius: 60px;
}

@media (max-width: 575.98px) {
    nav {
        background-color: #FFFFFF;
    }
    .navbar{
        margin-left: 0;
        margin-right: 0;
        padding-left: 10px;
        padding-right: 10px;
    }
}
</style>
