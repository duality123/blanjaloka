<template>   
 <div class="col-lg-8">
              <div id="myModal" class="modal" v-if="popupTambahUMKM" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleTutup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
         <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih  UMKM</h3>
      </li>
    </ul>
    <div v-if="this.umkm_all ==null" class="d-flex justify-content-center mt-4">
    <div class="spinner-border text-primary"></div>
  </div>

    <section  v-else >
       <div class="row">
         <div class="col d-flex justify-content-start">
        <MultiSearch :lazy="['umkm','umkm_all']" :url="`/admin/kegiatan/${kegiatan.id}/umkm?page=1`" judul="Cari UMKM berdasarkan nama,perusahaan,atau produk" />
        
      </div>
    </div>
           <div class="table-responsive tabletambah">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto UMKM</th>
              <th scope="col">Nama UMKM</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Produk</th>
              <th scope="col">Provinsi/lokasi</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr  v-for="(index,no) in umkm_all.data">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" :href="`/detail/profil/umkm/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_produk}}</td>
               <td>{{index.provinsi}}</td>
              <td>{{index.no_hp}}</td>
              <td>
               <button v-if="umkm.includes(index.id)" @click="this.toggleDeleteModal(id_delete=index.id)"  class="btn btn-semantic-error-4 text-neutral-white">
                <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus dari kegiatan
                </button  >
                 <button v-else @click="this.submitTambahUmkm(umkm_id=index.id)" class="btn btn-semantic-success-4  text-neutral-white">
                  <font-awesome-icon icon="fa-solid fa-plus" />
                  Tambahkan ke kegiatan
                </button  >

              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div  class="d-flex justify-content-center mt-4">
          <Pagination :lazy="['umkm','umkm_all']" :links="this.umkm_all.links"/>
      </div>
    </section>
    </div>
  </div>
      </div>
    </div>
  <RemoveUMKMLayoutModal :lazy="['umkm','umkm_all']" pesan="Anda yakin ingin mengeluarkan UMKM ini" :popup="this.deletePopupModal" :itemDelete="this.itemDelete" url="/admin/kegiatan/hapus_umkm" @toggleClose="toggleDeleteModal()" /> 
  <RemoveUMKMLayout pesan="Anda yakin ingin mengeluarkan UMKM ini" :popup="this.deletePopup" :itemDelete="this.itemDelete" url="/admin/kegiatan/hapus_umkm" @toggleClose="toggleDelete()" /> 
 <Layout section="umkm" :title="kegiatan.tema" :link="kegiatan.id">
    <ul class="tabs mt-4">
      <li class="active" >
          <h3>Daftar UMKM Yang Tergabung di Kegiatan</h3>
      </li>
    </ul>
    <section>
        <div class=" col d-flex justify-content-end mt-4 ">
        <button @click="toggleTambahUmkm()" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah UMKM
        </button>
      </div>
      <MultiSearch :url = "`/admin/kegiatan/${kegiatan.id}/umkm?page=1`"/>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto</th>
              <th scope="col">Nama</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Produk</th>
              <th scope="col">Provinsi/lokasi</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr  v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" :href="`/detail/profil/umkm/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_produk}}</td>
              <td>{{index.provinsi}}</td>
              <td>{{index.no_hp}}</td>
              <td>
                 <button v-if="!index.lulus_funding" @click="this.changeStatus(index.id)" class="btn btn-semantic-success-4  text-neutral-white ">
                  Luluskan
                </button  >
                 <button v-else @click="this.changeStatus(index.id)" class="btn m-t btn-semantic-error-2 text-semantic-error-4">
                  Batal Luluskan
                </button  >
                    <button @click="this.toggleDelete(id_delete=index.id)" class="m-2 btn btn-semantic-error-4 text-neutral-white">
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
import RemoveUMKMLayout from '../../../Components/RemoveItem.vue';
import RemoveUMKMLayoutModal from '../../../Components/RemoveItem.vue';
import Pagination from '../../../Components/Pagination.vue';
import Search from '../../../Components/Search.vue';
import MultiSearch from '../../../Components/MultiSearchUMKM.vue';
import { Inertia } from "@inertiajs/inertia";
export default{
    data(){
        return{
          deletePopup:false,
          deletePopupModal:false,
          itemDelete:null,
          popupTambahUMKM:false,
          idDelete:null,
          kegiatan_id:this.kegiatan.id,
          currentPage:document.location.pathname

      }
    },
    props:{
      items :Object,
      kegiatan:Object,
      umkm:Array,
      umkm_all:Object
    },
    components: {
     Layout,
      Link,
      Pagination,
      RemoveUMKMLayout,
      RemoveUMKMLayoutModal,
      Search,
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
       toggleTambahUmkm(){
        this.popupTambahUMKM = !this.popupTambahUMKM
        Inertia.visit('/admin/kegiatan/'+this.kegiatan_id+'/umkm?page=1',{ only: ['umkm','umkm_all'],preserveState:true})
         

       },
       toggleTutup(){
        this.popupTambahUMKM = !this.popupTambahUMKM
        Inertia.visit('/admin/kegiatan/'+this.kegiatan.id+'/umkm?page=1',{preserveState:true})
        
       },
      submitTambahUmkm(umkm_id){
        Inertia.post('/admin/kegiatan/tambah_umkm'
          ,{umkm_id:umkm_id,kegiatan_id:this.kegiatan.id}
          ,{only: ['umkm','umkm_all'],preserveState:true}
          )
      },
      changeStatus(userid){
        Inertia.post('/admin/kegiatan/ubah_status_publikasi',{user_id:userid,kegiatan_id:this.kegiatan.id})
      },
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

