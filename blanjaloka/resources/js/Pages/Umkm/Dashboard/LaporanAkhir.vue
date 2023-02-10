<template>
 
<Layout state="tugas_akhir" :link="kegiatan.id" :title="kegiatan.tema">
  <div class="my-4 d-flex align-items-center borderc gap-3">
      <h2 class="text-neutral-gray-5 m-0 me-auto">Tugas Akhir</h2>
  </div>
     <div class="mt-4 mb-5">
    <div v-if="tugas == null"><h2 class="text-neutral-gray-5 m-0 me-auto">Belum ada soal untuk sekarang</h2></div>
<div v-for="(item,no) in tugas">
    <div class="d-flex bd-highlight">
          <div class="p-2 flex-grow-1 bd-highlight"> 
              <p class="fw-semibold text-primary-blue-6 mb-0">
                  {{++no}}. {{item.soal}}  
              </p>
          </div>
    </div>
  </div>
</div>
 <div class="col-lg-12 MT-4">
      <div class=" d-flex justify-content-center">
      <h2>Jawaban Anda</h2>
    </div>
    <div class="mt-2">
      <form @submit.prevent="submit()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan jawaban anda </label>
         <input type="text" class="form-control" v-model="form.jawaban" id="provinsi" placeholder="Masukkan jawaban anda" >
           <small class="text-danger" v-if="form.errors.jawaban">{{ form.errors.jawaban }}</small>
      </div>
         <div class="mb-4">
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Gambar</label>
          <div class="card text-white bg-neutral-gray-1 mb-3  " style="overflow: hidden; width: 30rem;">
            <div class="d-flex justify-content-center pt-3 mb-4" v-if="this.previewImage">
                   <img :src="`${$page.props.asset_url}/${this.previewImage}`" alt="update icon" style="overflow: hidden; width: 10%;" id="img" >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4" >
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="img" >
                </div>
    
                <div class="row" style="margin-left:2px;" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" ref ="foto_profil" class="custom-file-input " @change="ubahGambar($event)"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-center">
                <p class="text-primary" style="padding-right: 6px;">atau</p>
                </div>
                  <div class="col d-flex justify-content-end" >
                <input type="file" class="custom-file-input2" style="width: 9rem;">
                </div>
                </div>
                 <small class="text-danger text-center" v-if="form.errors.gambar">{{form.errors.gambar}}</small>
                <div class="text-neutral-gray-3 text-center"><p class="fs-9">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p></div>
            </div>
          </div>
       <div class="mb-4">
         <label for="dokumen_legalitas" class="form-label text-neutral-gray-5 mb-2">Upload file</label>
         <div  class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="flex-grow-1" v-if="form.file == null">
                        <p class="text-neutral-gray-5">Upload your file</p>
                        <p class="text-neutral-gray-3">Format file .pdf, maks 10MB</p>
                      </div>
                       <div class="flex-grow-1" v-else-if="fileReviewer" >
                        <a :href="`${$page.props.asset_url}/${fileReviewer}`" class="text-neutral-gray-5">Lihat Bukti</a>
                      </div>
                       <div class="flex-grow-1" v-else>
                        <p class="text-neutral-gray-5">form.file.name</p>
                      </div>
                      <div class="position-relative">
                        <p class="text-primary-blue-6">Pilih</p>
                        <input @change="inputDokumen($event)" type="file" id="dokumen_legalitas">
                      </div>
                    </div>
                     <small class="text-danger text-center" v-if="form.errors.file" >{{form.errors.file}}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>  
          

  </Layout>
</template>


<script>
import Layout from '../../../Layouts/Kegiatanku.vue'
import { useForm, Link,usePage } from '@inertiajs/inertia-vue3'
export default{
  data(){
    return{
      popup:false,
      previewImage:null,
      fileReviewer:null
    }
  },
  setup(props){
   const form = useForm({
     jawaban:props.jawaban.jawaban,
     file:props.jawaban.file,
     gambar:props.jawaban.gambar,
     kegiatan_id: props.kegiatan.id
    })

   

    return {form}
  },

  components:{
    Layout,
    Link
  },
 
  methods:{
    submit(){
      this.popup=false;
      this.form.post('/umkm/dashboard/kegiatanku/tugas_akhir',{onSuccess: () => this.form.reset()})

    },
    popupExit(){
      this.popup = !this.popup
      this.previewImage = this.form.gambar
      this.fileReviewer = this.form.file
    },
    ubahGambar(event){
      if(event.target.files[0].type == 'image/jpeg' || event.target.files[0].type == 'image/png'){
        
            if(event.target.files[0].size >= 5000000){
              this.form.errors.gambar = "Size foto anda lebih dari 5MB !" 
              return
            }
        var image = document.getElementById('img');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.width = '10rem';
        image.style.overflow = 'hidden';
        this.form.gambar = event.target.files[0];
      }
      else{
        this.form.errors.gambar = "File yang anda upload bukanlah gambar !" 
         //console.log(event.target.files[0].type)
         return
      }
    },
     inputDokumen(event){
        if(event.target.files[0].type == 'application/pdf' || event.target.files[0].type == 'application/msword' || event.target.files[0].type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
            this.form.file = event.target.files[0]
            this.fileReviewer = null
            this.form.errors.file= null
   
           }
           else{
            this.form.errors.file = "dokumen anda harus pdf/docx !"

           }
    },
  },
  props:{
    tugas:Object,
    kegiatan:Object,
    jawaban:Object
  }


}

</script>


<style scoped>

section {
  margin-top: 10rem !important;
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
.modal-content{
  text-align: start;
}
.fs-btn {
    font-size: .875rem;
}

ul {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}

ul li {
  cursor: pointer;
}

ul li {
  padding-bottom: 0.5rem;
}

ul li a.active {
  border-bottom: 2px solid #398AB9;
  color:  #398ab9;
}

ul li a {
  text-decoration: none;
  font-weight: 600;
  color: black;
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
 .modal-content{
  height: 450px;
  overflow-y: scroll;
  text-align:start;
 }
.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.sidebar ul li {
  padding: 1rem;
  cursor: pointer;
}
 .modal-content{
  height: 450px;
  overflow-y: scroll;
 }
.sidebar ul li.active {
  border: 1px solid #AEAEAE;
  border-radius: 0.5rem;
}

.sidebar ul li.active a span,
.sidebar ul li.active a path {
  color: #398AB9;
  fill: #398AB9;
}

.sidebar ul li a {
  width: max-content;
  text-decoration: none;
  font-weight: 600;
  position: relative;
}

.sidebar ul li a span {
  width: max-content;
  position: absolute;
  left: 2rem;
}

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 1rem;
}

.step .number {
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.25rem;
  font-weight: 600;
  border-radius: 50%;
  background-color: #D9D9D9;
  color: #FFFFFF;
}

.step h1 {
  font-size: 1.125rem;
  font-weight: 600;
  color: #AEAEAE;
}
 .modal-content{
  height: 450px;
  overflow-y: scroll;
 }
.step.clear .number {
  background-color: #398AB9;
}

.step.clear h1 {
  color: #3E4041;
}

h2 {
  font-size: 1.25rem;
  font-weight: 600;
}

table thead tr td,
table thead tr th {
  font-weight: 600;
  color: #3E4041;
  border: none;
  text-align: center;
}

table tbody tr td,
table tbody tr th {
  font-weight: 400;
  color: #3E4041;
  border-bottom: none;
  text-align: center;
  background-color: #F0F0F0;
}

table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
  background-color: #F2F7FA;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>
