<template>
  <DashboardLayout title="Peserta Admin">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Kegiatan</h1>
    </div>
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Daftar Kegiatan</h3>
      </li>
    </ul>
    <section>
      <div class="d-flex justify-content-end">
        <Link href="/admin/dashboard/kegiatan/tambah_kegiatan/baru" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Kegiatan
        </Link>
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tema</th>
              <th scope="col">Id Kegiatan</th>
              <th scope="col">Mulai</th>
              <th scope="col">Berakhir</th>
              <th scope="col">Jumlah peserta</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items">
              <th scope="row">{{++no}}</th>
              <td><Link :href="`/admin/dashboard/kegiatan/${index.id}/detail`">{{index.tema}}</Link></td>
               <td>{{index.id}}</td>
               <td>{{index.dimulai}}</td>
                <td>{{index.berakhir}}</td>
                 <td>{{index.total_peserta}}/{{index.jumlah_orang_diundang}}</td>
                <td v-if="index.draft">Aktif</td>
                <td v-else>Tidak Aktif</td>
              <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                <Link :href="`/admin/dashboard/kegiatan/${index.id}/edit`" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </Link>
                <Link :href="`/admin/dashboard/kegiatan/${index.id}/hapus`" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
          <li v-if="prev">
            <Link :href="`/admin/dashboard/users/umkm/${prev}`">
              <font-awesome-icon icon="fa-solid fa-chevron-left" class="text-primary-blue-6" />
            </Link>
          </li>
          <li v-if="first">
              <Link :href="`/admin/dashboard/users/umkm/${first}`">{{first}}</Link>
          </li>
          <li v-if="prevBlok">
              <Link :href="`/admin/dashboard/users/umkm/${prevBlok}`">...</Link>
          </li>
          <div v-for="num in paginationNums">
          <li :class="[currentPage == num ? 'active':'']">
              <Link :href="`/admin/dashboard/users/umkm/${num}`">{{num}}</Link>
          </li>
        </div>
        <li v-if="nextBlok">
          <Link :href="`/admin/dashboard/users/umkm/${nextBlok}`">...</Link>
        </li>
        <li v-if="last">
            <Link :href="`/admin/dashboard/users/umkm/${last}`">{{last}}</Link>
        </li>
          <li v-if="next">
            <Link :href="`/admin/dashboard/users/umkm/${next}`">
              <font-awesome-icon icon="fa-solid fa-chevron-right" class="text-primary-blue-6" />
            </Link>
          </li>
        </ul>
      </div>
    </section>
  </DashboardLayout>
</template>

<script>
import Paginate from 'vuejs-paginate-next';
import { Link, useForm } from '@inertiajs/inertia-vue3'
import DashboardLayout from '../../../Layouts/Dashboard.vue';
export default{
    data(){
        return{
          currentTabItem: window.location.pathname.split('/')[4],
          currentPage : window.location.pathname.split('/')[4],
          tabItems :['Admin','Investor','UMKM'],

      }
    },
    props:{
      items : Array,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number
    },
    components: {
      DashboardLayout,
      Paginate,
      Link
    },

}
</script>

<style scoped>
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}

.tabs {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}
table{
	width: 900px;
}

.tabs li {
  cursor: pointer;
}

.tabs li {
  padding-bottom: 0.5rem;
}

.tabs li.active {
  border-bottom: 2px solid #398AB9;
}

.tabs li a {
  text-decoration: none;
  font-weight: 600;
}



table thead tr td,
table thead tr th {
  font-weight: 600;
  color: #3E4041;
  border: none;
  text-align: center;
}

table tbody tr td,
table tbody tr th {
  font-weight: 400;
  color: #3E4041;
  border-bottom: none;
  text-align: center;
}

table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
  background-color: #F2F7FA;
}

.pagination {
  display: flex;
  flex-direction: row;
  column-gap: 2rem;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  list-style: none;
  background-color: #FFFFFF;
}




.form-control {
  overflow:
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
}

.pagination li {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5px 12px;
  border-radius: 2px;
  cursor: pointer;
  transition: 300ms;
}

.pagination li:hover {
  background-color: #398AB9;
}

.pagination li:hover a,
.pagination li:hover a svg {
  color: #FFFFFF !important;
}

.pagination li a {
  text-decoration: none;
  color: #3E4041;
  font-weight: 600;
}

.pagination li.active {
  background-color: #398AB9;
}

.pagination li.active a {
  color: #FFFFFF;
}

@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }

  .pagination li:nth-child(3),
  .pagination li:nth-child(4) {
    display: none;
  }
}
</style>
