<template>
      <div class="col-lg-8" v-if="popupEdit">

              <div id="myModal" class="modal"  >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleEditClose()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Edit Temu Janji</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="editJanjiTemu()">
      <div v-if="this.umkm_all == null" class="d-flex justify-content-center mt-4">
            <div class="spinner-border text-primary"></div>
      </div>
      <div class="mt-4" v-else>
    <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih Investor</h3>
      </li>
    </ul>

        <div class="row">
         <div class="col d-flex justify-content-start">
        <MultiSearchInvestor :lazy="['investor_all','umkm_all']" url="/admin/janjitemu?page=1" />
        
      </div>
    </div>
           <div class="table-responsive ">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto Investor</th>
              <th scope="col">Nama Investor</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Perusahaan</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr  v-for="(index,no) in investor_all">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" :href="`/detail/profil/investor/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_perusahaan}}</td>
              <td>{{index.no_hp}}</td>
              <td>
               <button v-if="this.form.investor!= index.id"  @click="this.togglePilihInvestor(id_investor=index.id)"  class="btn btn-primary-blue-6 text-neutral-white">
                  <font-awesome-icon icon="fa-solid fa-plus" />
                  Pilih {{this.form.investor}}
                </button  >
                <button v-else @click="this.toggleBatalPilihInvestor()" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../assets/icons/icon_delete.png" alt="delete icon">
                  Batal pilih
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
        <div v-if="this.investorShowValue+10 <= this.countInvestor" class="d-flex justify-content-center mt-4">
        <button @click="loadMoreInv()" class="btn btn-primary-blue-6 text-neutral-white">Lihat lebih banyak Investor</button>
      </div>


      <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih UMKM </h3>
      </li>
    </ul>

        <div class="row">
         <div class="col d-flex justify-content-start">
        <MultiSearchUMKM :lazy="['umkm_all','investor_all']" url="/admin/janjitemu?page=1" />
        
      </div>
    </div>
           <div class="table-responsive ">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
             <tr>
              <th scope="col">No</th>
              <th scope="col">Foto UMKM</th>
              <th scope="col">Nama UMKM</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Produk</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr  v-for="(index,no) in umkm_all">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" :href="`/detail/profil/umkm/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_produk}}</td>
              <td>{{index.no_hp}}</td>
              <td >
                <button v-if="this.form.umkm != index.id"  @click="this.togglePilihUmkm(id_investor=index.id)"  class="btn btn-primary-blue-6 text-neutral-white">
                  <font-awesome-icon icon="fa-solid fa-plus" />
                  Pilih
                </button  >
                <button v-else @click="this.toggleBatalPilihUmkm()" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../assets/icons/icon_delete.png" alt="delete icon">
                  Batal pilih
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-if="this.umkmShowValue+10 <= this.countUMKM" class="d-flex justify-content-center mt-4">
        <button @click = "loadMoreUMKM()" class="btn btn-outline-primary-blue-6 text-neutral-white">Lihat lebih banyak UMKM</button>
      </div>

      </div>
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Lokasi</label>
         <input type="text" class="form-control" v-model="form.lokasi" id="provinsi" placeholder="Masukkan lokasi kegiatan" >
           <small class="text-danger"></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Dimulai</label>
         <input type="datetime-local" class="form-control" v-model="form.dimulai"  id="provinsi" placeholder="Masukkan waktu dimulai kegiatan" >
           <small class="text-danger"></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Berakhir</label>
         <input type="datetime-local" class="form-control" v-model="form.berakhir"  id="provinsi" placeholder="Masukkan waktu berakhir kegiatan" >
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
<div class="col-lg-8" v-if="popup" >
              <div id="myModal" class="modal" >
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
      <div v-if="this.investor_all == null" class="d-flex justify-content-center mt-4">
            <div class="spinner-border text-primary"></div>
      </div>
      <div class="mt-4" v-else>
    <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih Investor</h3>
      </li>
    </ul>

        <div class="row">
         <div class="col d-flex justify-content-start">
        <MultiSearchInvestor :lazy="['investor_all','umkm_all']"  url="/admin/janjitemu?page=1"  />
        
      </div>
    </div>

           <div class="table-responsive ">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto Investor</th>
              <th scope="col">Nama Investor</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Perusahaan</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr  v-for="(index,no) in investor_all">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" :href="`/detail/profil/investor/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_perusahaan}}</td>
              <td>{{index.no_hp}}</td>
              <td>
               <button v-if="this.form.investor != index.id"  @click="this.togglePilihInvestor(id_investor=index.id)"  class="btn btn-primary-blue-6 text-neutral-white">
                  <font-awesome-icon icon="fa-solid fa-plus" />
                  Pilih
                </button  >
                <button v-else @click="this.toggleBatalPilihInvestor()" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../assets/icons/icon_delete.png" alt="delete icon">
                  Batal pilih
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
        <div v-if="this.investorShowValue+10 <= this.countInvestor" class="d-flex justify-content-center mt-4">
        <button @click="loadMoreInv()" class="btn btn-primary-blue-6 text-neutral-white">Lihat lebih banyak Investor</button>
      </div>


      <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih UMKM</h3>
      </li>
    </ul>

        <div class="row">
         <div class="col d-flex justify-content-start">
        <MultiSearchUMKM :lazy="['umkm_all','investor_all']" url="/admin/janjitemu?page=1"   />
        
      </div>
    </div>
           <div class="table-responsive ">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
             <tr>
              <th scope="col">No</th>
              <th scope="col">Foto UMKM</th>
              <th scope="col">Nama UMKM</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Produk</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-if="umkm_all.length <= this.umkmShowValue "  v-for="(index,no) in umkm_all">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link :href="`/detail/profil/investor/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_produk}}</td>
              <td>{{index.no_hp}}</td>
              <td >
                <button v-if="this.form.umkm != index.id"  @click="this.togglePilihUmkm(id_investor=index.id)"  class="btn btn-primary-blue-6 text-neutral-white">
                  <font-awesome-icon icon="fa-solid fa-plus" />
                  Pilih
                </button  >
                 <button v-else @click="this.toggleBatalPilihUmkm()" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../assets/icons/icon_delete.png" alt="delete icon">
                  Batal pilih
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
        <div v-if="this.umkmShowValue+10 <= this.countUMKM" class="d-flex justify-content-center mt-4">
        <button @click="loadMoreUMKM()" class="btn btn-primary-blue-6 text-neutral-white">Lihat lebih banyak UMKM</button>
      </div>

      </div>
           <div class="mt-2">
      <form @submit.prevent="tambahJanjiTemu()">
  
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Lokasi</label>
         <input type="text" class="form-control" v-model="form.lokasi" id="provinsi" placeholder="Masukkan lokasi" >
           <small class="text-danger"></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Dimulai</label>
         <input type="datetime-local" class="form-control" v-model="form.dimulai"  id="provinsi" placeholder="Masukkan waktu dimulai" >
           <small class="text-danger"></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Berakhir</label>
         <input type="datetime-local" class="form-control" v-model="form.berakhir"  id="provinsi" placeholder="Masukkan waktu berakhir" >
           <small class="text-danger"></small>
      </div>

      <button type="submit" class="btn btn-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
    <DashboardLayout title="Janji Temu" state="janjitemu">
          <section>
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Daftar Kegiatan Janji Temu</h3>
      </li>
    </ul>
       <div class="col d-flex justify-content-end mt-4 mb-4">
         <button @click="popupOpen()" class="fs-btn p-2 px-3 btn text-white bg-primary-blue-6 border-primary-blue-6">
                        + Tambah Janji Temu
                    </button>
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
                  <button @click="this.toggleEditOpen(id=index.id,lokasi=index.lokasi,waktu=index.waktu,umkm=index.umkm.id,investor=index.investor.id,berakhir=index.berakhir,dimulai=index.waktu)" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </button>
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
     let uri = window.location.search.substring(1)
        let params = new URLSearchParams(uri)
        if (params.get('limitInv')) {
            this.investorShowValue = params.get('limitInv');
        }
        if(params.get('limitUMKM')) {
           this.umkmShowValue = params.get('limitUMKM');
        }
   
  },
  setup(props){
        const form = useForm({
         janji_temu_id:null,
         lokasi:'',
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
      toggleEditOpen(id=null,lokasi=null,waktu=null,umkm=null,investor=null,berakhir=null,dimulai=null){
        this.popupEdit = !this.popupEdit
        this.form.janji_temu_id = id
        this.form.lokasi = lokasi
        this.form.dimulai= dimulai
        this.form.umkm=umkm
        this.form.investor=investor
        this.form.berakhir=berakhir
        console.log(this.form.umkm);
        Inertia.visit('/admin/janjitemu?page=1',{ only:['investor_all','umkm_all','countUMKM','countInvestor'],preserveState:true }) 
        
      },
      toggleEditClose(){
        this.form.reset()
        Inertia.visit('/admin/janjitemu?page=1',{preserveState:false }) 
        
      },
      togglePilihInvestor(id_investor){
          this.form.investor = id_investor
      },
      toggleBatalPilihInvestor(){
          this.form.umkm = null
      },
      togglePilihUmkm(id_umkm){
          this.form.umkm = id_umkm
      },
      toggleBatalPilihUmkm(){
          this.form.umkm = null
      },
      popupOpen(){
        this.popup = ! this.popup
        console.log(this.popup)
        Inertia.visit('/admin/janjitemu?page=1',{ only:['investor_all','umkm_all','countUMKM','countInvestor'],preserveState:true })       
      },
      popupExit(){
        this.popup = ! this.popup
        this.form.reset()
        Inertia.visit('/admin/janjitemu?page=1',{preserveState:true })       
      },
      tambahJanjiTemu(){
        this.form.post('/admin/tambah_janji_temu',{onSuccess: () => this.form.reset(),preserveState:false});
      },
      editJanjiTemu(){
        this.form.post('/admin/edit_janji_temu',{preserveState:false});
      },
      loadMoreInv(){
         this.investorShowValue = parseInt(  this.investorShowValue)+10
        Inertia.get(document.location.href,{limitInv:this.investorShowValue},{ only:['investor_all','umkm_all','countUMKM','countInvestor'],preserveState:true })       
      },

       loadMoreUMKM(){
        this.umkmShowValue = parseInt(  this.umkmShowValue)+10
        Inertia.get(document.location.href,{limitUMKM:this.umkmShowValue},{ only:['investor_all','umkm_all','countUMKM','countInvestor'],preserveState:true })       
      }
 

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
