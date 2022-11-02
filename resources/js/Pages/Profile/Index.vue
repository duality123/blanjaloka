<template>
    <Layout>
        <div class="profile-saya">
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
                                                <img :src="currentFile.fotoProfile" alt="" class="d-block mx-auto w-50 h-50">
                                                <div class="d-flex justify-content-between align-items-center mt-3 ">
                                                    <label for="profile" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-file-arrow-up" />  Upload Gambar</label>
                                                    <input class="form-control formFile" type="file" @input="formFile.fotoProfile = $event.target.files[0]" id="profile" @change="onFileChange($event, 'profile')">
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
                                            <input type="text" class="form-control" id="nama" v-model="formFile.nama" placeholder="Masukkan nama lengkap Anda">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="tempat_kelahiran" class="form-label">Tempat Kelahiran</label>
                                            <select class="form-select" aria-label="Default select example" v-model="formFile.tempat_lahir">
                                                <option disabled selected>Pilih tempat kelahiran Anda</option>
                                                <option value="Purwokerto">Purwokerto</option>
                                                <option value="Purbalingga">Purbalingga</option>
                                                <option value="Banyumas">Banyumas</option>
                                            </select>
                                        </div>
                                        
                                        <div class=" mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" :class="inputDate" v-model="formFile.tanggal_lahir">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                            <select class="form-select" aria-label="Default select example" v-model="formFile.pendidikan_terakhir">
                                                <option disabled selected>Pilih pendidikan terakhir Anda</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMK">SMK</option>
                                                <option value="Kuliah">Kuliah</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                                            <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat tinggal Anda" v-model="formFile.alamat">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="kelurahan" class="form-label">Kelurahan</label>
                                            <select class="form-select" aria-label="Default select example" v-model="formFile.kelurahan">
                                                <option disabled selected>Pilih kelurahan tempat tinggal Anda</option>
                                                <option value="Grendeng">Grendeng</option>
                                                <option value="Pabuaran">Pabuaran</option>
                                                <option value="Sumampir">Sumampir</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="kecamatan" class="form-label">Kecamatan</label>
                                            <select class="form-select" aria-label="Default select example" v-model="formFile.kecamatan">
                                                <option disabled selected>Pilih kecamatan tempat tinggal Anda</option>
                                                <option value="Purwokerto Utara">Purwokerto Utara</option>
                                                <option value="Purwokerto Timur">Purwokerto Timur</option>
                                                <option value="Purwokerto Barat">Purwokerto Barat</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="kabupaten" class="form-label">Kabupaten</label>
                                            <select class="form-select" aria-label="Default select example" v-model="formFile.kabupaten">
                                                <option disabled selected>Pilih kabupaten tempat tinggal Anda</option>
                                                <option value="Banyumas">Banyumas</option>
                                                <option value="Ajibarang">Ajibarang</option>
                                                <option value="Purbalingga">Purbalingga</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="provinsi" class="form-label">Provinsi</label>
                                            <select class="form-select" aria-label="Default select example" v-model="formFile.provinsi">
                                                <option disabled selected>Pilih provinsi tempat tinggal Anda</option>
                                                <option value="Jawa Tengah">Jawa Tengah</option>
                                                <option value="Jawa Barat">Jawa Barat</option>
                                                <option value="Jawa Timur">Jawa Timur</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="tab" v-if="currentTab == 3">
                                        
                                        <div class="mb-3">
                                            <h4 for="" class="form-label font-bold ">Unggah Foto KTP</h4>
                                            <p class="text-muted">Foto KTP harus jelas dapat terlihat dan dapat terbaca.</p>
                                            <div class="input-profile rounded p-2">
                                                <img :src="currentFile.fotoKTP" alt="" class="d-block mx-auto w-50 h-50">
                                                <div class="d-flex justify-content-between align-items-center mt-3 ">
                                                    <label for="ktp" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-file-arrow-up" />  Upload Gambar</label>
                                                    <input class="form-control formFile" type="file" @input="formFile.fotoKTP = $event.target.files[0]" id="ktp" @change="onFileChange($event, 'ktp')">
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
                                                <img :src="currentFile.fotoSelfie" alt="" class="d-block mx-auto w-50 h-50">
                                                <div class="d-flex justify-content-between align-items-center mt-3 ">
                                                    <label for="selfie" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-file-arrow-up" />  Upload Gambar</label>
                                                    <input class="form-control formFile" type="file" @input="formFile.fotoSelfie = $event.target.files[0]" id="selfie" @change="onFileChange($event, 'selfie')">
                                                    <label for="" class="text-primary">atau</label>
                                                    <label for="formFile" id="formFileLabel" class="p-2 rounded-4"><font-awesome-icon icon="fa-solid fa-camera" />  Ambil Gambar</label>
                                                    <input class="form-control formFile" type="file" id="">
                                                </div>
                                                <p class="text-muted text-center mt-3">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div v-if="currentTab != 3" class="btn btn-lanjut float-end text-white" @click="nextStep(1)">Selanjutnya</div>
                                    <div v-else class="btn btn-lanjut float-end text-white" @click="submit">Submit</div>
                                    
                                    
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
import {  reactive, ref, watch } from 'vue';
import Layout from '../../Layouts/Layout.vue';
import Sidebar from '../../Layouts/components/profile/Sidebar.vue'
import { Inertia } from '@inertiajs/inertia';

export default{
    components:{
        Layout,
        Sidebar
    },
    props:{
        errors: Object,
        user: Object
    },
    setup(props){
        const currentTab = ref(1);
        const inputDate = ref('inputInvisible')
        const isCameraOpen = ref(false)
        
        const formFile = useForm({
            id:props.user.id,
            nama: '',
            tempat_lahir: '',
            tanggal_lahir: '',
            pendidikan_terakhir: '',
            alamat: '',
            kelurahan:'',
            kecamatan:'',
            kabupaten:'',
            provinsi:'',
            fotoProfile: '',
            fotoKTP: '',
            fotoSelfie: ''
        })
        
        
        
        
        
        
        const currentFile = reactive({
            fotoProfile:'http://127.0.0.1:5173/resources/js/assets/icons/icon_account_circle.png',
            fotoKTP:'http://127.0.0.1:5173/resources/js/assets/icons/icon_account_circle.png',
            fotoSelfie:'http://127.0.0.1:5173/resources/js/assets/icons/icon_account_circle.png'
        })
        
        
        
        watch(
        () => formFile.tanggal_lahir,
        (tanggal_lahir, prevValue) => {
            formFile.tanggal_lahir != null ? inputDate.value = 'inputVisible' : inputDate.value = 'inputInvisible'
            
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
            reader.onload = (e) => {
                
                if(type == 'profile') {
                    currentFile.fotoProfile = e.target.result;
                }else if(type == 'ktp'){
                    currentFile.fotoKTP = e.target.result;
                }else if(type == 'selfie'){
                    currentFile.fotoSelfie = e.target.result;
                }
                
            };
            
            reader.readAsDataURL(files[0]);
        }
        
        const submit = () => {
            Inertia.post(`/profile-saya/`, formFile);
        }
        
        
        
        return {currentTab,  nextStep,  inputDate, onFileChange, formFile, submit, currentFile}
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