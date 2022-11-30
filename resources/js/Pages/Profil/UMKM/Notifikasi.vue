<template>
  <DashboardLayout page = "notifikasi" >
           <section class="mt-4">
      <div class="container">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">
                  <h1>Notifikasi</h1>
          <!--        <a href="#" class="text-primary-blue-6 mb-0">Tandai sudah dibaca</a> -->
                </div>
                <div class="mt-4">
                    <div v-for="notifikasi in items" >
                  <div class="bg-primary-blue-1 p-3 mb-4 card-notif">
                    <h1 class="text-neutral-gray-5">
                      {{notifikasi.pesan}} <template v-if="notifikasi.nama.toLowerCase() == 'revisi profil' ">
                      <Link :href="`${notifikasi.redirect}`">Perbaiki data anda !</Link>
                    </template>
                    </h1>
                    <p class="text-neutral-gray-3 mb-0">{{notifikasi.tanggal}} WIB</p>
                  </div>
                </div>
                 </div>
                </div>
              </div>
            </div>
      </div>
    </section>
  </DashboardLayout>
</template>

<script>
import DashboardLayout from '../../../Layouts/Profile.vue';
import {Link} from '@inertiajs/inertia-vue3';
export default{
components:{
  DashboardLayout,
  Link
},
props:{
  items:Array,
}
}
</script>

<style scoped>
section {
  margin-top: 0rem !important;
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
@media (max-width: 575.98px) {
  .quit {
    align: start;
  }
}
.dropdown-list-image {
    position: relative;
    height: 2.5rem;
    width: 2.5rem;
}
.dropdown-list-image img {
    height: 2.5rem;
    width: 2.5rem;
}
.btn-light {
    color: #2cdd9b;
    background-color: #e5f7f0;
    border-color: #d8f7eb;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}

h2 {
  font-size: 1.3rem;
  font-weight: 400;
}

.card {
  border: none;
  border-radius: 1.25rem;
}

.fa-times{
  margin-left: 300px;
}

.card h3 {
  font-size: 1rem;
  font-weight: 400;
}
</style>
