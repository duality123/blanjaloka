<template>

              <div id="myModal" class="modal" v-if="popupTambahInvestor" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleTutup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih Investor</h3>
      </li>
    </ul>
    <div v-if="this.investor_all ==null" class="d-flex justify-content-center mt-4">
    <div class="spinner-border text-primary"></div>
  </div>

    <section  v-else >
       <div class="row">
         <div class="col d-flex justify-content-start">
        <MultiSearch :lazy="['investor','investor_all']"  :url="`/admin/kegiatan/${kegiatan.id}/investor?page=1`" />
        
      </div>
    </div>
           <div class="table-responsive tabletambah">
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
             <tr v-for="(index,no) in investor_all.data">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" :href="`/detail/profil/investor/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_perusahaan}}</td>
              <td>{{index.no_hp}}</td>
              <td>
               <button v-if="investor.includes(index.id)" @click="this.toggleDeleteModal(id_delete=index.id)"  class="btn btn-semantic-error-4 text-neutral-white m-2 ">
                <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus dari kegiatan
                </button  >
                 <button v-else @click="this.submitTambahInvestor(investor_id=index.id)" class="btn btn-semantic-success-4 m-2  text-neutral-white">
                   <font-awesome-icon icon="fa-solid fa-plus" />
                  Tambahkan ke kegiatan
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
          <Pagination :lazy="['investor_all','investor']" :links="investor_all.links"/>
      </div>
    </section>
  </div>
      </div>
<RemoveInvestorLayout pesan="Anda yakin ingin mengeluarkan investor ini" :popup="this.deletePopup" :itemDelete="this.itemDelete" url="/admin/kegiatan/hapus_investor" @toggleClose="toggleDelete()" />   
<RemoveInvestorLayoutModal :lazy="['investor','investor_all']" pesan="Anda yakin ingin mengeluarkan investor ini" :popup="this.deletePopupModal" :itemDelete="this.itemDelete" url="/admin/kegiatan/hapus_investor" @toggleClose="toggleDeleteModal()" />  
 <Layout section="investor" :title="kegiatan.tema" :link="kegiatan.id">
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Daftar Investor Yang Tergabung di Kegiatan</h3>
      </li>
    </ul>
    <section>
        <div class=" col d-flex justify-content-end">
        <button @click="toggleTambahInvestor()" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Investor
        </button>
      </div>
        <MultiSearch :url="`/admin/kegiatan/${kegiatan.id}/investor?page=1`"/>
      <div class="table-responsive">
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
             <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link :href="`/detail/profil/investor/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_perusahaan}}</td>
              <td>{{index.no_hp}}</td>
              <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                <button @click="this.toggleDelete(id_delete=index.id)" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Keluarkan
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
  </Layout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import Layout from '../../../Layouts/Kegiatan.vue';
import RemoveInvestorLayout from '../../../Components/RemoveItem.vue';
import RemoveInvestorLayoutModal from '../../../Components/RemoveItem.vue';
import Pagination from '../../../Components/Pagination.vue';
import MultiSearch from '../../../Components/MultiSearchInvestor.vue';
import { Inertia } from "@inertiajs/inertia";
export default{
    data(){
        return{
          deletePopup:false,
          deletePopupModal:false,
          itemDelete:null,
          popupTambahInvestor:false,
          idDelete:null,
          kegiatan_id:this.kegiatan.id,
          currentPage:document.location.pathname.split('/')[4]

      }
    },
  setup(props){
        const form = useForm({
         kegiatan_id:props.kegiatan.id,
         nama_investor:''
    })

    return {form}
  },
    props:{
      items :Object,
      kegiatan:Object,
      investor:Array,
      investor_all:Object
    },
    components: {
     Layout,
      Link,
      Pagination,
      RemoveInvestorLayout,
      RemoveInvestorLayoutModal,
      MultiSearch
    },

    methods:{

       toggleDelete(id_delete=null){
          this.deletePopup = !this.deletePopup
          this.itemDelete = {kegiatan_id:this.kegiatan.id,id:id_delete}
          
       },

       toggleDeleteModal(id_delete=null){
          this.deletePopupModal = !this.deletePopupModal
          this.itemDelete = {kegiatan_id:this.kegiatan.id,id:id_delete}
          
       },
       toggleTambahInvestor(){
        this.popupTambahInvestor = !this.popupTambahInvestor
        Inertia.visit('/admin/kegiatan/'+this.kegiatan_id+'/investor?page=1',{ only: ['investor','investor_all'],preserveState:true})
         

       },
       toggleTutup(){
        this.popupTambahInvestor = !this.popupTambahInvestor
        Inertia.visit('/admin/kegiatan/'+this.kegiatan.id+'/investor?page=1',{preserveState:true})
        
       },
      submitTambahInvestor(investor_id){
        Inertia.post('/admin/kegiatan/tambah_investor'
          ,{investor_id:investor_id,kegiatan_id:this.kegiatan.id}
         ,{only: ['investor','investor_all'],preserveState:true}
          )
      }
      },

  }


</script>

<style scoped>
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
.imagetd{
  width: 100px;
  height: 100px;
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

.tabletambah{
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
