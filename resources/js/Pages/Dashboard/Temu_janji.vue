<template>
    <RemoveJanjiTemuLayout pesan="Anda yakin ingin menghapus Janji Temu ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/dashboard/hapus_janjitemu" @toggleClose="switchClose()" />
  <DashboardLayout title="Janji Temu" state="janjitemu">
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
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Waktu</th>
              <th scope="col">Investor</th>
                <th scope="col">UMKM</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items">
              <th scope="row">{{++no}}</th>
               <td>{{index.lokasi}}</td>
               <td>{{index.waktu}}</td>
                <td>{{index.nama_investor}}</td>
             <td>{{index.nama_umkm}}</td>
             <td v-if="index.status==0">Menunggu</td>
             <td v-else-if="index.status==1">Disetujui</td>
              <td v-else-if="index.status==2">Reschedule</td>
              <td v-else-if="index.status==3">Selesai</td>
              <td>
                        <div class="d-flex justify-content-center mt-2">
                          <button  @click="action(id=index.id,aksi=1)" class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">Disetujui</button>
                        </div>
                          <div class="d-flex justify-content-center mt-2">
                           <button @click="action(id=index.id,aksi=2)" class="btn btn-semantic-warning-4 me-2 px-3  text-neutral-white cursor-pointer">
                           Reschedule
                          </button>
                        </div>
                          <div class="d-flex justify-content-center mt-2">
                          <button @click="action(id=index.id,aksi=3)" class="btn btn-semantic-success-4 me-2 px-3 text-neutral-white cursor-pointer">
                           Selesai
                          </button>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                          <button @click="switchClose(id=index.id)" class="btn btn-semantic-error-4 me-2 px-3 text-neutral-white cursor-pointer">
                           Hapus
                          </button>
                        </div>
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
              <Link :href="`/admin/dashboard/users/umkm/${num}`">{{currentPage}}</Link>
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
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import DashboardLayout from '../../Layouts/Dashboard.vue';
import RemoveJanjiTemuLayout from '../../Components/RemoveItem.vue';
export default{
    data(){
        return{
          popup:false,
          deletePopup:false,
          itemDelete:null,
          currentPage:window.location.pathname.split('/')[4],

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
      Link,
      RemoveJanjiTemuLayout
    },
    mounted(){
      console.log( this.currentPage);
    },
    methods:{
       switchClose(id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:id}
      },
      action(id=null,aksi=null){
        Inertia.post('/admin/dashboard/ubah_janji_temu',{'id':id,'update':aksi})
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
