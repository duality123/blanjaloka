<template>
  <BaseLayout :page="this.currentPage">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">{{ currentStep }}</span>
                    dari 3</p>
                </div>
                <h2 class="mt-4">Profil Saya</h2>
                <p class="text-neutral-gray-5">Harap masukkan sesuai dengan data diri dan kondisi Anda saat ini!</p>
                <form @submit.prevent="submit()">
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
                       <input type="text" class="form-control" v-model="form.kelurahan" id="kelurahan" placeholder="Masukkan tempat lahir Anda" >
                        <small class="text-danger" v-if="form.errors.kelurahan">{{ form.errors.kelurahan }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kecamatan" class="form-label text-neutral-gray-5">Kecamatan</label>
                       <input type="text" class="form-control" v-model="form.kecamatan" id="kecamatan" placeholder="Masukkan tempat lahir Anda" >
                        <small class="text-danger" v-if="form.errors.kecamatan">{{ form.errors.kecamatan }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Kabupaten</label>
                       <input type="text" class="form-control" v-model="form.kabupaten" id="kabupaten" placeholder="Masukkan tempat lahir Anda" >
                        <small class="text-danger" v-if="form.errors.kabupaten">{{ form.errors.kabupaten }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Provinsi</label>
                      <input type="text" class="form-control" v-model="form.provinsi" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">No Handphone</label>
                      <input type="text" class="form-control" v-model="form.no_hp" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.no_hp">{{ form.errors.no_hp }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Status</label>
                      <input type="text" class="form-control" v-model="form.status" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.status">{{ form.errors.status }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Kewarganeraan</label>
                      <input type="text" class="form-control" v-model="form.kewarganegaraan" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.kewarganegaraan">{{ form.errors.kewarganegaraan }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Agama</label>
                      <input type="text" class="form-control" v-model="form.agama" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.agama">{{ form.errors.agama }}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Pengalaman Kerja</label>
                      <input type="text" class="form-control" v-model="form.pengalaman_kerja" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.pengalaman_kerja">{{ form.errors.pengalaman_kerja}}</small>
                  </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" :disabled="formCheck" class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">Selanjutnya</button>
                </div>
                 </form>
              </div>
        </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Profile.vue'
import { ref } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";
export default{
  data(){
    return{
      currentStep : window.location.pathname.split('/')[2],
      currentPage : window.location.pathname.split('/')[1],
      foto1 : null,
      process : true
    }
  },
  setup () {
    const form = useForm({
      nama_lengkap: null,
      tempat_kelahiran: null,
      tanggal_lahir: null,
      alamat: null,
      kelurahan: null,
      kecamatan: null,
      kabupaten: null,
      provinsi: null,
      pendidikan_terakhir:null,
      no_hp:null,
      status:null,
      kewarganegaraan:null,
      agama: null,
      pengalaman_kerja:null
    })

    return { form }
  },

  mounted(){
    //console.log( this.$page.props.auth.profil['tanggal_lahir'])
      this.form.nama_lengkap= this.$page.props.auth.profil['nama_lengkap'],
      this.form.tempat_kelahiran= this.$page.props.auth.profil['tempat_kelahiran'],
      this.form.tanggal_lahir= (this.$page.props.auth.profil['tanggal_lahir'] == null )? null:this.$page.props.auth.profil['tanggal_lahir'].split(' ')[0],
      this.form.alamat= this.$page.props.auth.profil['alamat'],
      this.form.kelurahan= this.$page.props.auth.profil['kelurahan'],
      this.form.kecamatan= this.$page.props.auth.profil['kecamatan'],
      this.form.kabupaten= this.$page.props.auth.profil['kabupaten'],
      this.form.provinsi= this.$page.props.auth.profil['provinsi'],
      this.form.pendidikan_terakhir= this.$page.props.auth.profil['pendidikan_terakhir'],
      this.form.no_hp=this.$page.props.auth.profil['no_hp'],
      this.form.status=this.$page.props.auth.profil['status'],
      this.form.kewarganegaraan=this.$page.props.auth.profil['kewarganegaraan'],
      this.form.agama= this.$page.props.auth.profil['agama'],
      this.form.pengalaman_kerja= this.$page.props.auth.profil['pengalaman_kerja']
     if (this.form.nama_lengkap != null && this.form.tempat_kelahiran != null  && this.form.tanggal_lahir == null  && this.form.alamat != null && this.form.kelurahan != null  &&  this.form.kecamatan != null  &&  this.form.kabupaten != null &&  this.form.provinsi != null &&  this.form.pendidikan_terakhir != null &&  this.form.no_hp != null &&  this.form.status != null  &&  this.form.kewarganegaraan != null  ||  this.form.agama != null && this.form.pengalaman_kerja != null) {
        this.process = false;
      }
  },
  computed:{
    formCheck(){
      if (this.form.nama_lengkap == null || this.form.tempat_kelahiran == null  || this.form.tanggal_lahir ==null  || this.form.alamat ==null || this.form.kelurahan == null  ||  this.form.kecamatan ==null  ||  this.form.kabupaten == null ||  this.form.provinsi == null ||  this.form.pendidikan_terakhir ==null ||  this.form.no_hp ==null ||  this.form.status ==null  ||  this.form.kewarganegaraan == null  ||  this.form.agama == null || this.form.pengalaman_kerja == null) {
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
     if (this.form.nama_lengkap == null || this.form.tempat_kelahiran == null  || this.form.tanggal_lahir ==null  || this.form.alamat ==null || this.form.kelurahan == null  ||  this.form.kecamatan ==null  ||  this.form.kabupaten == null ||  this.form.provinsi == null ||  this.form.pendidikan_terakhir ==null ||  this.form.no_hp ==null ||  this.form.status ==null  ||  this.form.kewarganegaraan == null  ||  this.form.agama == null || this.form.pengalaman_kerja == null) {
        return 
      }
      this.form.post('/profil/proses/kedua')
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
