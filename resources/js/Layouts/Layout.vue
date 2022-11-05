<template>

    <Head>
        <title>Blanjaloka - {{ title }}</title>
        <meta name="description" content="Your page description">
    </Head>
    <header class="fixed-top">
        <div
            class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-2 gap-lg-4 py-2 bg-primary-blue-6">
            <p class="text-neutral-white mb-0">Silakan lengkapi data diri Anda</p>
            <a href="#"
                class="btn btn-outline-primary-blue-6 py-2 text-neutral-white border border-white btn_custom_outline">Lengkapi
                Profil</a>
        </div>
        <nav class="navbar navbar-expand-lg" :class="{ 'bg-primary-blue-6': scrollPosition > 100 }">
            <div class="container">
                <Link class="navbar-brand" href="/">
                <img v-if="scrollPosition < 100" src="../assets/images/blanjaloka_logo_blue.png" alt="blanjaloka logo"
                    class="img-fluid">
                <img v-if="scrollPosition > 100" src="../assets/images/blanjaloka_logo_white.png" alt="blanjaloka logo"
                    class="img-fluid">
                </Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#blanjaloka_navbar" aria-controls="blanjaloka_navbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="blanjaloka_navbar">
                    <div class="navbar-nav ms-auto">
                        <Link href="/" class="nav-link"
                            :class="{ 'text-neutral-white': scrollPosition > 100, 'text-neutral-gray-4': scrollPosition < 100 }">
                        Beranda</Link>
                        <a href="#" class="nav-link"
                            :class="{ 'text-neutral-white': scrollPosition > 100, 'text-neutral-gray-4': scrollPosition < 100 }">Tentang
                            Program</a>
                        <a href="#" class="nav-link"
                            :class="{ 'text-neutral-white': scrollPosition > 100, 'text-neutral-gray-4': scrollPosition < 100 }">Panduan</a>
                    </div>
                    <div class="navbar-nav align-items-lg-center gap-3 ms-auto">
                        <Link href="/login" class="btn px-4 py-2 border-5 btn_custom_outline"
                            :class="{ 'btn-outline-neutral-white text-neutral-white': scrollPosition > 100, 'btn-outline-primary-blue-6 text-primary-blue-6': scrollPosition < 100 }">
                        Masuk</Link>
                        <Link href="/register" class="btn px-4 py-2"
                            :class="{ 'btn-neutral-white text-primary-blue-6': scrollPosition > 100, 'btn-primary-blue-6 text-white': scrollPosition < 100 }">
                        Daftar</Link>
                        <li class="nav-item dropdown">
                            <a href="#"
                                class="d-flex align-items-center justify-content-center gap-2 bg-neutral-white rounded-pill p-2 dropdown-toggle user_profile_menu"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../assets/images/user_profile_public_img.png" alt="user profile public">
                                <img src="../assets/icons/icon_burger_menu_blue.png" alt="burger menu icon">
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                        <span>Notifikasi</span>
                                        <div class="bg-primary-blue-6 text-white notif_badge">2</div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Akun Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">UMKM Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-semantic-error-4" href="#">Keluar</a></li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <slot />
    <section class="cta_section">
        <div class="container d-flex justify-content-center">
            <img src="../assets/images/cta_img.png" alt="cta img" class="img-fluid">
        </div>
    </section>
    <footer class="bg-neutral-gray-1">
        <div class="container">
            <div class="row align-items-center border-bottom border-neutral-gray-2 pb-5">
                <div class="col-lg-4 ps-lg-0">
                    <img src="../assets/images/blanjaloka_logo_blue.png" alt="blankaloka logo" class="img-fluid">
                    <p class="text-neutral-black">
                        Sebuah program yang membantu UMKM untuk elevasi produk-produk digital agar mampu bersaing secara
                        nasional maupun internasional.
                    </p>
                </div>
                <div class="col-lg d-flex justify-content-lg-end">
                    <a href="#" class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">
                        Daftarkan UMKM Sekarang
                    </a>
                </div>
            </div>
            <div class="row align-items-end py-4 gap-4">
                <div class="col-lg ps-lg-0">
                    <div class="d-flex gap-4">
                        <Link href="/kebijakan-privasi" class="text-decoration-none text-neutral-gray-4">Kebijakan
                        Privasi</Link>
                        <Link href="/syarat-dan-ketentuan" class="text-decoration-none text-neutral-gray-4">Syarat dan
                        Ketentuan</Link>
                    </div>
                    <p class="text-neutral-gray-4 mt-3 mb-0">&copy; Copyright 2022. All Rights Reserved</p>
                </div>
                <div class="col-lg d-flex justify-content-center justify-content-lg-end">
                    <div class="d-flex gap-4">
                        <a href="#">
                            <img src="../assets/icons/icon_instagram_blue.png" alt="icon instagram blue">
                        </a>
                        <a href="#">
                            <img src="../assets/icons/icon_facebook_blue.png" alt="icon facebook blue">
                        </a>
                        <a href="#">
                            <img src="../assets/icons/icon_twitter_blue.png" alt="icon twitter blue">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { ref, onMounted } from 'vue'

const scrollPosition = ref(0);
const props = defineProps({
    title: {
        type: String,
        default: 'Berikan judul disini'
    }
});

onMounted(() => {
    window.addEventListener('scroll', () => {
        scrollPosition.value = window.scrollY;
    });
});
</script>

<style>
.nav-link,
a.btn {
    font-weight: 600;
}

.user_profile_menu {
    cursor: pointer;
}

.notif_badge {
    width: 2rem;
    height: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
}

.dropdown-toggle::after {
    display: none;
}

.navbar-expand-lg .navbar-nav .dropdown-menu {
    width: 15rem;
    left: -9rem;
    margin-top: 2rem;
    border-radius: 0.75rem;
}

.btn_custom_outline {
    border-width: 2px !important;
}

.btn_custom_outline:hover {
    color: #FFFFFF !important;
}

.cta_section {
    padding-top: 10rem;
    margin-bottom: -5rem;
}

footer {
    padding-top: 10rem;
}

@media (max-width: 575.98px) {
    nav {
        background-color: #FFFFFF;
    }

    .navbar-expand-lg .navbar-nav .dropdown-menu {
        width: 100%;
    }

    .cta_section {
        padding: 5rem 0;
        margin-bottom: -6.5rem;
    }

    footer {
        padding-top: 5rem;
    }
}
</style>
