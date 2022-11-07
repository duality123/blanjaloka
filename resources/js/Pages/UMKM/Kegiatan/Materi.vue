<template>
    <Layout>
        <div class="materi">
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
                                
                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">E-learning</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Membuat Unique Values Produk</li>
                                        <li class="breadcrumb-item active" aria-current="page">Membuat Unique Values Produk</li>
                                    </ol>
                                </nav>
                                
                                <video controls class="rounded">
                                    <source src="../../../assets/videos/countdown.mp4" type="video/mp4">
                                </video>

                                <h3 class="mt-4">Bab 1 : Menentukan Pasar</h3>
                                <p>
                                    Pada bab ini kamu akan mempelajari lorem ipsum dolor sit amet, consectetur adipiscing elit. Metus mauris, imperdiet dui ipsum euismod in mauris praesent blandit. Massa molestie interdum id viverra est proin mattis. Id eget at justo, est accumsan non, tortor, odio non. Integer gravida velit a at mauris mi. Non at amet sit pellentesque tempor, nibh in. Nascetur fermentum tincidunt fusce et, cursus. Vel nascetur quis commodo consectetur. Ultrices montes, in iaculis cras facilisi. Faucibus et augue viverra eleifend. Nec mi ultrices platea purus non vitae integer diam, mauris.
                                </p>
                                
                                <div class="float-end">
                                    <button class="btn btn-outline-primary">Bab Selanjutnya</button>
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
video{
    width: 100%;
}
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

.number{
    background-color: #398AB9;
    color: #ffffff;
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
    background-color: #fdfdfd;
    color: #181A1B;
    font-size: 16px;
    border-radius: 20px;
    text-decoration: none;
}

.badge:active{
    background-color: #2F739A;
}

.badge:hover{
    background-color: #E4F0F6;
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
        background-color: #349edb;
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