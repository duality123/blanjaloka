<template>
  <DashboardLayout title="Tambah Kegiatan" state="funding">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Tambah Investasi</h1>
    </div>
    <div class="d-flex mt-4">
      <Link href="/admin/investasi?page=1" class="text-decoration-none text-primary-blue-6 me-2">Investasi ></Link>
      <p class="text-neutral-gray-4"> Tambah Investasi</p>
    </div>
    <div class="row">
      <div class="col-lg-6">
    <form  @submit.prevent="submitForm()">
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Nama</label>
              <input type="text" class="form-control mb-3" v-model="form.name" id="kurikulum" placeholder="Masukkan deskripsi"
              >
               <small class="text-danger text-center" v-if="form.errors.name" >{{form.errors.name}}</small> 
            </div>
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Foto Bisnis</label>
               <div  class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="position-relative">
                        <h1 class="text-neutral-gray-5">Upload your file</h1>
                        <p class="text-neutral-gray-3">Format file .pdf, maks 10MB</p>
                      </div>
                      <div class="position-relative">
                        <h2 class="text-primary-blue-6">Pilih</h2>
                        <input @change="inputDokumen($event)" type="file" id="dokumen_legalitas">
                      </div>
                    </div>
               <small class="text-danger text-center" v-if="form.errors.foto_bisnis" >{{form.errors.fotto_bisnis}}</small> 


            </div>

<div v-for="item in form.foto_bisnis">
           
               <div  class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom mb-2">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="position-relative">
                        <h1 class="text-neutral-gray-5">{{item.name}}</h1>
                      </div>
                        <div class="position-relative">
                      <button @click="removeGambar(item)" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width:2px;"><span aria-hidden="true">&times;</span></button>
                    </div>
                    </div>
               <small class="text-danger text-center" v-if="form.errors.foto_bisnis" >{{form.errors.foto_bisnis}}</small> 


            </div>
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Jumlah Investasi</label>

              <input v-model="form.jumlah_investasi" type="number" class="form-control mb-3" id="kurikulum" placeholder="Masukkan deskripsi"
              >
               <small class="text-danger text-center" v-if="form.errors.jumlah_investasi">{{form.errors.jumlah_investasi}}</small> 
            </div>
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Target Investasi</label>

              <input v-model="form.target_investasi" type="number" class="form-control mb-3" id="kurikulum" placeholder="Masukkan target investasi"
              >
               <small class="text-danger text-center" v-if="form.errors.target_investasi">{{form.errors.target_investasi}}</small> 
            </div>
          <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Jumlah Investor</label>
              <input type="text" class="form-control mb-3" v-model="form.jumlah_investor" id="kurikulum" placeholder="Masukkan jumlah investor"
              >
               <small class="text-danger text-center" v-if="form.errors.jumlah_investor" >{{form.errors.jumlah_investor}}</small> 
            </div>
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Waktu balik modal start</label>
              <input type="datetime-local" v-model="form.waktu_balik_modal_start" class="form-control mb-3" id="kurikulum" placeholder="Masukkan waktu balik modal berawal"
              >
               <small class="text-danger text-center" v-if="form.errors.waktu_balik_modal_start" >{{form.errors.waktu_balik_modal_start}}</small> 
            </div>

             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Waktu balik modal end</label>
              <input type="datetime-local"  v-model="form.waktu_balik_modal_end" class="form-control mb-3" id="kurikulum" placeholder="Masukkan waktu balik modal berakhir"
              >
               <small class="text-danger text-center" v-if="form.errors.waktu_balik_modal_end" >{{form.errors.waktu_balik_modal_end}}</small> 
            </div>
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Minimum investasi</label>
              <input type="number" v-model="form.minimum_investasi" class="form-control mb-3" id="kurikulum" placeholder="Masukkan Minimum Investasi"
              >
               <small class="text-danger text-center"  v-if="form.errors.minimum_investasi" >{{form.errors.minimum_investasi}}</small> 
            </div>

             <div class="mb-4">
               <div class="form-check">
                <input class="form-check-input" type="checkbox" v-model="form.status"  id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Aktif
                </label>
            </div>
          </div>
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Kategori</label>
              <input type="text" v-model="form.kategori"  class="form-control mb-3" id="kurikulum" placeholder="Masukkan kategori"
              >
               <small class="text-danger text-center" v-if="form.errors.kategori">{{form.errors.kategori}}</small> 
            </div>
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Lokasi</label>
              <input type="text"  v-model="form.lokasi" class="form-control mb-3" id="kurikulum" placeholder="Masukkan lokasi"
              >
               <small class="text-danger text-center" v-if="form.errors.lokasi">{{form.errors.lokasi}}</small> 
            </div>
             <div class="d-flex justify-content-end">
                  <button  class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">Selanjutnya</button>
                </div>
              </form>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import { useForm, Link,usePage } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';
const form = useForm({
  name:'',
  foto_bisnis:[], 
  jumlah_investasi:null, 
  target_investasi:null,  
  jumlah_investor:null,
  waktu_balik_modal_start:null,
  waktu_balik_modal_end:null,
  minimum_investasi:null,
  persentase_hasil_investasi:null,
  kategori :null, 
  lokasi :null,
  status :null,
});


const refDeskripsikegiatan = ref(null);
const refJumlahPartisipan = ref(null);
const refMasaInkubasi = ref(null);
const handleResizeDeskripsiKegiatan = () => {
  refDeskripsikegiatan.value.style.height = `${refDeskripsikegiatan.value.scrollHeight}px`;
}
const handleResizeJumlahPartisipan = () => {
  refJumlahPartisipan.value.style.width = '1.5rem';
}
const inputDokumen=(event)=>{
        if(event.target.files[0].type == 'image/jpeg' ||event.target.files[0].type == 'image/png'){
          if(event.target.files[0].size >= 5000000){
          
            form.errors.foto_bisnis = "Size foto anda lebih dari 5MB!";
            return
          }
            form.foto_bisnis.push(event.target.files[0])
            form.errors.foto_bisnis = null
   
           }
           else{
            form.errors.foto_bisnis = "file yang anda upload bukan gambar !"

           }
    }
const removeGambar=(value)=>{
      const index = form.foto_bisnis.indexOf(value);
        if (index > -1) {
          form.foto_bisnis.splice(index, 1); 
}
}
const props = defineProps({
  investor:Object,
})
const handleResizeMasaInkubasi = () => {
  refMasaInkubasi.value.style.width = '1.5rem';
}
const submitForm = () => {
  form.post('/admin/investasi/tambah_investasi_post')
}
</script>

<style scoped>
  .close{
  border-width: 0px;
  background-color: transparent;
}
.input_upload_custom h1,
.input_upload_custom h2 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0;
}
.input_upload_custom .position-relative {
  overflow: hidden;
  cursor: pointer;
}
.input_upload_custom p {
  font-size: 0.75rem;
  font-weight: 400;
  margin-bottom: 0;
}
.input_upload_custom input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
form section h2 {
  font-size: 1.25rem;
}
.form-control {
  background-color: transparent;
  resize: none;
}
textarea::-webkit-scrollbar {
  display: none;
}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;

}
.custom-file-input::before {

  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0\00a0Upload Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload.png');
  background-repeat: no-repeat;
  background-size: 18px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

.custom-file-input2::-webkit-file-upload-button {
  visibility: hidden;

}

.custom-file-input2::before {
  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0  Ambil Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload2.png');
  background-repeat: no-repeat;
  background-size: 18px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input2:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}

.form-control {
  border: none;
  border-radius: 0;
  border-bottom: 2px solid #AEAEAE;
  padding-left: 0;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
}
.desc_count {
  font-size: 0.75rem;
  font-weight: 400;
  color: #3E4041;
  position: absolute;
  right: 0;
  bottom: -1.5rem;
}
.count_input {
  width: 14rem;
}
.count_input_leading {
  position: absolute;
  right: -3.5rem;
  bottom: 0.5rem;
}
.telp_input .form-control {
  padding-left: 2.5rem !important;
}
.telp_input .telp_leading {
  position: absolute;
  left: 0;
  bottom: 0.5rem;
}
form button {
  padding: 0.75rem 1.5rem;
}
</style>
