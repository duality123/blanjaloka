<template>
    <BaseLayout title="Syarat dan Ketentuan">
        <section class="mt-5">
            <div class="container text-center">
                <div class="mb-5">
                    <img
                        src="../../assets/images/mail2.png"
                        alt=""
                        style="width: 10rem"
                    />
                </div>
                <h2>Verifikasi Email Anda</h2>
                <p>Kami telah mengirimkan verifikasi akun ke <b>{{this.$page.props.auth.user.email}}</b>
                    <br>Silahkan cek kota masuk Anda untuk melakukan verifikasi.
                    {{getTime}}
                </p>
                <small>Tidak merupakan email anda ? <a href="">Ganti Email</a></small>
                <div class="mt-5">
                    <button
                        class="btn btn-primary-blue-6 text-neutral-white disabled"
                        style="padding: 5px 60px"
                    >
                        Kirim Ulang Email
                    </button>
                </div>
            </div>
        </section>
    </BaseLayout>
</template>

<script>
import BaseLayout from "../../Layouts/Layout.vue";
export default{

props:{
    request:String,
},
computed: {
  getTime(){
    const date = new Date();
    let h = (date.getHours() > 10)? date.getHours() : "0" + date.getHours()  ;
    let m = (date.getMinutes() > 10)? date.getMinutes()  : "0" + date.getMinutes() ;
    return h + ':' + m;
  }
},
components: {
  BaseLayout
},
}
</script>

<style scoped>
section {
    margin-top: 10rem !important;
}
section p {
    font-weight: 400;
    font-size: 18px;
    line-height: 150%;
}
</style>
