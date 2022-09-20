<template>
<!-- Footer -->
        <section class="border-top footer" >
            <div class="container-fluid">
                <div class="row d-flex">
                    <div class="border col-sm-5">
                        <h3 class="justify-content-center">
                            Belanja nyaman dengan Blanjaloka <br />
                            Belanja lebih mudah bersama Blanjaloka
                        </h3>
                    </div>
                    <div class="col-sm-7 px-2 ms-5 py-5">
                        <h2>Blanjaloka</h2>
                        <p class="py-3">
                            Sebuah program yang membantu UMKM untuk <br />
                            elevasi produk-produk digital agar mampu bersaing
                            <br />
                            secara nasional maupun internasional.
                        </p>
                    </div>
                    <div class="col-sm-4 ms-5 py-5 d-flex">
                        <div class="mx-5">
                            <h2>Menu</h2>
                            <p>Sub menu</p>
                            <p>Sub menu</p>
                            <p>Sub menu</p>
                            <p>Sub menu</p>
                        </div>
                        <div class="mx-5">
                            <h2>Menu</h2>
                            <p>Sub menu</p>
                            <p>Sub menu</p>
                            <p>Sub menu</p>
                            <p>Sub menu</p>
                        </div>
                    </div>
                    <hr />
                    <div class="col-7 px-2 ms-5">
                        <div class="d-flex">
                            <p>Kebijakan Privasi</p>
                            <p class="mx-5">Syarat dan Ketentuan</p>
                        </div>
                        <p>© Copyright 2022. All Rights Reserved</p>
                    </div>
                    <div class="col-4 ms-4 d-flex">
                        <div class="mx-4 pt-5">
                            <i
                                class="bi bi-instagram"
                            ></i>
                        </div>
                        <div class="mx-3 pt-5">
                            <i
                                class="bi bi-facebook"
                                style="font-size: 2rem"
                            ></i>
                        </div>
                        <div class="mx-3 pt-5">
                            <i
                                class="bi bi-twitter"
                            ></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer close -->
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
.footer{
    background-color: #f0f0f0;
    margin-top:100px;
}
.bi{
    font-size: 2rem;
}
.border{
     background-color: #398ab9;
     border-radius: 12px;
     margin-left: 350px;
     margin-top: -30px;
}
</style>