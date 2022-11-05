<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmAccountSidebar />
          <div class="col-lg-5">
            <div class="card mb-3" v-if="currentStep === 1">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">{{ currentStep }}</span>
                    dari 3</p>
                </div>
                <h2 class="mt-4">Foto Profil</h2>
                <p class="text-neutral-gray-5">Foto yang baik mungkin akan membantu Anda dalam proses inkubasi
                  kedepannya.</p>
                <div class="d-flex justify-content-end">
                  <a href="#" class="btn btn-primary-blue-3 text-neutral-white py-2 px-4"
                    @click="currentStep++">Selanjutnya</a>
                </div>
              </div>
            </div>
            <div class="card mb-3" v-if="currentStep === 2">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">{{ currentStep }}</span>
                    dari 3</p>
                </div>
                <h2 class="mt-4">Profil Saya</h2>
                <p class="text-neutral-gray-5">Harap masukkan sesuai dengan data diri dan kondisi Anda saat ini!</p>
                <form class="mt-5">
                  <div class="mb-4">
                    <label for="nama_lengkap" class="form-label text-neutral-gray-5">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" placeholder="Masukkan nama lengkap Anda">
                  </div>
                  <div class="mb-4">
                    <label for="tempat_kelahiran" class="form-label text-neutral-gray-5">Tempat Kelahiran</label>
                    <select class="form-select" id="tempat_kelahiran">
                      <option selected disabled>Pilih tempat kelahiran Anda</option>
                      <option>testing</option>
                      <option>testing</option>
                      <option>testing</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label text-neutral-gray-5">Tanggal Lahir</label>
                    <select class="form-select" id="tanggal_lahir">
                      <option selected disabled>Masukkan tanggal lahir Anda</option>
                      <option>testing</option>
                      <option>testing</option>
                      <option>testing</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="alamat" class="form-label text-neutral-gray-5">Alamat Tempat Tinggal</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat tinggal Anda">
                  </div>
                  <div class="mb-4">
                    <label for="kelurahan" class="form-label text-neutral-gray-5">Kelurahan</label>
                    <select class="form-select" id="kelurahan">
                      <option selected disabled>Pilih kelurahan tempat tinggal Anda</option>
                      <option>testing</option>
                      <option>testing</option>
                      <option>testing</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="kecamatan" class="form-label text-neutral-gray-5">Kecamatan</label>
                    <select class="form-select" id="kecamatan">
                      <option selected disabled>Pilih kecamatan tempat tinggal Anda</option>
                      <option>testing</option>
                      <option>testing</option>
                      <option>testing</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Kabupaten</label>
                    <select class="form-select" id="kabupaten">
                      <option selected disabled>Pilih kabupaten tempat tinggal Anda</option>
                      <option>testing</option>
                      <option>testing</option>
                      <option>testing</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Provinsi</label>
                    <select class="form-select" id="provinsi">
                      <option selected disabled>Pilih provinsi tempat tinggal Anda</option>
                      <option>testing</option>
                      <option>testing</option>
                      <option>testing</option>
                    </select>
                  </div>
                </form>
                <div class="d-flex justify-content-end">
                  <a href="#" class="btn btn-primary-blue-3 text-neutral-white py-2 px-4">Selanjutnya</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '../../../Layouts/Layout.vue'
import UmkmAccountSidebar from '../../../Components/UmkmAccountSidebar.vue'
import { ref } from 'vue'

const currentStep = ref(1);
</script>

<style scoped>
section {
  margin-top: 10rem !important;
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