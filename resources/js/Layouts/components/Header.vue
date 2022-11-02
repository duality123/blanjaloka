<template>
    
    <div v-if="kelengkapan && $page.props.auth.is_authenticated" class="lengkapi-profile d-flex justify-content-center pt-2 pb-1">
        
        <p class="mt-2 text-white">Silahkan lengkapi data diri Anda</p>
        <div class="mx-2 btn btn-lengkapi-profile" @click="btnLengkapiprofile">Lengkapi Profile</div>
        
    </div>
    <nav class="navbar  navbar-expand-lg " :class="{'fixed-top': navbarFixedTop}">
        <a class="navbar-brand" href="#">
            <img src="../../assets/images/blanjaloka_logo.png" alt="blanjaloka logo" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blanjaloka_navbar"
        aria-controls="blanjaloka_navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse me-5 pe-5" id="blanjaloka_navbar">
        <div class="navbar-nav ms-auto">
            <a href="#" class="nav-link text-neutral-gray-4">Beranda</a>
            <a href="#" class="nav-link text-neutral-gray-4">Tentang Program</a>
            <a href="#" class="nav-link text-neutral-gray-4">Panduan</a>
        </div>
        <div class="navbar-nav gap-3 ms-auto" v-if="!$page.props.auth.is_authenticated">
            <Link href="/login"
            class="btn btn-outline-primary-blue-6 text-primary-blue-6 px-4 py-2 border-5 btn_custom_outline">
            Masuk</Link>
            <Link href="/kebijakan" class="btn btn-primary-blue-6 text-white px-4 py-2">Daftar</Link>
        </div>
        <div class="navbar-nav ms-auto profile-menu" v-else>
            <img src="../../assets/images/user_profile_img.png" alt="">
            <div class="dropdown">
                <button class="btn btn-profile" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../../assets/icons/icon_menu.png" alt="">
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/profile-saya/">Profile Saya</a></li>
                    <li><a class="dropdown-item" @click="logout">Logout</a></li>
                </ul>
            </div>
        </div>
        
    </div>
    
</nav>
</template>

<script>
import { Link, usePage } from '@inertiajs/inertia-vue3';
//import inertia adapter
import { Inertia } from "@inertiajs/inertia";
import { ref, reactive, computed } from '@vue/reactivity';
import { onMounted } from 'vue';
import axios from 'axios';
export default {
    
    components: {
        Link
    },
    methods: {
        
    },
    setup(){
        const navbarFixedTop = ref(true)
        const is_authenticated = computed(() => usePage().props.value.auth.is_authenticated)
        const kelengkapan = ref(false);
        const user_id = ref(null);
        
        
        onMounted(()=>{
            
            axios.get('/user')
            .then(res => {
                
                if(is_authenticated.value){
                    user_id.value = res.data.id;
                    if(
                    (res.data.foto_profile != null && res.data.foto_profile != '')  && 
                    (res.data.ktp != null && res.data.ktp != '')  &&
                    (res.data.foto_selfie != null && res.data.foto_selfie != '')  &&
                    (res.data.nama != null && res.data.nama != '')  &&
                    (res.data.tempat_kelahiran != null && res.data.tempat_kelahiran !='')  &&
                    (res.data.tanggal_lahir != null && res.data.tanggal_lahir)  &&
                    (res.data.pendidikan_terakhir != null && res.data.pendidikan_terakhir)  &&
                    (res.data.alamat != null && res.data.alamat)  &&
                    (res.data.kelurahan != null && res.data.kelurahan)  &&
                    (res.data.kabupaten != null && res.data.kabupaten)  &&
                    (res.data.provinsi != null && res.data.provinsi )) {
                        kelengkapan.value = false;
                        navbarFixedTop.value = true;
                    }else{
                        kelengkapan.value = true;
                        navbarFixedTop.value = false;
                    }
                }else{
                    navbarFixedTop.value = true;
                }
                
            })
            
            
            
            
            
            
        })
        
        
        const logout = () => {
            Inertia.post("/logout", {
                _token: this.$page.props.csrf_token,
            });
        }
        
        const btnLengkapiprofile = ()=>{
            Inertia.get(`/profile-saya`);
        }
        return {kelengkapan, logout, btnLengkapiprofile, navbarFixedTop}
        
    }
}
</script>

<style scoped>

.lengkapi-profile{
    background-color: #398AB9;
}

.btn-lengkapi-profile{
    background-color: transparent;
    color: #FFFFFF;
    border: 1px solid #FFFFFF;
    max-height: 40px;
}
.btn-lengkapi-profile:hover{
    background-color: transparent;
    color: #FFFFFF;
    border: 1px solid #FFFFFF;
    max-height: 40px;
}
.nav-link,
a.btn {
    font-weight: 600;
}

.navbar{
    margin-left: 80px;
    margin-right: 80px;
}
.btn_custom_outline {
    border-width: 2px !important;
}

.btn_custom_outline:hover {
    color: #FFFFFF !important;
}

.btn-profile{
    border: none;
}

.btn-profile:hover{
    border: none;
}

.profile-menu{
    background: #FFFFFF;
    border-radius: 60px;
}

@media (max-width: 575.98px) {
    nav {
        background-color: #FFFFFF;
    }
    .navbar{
        margin-left: 0;
        margin-right: 0;
        padding-left: 10px;
        padding-right: 10px;
    }
}
</style>
