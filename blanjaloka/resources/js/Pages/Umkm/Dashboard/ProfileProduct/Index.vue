<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h1>Profil Produk</h1>
                <p>
                  Harap masukkan data terkait produk yang Anda jual/tawarkan.
                </p>
                <form class="mt-4">
                  <div class="mb-4">
                    <label for="nama_produk" class="form-label text-neutral-gray-5">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" placeholder="Masukkan nama produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="jumlah_produk" class="form-label text-neutral-gray-5">Jumlah Produk</label>
                    <input type="text" class="form-control" id="jumlah_produk"
                      placeholder="Masukkan jumlah produk yang ada di usaha Anda">
                  </div>
                  <div class="mb-4">
                    <label for="ketegori_produk" class="form-label text-neutral-gray-5">Kategori Produk</label>
                    <select class="form-select" id="ketegori_produk">
                      <option selected disabled>Pilih kategori produk Anda</option>
                      <option>Start Up</option>
                      <option>Enterprice</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="bahan_produk" class="form-label text-neutral-gray-5">Bahan Produk</label>
                    <input type="text" class="form-control" id="bahan_produk"
                      placeholder="Masukkan bahan produk usaha Anda">
                  </div>
                  <div class="mb-4">
                    <label for="keterangan_halal" class="form-label text-neutral-gray-5 mb-2">Keterangan Halal</label>
                    <div class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="flex-grow-1">
                        <h1 class="text-neutral-gray-5">Upload your file</h1>
                        <p class="text-neutral-gray-3">Format file .pdf, maks 10MB</p>
                      </div>
                      <div class="position-relative">
                        <h2 class="text-primary-blue-6">Pilih</h2>
                        <input type="file" id="keterangan_halal">
                      </div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label for="manfaat_fungsional" class="form-label text-neutral-gray-5">Manfaat Fungsinal</label>
                    <input type="text" class="form-control" id="manfaat_fungsional"
                      placeholder="Tuliskan manfaat fungsional produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="manfaat_non_fungsional" class="form-label text-neutral-gray-5">Manfaat
                      Non-Fungsional</label>
                    <input type="text" class="form-control" id="manfaat_non_fungsional"
                      placeholder="Tuliskan manfaat non-fungsional produk Anda">
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary-blue-3 text-neutral-white">Kirim</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '../../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../../Components/UmkmDashboardSidebar.vue'
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const refDeskripsiUsaha = ref(null);

const handleResizeDeskripsiUsaha = () => {
  refDeskripsiUsaha.value.style.height = `${refDeskripsiUsaha.value.scrollHeight}px`;
}
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

textarea::-webkit-scrollbar {
  display: none;
}

textarea {
  resize: none;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>