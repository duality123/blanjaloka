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
        <div v-if = '!$page.props.auth.profileComplete || !$page.props.auth.profilPerusahaanComplete || !$page.props.auth.dokumenPerusahaanComplete ' class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-2 gap-lg-4 py-2 bg-primary-blue-6">
            <p class="text-neutral-white mb-0">Silakan lengkapi data diri Anda</p>
            <Link v-if="!$page.props.auth.profileComplete" href="/profil/1"
                class="btn btn-outline-primary-blue-6 py-2 text-neutral-white border border-white btn_custom_outline">Lengkapi
                Profil</Link>
             <Link v-else-if="!$page.props.auth.profilPerusahaanComplete" href="/investor/dashboard/profil_perusahaan"
                class="btn btn-outline-primary-blue-6 py-2 text-neutral-white border border-white btn_custom_outline">Lengkapi Profil Perusahaan  </Link>

             <Link v-else-if="!$page.props.auth.dokumenPerusahaanComplete" href="/umkm/dashboard/dokumen_perusahaan"
                class="btn btn-outline-primary-blue-6 py-2 text-neutral-white border border-white btn_custom_outline">Lengkapi
                Dokumen Perusahaan</Link>
       
    </div>
    <div v-else-if="!$page.props.auth.user.accepted"
            class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-2 gap-lg-4 py-2 bg-primary-blue-6">
              <p v-if="!$page.props.auth.user.accepted" class="text-neutral-white mb-0">Data anda sedang diproses silahkan cek email secara berkala !</p>
        </div>      
        <nav class="navbar navbar-expand-lg bg-primary-blue-6">
            <div class="container">
                <Link class="navbar-brand" href="/">
                <img src="../assets/images/blanjaloka_logo_white.png" alt="blanjaloka logo"
                    class="img-fluid">
                </Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#blanjaloka_navbar" aria-controls="blanjaloka_navbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="blanjaloka_navbar">
                    <div class="navbar-nav ms-auto">
                        <Link href="/investor/beranda" class="nav-link text-neutral-white">
                        Beranda</Link>
                        <Link href="/about" class="nav-link text-neutral-white ">Tentang
                            Program</Link>
                        <Link href="/panduan" class="nav-link text-neutral-white">Panduan</Link>
                        <Link href="/contact" class="nav-link text-neutral-white">Hubungi Admin</Link>
                    </div>
                    <div class="navbar-nav align-items-lg-center gap-3 ms-auto">
                        <li v-if="$page.props.auth.user" class="nav-item dropdown">
                            <a href="#"
                                class="d-flex align-items-center justify-content-center gap-2 bg-neutral-white rounded-pill p-2 dropdown-toggle user_profile_menu"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <img v-if ="!$page.props.auth.profil['foto_profil']" src="../assets/images/user_profile_public_img.png" alt="user profile public">
                          <img v-else :src="`${$page.props.asset_url}/${$page.props.auth.profil['foto_profil']}`"  class="foto_profil"  alt="user profile public">
                                <img src="../assets/icons/icon_burger_menu_blue.png" alt="burger menu icon">
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <Link class="dropdown-item d-flex align-items-center justify-content-between"
                                        href="/notifikasi/Investor">
                                    <span>Notifikasi</span>
                                    <div v-if="$page.props.auth.user.notifikasi" class="bg-primary-blue-6 text-white notif_badge">{{$page.props.auth.user.notifikasi}}</div>
                                    </Link>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <Link class="dropdown-item" href="/investor/profil/1">Akun Saya</Link>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li >
                                    <Link class="dropdown-item" href="/investor/dashboard">Investasi Saya</Link>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                <form @submit.prevent="logout">
                                 <button class="dropdown-item text-semantic-error-4" type="submit" >Keluar</button>
                                </form>
                            </li>
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
                        <Link href="/kebijakan_privasi" class="text-decoration-none text-neutral-gray-4">Kebijakan
                        Privasi</Link>
                        <Link href="/syarat_dan_ketentuan" class="text-decoration-none text-neutral-gray-4">Syarat dan
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
import contactUs from '../Components/contactUs.vue'
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
    height: 50px;
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
.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 1rem;
}
.step .number {
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.25rem;
  font-weight: 600;
  border-radius: 50%;
  background-color: #D9D9D9;
  color: #FFFFFF;
}
.step h1 {
  font-size: 1.125rem;
  font-weight: 600;
  color: #AEAEAE;
}
.step.clear .number {
  background-color: #398AB9;
}
.step.clear h1 {
  color: #3E4041;
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
