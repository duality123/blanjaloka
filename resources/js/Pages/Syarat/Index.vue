<template>
    <LayoutVue>
        <div class="container">
            <h2>Syarat & Ketentuan</h2>
            
            <div class="syarat-ketentuan">
                <p>Berikut adalah syarat dan ketentuan untuk UMKM dapat mengikuti inkubasi di Blanjaloka Akselerator</p>
                <ol class="px-3">
                    <li>UMKM Anda telah terdaftar sebagai seller di Blanjaloka</li>
                    <li>Berada pada usia produktif yaitu 15 sampai 64 tahun (Menurut Badan Pusat Statistik (BPS))</li>
                    <li>UMKM Anda merupakan milik Anda sendiri dan telah berjalan minimal 6 bulan</li>
                    <li>Melengkapi data pribadi dan usaha yang diperlukan</li>
                </ol>
            </div>
            
            <div class="d-flex justify-content-center mt-5 mb-3">
                <input class="form-check-input mt-1 me-2" type="checkbox" value="" aria-label="Checkbox for following text input" @click="handleToggleButtonLanjut">
                <p>Saya telah membaca dan menyetujui Syarat dan Ketentuan dari aplikasi Blanjaloka Akselerator seperti yang tertera diatas</p>
            </div>
            
            <div class="d-flex justify-content-center my-2">
                <button class="btn btn-lanjut btn-primary-blue-6 text-white px-4 py-2" :disabled="toggleButtonLanjut" @click="handleButtonLanjut">Lanjutkan</button>
            </div>
        </div>
    </LayoutVue>
</template>

<script>
    import { ref } from 'vue';
import LayoutVue from '../../Layouts/Layout.vue';
    export default{
        components:{
            LayoutVue
        },

        setup(){
            const toggleButtonLanjut = ref(true);

            const handleToggleButtonLanjut = () =>{
                toggleButtonLanjut.value = !toggleButtonLanjut.value;
            }

            const handleButtonLanjut = () => {
                window.location.href = '/register'
            }
            return {toggleButtonLanjut, handleToggleButtonLanjut, handleButtonLanjut}
        }
    }
</script>

<style scoped>
    
    h2{
        font-family: 'Inter';
        font-style: normal;
        font-weight: 600;
        font-size: 34px;
        line-height: 140%;
        color: #181A1B;
    }
    
    .kebijakan-privasi{
        margin-top: 32px;
    }
    
    .btn-lanjut{
        width: 400px;
        height: 46px;
    }
</style>
