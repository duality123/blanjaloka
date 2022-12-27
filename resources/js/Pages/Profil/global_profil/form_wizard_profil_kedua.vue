<template>
  <BaseLayout :page="this.currentPage">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">{{ currentStep }}</span>
                    dari 3</p>
                </div>
                 <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    Anda wajib mengisi profil anda sesuai data anda saat ini !
                  </p>
                </div>
                </div>
                <form @submit.prevent="submit()">
                  <h2 class="mt-4">Profil Saya</h2>
                  <div class="mb-4">
                    <label for="nama_lengkap" class="form-label text-neutral-gray-5">Nama Lengkap</label>
                    <input type="text" v-model="form.nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukkan nama lengkap Anda" >
                     <small class="text-danger" v-if="form.errors.nama_lengkap">{{ form.errors.nama_lengkap }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="tempat_kelahiran" class="form-label text-neutral-gray-5">Tempat Kelahiran</label>
                    <input type="text" class="form-control" v-model="form.tempat_kelahiran" id="tempat_kelahiran" placeholder="Masukkan tempat lahir Anda">
                     <small class="text-danger" v-if="form.errors.tempat_kelahiran">{{ form.errors.tempat_kelahiran }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label text-neutral-gray-5">Tanggal Lahir</label>
                      <input type="date" class="form-control" v-model="form.tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan tanggal lahir Anda" >
                       <small class="text-danger" v-if="form.errors.tanggal_lahir">{{ form.errors.tanggal_lahir }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="pendidikan_terakhir" class="form-label text-neutral-gray-5">Pendidikan Terakhir</label>
                      <input type="text" class="form-control" v-model="form.pendidikan_terakhir" id="pendidikan_terakhir" placeholder="pendidikan terakhir Anda" >
                       <small class="text-danger" v-if="form.errors.pendidikan_terakhir">{{ form.errors.pendidikan_terakhir }}</small>
                  </div>

                  <div class="mb-4">
                    <label for="alamat" class="form-label text-neutral-gray-5">Alamat Tempat Tinggal</label>
                    <input type="text" class="form-control" id="alamat" v-model="form.alamat" placeholder="Masukkan alamat tinggal Anda" >
                  </div>
                  <div class="mb-4">
                    <label for="kelurahan" class="form-label text-neutral-gray-5">Kelurahan</label>
                       <input type="text" class="form-control" v-model="form.kelurahan" id="kelurahan" placeholder="Masukkan Kelurahan Anda" >
                        <small class="text-danger" v-if="form.errors.kelurahan">{{ form.errors.kelurahan }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kecamatan" class="form-label text-neutral-gray-5">Kecamatan</label>
                       <input type="text" class="form-control" v-model="form.kecamatan" id="kecamatan" placeholder="Masukkan Kecamatan Anda" >
                        <small class="text-danger" v-if="form.errors.kecamatan">{{ form.errors.kecamatan }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Kabupaten</label>
                       <input type="text" class="form-control" v-model="form.kabupaten" id="kabupaten" placeholder="Masukkan Kabupaten Anda" >
                        <small class="text-danger" v-if="form.errors.kabupaten">{{ form.errors.kabupaten }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Provinsi</label>
                      <input type="text" class="form-control" v-model="form.provinsi" id="provinsi" placeholder="Masukkan Provinsi Anda" >
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">No Handphone</label>
                      <input type="text" class="form-control" v-model="form.no_hp" id="provinsi" placeholder="Masukkan nO Handphone Anda" >
                       <small class="text-danger" v-if="form.errors.no_hp">{{ form.errors.no_hp }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Status</label>
                      <input type="text" class="form-control" v-model="form.status" id="provinsi" placeholder="Masukkan status Anda" >
                       <small class="text-danger" v-if="form.errors.status">{{ form.errors.status }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Kewarganeraan</label>
                      <input type="text" class="form-control" v-model="form.kewarganegaraan" id="provinsi" placeholder="Masukkan Kewarganegaraan Anda" >
                       <small class="text-danger" v-if="form.errors.kewarganegaraan">{{ form.errors.kewarganegaraan }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Agama</label>
                      <input type="text" class="form-control" v-model="form.agama" id="provinsi" placeholder="Masukkan agama Anda" >
                       <small class="text-danger" v-if="form.errors.agama">{{ form.errors.agama }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Pengalaman Kerja</label>
                      <input type="text" class="form-control" v-model="form.pengalaman_kerja" id="provinsi" placeholder="Masukkan Pengalaman kerja Anda" >
                       <small class="text-danger" v-if="form.errors.pengalaman_kerja">{{ form.errors.pengalaman_kerja}}</small>
                  </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" :disabled="formCheck" class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">Selanjutnya</button>
                </div>
                 </form>
            
        </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Profile.vue'
import { ref } from 'vue'
import { useForm,usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia"
export default{
  data(){
    return{
      currentStep : window.location.pathname.split('/')[2],
      currentPage : window.location.pathname.split('/')[1],
      process : false
    }
  },

  setup () {
    const form = useForm({
      nama_lengkap: usePage().props.value.auth.profil['nama_lengkap'],
      tempat_kelahiran: usePage().props.value.auth.profil['tempat_kelahiran'],
      tanggal_lahir:  (usePage().props.value.auth.profil['tanggal_lahir'] == null )? null:usePage().props.value.auth.profil['tanggal_lahir'].split(' ')[0],
      alamat: usePage().props.value.auth.profil['alamat'],
      kelurahan:usePage().props.value.auth.profil['kelurahan'],
      kecamatan: usePage().props.value.auth.profil['kecamatan'],
      kabupaten: usePage().props.value.auth.profil['kabupaten'],
      provinsi:usePage().props.value.auth.profil['provinsi'],
      pendidikan_terakhir: usePage().props.value.auth.profil['pendidikan_terakhir'],
      no_hp:usePage().props.value.auth.profil['no_hp'],
      status:usePage().props.value.auth.profil['status'],
      kewarganegaraan:usePage().props.value.auth.profil['kewarganegaraan'],
      agama: usePage().props.value.auth.profil['agama'],
      pengalaman_kerja: usePage().props.value.auth.profil['pengalaman_kerja']
    })

    return { form }
  },
  watch: {
  form: {
     handler(newVal, oldVal){ 
        if (newVal) {
          this.process = true;
        }
     },
     deep: true, 

  }
},
  computed:{
    formCheck(){
      if (this.form.nama_lengkap == '' || this.form.tempat_kelahiran == ''  || this.form.tanggal_lahir == ''  || this.form.alamat =='' || this.form.kelurahan == ''  ||  this.form.kecamatan == ''  ||  this.form.kabupaten == '' ||  this.form.provinsi == '' ||  this.form.pendidikan_terakhir == '' ||  this.form.no_hp == '' ||  this.form.status == ''  ||  this.form.kewarganegaraan == ''  ||  this.form.agama == '' || this.form.pengalaman_kerja == '') {
        return true
      }
      return false;
    }
  },
  components:{
    BaseLayout
  },
  methods:{
    submit(){
      if (this.process) {
         this.form.post('/profil/proses/wizard_kedua')
      }
      else{
        Inertia.get('/profil/3')
      }
    },
  }
}
</script>

<style scoped>
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
