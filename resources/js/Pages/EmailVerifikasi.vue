<template>
    <BaseLayout title="Syarat dan Ketentuan">
        <section class="mt-5">
            <div class="container text-center">
                <div class="mb-5">
                    <img
                        src="../../../public/images/mail.png"
                        alt=""
                        style="width: 290px"
                    />
                </div>
                <h2>Verifikasi Email Anda berhasil</h2>
                <p>Email telah dikirim ke akun <b>angilham2@gmail.com</b></p>
                <p>
                    Silahkan cek kota masuk Anda untuk melakukan verifikasi.
                    (00:00)
                </p>
                <p>Tidak merupakan email anda ? <a href="">Ganti Email</a></p>
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

<script setup>
import BaseLayout from "../Layouts/Layout.vue";
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
