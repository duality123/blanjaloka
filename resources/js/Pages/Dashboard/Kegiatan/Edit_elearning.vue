<template>
  <DashboardLayout title="Tambah Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">{{elearning.judul}}</h1>
    </div>
    <div class="d-flex mt-4">
      <Link href="/dashboard/kegiatan" class="text-decoration-none text-primary-blue-6 me-2">Kegiatan</Link>
      <p class="text-neutral-gray-4"> Tambah Elearning</p>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <form @submit.prevent="handleSubmit">
          <section class="mb-5">
            <div class="mb-4">
              <label for="nama_juri" class="form-label text-neutral-gray-5">Waktu</label>
              <input type="date" class="form-control px-0" multiple placeholder="Masukkan nama juri kegiatan(contoh: Rahman, Bobby)" id="nama_juri"
                v-model="form.waktu" />
                <small class="text-danger text-center" v-if="form.errors.waktu">{{form.errors.waktu}}</small>
            </div>
            <h2 class="text-neutral-gray-5 mb-4"></h2>
            <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Judul</label>
              <input type="text" class="form-control" id="kurikulum" placeholder="Masukkan link file kurikulum kegiatan"
                v-model="form.judul">
               <small class="text-danger text-center" v-if="form.errors.judul">{{form.errors.judul}}</small> 
            </div>
            <div class="mb-4">
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Foto</label>
          <div class="card text-white bg-neutral-gray-1 mb-3 " >
                 <div v-if="form.gambar != null" class="d-flex justify-content-center pt-3 mb-4">
                   <img :src="`${$page.props.asset_url}/${form.gambar}`" alt="update icon" style="overflow: hidden; width: 5rem;" id="foto1" >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4">
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="foto1" >
                </div>

                <div class="row" style="margin-left:2px;" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" ref ="foto_profil" class="custom-file-input " @change="ubahGambar($event)"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-between">
                <p class="text-primary"  style="padding-left:28px;">atau</p>
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
              <label for="kurikulum" class="form-label text-neutral-gray-5">Deskripsi</label>
              <input type="text" class="form-control" id="kurikulum" placeholder="Masukkan deskripsi"
                v-model="form.deskripsi">
               <small class="text-danger text-center" v-if="form.errors.deskripsi">{{form.errors.deskripsi}}</small> 
            </div>
          </section>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary-blue-6 text-neutral-white">Submit</button>
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
  tema:props.elearning.tema,
  deskripsi: props.elearning.deskripsi,
  waktu:props.elearning.hari_tanggal_waktu.split(' ')[0],
  judul:props.elearning.judul,
  gambar:props.elearning.foto,
  id:window.location.pathname.split('/')[5]
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
const ubahGambar = (event) => {
     if(event.target.files[0].type == 'image/jpeg' || event.target.files[0].type == 'image/png'){
        
            if(event.target.files[0].size >= 5000000){
              form.errors.gambar = "Size foto anda lebih dari 5MB !" 
              return
            }
        var image = document.getElementById('foto1');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.width = '10rem';
        image.style.overflow = 'hidden';
        form.gambar = event.target.files[0];
        //console.log(this.process)
      }
      else{
        form.errors.gambar = "File yang anda upload bukanlah gambar !" 
         //console.log(event.target.files[0].type)
         return
      }
    }

const props = defineProps({
  elearning:Object
})
const handleResizeMasaInkubasi = () => {
  refMasaInkubasi.value.style.width = '1.5rem';
}
const handleSubmit = () => {
  form.post('/admin/dashboard/kegiatan/elearning/edit')
}
</script>

<style scoped>
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
