<template>
          <div id="myModal" class="modal" v-if="$page.props.session.status">
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click="removePopup()" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
       <img src="../../assets/images/success.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-center text-center" style="margin-left: 2rem;">
       <h2>Link konfirmasi dikirim !</h2>
        </div>
        <div class="d-flex justify-content-center text-center" style="margin-left: 2rem;">
            <p>Segera cek email anda untuk verifikasi email</p>
        </div>
      </div>
    </div>
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
      <div class="form-section">
         <form @submit.prevent="submit">
          <label class="form-label text-neutral-gray-5">Email</label>
          <input type="email" class="form-control" v-model="form.email"
                                id="email" placeholder="Masukkan email Anda">
          <small class="text-danger" v-if="form.errors.email">Email anda tidak sesuai !</small>
          <button type="submit"
              class="btn btn-primary-blue-6 text-neutral-white mt-2" >Lanjutkan</button>
      </form>
    </div>
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
                    <img src="../../assets/images/blanjaloka_logo_blue.png" alt="blankaloka logo" class="img-fluid">
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
setup(){
 const form = useForm({
  email:null,
});

 return { form }
  
},
mounted(){
    console.log(this.$page.props.session.status )
},

methods:{
  submit(){
    this.form.post('/forgot-password')
  },
  removePopup(){
    this.$page.props.session.status = null
  }
},
components:{
    Link
}

}


</script>

<style scoped>
.form-section{
 margin-left: 32rem;
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


@media (max-width: 575.98px) {
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
  .form-control {
  border: none;
  border-radius: 0;
  border-bottom: 2px solid #AEAEAE;
  padding-left: 0;
  max-width:60rem;
}
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
  .form-section{
    margin-left:1rem;
  }
}
</style>
