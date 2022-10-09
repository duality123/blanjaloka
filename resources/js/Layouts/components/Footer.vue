<template>
<!-- Footer -->
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
    import { Link } from '@inertiajs/inertia-vue3';
    export default {
        components:{
            Link
        }
    }
</script>
<style scoped>

.cta_section {
    padding-top: 10rem;
    margin-bottom: -5rem;
}

footer {
    padding-top: 10rem;
}

@media (max-width: 575.98px) {

    .cta_section {
        padding: 5rem 0;
        margin-bottom: -6.5rem;
    }

    footer {
        padding-top: 5rem;
    }
}
</style>