<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../assets/images/blanjaloka_logo_blue.png" alt="blanjaloka logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blanjaloka_navbar"
                aria-controls="blanjaloka_navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="blanjaloka_navbar">
                <div class="navbar-nav ms-auto">
                    <a href="/" class="nav-link text-neutral-gray-4">Beranda</a>
                    <a href="#" class="nav-link text-neutral-gray-4">Tentang Program</a>
                    <a href="#" class="nav-link text-neutral-gray-4">Panduan</a>
                </div>
                <div class="navbar-nav gap-3 ms-auto">
                    <Link href="/login"
                        class="btn btn-outline-primary-blue-6 text-primary-blue-6 px-4 py-2 border-5 btn_custom_outline">
                    Masuk</Link>
                    <Link href="/register" class="btn btn-primary-blue-6 text-white px-4 py-2">Daftar</Link>
                </div>
            </div>
        </div>
    </nav>
    <section class="mt-4">
      <div class="container text-center">
         <div class="mb-5">
                    <img
                        src="../../assets/images/reset_password.png"
                        alt=""
                        style="width: 10rem"
                    />
            </div>
            <h2><b>Reset kata sandi</b></h2>
            <p>Masukkan email anda yang telah terdaftar di <span class="text-primary-blue-6">Blanjaloka</span> untuk mereset kata sandi.</p>
      </div>
         <form @submit.prevent="submit">
          <div class="form-section" style="margin-left: 32rem;">
            <small class="text-danger" v-if="this.$page.props.isEmailSend !=null">{{this.$page.props.isEmailSend}}</small>
          <label class="form-label text-neutral-gray-5">Email</label>
          <input type="email" class="form-control" v-model="form.email"
                                id="email" placeholder="Masukkan email Anda">
          <small class="text-danger" v-if="form.errors.email">Email anda tidak sesuai !</small>
        </div>
          <button type="submit"
              class="btn btn-primary-blue-6 text-neutral-white mt-2" style="margin-left: 32rem;">Lanjutkan</button>
      </form>
    </section>
    <section class="cta_section">
        <div class="container d-flex justify-content-center">
            <img src="../../assets/images/cta_img.png" alt="cta img" class="img-fluid">
        </div>
    </section>
    <footer class="bg-neutral-gray-1">
        <div class="container">
            <div class="row align-items-center border-bottom border-neutral-gray-2 pb-5">
                <div class="col-lg-4 ps-lg-0">
                    <img src="../../assets/images/blanjaloka_logo.png" alt="blankaloka logo" class="img-fluid">
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
                        <a href="#" class="text-decoration-none text-neutral-gray-4">Kebijakan Privasi</a>
                        <a href="#" class="text-decoration-none text-neutral-gray-4">Syarat dan Ketentuan</a>
                    </div>
                    <p class="text-neutral-gray-4 mt-3 mb-0">&copy; Copyright 2022. All Rights Reserved</p>
                </div>
                <div class="col-lg d-flex justify-content-center justify-content-lg-end">
                    <div class="d-flex gap-4">
                        <a href="#">
                            <img src="../../assets/icons/icon_instagram_blue.png" alt="icon instagram blue">
                        </a>
                        <a href="#">
                            <img src="../../assets/icons/icon_facebook_blue.png" alt="icon facebook blue">
                        </a>
                        <a href="#">
                            <img src="../../assets/icons/icon_twitter_blue.png" alt="icon twitter blue">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3'
import { Inertia } from "@inertiajs/inertia";
export default{
data(){
  return{
    next:usePage().props.isEmailSend ? usePage().props.isEmailSend : null
  }
},
beforeUnmount() {
  if(this.next){
    Inertia.get('/halaman_verifikasi')
  }
},
setup(){
 const form = useForm({
  email:null,
});

 return { form }
  
},

methods:{
  submit(){
    this.form.post('/forgot-password')
  }
}

}


</script>

<style scoped>
form{

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
  max-width: 24rem;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
}


section {
  margin-top: 10rem !important;
}
h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}
ul {
  list-style: decimal;
  padding: 0;
}
ul li {
  margin-left: 1rem;
  margin-bottom: 0.5rem;
}

.form-check-label {
  font-weight: 600;
  color: #3E4041;
}
form button {
  padding: 0.5rem 10rem;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
  form button {
    width: 100%;
    padding: 0.5rem 0;
  }
}
</style>
