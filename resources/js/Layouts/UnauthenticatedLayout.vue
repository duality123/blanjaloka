<template>
     <Head>
        <title>Blanjaloka - {{ title }}</title>
        <meta name="description" content="Your page description">
    </Head>
    <header class="fixed-top">
             <div id="myModal" class="modal" v-if="$page.props.session.success">
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "removePopup" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
       <img src="../assets/images/success.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-center text-center" style="margin-left: 2rem;">
       <h2>{{$page.props.session.success}}</h2>
        </div>
      </div>
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
                        <Link  href="/login" class="btn px-4 py-2 border-5 btn_custom_outline"
                            :class="{ 'btn-outline-neutral-white text-neutral-white': scrollPosition > 100, 'btn-outline-primary-blue-6 text-primary-blue-6': scrollPosition < 100 }">
                        Masuk</Link>
                        <Link  href="/register" class="btn px-4 py-2"
                            :class="{ 'btn-neutral-white text-primary-blue-6': scrollPosition > 100, 'btn-primary-blue-6 text-white': scrollPosition < 100 }">
                        Daftar</Link>
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
import { Head, Link,usePage } from '@inertiajs/inertia-vue3'
import { ref, onMounted } from 'vue'
import { Inertia } from '@inertiajs/inertia'
const scrollPosition = ref(0);
const props = defineProps({
    title: {
        type: String,
        default: 'Berikan judul disini'
    }
});
onMounted(() => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    window.addEventListener('scroll', () => {
        scrollPosition.value = window.scrollY;
    });
});

const logout = () => {
  Inertia.post('/logout',{
    _token: usePage().props.csrf_token
  })
};

const removePopup = () => {
  usePage().props.value.session.success = false;
}

</script>

<style>
.foto_profil{
    border-radius: 50%;
    width: 60px;
}
.nav-link,
a.btn {
    font-weight: 600;
}
.user_profile_menu {
    cursor: pointer;
}
.modal-content{
  height: 450px;
  overflow-y: scroll;
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
.lowerOpacity{
  opacity:  0.3;
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
.close{
  border-width: 0px;
  background-color: white;
}

.modal {
  position: fixed; /* Stay in place */
  padding-top: 100px; /* Location of the box */
  left: 0;
  display: block;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.1); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin-top: 3rem;
  margin-left: 25rem;
  padding: 20px;
  border-radius: 25px;
  width: 40%;
  text-align: center;
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
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
}
}
</style>
