<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h1>UMKM Incubation Nusantara 2022 #Batch2</h1>
                <ul class="mt-4">
                  <li v-for="item in tabItems" :class="{ 'active': item.isActive }"
                    @click="handleChangeCurrentTabItem(item.title)">
                    <a :class="{ 'text-neutral-black': item.isActive, 'text-neutral-gray-4': !item.isActive }">
                      {{ item.title }}
                    </a>
                  </li>
                </ul>
                <a href="#"
                  class="btn btn-semantic-error-4 text-white d-flex align-items-center gap-2 my-4 button_keluar"
                  data-bs-toggle="modal" data-bs-target="#modal_keluar_kegiatan">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.6246 12.975C12.4746 12.8083 12.3996 12.625 12.3996 12.425C12.3996 12.225 12.4746 12.05 12.6246 11.9L14.5246 10H6.87461C6.65794 10 6.47894 9.929 6.33761 9.787C6.19561 9.64567 6.12461 9.46667 6.12461 9.25C6.12461 9.03333 6.19561 8.854 6.33761 8.712C6.47894 8.57067 6.65794 8.5 6.87461 8.5H14.5246L12.6246 6.575C12.4746 6.425 12.3996 6.25 12.3996 6.05C12.3996 5.85 12.4746 5.675 12.6246 5.525C12.7746 5.375 12.9496 5.3 13.1496 5.3C13.3496 5.3 13.5163 5.36667 13.6496 5.5L16.7746 8.625C16.8579 8.70833 16.9206 8.804 16.9626 8.912C17.0039 9.02067 17.0246 9.13333 17.0246 9.25C17.0246 9.36667 17.0039 9.479 16.9626 9.587C16.9206 9.69567 16.8579 9.79167 16.7746 9.875L13.6496 13C13.4996 13.1667 13.3289 13.2417 13.1376 13.225C12.9456 13.2083 12.7746 13.125 12.6246 12.975ZM2.39961 18C1.89961 18 1.47461 17.825 1.12461 17.475C0.774609 17.125 0.599609 16.7 0.599609 16.2V2.3C0.599609 1.8 0.774609 1.375 1.12461 1.025C1.47461 0.675 1.89961 0.5 2.39961 0.5H8.37461C8.57461 0.5 8.74961 0.570667 8.89961 0.712C9.04961 0.854 9.12461 1.03333 9.12461 1.25C9.12461 1.46667 9.04961 1.64567 8.89961 1.787C8.74961 1.929 8.57461 2 8.37461 2H2.39961C2.33294 2 2.26628 2.03333 2.19961 2.1C2.13294 2.16667 2.09961 2.23333 2.09961 2.3V16.2C2.09961 16.2667 2.13294 16.3333 2.19961 16.4C2.26628 16.4667 2.33294 16.5 2.39961 16.5H8.37461C8.57461 16.5 8.74961 16.5707 8.89961 16.712C9.04961 16.854 9.12461 17.0333 9.12461 17.25C9.12461 17.4667 9.04961 17.646 8.89961 17.788C8.74961 17.9293 8.57461 18 8.37461 18H2.39961Z"
                      fill="white" />
                  </svg>
                  Keluar Kegiatan ini
                </a>
                <p class="text-neutral-gray-5">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit pellentesque et scelerisque id integer
                  diam pharetra nunc tempus. Ultrices eget et pellentesque adipiscing interdum in ultricies quis. Urna
                  egestas libero dolor elit eget pulvinar est vel. Rhoncus varius lobortis quis tortor odio ipsum magna
                  nunc. Fermentum luctus tincidunt sed at.
                </p>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="d-flex align-items-center justify-conten-between">
                      <p class="flex-grow-1">Juri</p>
                      <p class="fw-semibold">Bu Sulis, Pak Darman</p>
                    </div>
                    <div class="d-flex align-items-center justify-conten-between">
                      <p class="flex-grow-1">Investor</p>
                      <p class="fw-semibold">Bu Sulis, Pak Darman</p>
                    </div>
                    <div class="d-flex align-items-center justify-conten-between">
                      <p class="flex-grow-1">Masa Inkubasi</p>
                      <p class="fw-semibold">3 Bulan</p>
                    </div>
                    <div class="d-flex align-items-center justify-conten-between">
                      <p class="flex-grow-1">PIC</p>
                      <p class="fw-semibold">Pak Haqi</p>
                    </div>
                    <div class="d-flex align-items-center justify-conten-between">
                      <p class="flex-grow-1">Kontak PIC</p>
                      <p class="fw-semibold">+62 856712345678</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- modal keluar kegiatan -->
          <div class="modal fade" id="modal_keluar_kegiatan" tabindex="-1" aria-labelledby="modal_keluar_kegiatan_label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="d-flex justify-content-center">
                    <svg width="114" height="113" viewBox="0 0 114 113" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M56.9994 103.583C82.8952 103.583 104.083 82.3957 104.083 56.4998C104.083 30.604 82.8952 9.4165 56.9994 9.4165C31.1035 9.4165 9.91602 30.604 9.91602 56.4998C9.91602 82.3957 31.1035 103.583 56.9994 103.583Z"
                        stroke="#FF6347" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M57 37.6665V61.2082" stroke="#FF6347" stroke-width="8" stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path d="M56.9746 75.3335H57.0169" stroke="#FF6347" stroke-width="8" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>
                  </div>
                  <h1 class="text-center mt-4">Keluar Kegiatan</h1>
                  <p class="text-center">
                    Anda akan keluar dari kegiatan ini. Anda akan dihapus dari daftar partisipan.
                    Apakah kamu yakin akan keluar dari kegiatan ini?
                  </p>
                  <div class="d-flex justify-content-center gap-4">
                    <a href="#" class="btn btn-outline-primary-blue-6 text-primary-blue-6 btn_custom_outline"
                      data-bs-dismiss="modal">
                      Batal
                    </a>
                    <a href="#" class="btn btn-primary-blue-6 text-neutral-white">
                      Keluar
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- modal keluar kegiatan -->
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '../../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../../Components/UmkmDashboardSidebar.vue'
import { ref } from 'vue';

const tabItems = ref([
  {
    title: 'Deskripsi',
    isActive: true
  },
  {
    title: 'E-Learning',
    isActive: false
  },
  {
    title: 'Eventual',
    isActive: false
  },
  {
    title: 'Logbook',
    isActive: false
  },
]);

const handleChangeCurrentTabItem = (title) => {
  tabItems.value = tabItems.value.map((tab) => {
    return tab.title == title ? { ...tab, isActive: true } : { ...tab, isActive: false };
  });
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

.card h1 {
  font-size: 2rem;
}

ul {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}

.card ul li {
  cursor: pointer;
}

.card ul li {
  padding-bottom: 0.5rem;
}

.card ul li.active {
  border-bottom: 2px solid #398AB9;
}

.card ul li a {
  text-decoration: none;
  font-weight: 600;
}

.button_keluar {
  width: fit-content;
}

.modal-dialog {
  max-width: 35rem;
}

.modal-dialog h1 {
  font-size: 1.5rem;
  font-weight: 600;
}

.modal-dialog a {
  width: 12rem;
}

.btn_custom_outline {
  border-width: 2px !important;
}

.btn_custom_outline:hover {
  color: #FFFFFF !important;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }

  .card ul {
    gap: 1rem;
    flex-direction: column;
  }
}
</style>