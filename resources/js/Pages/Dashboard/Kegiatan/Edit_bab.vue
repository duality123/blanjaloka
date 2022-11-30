<template>
  <DashboardLayout title="Tambah Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Edit Bab</h1>
    </div>
    <div class="d-flex mt-4">
      <Link href="admin/dashboard/kegiatan/1" class="text-decoration-none text-primary-blue-6 me-2">Kegiatan</Link>
      <p class="text-neutral-gray-4">Edit Bab</p>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <form @submit.prevent="handleSubmit">
          <section class="mb-5">
            <div class="mb-4">
              <label for="nama_juri" class="form-label text-neutral-gray-5">Judul</label>
              <input type="text" class="form-control mb-3" id="kurikulum" placeholder="Masukkan deskripsi"
                v-model="form.judul">
                <small class="text-danger text-center" v-if="form.errors.judul">{{form.errors.judul}}</small>
            </div>
            <h2 class="text-neutral-gray-5 mb-4"></h2>
            <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Deskripsi</label>
              <input type="text" class="form-control" id="kurikulum" placeholder="Masukkan deskripsi"
                v-model="form.deskripsi">
               <small class="text-danger text-center" v-if="form.errors.deskripsi">{{form.errors.deskripsi}}</small> 
            </div>

            
             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Link Video</label>
              <input type="text" class="form-control mb-3" id="kurikulum" placeholder="Masukkan deskripsi"
                v-model="form.link_video">
                 <iframe  v-if  = "form.link_video" width="300" height="300"
                                    :src="`${form.link_video}`">
                                </iframe>
               <small class="text-danger text-center" v-if="form.errors.link_video">{{form.errors.link_video}}</small> 
            </div>

             <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Nomor Bab</label>
              <input type="number" class="form-control mb-3" id="kurikulum" placeholder="Masukkan nomor bab"
                v-model="form.bab">
               <small class="text-danger text-center" v-if="form.errors.bab">{{form.errors.bab}}</small> 
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
  judul:props.bab.judul,
  deskripsi:props.bab.deskripsi,
  link_video:props.bab.link_video,
  bab:props.bab.bab,
  id : window.location.pathname.split('/')[6]
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

const handleResizeMasaInkubasi = () => {
  refMasaInkubasi.value.style.width = '1.5rem';
}
const handleSubmit = () => {
  form.post('/admin/dashboard/kegiatan/elearning/bab/edit')
}

const props = defineProps({
  elearning:Object,
  bab:Object
})
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
