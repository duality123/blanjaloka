<template>
    <BaseLayout>
        <section>
            <div class="container text-center">
                <div class="mb-5">
                    <img
                        src="../../../public/images/mails.png"
                        alt=""
                        style="width: 290px"
                    />
                </div>
                <div class="mt-5">
                    <p>Silahkan lanjut pengisian data Anda</p>
                    <button
                        class="btn btn-primary-blue-6 text-neutral-white"
                        style="padding: 5px 100px"
                    >
                        Lanjutkan
                    </button>
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
    margin-top: 15rem !important;
}

section p {
    font-weight: 400;
    font-size: 18px;
    line-height: 150%;
}
</style>
