<template>
  <DashboardLayout title="Tambah Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Tambah Kegiatan</h1>
    </div>
    <div class="d-flex mt-4">
      <Link href="/dashboard/kegiatan" class="text-decoration-none text-primary-blue-6 me-2">Kegiatan</Link>
      <p class="text-neutral-gray-4">> Tambah Kegiatan</p>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <form @submit.prevent="handleSubmit">
          <section class="mb-5">
            <h2 class="text-neutral-gray-5 mb-4">Bagian 1</h2>
            <div class="mb-4">
              <label for="tema_kegiatan" class="form-label text-neutral-gray-5">Tema Kegiatan</label>
              <input type="text" class="form-control" id="tema_kegiatan" placeholder="Masukkan tema kegiatan"
                v-model="form.tema_kegiatan">
            </div>
            <div class="mb-4">
              <label for="deskripsi_kegiatan" class="form-label text-neutral-gray-5">Deskripsi Kegiatan</label>
              <div class="position-relative">
                <textarea class="form-control" id="deskripsi_kegiatan" rows="1"
                  placeholder="Tuliskan deskripsi kegiatan" maxlength="512" ref="refDeskripsikegiatan"
                  @input="handleResizeDeskripsiKegiatan" v-model="form.deskripsi_kegiatan"></textarea>
                <span class="desc_count">{{ form.deskripsi_kegiatan.length }}/512</span>
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
                  v-model="form.jumlah_partisipan">
                <span class="count_input_leading">Orang</span>
              </div>
            </div>
            <div class="mb-4">
              <label for="nama_juri" class="form-label text-neutral-gray-5">Nama Juri</label>
              <v-select multiple placeholder="Masukkan nama juri kegiatan" id="nama_juri"
                :options="['Canada','United States']" v-model="form.nama_juri" />
            </div>
            <div class="mb-4">
              <label for="nama_investor" class="form-label text-neutral-gray-5">Nama Investor</label>
              <v-select multiple placeholder="Masukkan nama-nama investor kegiatan" id="nama_investor"
                :options="['Canada','United States']" v-model="form.nama_investor" />
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
              <v-select multiple placeholder="Masukkan nama PIC kegiatan" id="pic" :options="['Canada','United States']"
                v-model="form.pic" />
            </div>
            <div class="mb-4">
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Kontak Nomor PIC</label>
              <div class="position-relative telp_input">
                <span class="telp_leading">+62</span>
                <input type="number" class="form-control" id="kontak_nomor_pic"
                  placeholder="Masukkan nomor hanphone Anda" v-model="form.kontak_nomor_pic">
              </div>
            </div>
          </section>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary-blue-3 text-neutral-white">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';

const form = useForm({
  tema_kegiatan: '',
  deskripsi_kegiatan: '',
  jumlah_partisipan: null,
  nama_juri: null,
  nama_investor: null,
  masa_inkubasi: null,
  kurikulum: '',
  pic: null,
  kontak_nomor_pic: null
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
  console.log(form);
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