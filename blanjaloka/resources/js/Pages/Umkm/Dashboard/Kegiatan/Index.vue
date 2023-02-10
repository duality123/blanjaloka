<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h1>Kegiatanku</h1>
                <div class="row">
                  <div class="col-lg-5">
                    <Link href="/umkm/dashboard/kegiatan/1" class="text-decoration-none">
                    <div class="card card_kegiatan">
                      <div class="card-body">
                        <div class="position-relative overflow-hidden rounded">
                          <img src="../../../../assets/images/kegiatanku_example.png" alt="kegiatanku image"
                            class="img-fluid w-100" />
                          <div class="bg-semantic-success-1 text-semantic-success-4 status">Sedang Berlangsung</div>
                        </div>
                        <div>
                          <h1 class="text-neutral-black mt-2">UMKM Incubation Nusantara 2022 #Batch 2</h1>
                          <p class="text-neutral-gray-4 mb-0">7 Oktober 2022 - 1 Februari 2023</p>
                        </div>
                      </div>
                    </div>
                    </Link>
                  </div>
                  <div class="col-lg-5">
                    <Link href="/umkm/dashboard/kegiatan/1" class="text-decoration-none">
                    <div class="card card_kegiatan">
                      <div class="card-body">
                        <div class="position-relative overflow-hidden rounded">
                          <img src="../../../../assets/images/kegiatanku_example.png" alt="kegiatanku image"
                            class="img-fluid w-100" />
                          <div class="bg-neutral-gray-1 text-neutral-gray-4 status">Selesai</div>
                        </div>
                        <div>
                          <h1 class="text-neutral-black mt-2">UMKM Incubation Nusantara 2022 #Batch 2</h1>
                          <p class="text-neutral-gray-4 mb-0">7 Oktober 2022 - 1 Februari 2023</p>
                        </div>
                      </div>
                    </div>
                    </Link>
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
import { Link } from '@inertiajs/inertia-vue3';
import BaseLayout from '../../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../../Components/UmkmDashboardSidebar.vue'
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

.card_kegiatan {
  border: none;
  cursor: pointer;
  transition: 300ms;
}

.card_kegiatan:hover {
  background-color: #F2F7FA;
}

.card_kegiatan .status {
  position: absolute;
  top: 0;
  left: 0;
  font-size: 0.75rem;
  font-weight: 400;
  padding: 0.5rem;
  border-bottom-right-radius: 0.375rem;
}

.card_kegiatan h1 {
  font-size: 1.125rem;
  font-weight: 600;
}

.card_kegiatan p {
  font-size: 0.875rem;
  font-weight: 500;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>