<template>
   <BaseLayout title="UMKM Profile">
    <section class="mt-10">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
            <div class="col-lg-8">
              <div  class="card-body" >
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">1</span>
                    dari 1</p>
                </div>
                <h2 class="mt-4">Profil Produk</h2>
                <p class="text-neutral-gray-5">Harap masukkan sesuai dengan data diri dan kondisi Anda saat ini!</p>
                <form @submit.prevent="submit()">
                  <div class="mb-4">
                    <label for="nama_lengkap" class="form-label text-neutral-gray-5">Nama Produk</label>
                    <input type="text" v-model="form.jenis_produk"  class="form-control" id="nama_lengkap" placeholder="Masukkan nama produk Anda" >
                     <small class="text-danger" v-if="form.errors.jenis_produk">{{ form.errors.jenis_produk}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="tempat_kelahiran" class="form-label text-neutral-gray-5">Jumlah Produk Yang Dijual</label>
                    <input type="number" class="form-control"  v-model="form.jumlah_produk_yang_dijual" id="tempat_kelahiran" placeholder="Masukkan jumlah total produk anda">
                     <small class="text-danger" v-if="form.errors.jumlah_produk_yang_dijual">{{ form.errors.jumlah_produk_yang_dijual}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label text-neutral-gray-5">Bahan Produk</label>
                      <input type="text" class="form-control"  v-model="form.bahan_produk"  id="tanggal_lahir" placeholder="Masukkan bahan produk anda" >
                       <small class="text-danger" v-if="form.errors.bahan_produk">{{ form.errors.bahan_produk}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="pendidikan_terakhir" class="form-label text-neutral-gray-5">Kategori Produk</label>
                      <input type="text" class="form-control"  v-model="this.form.kategori_produk" id="pendidikan_terakhir" placeholder="pendidikan kategori produk Anda" >
                       <small class="text-danger" v-if="form.errors.kategori_produk">{{ form.errors.kategori_produk}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kelurahan" class="form-label text-neutral-gray-5">Harga Produk</label>
                       <input type="number" class="form-control"  v-model="form.harga_produk" id="kelurahan" placeholder="Masukkan harga produk anda" >
                     <small class="text-danger" v-if="form.errors.harga_produk">{{ form.errors.harga_produk}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="dokumen_legalitas" class="form-label text-neutral-gray-5 mb-2">Clearance Documents</label>
                    <div v-if="!form.keterangan_halal" class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
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

                         <div v-else class="d-flex align-items-center px-4 py-2 alert alert-success gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                       <div class="position-relative">
                           <h1 v-if="this.$page.props.auth.produk['keterangan_halal'] != null" class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${this.$page.props.auth.produk['keterangan_halal']}`">{{form.keterangan_halal.split('/')[2]}}</a></h1>
                        <h1 v-else class="text-neutral-gray-5">{{form.keterangan_halal.name}}</h1>
                      </div>
                      <div class="position-relative">
                        <h2 class="text-primary-blue-6">Ganti Dokumen</h2>
                        <input type="file" @change="inputDokumen($event)" id="dokumen_amdal">
                      </div>
                    </div>
                     <small class="text-danger text-center" v-if="this.fileError" >{{this.fileError}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Manfaat Fungsional</label>
                       <input type="text" class="form-control"  v-model="form.manfaat_fungsional" id="kabupaten" placeholder="Masukkan manfaat fungsional Anda" >
                      <small class="text-danger" v-if="form.errors.manfaat_fungsional">{{ form.errors.manfaat_fungsional}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Manfaat Nonfungsional</label>
                      <input type="text" class="form-control"  v-model="form.manfaat_nonfungsional" id="provinsi" placeholder="Masukkan nonfungsional Anda" >
                        <small class="text-danger" v-if="form.errors.manfaat_nonfungsional">{{ form.errors.kategori_nonfungsional}}</small>
                  </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" :disabled="formCheck" class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">Selanjutnya</button>
                </div>
                 </form>
              </div>
            </div>
          </div>
        </div>
        </section>
        </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../Components/UmkmDashboardSidebar.vue'
import { ref } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
export default{
  data(){
    return{
      currentStep : window.location.pathname.split('/')[2],
      currentPage : window.location.pathname.split('/')[1],
      fileError:null
    }
  },
  setup () {
    const form = useForm({
      jenis_produk: null,
      jumlah_produk_yang_dijual: null,
      bahan_produk: null,
      kategori_produk: null,
      harga_produk: null,
      keterangan_halal: null,
      manfaat_fungsional: null,
      manfaat_nonfungsional:null,
    })

    return { form }
  },
  mounted(){
      this.form.jenis_produk= this.$page.props.auth.produk['jenis_produk']
      this.form.jumlah_produk_yang_dijual= this.$page.props.auth.produk['jumlah_produk_yang_dijual']
      this.form.bahan_produk= this.$page.props.auth.produk['bahan_produk']
      this.form.kategori_produk=this.$page.props.auth.produk['kategori_produk']
      this.form.harga_produk= this.$page.props.auth.produk['harga_produk']
      this.form.keterangan_halal=this.$page.props.auth.produk['keterangan_halal']
      this.form.manfaat_fungsional=this.$page.props.auth.produk['manfaat_fungsional']
      this.form.manfaat_nonfungsional=this.$page.props.auth.produk['manfaat_nonfungsional']
      
  },
  computed:{
    formCheck(){
      if (this.form.jenis_produk== null && this.form.jumlah_produk_yang_dijual == null && this.form.bahan_produk == null && this.form.keterangan_halal== null && this.form.manfaat_fungsional == null && this.form.manfaat_nonfungsional == null  &&  this.form.kategori_produk == null && this.form.harga_produk == null){
        return true
      }
      return false
    }
  },
  components:{
    BaseLayout,
    UmkmDashboardSidebar
  },
  methods:{
    submit(){
      if (this.form.keterangan_halal=='') {
        this.fileError = "Masukkan dokumen clearance dokumen terlebih dahulu"
        return
        }
         this.form.post('/umkm/dashboard/profil_produk/proses/pertama')     
    },
  inputDokumen(event){
        if(event.target.files[0].type == 'application/pdf' || event.target.files[0].type == 'application/msword'){
            this.form.keterangan_halal = event.target.files[0]
            this.$page.props.auth.produk['keterangan_halal'] = null
            this.fileError = null
   
           }
           else{
               this.fileError = "dokumen anda harus pdf/docx !"

           }
    },
  }
}
</script>

<style scoped>
section{
  margin-top: 10rem;
}
.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
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

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;

}
.hide{
  display: none;
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
  background-size: 19px 20px;
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

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}
.card h2 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #3E4041;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>
