<template>
   <RemoveJanjiTemuLayout pesan="Anda yakin ingin menghapus janji temu ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/hapus_janjitemu" @toggleClose="switchClose()" />
    <DashboardLayout title="Janji Temu" state="janjitemu">
          <section>
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Daftar Kegiatan Janji Temu</h3>
      </li>
    </ul>
       <div class="col d-flex justify-content-end mt-4 mb-4">
         <Link href="/admin/tambah_janji_temu_view" class="fs-btn p-2 px-3 btn text-white bg-primary-blue-6 border-primary-blue-6">
                        + Tambah Janji Temu
                    </Link>
      </div>
         <div class="col-xl-12 d-flex justify-content-start">
         <MultiSearchJanjiTemu :url="`/admin/janjitemu/?page=1`" judul="Cari Jadwal janji temu" />
        <div class="dropdown   ">
  <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><Link preserve-state :data="{berakhir:'t'}" class="dropdown-item" :href="url">Sudah selesai</Link></li>
                <li><Link preserve-state :data="{berakhir:'f'}" class="dropdown-item" :href="url">Belum Selesai</Link></li>
              </ul>
            </div>
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
                  <td><Link :href="`/detail/profil/investor/${index.investor.profil.user_id}`" class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">{{index.investor.profil.nama_lengkap}}</Link>
                  </td>
                  <td>         
                     <td><Link  :href="`/detail/profil/umkm/${index.umkm.profil.user_id}`" class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">{{index.umkm.profil.nama_lengkap}}</Link>
                  </td>
                </td>
             <td>{{index.berakhir}}</td>

         
              <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                  <Link :href="`/admin/ubah_janji_temu_view/${index.id}`" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </Link>
                 <button @click="this.switchClose(id=index.id)"  class="btn btn-semantic-error-4 text-neutral-white">
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
import Search from '../../Components/Search.vue';
import MultiSearchUMKM from '../../Components/MultiSearchUMKM.vue';
import MultiSearchInvestor from '../../Components/MultiSearchInvestor.vue';
import MultiSearchJanjiTemu from '../../Components/JanjiTemuMultiSearch.vue'
export default{
    data(){
        return{
          popup:false,
          popupEdit:false,
          deletePopup:false,
          itemDelete:null,
          investorShowValue:10,
          umkmShowValue:10,
          url:document.location.href
        

      }
    },
  mounted(){
    /*
     let uri = window.location.search.substring(1)
        let params = new URLSearchParams(uri)
        if (params.get('limitInv')) {
            this.investorShowValue = params.get('limitInv');
        }
        if(params.get('limitUMKM')) {
           this.umkmShowValue = params.get('limitUMKM');
        }
        */
   
  },
  setup(props){
        const form = useForm({
         janji_temu_id:null,
         lokasi:null,
         dimulai:null,
         berakhir:null,
         investor:null,
         umkm:null

         
    })


    return {form}
  },

    props:{
      items : Object,
      umkm_all:Object,
      investor_all:Object,
      countUMKM:Number,
      countInvestor:Number
    },
    components: {
      DashboardLayout,
      Link,
      RemoveJanjiTemuLayout,
      Pagination,
      Search,
      MultiSearchUMKM,
      MultiSearchInvestor,
      MultiSearchJanjiTemu
    },

    methods:{
       switchClose(id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:id}
      },
   

    }

}
</script>

<style scoped>
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
.tdnama{
  margin-left: 4px;
}

.tdimg{
  width: 200px;
  height: 100px;
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
.imagetd{
  width: 100px;
  height: 100px;
}
.modal {
  position: fixed; /* Stay in place */
  left: 0;
  display: block;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.1); /* Black w/ opacity */
  padding: 2px;
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: 3rem;
  margin-left:4rem;
  padding: 20px;
  border-radius: 25px;
  width: 90%;
  height: 85%;
  overflow-y: scroll;
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
	width: 100%;
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
  text-align: start;
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


.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
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
