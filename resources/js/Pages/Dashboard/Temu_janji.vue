<template>
    <RemoveJanjiTemuLayout pesan="Anda yakin ingin menghapus Janji Temu ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/dashboard/hapus_janjitemu" @toggleClose="switchClose()" />
  <DashboardLayout title="Janji Temu" state="janjitemu">
      <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popup" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "popupExit()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Tambah Temu Janji</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submit()">
  
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Lokasi</label>
         <input type="text" class="form-control" v-model="form.lokasi" id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger"></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Dimulai</label>
         <input type="date" class="form-control" v-model="form.dimulai"  id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger"></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Berakhir</label>
         <input type="date" class="form-control" v-model="form.berakhir"  id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger"></small>
      </div>
        <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Nama UMKM</label>
          <v-select multiple placeholder="Masukkan nama-nama investor kegiatan" id="nama_investor"
                :options="umkm" v-model="form.umkm" />
           <small class="text-danger"></small>
      </div>
         <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Nama Investor</label>
          <v-select multiple placeholder="Masukkan nama-nama investor kegiatan" id="nama_investor"
                :options="investor" v-model="form.investor" />
           <small class="text-danger"></small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Kegiatan Janji Temu</h1>
    </div>
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Daftar Kegiatan Janji Temu</h3>
      </li>
    </ul>
    <section>
      <div class="d-flex justify-content-end">
         <submit @click="popupExit()" class="fs-btn p-2 px-3 btn text-white bg-primary-blue-6 border-primary-blue-6">
                        + Tambah Janji Temu
                    </submit>
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Mulai</th>
              <th scope="col">Investor</th>
                <th scope="col">UMKM</th>
                <th scope="col">Berakhir</th>
                <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
               <td>{{index.lokasi}}</td>
               <td>{{index.waktu}}</td>
                <td>{{index.nama_investor}}</td>
             <td>{{index.nama_umkm}}</td>
             <td>{{index.berakhir}}</td>
         
              <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                  <button @click="this.toggleEdit(id=index.id)" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </button>
                 <button @click="this.switchClose(elearning_id=index.id)"  class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../assets/icons/icon_delete.png" alt="delete icon">
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
import { Inertia } from '@inertiajs/inertia'
import DashboardLayout from '../../Layouts/Dashboard.vue';
import RemoveJanjiTemuLayout from '../../Components/RemoveItem.vue';
import Pagination from '../../Components/Pagination.vue';
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
         lokasi:'',
         dimulai:null,
         berakhir:null,
         investor:'',
         umkm:''
         
    })

    return {form}
  },
    props:{
      items : Object,
      umkm:Array,
      investor:Array
    },
    components: {
      DashboardLayout,
      Link,
      RemoveJanjiTemuLayout,
      Pagination
    },
    mounted(){
      console.log( this.currentPage);
    },
    methods:{
       switchClose(id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:id}
      },
      Edit(id=null){
        Inertia.post('/admin/dashboard/ubah_janji_temu',{'id':id})
      },
      toggleEdit(id=null){
        
      }
      popupExit(){
        this.popup = ! this.popup
      },
      submit(){
        this.popup = !this.popup
        this.form.post('/admin/dashboard/tambah_janji_temu');
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
  height: 450px;
  overflow-y: scroll;
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
