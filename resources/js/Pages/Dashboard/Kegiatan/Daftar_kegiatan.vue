<template>
    <RemoveKegiatanLayout pesan="Anda yakin ingin menghapus kegiatan ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/dashboard/kegiatan/hapus_kegiatan" @toggleClose="switchClose()" />
  <DashboardLayout title="Daftar kegiatan" state="kegiatan">
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
             <tr v-for="(index,no) in items.data">
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
                <button @click="this.switchClose(kegiatan_id=index.id)" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
      <Pagination :links="items.links"/>
      </div>
    </section>
  </DashboardLayout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import RemoveKegiatanLayout from '../../../Components/RemoveItem.vue';
import Pagination from '../../../Components/Pagination.vue';
export default{
    data(){
        return{
          popup:false,
          deletePopup:false,
          itemDelete:null

      }
    },
  setup(props){
        const form = useForm({
         id:null,
         tema:null,
         mulai:null,
         berakhir:null,
         jumlah_peserta:null,
         status:null,
    })

    return {form}
  },
    props:{
      items :Object,
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
      Link,
      RemoveKegiatanLayout,
      Pagination
    },
    methods:{
       switchClose(kegiatan_id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:kegiatan_id}
      }
    }

}
</script>

<style scoped>
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}

.close{
  border-width: 0px;
  background-color: white;
}
.modal-content{
  text-align: start;
}
.modal {
  position: fixed; /* Stay in place */
  padding-top: 100px; /* Location of the box */
  left: 0;
  display: block;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.1); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin-top: 3rem;
  margin-left: 25rem;
  padding: 20px;
  border-radius: 25px;
  width: 40%;
  text-align: center;
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


.modal-content{
  text-align: start;
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
