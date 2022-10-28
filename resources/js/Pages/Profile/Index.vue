<template>
    <Layout>
        <div class="profile-saya  py-5">
            <div class="container ">
                <div class="row">
                    
                    <!-- Sidebar -->
                    <Sidebar />
                    <div class="col col-md-8">
                        <div class="card" style="width: 25rem;">
                            <div class="card-body">
                                
                                <div class="d-flex justify-content-between">
                                    <h6>Profile Saya</h6>
                                    <div class="text-muted">Langkah {{currentTab}} dari 3</div>
                                </div>
                                
                                <form action="" class="mt-4">
                                    <div class="tab" v-if="currentTab == 1">
                                        <div class="mb-3">
                                            <h4 for="" class="form-label font-bold ">Foto Profile</h4>
                                            <p class="text-muted">Wajah pada profil foto harus jelas. Foto yang baik mungkin akan membantu Anda dalam proses inkubasi kedepannya.</p>
                                            <div class="input-profile rounded p-2">
                                                <img :src="formFile.fotoProfile.currentFile" alt="" class="d-block mx-auto w-50 h-50">
                                                <div class="d-flex justify-content-between align-items-center mt-3 ">
                                                    <label for="profile" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-file-arrow-up" />  Upload Gambar</label>
                                                    <input class="form-control formFile" type="file" id="profile" @change="onFileChange($event, 'profile')">
                                                    <label for="" class="text-primary">atau</label>
                                                    <label for="formFile" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-camera" />  Ambil Gambar</label>
                                                    <input class="form-control formFile" type="file" id="">
                                                </div>
                                                <p class="text-muted text-center mt-3">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="tab" v-if="currentTab == 2">
                                        <h6 >Data Diri</h6>
                                        <p class="text-muted">Harap masukkan sesuai dengan data diri dan kondisi Anda saat ini!</p>
                                        
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap Anda">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="tempat_kelahiran" class="form-label">Tempat Kelahiran</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option disabled selected>Pilih tempat kelahiran Anda</option>
                                                <option value="1">Purwokerto</option>
                                                <option value="2">Purbalingga</option>
                                                <option value="3">Banyumas</option>
                                            </select>
                                        </div>
                                        
                                        <div class=" mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" :class="inputDate" v-model="form.tanggal_lahir">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option disabled selected>Pilih pendidikan terakhir Anda</option>
                                                <option value="1">SMP</option>
                                                <option value="2">SMK</option>
                                                <option value="3">Kuliah</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                                            <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat tinggal Anda">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="kelurahan" class="form-label">Kelurahan</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option disabled selected>Pilih kelurahan tempat tinggal Anda</option>
                                                <option value="1">Grendeng</option>
                                                <option value="2">Pabuaran</option>
                                                <option value="3">Sumampir</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="kecamatan" class="form-label">Kecamatan</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option disabled selected>Pilih kecamatan tempat tinggal Anda</option>
                                                <option value="1">Purwokerto Utara</option>
                                                <option value="2">Purwokerto Timur</option>
                                                <option value="3">Purwokerto Barat</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="kabupaten" class="form-label">Kabupaten</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option disabled selected>Pilih kabupaten tempat tinggal Anda</option>
                                                <option value="1">Banyumas</option>
                                                <option value="2">Ajibarang</option>
                                                <option value="3">Purbalingga</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="provinsi" class="form-label">Provinsi</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option disabled selected>Pilih provinsi tempat tinggal Anda</option>
                                                <option value="1">Jawa Tengah</option>
                                                <option value="2">Jawa Barat</option>
                                                <option value="3">Jawa Timur</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="tab" v-if="currentTab == 3">
                                        
                                        <div class="mb-3">
                                            <h4 for="" class="form-label font-bold ">Unggah Foto KTP</h4>
                                            <p class="text-muted">Foto KTP harus jelas dapat terlihat dan dapat terbaca.</p>
                                            <div class="input-profile rounded p-2">
                                                <img :src="formFile.fotoKTP.currentFile" alt="" class="d-block mx-auto w-50 h-50">
                                                <div class="d-flex justify-content-between align-items-center mt-3 ">
                                                    <label for="ktp" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-file-arrow-up" />  Upload Gambar</label>
                                                    <input class="form-control formFile" type="file" id="ktp" @change="onFileChange($event, 'ktp')">
                                                    <label for="" class="text-primary">atau</label>
                                                    <label for="formFile" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-camera" />  Ambil Gambar</label>
                                                    <input class="form-control formFile" type="file" id="">
                                                </div>
                                                <p class="text-muted text-center mt-3">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h4 for="" class="form-label font-bold ">Unggah Foto KTP + Selfie</h4>
                                            <p class="text-muted">Foto KTP harus jelas dapat terlihat dan dapat terbaca.</p>
                                            <div class="input-profile rounded p-2">
                                                <img :src="formFile.fotoSelfie.currentFile" alt="" class="d-block mx-auto w-50 h-50">
                                                <div class="d-flex justify-content-between align-items-center mt-3 ">
                                                    <label for="selfie" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-file-arrow-up" />  Upload Gambar</label>
                                                    <input class="form-control formFile" type="file" id="selfie" @change="onFileChange($event, 'selfie')">
                                                    <label for="" class="text-primary">atau</label>
                                                    <label for="formFile" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-camera" />  Ambil Gambar</label>
                                                    <input class="form-control formFile" type="file" id="">
                                                </div>
                                                <p class="text-muted text-center mt-3">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="btn btn-lanjut float-end text-white" @click="nextStep(1)">Selanjutnya</div>
                                    
                                </form>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>


import { useForm } from '@inertiajs/inertia-vue3';
import {  ref, watch } from 'vue';
import Layout from '../../Layouts/Layout.vue';
import Sidebar from '../../Layouts/components/profile/Sidebar.vue'

export default{
    components:{
        Layout,
        Sidebar
    },
    setup(){
        const currentTab = ref(1);
        const inputDate = ref('inputInvisible')
        const isCameraOpen = ref(false)
        
        const formFile = useForm({
            fotoProfile: {
                currentFile:'http://127.0.0.1:5173/resources/js/assets/icons/icon_account_circle.png',
                name: null
            },
            fotoKTP: {
                currentFile:'http://127.0.0.1:5173/resources/js/assets/icons/icon_account_circle.png',
                name: null
            },
            fotoSelfie: {
                currentFile:'http://127.0.0.1:5173/resources/js/assets/icons/icon_account_circle.png',
                name: null
            }
        })
        
        const form = useForm({
            tanggal_lahir : null
        })
        
        watch(
        () => form.tanggal_lahir,
        (tanggal_lahir, prevValue) => {
            form.tanggal_lahir != null ? inputDate.value = 'inputVisible' : inputDate.value = 'inputInvisible'
            
        }
        )        
        
        const nextStep = (n)=>{
            const btn = document.getElementsByClassName('btn-lanjut')[0]
            btn.style.backgroundColor= '#398AB9';
            currentTab.value = currentTab.value + n;
            
        }
        
        const onFileChange = (e, type) => {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
            return;
            
            var reader = new FileReader();
            console.log(type)
            reader.onload = (e) => {
                
                if(type == 'profile') {
                    formFile.fotoProfile.currentFile = e.target.result;
                    formFile.fotoProfile.name = files[0].name;
                }else if(type == 'ktp'){
                    formFile.fotoKTP.currentFile = e.target.result;
                    formFile.fotoKTP.name = files[0].name;
                }else if(type == 'selfie'){
                    console.log('oke')
                    formFile.fotoSelfie.currentFile = e.target.result;
                    formFile.fotoSelfie.name = files[0].name;
                }

                console.log(formFile);
            };
            
            reader.readAsDataURL(files[0]);
        }
        
        
        
        return {currentTab,  nextStep, form, inputDate, onFileChange, formFile}
    },
}
</script>

<style scoped>



.form-label{
    font-weight: 600;
    font-size: 15px;
    font-style: 'Inter';
}

.input-profile{
    background-color: #F0F0F0;
}


.inputInvisible{
    color: transparent;
}

.inputVisible{
    color: rgb(0, 0, 0)
}


#formFileLabel{
    cursor:pointer;
    background: #FFF;
    font-size: 12px;
    font-style: 'Inter';
    font-weight: 400;
}

.formFile{
    opacity: 0;
    position: absolute;
    z-index: -1;
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






</style>