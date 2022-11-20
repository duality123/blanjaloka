<template>
    <BaseLayout>
        <section>
            <div class="container text-center">
                <div class="heading">
                    <h2>Ganti No. Handphone</h2>
                    <p>
                        Masukkan nomor handphone aktif Anda. Kamu akan mengirim
                        kode OTP ke nomor tersebut.
                    </p>
                    <div
                        class="d-flex justify-content-center align-items-center container"
                    >
                        <div class="card d-block mt-5">
                            <p>No. Handphone</p>
                            <input
                                type="text"
                                class="form-control"
                                style="display: block"
                                placeholder="Masukkan nomor hanphone Anda"
                            />
                            <button
                                class="btn btn-outline-primary-blue-6 button-change mt-3 disabled"
                            >
                                Kirim Kode OTP
                            </button>
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

.heading {
    margin-top: 140px;
}

.button-change {
    padding: 10px 104px;
}

.card {
    border: none;
}

.forms {
}

.tes {
    border: 1px solid red;
}
</style>
