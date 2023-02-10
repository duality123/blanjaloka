<template>
    <BaseLayout title="Kembangkan UMKM dan Dapatkan Dana Investasi">
        <section class="hero_section min-vh-100">
            <div class="container">
                <h1 class="text-neutral-black text-center tagline">
                    Kembangkan <b>UMKM</b> dan <br> Dapatkan <b>Dana Investasi</b>
                </h1>
                <p class="text-neutral-black text-center mt-4">
                    Dapatkan bimbingan dari para mentor serta pendanaan UMKM <br>
                    Anda di Blanjaloka Akselerator sekarang juga!
                </p>
                <div class="d-flex flex-column flex-lg-row justify-content-center gap-3 gap-lg-4 mt-5">
                    <Link href="/register" class="btn btn-primary-blue-6 text-primary-blue-6 text-white py-2 border-5">Daftarkan
                        UMKM Sekarang</Link>
                    <a href="#" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">Jadi
                        Investor</a>
                </div>
                <div id="animation2">
                </div>
                <div class="row align-items-center position-relative info">
                    <img src="../assets/images/decore_img.png" alt="decorate img"
                        class="position-absolute decorate_img">
                    <div class="col-lg">
                        <h1 class="text-neutral-black">Apa itu Blanjaloka Akselerator?</h1>
                        <p class="text-neutral-black m-4">
                            <b>Blanjaloka Akselerator</b> adalah sebuah program yang membantu UMKM untuk elevasi
                            produk-produk
                            digital
                            agar mampu bersaing secara nasional maupun internasional.
                        </p>
                    </div>
                    <div id="animation1" style="width:40%">
                    </div>
                </div>
            </div>
        </section>
        <section class="profit_section bg-primary-blue-1 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg">
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            <img src="../assets/icons/icon_profit_1.png" alt="Perkembangan UMKM Lebih Cepat">
                        </div>
                        <h1 class="text-neutral-black mt-4">Perkembangan UMKM Lebih Cepat</h1>
                        <p>
                            Blanjaloka membawa UMKM untuk level-up dengan pelatihan dan menginkubasi UMKM agar bisa
                            berkembang lebih baik lagi.
                        </p>
                    </div>
                    <div class="col-lg">
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            <img src="../assets/icons/icon_profit_2.png" alt="Kesempatan Pendanaan UMKM">
                        </div>
                        <h1 class="text-neutral-black mt-4">Kesempatan Pendanaan UMKM</h1>
                        <p>
                            Dapatkan kesempatan pendanaan untuk UMKM Anda dari para investor.
                        </p>
                    </div>
                    <div class="col-lg">
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            <img src="../assets/icons/icon_profit_3.png"
                                alt="Peningkatan Penjualan Hingga ke Skala Internasional">
                        </div>
                        <h1 class="text-neutral-black mt-4">Peningkatan Penjualan Hingga ke Skala Internasional</h1>
                        <p>
                            UMKM milik Anda akan dibantu untuk elevasi produk-produk digital agar mampu bersaing secara
                            nasional maupun internasional.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="learn_section position-relative overflow-hidden">
            <img src="../assets/images/decore_img.png" alt="decorate img" class="position-absolute decorate_img">
            <div class="container">
                <div class="row d-flex gap-5">
                    <div class="col-lg order-2 order-lg-1">
                        <div id="animation3"></div>

                        <p class="text-neutral-black mt-4">
                            {{ learnItems[activeLearn].desc }}
                        </p>
                    </div>
                    <div class="col-lg order-1 order-lg-2">
                        <h1 class="text-neutral-black">What You’ll Learn</h1>
                        <div class="mt-4">
                            <div v-for="(item, index) in learnItems"
                                class="d-flex align-items-center gap-4 p-3 mb-4 rounded-pill learn_item"
                                :class="{'bg-primary-blue-2': item.isActive}"
                                @click="handleChangeCurrentLearnItem(item.title)">
                                <div class="d-flex justify-content-center align-items-center text-neutral-white number"
                                    :class="{'bg-primary-blue-6': item.isActive, 'bg-primary-blue-2': !item.isActive, 'text-neutral-white': item.isActive, 'text-neutral-gray-3': !item.isActive}">
                                    {{ index + 1 }}
                                </div>
                                <h2 class="mb-0" :class="{'text-neutral-gray-3': !item.isActive}">{{ item.title }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="faq_section position-relative overflow-hidden">
            <img src="../assets/images/decore_img.png" alt="decorate img" class="position-absolute decorate_img">
            <div class="container">
                <h1 class="text-neutral-black text-center">Pertanyaan Sering Ditanyakan</h1>
                <div class="accordion mt-5" id="accordionExample">
                    <div class="accordion-item rounded border mb-4">
                        <h2 class="accordion-header" id="faq_one">
                            <button class="accordion-button bg-primary-blue-2 text-neutral-gray-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse_faq_one" aria-expanded="true"
                                aria-controls="collapse_faq_one">
                                Apa itu Blanjaloka Akselerator?
                            </button>
                        </h2>
                        <div id="collapse_faq_one" class="accordion-collapse collapse show" aria-labelledby="faq_one"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-primary-blue-2">
                                Blanjaloka Akselerator adalah platform dimana para UMKM dapat mencari investor untuk usahanya atau bahkan sebaliknya.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded border mb-4">
                        <h2 class="accordion-header" id="faq_two">
                            <button class="accordion-button bg-primary-blue-2 text-neutral-gray-5 collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapse_faq_two"
                                aria-expanded="false" aria-controls="collapse_faq_two">
                                Bagaimana cara mengikuti program akselerator di Blanjaloka?
                            </button>
                               
                        </h2>
                        <div id="collapse_faq_two" class="accordion-collapse collapse" aria-labelledby="faq_two"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-primary-blue-2">
                                <ol class="">
                                    <li><strong>Daftarkan diri anda di Blanjaloka.id</strong></li>
                                    <li><strong>Penuhi data diri anda</strong></li>
                                    <li><strong>Tunggu admin untuk acc</strong></li>
                                    <li><strong>Selamat anda bisa menggunakan platform blanjaloka untuk mencari investor atau mencari UMKM</strong></li>
                            </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </BaseLayout>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref,onMounted } from 'vue';
import lottie from 'lottie-web'
//http://127.0.0.1:5173/resources/js/assets/animations/landing1.json
import BaseLayout from '../Layouts/UnauthenticatedLayout.vue'



onMounted(()=>{
      lottie.loadAnimation({
      container: document.getElementById('animation1'),
      path: '../storage/landing1.json',
      renderer: 'svg',
      loop: true,
      autoplay: true,
      name: "Demo Animation",
});
 lottie.loadAnimation({
      container: document.getElementById('animation2'),
      path: '../storage/landing2.json',
      renderer: 'svg',
      loop: true,
      autoplay: true,
      name: "Demo Animation",
});
  lottie.loadAnimation({
      container: document.getElementById('animation3'),
      path: '../storage/learn.json',
      renderer: 'svg',
      loop: true,
      autoplay: true,
      name: "Demo Animation",
});
})

const learnItems = ref([
    {
        title: 'sales',
        desc: 'Tahap inkubasi terdiri lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi, odio montes, luctus in ut cursus est at dictum.',
        isActive: true
    },
    {
        title: 'testing 1',
        desc: 'Testing 1.',
        isActive: false
    },
    {
        title: 'testing 2',
        desc: 'Testing 2.',
        isActive: false
    },
]);
const activeLearn = ref(0);

const handleChangeCurrentLearnItem = (title) => {
    learnItems.value = learnItems.value.map((learn) => {
        return learn.title == title ? { ...learn, isActive: true } : { ...learn, isActive: false };
    });

    activeLearn.value = learnItems.value.findIndex((learn) => learn.title == title);
}
</script>

<style scoped>
.hero_section {
    background-image: url('../assets/images/bg_hero_landing_page.png');
    background-size: contain;
    background-repeat: no-repeat;
    padding: 10rem 0;
}

.hero_section .tagline {
    font-size: 4rem;
    font-weight: 500;
    line-height: 4.5rem;
}

.hero_section p {
    font-size: 1.25rem;
    font-weight: 400;
    line-height: 1.8rem;
}

.hero_section a.btn {
    width: 18rem;
}

#animation1{
    width: 70%;
}

.hero_section img {
    margin-top: 7.5rem;
}

.hero_section .info h1 {
    font-size: 2.1rem;
    font-weight: 600;
}

.hero_section .info .decorate_img {
    width: 25rem;
    top: -10rem;
    left: -10rem;
    z-index: -1;
}

.profit_section h1 {
    font-size: 1.5rem;
    font-weight: 600;
}

.profit_section p {
    font-size: 1.1rem;
    font-weight: 400;
}

.learn_section {
    padding-top: 12rem;
}

.learn_section .decorate_img {
    width: 25rem;
    top: 2rem;
    right: -8.5rem;
    z-index: -1;
}

.learn_section h1,
.faq_section h1 {
    font-size: 2rem;
    font-weight: 600;
}

.learn_section .learn_item {
    cursor: pointer;
}

.learn_section .number {
    width: 3rem;
    height: 3rem;
    font-size: 1.2rem;
    font-weight: 600;
    border-radius: 50%;
}

.learn_section h2 {
    font-size: 1.5rem;
    font-weight: 600;
    text-transform: capitalize;
}

.faq_section {
    padding-top: 10rem;
}

.faq_section .decorate_img {
    width: 25rem;
    top: 50%;
    left: -8.5rem;
    z-index: -1;
}

.faq_section .accordion-button {
    font-size: 1.5rem;
    font-weight: 600;
}

.faq_section .accordion-button:focus {
    box-shadow: none;
}

.faq_section .accordion-button:not(.collapsed) {
    box-shadow: inset 0 calc(-1 * 1px) 0 #398AB9;
}

.faq_section .accordion-body {
    font-size: 1.25rem;
    font-weight: 400;
}

.cta_section {
    padding-top: 10rem;
    margin-bottom: -5rem;
}

@media (max-width: 575.98px) {
    .hero_section {
        padding: 10rem 0;
    }

    .hero_section .tagline {
        font-size: 2rem;
        line-height: 2rem;
    }

    .hero_section a.btn {
        width: 100%;
    }

    .hero_section img {
        margin-top: 5rem;
    }

    .hero_section .info .decorate_img,
    .learn_section .decorate_img {
        width: 15rem;
    }

    .hero_section .info .decorate_img {
        top: -5rem;
        left: -5rem;
    }

    .learn_section .decorate_img {
        right: 0;
    }

    .learn_section {
        padding-top: 6rem;
    }

    .faq_section {
        padding-top: 5rem;
    }

    .faq_section .decorate_img {
        width: 15rem;
        top: 0;
        left: 0;
        z-index: -1;
    }

    .faq_section .accordion-button {
        font-size: 1.25rem;
    }

    .faq_section .accordion-body {
        font-size: 1rem;
    }

    .cta_section {
        padding: 5rem 0;
        margin-bottom: -6.5rem;
    }
}
</style>
