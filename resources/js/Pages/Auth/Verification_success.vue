<template>
    <BaseLayout title="Syarat dan Ketentuan">
        <section class="mt-5">
            <div class="container text-center">
                <div class="mb-5">
                    <img
                        src="../../assets/images/mail.png"
                        alt=""
                        style="width: 290px"
                    />
                </div>
                <p>Silahkan lanjutkan ke pengisian data anda.</p>
                <div class="mt-5">
                    <Link :href="`${redirect}`" v-if="redirect"
                        class="btn btn-primary-blue-6 text-neutral-white "
                        style="padding: 5px 60px"
                    >
                        Lanjutkan
                    </Link>
                </div>
            </div>
        </section>
    </BaseLayout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import BaseLayout from "../../Layouts/Layout.vue";
export default{
props:{
redirect:String
},
components: {
  BaseLayout,
  Link
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
