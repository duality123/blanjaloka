<template>
    <Layout>
        <div class="profile-saya">
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
                                
                                <div class="badge badge mt-3 p-3 rounded-pill ">
                                    <font-awesome-icon icon="fa-solid fa-exclamation" class="d-none d-lg-inline-block" />
                                    <span class="mx-2 badge-text">Eventual merupakan layanan konsultasi antara pelaku UMKM dan mentor setiap minggunya.</span>
                                </div>
                                
                                <div class="d-flex p-1 mt-4 justify-content-between align-items-center header-eventual">
                                    <p class="mt-4 fs-5 font-bold">Riwayat Eventual Anda</p>
                                    <button class="btn btn-konsultasi text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Daftar Konsultasi</button>
                                </div>
                                
                                <table class="table table-striped text-center">
                                    <thead class="table-primary">
                                        <tr class="">
                                            <th scope="col">Minggu</th>
                                            <th scope="col">Perihal</th>
                                            <th scope="col">Nama Mentor</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">11</td>
                                            <td>Diskusi terkait enhance produk</td>
                                            <td>-</td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button class="btn btn-warning text-white me-1">Menunggu Konfirmasi</button>
                                                    <button class="btn"><font-awesome-icon icon="fa-solid fa-exclamation" class="d-none d-md-block" /></button>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">10</td>
                                            <td>Diskusi terkait enhance produk</td>
                                            <td>Bu Malika</td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button class="btn btn-primary text-white me-3">Ikuti Konsultasi</button>
                                                    <button class="btn">
                                                        <font-awesome-icon icon="fa-solid fa-exclamation" class="d-none d-md-block" />
                                                    </button>
                                                    
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">9</td>
                                            <td>Diskusi terkait enhance produk</td>
                                            <td>Pak Sulaiman</td>
                                            <td><button class="btn btn-success text-white">Selesai</button>
                                                <button class="btn">
                                                    <font-awesome-icon icon="fa-solid fa-exclamation" class="d-none d-md-block " />
                                                </button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-body">
                            <h5 class="text-center mb-4">Daftar Konsultasi</h5>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" placeholder="Adelia Rizma">
                            </div>
                            <div class="mb-3">
                                <label for="usaha" class="form-label">Nama Usaha</label>
                                <input type="text" class="form-control" id="usaha" placeholder="Londry Onlen">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Jalan Raya Merah Putih No. 10">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="adelia123@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon" placeholder="+626135613129">
                            </div>
                            
                            <div class="mb-3">
                                <label for="kontak" class="form-label">Anda ingin dihubungi melalui:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Email
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Whatsapp
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="diskusi" class="form-label">Hal apa yang ingin Anda diskusikan?</label>
                                <input type="text" class="form-control" id="diskusi" placeholder="Diskusi cara membuat produk lebih menarik">
                            </div>
                            
                            <button class="btn btn-primary text-white float-end">Kirim</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </Layout>
    </template>
    
    <script setup>
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

@media (max-width: 575.98px) {
    ul {
        gap: 1rem;
        flex-direction: column;
        text-align: center;
        justify-content: center;
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

@media (max-width: 575.98px) {
}


</style>