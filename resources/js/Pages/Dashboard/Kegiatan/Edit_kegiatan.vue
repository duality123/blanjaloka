<template>
  <DashboardLayout title="Tambah Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Edit Kegiatan</h1>
    </div>
    <div class="d-flex mt-4">
      <Link href="/dashboard/kegiatan" class="text-decoration-none text-primary-blue-6 me-2">Kegiatan</Link>
      <p class="text-neutral-gray-4"> Tambah Kegiatan</p>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <form @submit.prevent="handleSubmit">
          <section class="mb-5">
            <h2 class="text-neutral-gray-5 mb-4">Bagian 1</h2>
            <div class="mb-4">
              <label for="tema_kegiatan" class="form-label text-neutral-gray-5">Tema Kegiatan</label>
              <input type="text" class="form-control" id="tema_kegiatan" placeholder="Masukkan tema kegiatan"
                v-model="form.tema">
            </div>

              <div class="mb-4">
              <label for="nama_juri" class="form-label text-neutral-gray-5">Tanggal mulai</label>
              <input type="date" class="form-control px-0" multiple placeholder="Masukkan nama juri kegiatan(contoh: Rahman, Bobby)" id="nama_juri"
                v-model="form.dimulai.split(' ')[0]" />
            </div>
            <div class="mb-4">
              <label for="nama_juri" class="form-label text-neutral-gray-5">Tanggal berakhir</label>
              <input type="date" class="form-control px-0" id="nama_juri"
                v-model="form.berakhir.split(' ')[0]" />
            </div>
            <div class="mb-4">
              <label for="deskripsi_kegiatan" class="form-label text-neutral-gray-5">Deskripsi Kegiatan</label>
              <div class="position-relative">
                <textarea class="form-control" id="deskripsi_kegiatan" rows="1"
                  placeholder="Tuliskan deskripsi kegiatan" maxlength="512" ref="refDeskripsikegiatan"
                  @input="handleResizeDeskripsiKegiatan" v-model="form.deskripsi"></textarea>
                <span class="desc_count">{{ form.deskripsi.length }}/512</span>
              </div>
            </div>
          </section>
          <section class="mb-5">
            <h2 class="text-neutral-gray-5 mb-4">Bagian 2</h2>
            <div class="mb-4">
              <label for="jumlah_partisipan" class="form-label text-neutral-gray-5">Jumlah Partisipan</label>
              <div class="position-relative count_input" ref="refJumlahPartisipan">
                <input type="number" class="form-control px-0" id="jumlah_partisipan"
                  placeholder="Masukkan jumlah partisipan" @input="handleResizeJumlahPartisipan"
                  v-model="form.jumlah_orang_diundang">
                <span class="count_input_leading">Orang</span>
              </div>
            </div>
            <div class="mb-4">
              <label for="nama_juri" class="form-label text-neutral-gray-5">Nama Juri ( gunakan koma jika lebih dari satu orang)</label>
              <input type="text" class="form-control px-0" multiple placeholder="Masukkan nama juri kegiatan(contoh: Rahman, Bobby)" id="nama_juri"
                v-model="form.nama_juri" />
            </div>
            <div class="mb-4">
              <label for="nama_investor" class="form-label text-neutral-gray-5">Nama Investor</label>
              <v-select multiple placeholder="Masukkan nama-nama investor kegiatan" id="nama_investor"
                :options="investor" v-model="form.nama_investor" />
            </div>
            <div class="mb-4">
              <label for="nama_investor" class="form-label text-neutral-gray-5">Nama UMKM</label>
              <v-select multiple placeholder="Masukkan nama-nama investor kegiatan" id="nama_investor"
                :options="umkm" v-model="form.nama_umkm" />
            </div>
          </section>
          <section class="mb-5">
            <h2 class="text-neutral-gray-5 mb-4">Bagian 3</h2>
            <div class="mb-4">
              <label for="masa_inkubasi" class="form-label text-neutral-gray-5">Masa Inkubasi</label>
              <div class="position-relative count_input" ref="refMasaInkubasi">
                <input type="number" class="form-control px-0" id="masa_inkubasi"
                  placeholder="Masukkan lama masa inkubasi" @input="handleResizeMasaInkubasi"
                  v-model="form.masa_inkubasi">
                <span class="count_input_leading">Bulan</span>
              </div>
            </div>
            <div class="mb-4">
              <label for="kurikulum" class="form-label text-neutral-gray-5">Kurikulum</label>
              <input type="text" class="form-control" id="kurikulum" placeholder="Masukkan link file kurikulum kegiatan"
                v-model="form.kurikulum">
            </div>

            <div class="mb-4">
              <label for="pic" class="form-label text-neutral-gray-5">PIC</label>
              <input type="text" class="form-control" id="kurikulum" placeholder="Masukkan pic kegiatan"
                v-model="form.pic">
            </div>
            <div class="mb-4">
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Gambar</label>
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
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Kontak Nomor PIC</label>
              <div class="position-relative telp_input">
                <span class="telp_leading">+62</span>
                <input type="number" class="form-control" id="kontak_nomor_pic"
                  placeholder="Masukkan nomor hanphone Anda" v-model="form.kontak">
              </div>
            </div>
          </section>
          <div class="form-check">
  <input class="form-check-input" type="checkbox" v-model="form.draft" id="flexCheckDefault" :checked="checked">
  <label class="form-check-label" for="flexCheckDefault">
    Aktif
  </label>
</div>
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
import { ref, computed,onMounted,onUnmounted } from 'vue'
const form = useForm({
  id: window.location.pathname.split('/')[4],
  tema: props.kegiatan.tema,
  deskripsi: props.kegiatan.deskripsi,
  jumlah_orang_diundang: props.kegiatan.jumlah_orang_diundang,
  masa_inkubasi: props.kegiatan.masa_inkubasi,
  kurikulum:  props.kegiatan.kurikulum,
  pic:  props.kegiatan.pic,
  kontak:  props.kegiatan.kontak,
  draft: props.kegiatan.draft,
  dimulai: props.kegiatan.dimulai,
  dibuat:props.kegiatan.dibuat,
  berakhir:props.kegiatan.berakhir,
  nama_juri:props.kegiatan.nama_juri,
  nama_investor:props.oldInvestor,
  nama_umkm:props.oldUmkm,
  gambar:props.kegiatan.gambar
});

const checked = ref(false)
onMounted(()=>{
 if (form.draft) {
  checked.value=true
 }
})
 
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
        var image = document.getElementById('img');
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
  investor:Array,
  kegiatan:Object,
  oldInvestor:Array,
  umkm:Array,
  oldUmkm:Array
})
const handleResizeMasaInkubasi = () => {
  refMasaInkubasi.value.style.width = '1.5rem';
}
const handleSubmit = () => {
  console.log(form.draft)
  form.post('/admin/dashboard/kegiatan/edit_post')
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
