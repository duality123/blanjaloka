<template>
    <Layout>
        <div class="kegiatan">
            <div class="container ">
                <div class="row">
                    
                    <!-- Sidebar -->
                    <Sidebar />
                    <div class="col col-lg-9 ">
                        <div class="card">
                            
                            <div class="card-body">
                                <h3>UMKM Incubation Nusantara 2022 #Batch2</h3>
                                
                                <header class="my-4 pt-2 px-1 d-flex">
                                    <ul>
                                        <li v-for="item in tabItems" :class="{'active': item.isActive}" @click="handleChangeCurrentTabItem(item.title)">
                                            <a :class="{'text-neutral-black': item.isActive, 'text-neutral-gray-4': !item.isActive}">{{ item.title }}</a>
                                        </li>
                                    </ul>
                                    
                                </header>
                                
                                <p>
                                    E-Learning atau pembelajaran online atau daring (dalam jaringan) pada layanan Blanjaloka adalah pembelajaran yang dikembangkan oleh Tim Blanjaloka dalam bentuk online (dalam jaringan) melalui media website. Materi pembelajaran daring layanan blanjaloka mencakup materi tentang entrepreneurship, bisnis, dan usaha. Selain itu, terdapat pula materi-materi yang lebih teknis dan spesifik terkait cara mengembangkan usaha hingga ke skala internasional.
                                </p>
                                
                                <p>
                                    Setelah menyelesaikan pembelajaran daring ini, pelaku UMKM diharapkan lebih paham bagaimana mengembangkan usaha bisnis mereka.
                                </p>
                                
                                
                                <div class="mt-5 d-flex justify-content-between card-wrapper">
                                    <div class="card card-kegiatan" style="width: 12rem;">
                                        <img src="../../../assets/images/card-kegitan.png" class="card-img-top img-fluid" alt="...">
                                        <div class="card-body">
                                            <h6 class="card-title">Membuat Unique Value Produk Agar Laris Di Pasar</h6>
                                            <p class="card-text">Pada materi ini pelaku UMKM belajar mengenai  bagaimana menciptakan produk yang unik dan laris di pasaran.</p>
                                            <a href="#" class="btn btn-primary d-block">Ikuti Pembelajaran</a>
                                        </div>
                                    </div>
                                    <div class="card card-kegiatan" style="width: 12rem;">
                                        <img src="../../../assets/images/card-kegitan.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h6 class="card-title">Membuat Unique Value Produk</h6>
                                            <p class="card-text">Pada materi ini pelaku UMKM belajar mengenai  bagaimana menciptakan produk yang unik dan laris di pasaran.</p>
                                            <a href="#" class="btn btn-primary d-block">Ikuti Pembelajaran</a>
                                        </div>
                                    </div>
                                    <div class="card card-kegiatan" style="width: 12rem;">
                                        <img src="../../../assets/images/card-kegitan.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h6 class="card-title">Membuat Unique Value Produk</h6>
                                            <p class="card-text">Pada materi ini pelaku UMKM belajar mengenai  bagaimana menciptakan produk yang unik dan laris di pasaran.</p>
                                            <a href="#" class="btn btn-primary d-block">Ikuti Pembelajaran</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </Layout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue';
import Layout from '../../../Layouts/Layout.vue';
import Sidebar from '../../../Layouts/components/inkubasi/Sidebar.vue'

const tabItems = ref([
{
    title: 'Deskripsi',
    isActive: true
},
{
    title: 'E-Learning',
    isActive: false
},
{
    title: 'Eventual',
    isActive: false
},
{
    title: 'Logbook',
    isActive: false
},
]);

const handleChangeCurrentTabItem = (title) => {
    tabItems.value = tabItems.value.map((tab) => {
        return tab.title == title ? { ...tab, isActive: true } : { ...tab, isActive: false };
    });
}

</script>


<style scoped>

header{
    border: 1px solid #dbcfcf;
    border-radius: 8px;
}
/* 
a{
    color: #686868;
    text-decoration: none;
    font-size: 20px;
} */

ul {
    display: flex;
    column-gap: 2rem;
    list-style: none;
    border: none;
    padding: 0;
    border-bottom: 1px solid #F0F0F0;
}

ul li {
    cursor: pointer;
}


ul li.active {
    padding: 0;
    border-bottom: 2px solid #398AB9 !important;
}

ul li a {
    text-decoration: none;
    font-weight: 600;
}


.badge{
    background-color: #F2F7FA;
    color: #398AB9;
    font-size: 16px;
}

.badge-text{
    display:inline-block;
    width:100%;
    word-wrap:break-word;
    white-space: normal;
}

.btn-konsultasi{
    background-color: #398AB9;
}
.btn-konsultasi:hover{
    background-color: #349edb;
}

.form-label{
    font-weight: 600;
    font-size: 15px;
    font-style: 'Inter';
}

.form-control, .form-select{
    border: none;
    border-radius: 0;
    border-bottom: 2px solid #AEAEAE;
    padding: 0;
}

.btn-lanjut{
    background-color: #398AB9;
}
.btn-lanjut:hover{
    background-color: #4398c9;
}

.card-kegiatan{
    border-radius: 10px 10px 2px 2px;
    border:none;
}
.card-kegiatan:hover{
    background-color: #E4F0F6;
}
.card h6{
    font-weight: 600;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.card-text{
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.card .btn{
    font-size: 14px;
}

.card-kegiatan .card-body{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

@media (max-width: 575.98px) {
    ul {
        gap: 1rem;
        flex-direction: column;
        text-align: center;
        justify-content: center;
    }
    
    .card-wrapper{
        gap: 3rem;
        flex-direction: column;
        text-align: center;
        justify-content: center;
    }

    .card-kegiatan{
        width: 18rem !important;
        margin: auto;
    }

    

    header{
        justify-content: center;
    }
    
    .badge-text{
        display:block;
        width:100%;
        word-wrap:break-word;
        white-space: normal;
    }
    
    
}



</style>