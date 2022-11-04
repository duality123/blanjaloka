<template>
  <BaseLayout title="UMKM Notifikasi">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmSidebar />
          <div class="col-lg-8">
            <div class="card mb-3" v-if="currentStep === 1">
              <div class="card-body">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">
                  <h1>Notifikasi</h1>
                  <a href="#" class="text-primary-blue-6 mb-0">Tandai sudah dibaca</a>
                </div>
                <div class="mt-4">
                  <div class="bg-primary-blue-1 p-3 mb-4 card-notif">
                    <h1 class="text-neutral-gray-5">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit nama
                      notifikasi.
                    </h1>
                    <p class="text-neutral-gray-3 mb-0">1 November 2022 | 15.30 WIB</p>
                  </div>
                  <div class="bg-primary-blue-1 p-3 mb-4 card-notif">
                    <h1 class="text-neutral-gray-5">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit nama
                      notifikasi.
                    </h1>
                    <p class="text-neutral-gray-3 mb-0">1 November 2022 | 15.30 WIB</p>
                  </div>
                  <div class="p-3 mb-4 card-notif">
                    <h1 class="text-neutral-gray-5">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit nama
                      notifikasi.
                    </h1>
                    <p class="text-neutral-gray-3 mb-0">1 November 2022 | 15.30 WIB</p>
                  </div>
                  <div class="p-3 mb-4 card-notif">
                    <h1 class="text-neutral-gray-5">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit nama
                      notifikasi.
                    </h1>
                    <p class="text-neutral-gray-3 mb-0">1 November 2022 | 15.30 WIB</p>
                  </div>
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
import BaseLayout from '../../Layouts/Layout.vue'
import UmkmSidebar from '../../Components/UmkmSidebar.vue'
import { ref } from 'vue'

const currentStep = ref(1);
</script>

<style scoped>
section {
  margin-top: 10rem !important;
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

.card a {
  text-decoration: none;
}

.card-notif h1 {
  font-size: 1.25rem;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }

  .card-notif h1 {
    font-size: 1rem;
  }
}
</style>