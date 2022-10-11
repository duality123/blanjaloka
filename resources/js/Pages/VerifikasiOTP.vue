<template>
    <BaseLayout>
        <section>
            <div class="container text-center">
                <div class="">
                    <img
                        src="../../../public/images/otp.png"
                        alt=""
                        style="width: 128px"
                    />
                </div>
                <div class="mt-5">
                    <h2>Verifikasi No. Handphone Anda</h2>
                    <p>
                        Silahkan masukan kode OTP yang telah kami kirimkan ke
                        nomor <b>+6282238603481</b>
                    </p>
                    <p>Sisa Waktu <b class="text-primary-blue-5">00:32</b></p>
                    <button
                        class="btn btn-outline-primary-blue-6 button-resend"
                    >
                        Kirim Ulang Kode OTP
                    </button>
                    <div
                        class="d-flex justify-content-center align-items-center container"
                    >
                        <div class="card py-5 px-3">
                            <div class="d-flex d-flex-row mt-5">
                                <input type="number" class="forms" />
                                <input type="number" class="forms" />
                                <input type="number" class="forms" />
                                <input type="number" class="forms" />
                                <input type="number" class="forms" />
                                <input type="number" class="forms" />
                            </div>
                            <div class="text-center mt-5">
                                <span class="d-block mobile-text"
                                    >Tidak Mendapatkan Kode OTP?
                                    <a href="">Ganti nomor handphone</a></span
                                ><button
                                    class="btn btn-outline-primary-blue-6 button-change mt-3 disabled"
                                >
                                    Lanjutkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </BaseLayout>
</template>

<script setup>
import BaseLayout from "../Layouts/Layout.vue";
</script>

<style>
section {
    margin-top: 10rem !important;
}

.button-resend {
    padding: 10px 70px;
}

.button-change {
    padding: 10px 104px;
}

.card {
    border: none;
}

.forms {
    margin: 12px;
    outline: 0.5px grey solid;
    width: 60px;
    height: 40px;
}

.forms:focus {
    outline: 2px aquamarine solid;
}
</style>
