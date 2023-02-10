<template>
   
 <Layout section="investasi" :title="bisnis.name" :link="bisnis.id">
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Track Record Investasi dan Pengeluaran</h3>
      </li>
    </ul>
    <section>
  <div class="row">
         <div class="col d-flex justify-content-start">
      <Search :url="`/admin/investasi/${bisnis.id}/detail_investasi/${currentUser}?page=1`" judul="Cari Track Record" /> 
        
      </div>  
 <div class="col d-flex justify-content-end">
        <button @click="togglePopupTambah()" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Track Record
        </button>
      </div>
  </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto</th>
              <th scope="col">Nama</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Perusahaan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <tr>
            
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
import Layout from './Layouts/Bisnis.vue';
import Search from './Components/Search.vue';
import Pagination from './Components/Pagination.vue';
import { Inertia } from "@inertiajs/inertia";
export default{
    data(){
        return{
          popup:false,
          deletePopup:false,
          itemDelete:null,
          cari:null,
          popupTambah:false,
          popupEdit:false,
          url:null,
          fileReviewer:null,
          message:null,
          popupLihatJawaban:false,
          currentUser:window.location.pathname.split('/')[5]

      }
    },
  setup(props){
        const form = useForm({
        uang_masuk:null,
        bisnis_id:props.bisnis.id,
        uang_keluar:null,
        bukti:null,
        user_id:window.location.pathname.split('/')[5]
    })

    return {form}
  },
    props:{
      items :Object,
      bisnis:Object,
    },
    components: {
      Layout,
      Link,
      RemoveKegiatanLayout,
      Pagination,
      Search
    },
    methods:{
       switchClose(delete_id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:delete_id}
      },
      togglePopupTambah(){
        this.form.reset()
        this.popupTambah = !this.popupTambah
      },
       togglePopupEdit(moneyIn=null,moneyOut=null,buktiIn=null){
        this.form.uang_masuk=moneyIn
        this.form.uang_keluar=moneyOut
        this.fileReviewer = buktiIn
        this.form.bukti = buktiIn
        this.popupEdit = !this.popupEdit
      },
      submitTambah(){
        this.popupTambah = false
        this.form.post('/admin/investasi/submit_record_investor',{onSuccess: () => this.form.reset()})
      },
       submitEdit(){
        this.popupEdit= false
        this.form.post('/admin/investasi/edit_record_investor',{onSuccess: () => this.form.reset()})
      },
      inputDokumen(event){
        console.log(event.target.files[0].type )
        if(event.target.files[0].type == 'application/pdf' || event.target.files[0].type == 'application/msword' || event.target.files[0].type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
            this.form.bukti = event.target.files[0]
            this.fileReviewer = null
            this.form.errors.bukti= null

   
           }
           else{
            this.form.errors.bukti= "dokumen anda harus pdf/docx !"

           }
    },
  },
    }


</script>

<style scoped>
td{
  width:200px;
}

.input_upload_custom h1,
.input_upload_custom h2 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0;
}
.input_upload_custom .position-relative {
  overflow: hidden;
  cursor: pointer;
}
.input_upload_custom p {
  font-size: 0.75rem;
  font-weight: 400;
  margin-bottom: 0;
}
.input_upload_custom input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.gambar_preview{
  width: 500px;
  height: 600px;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
.customfile{
  height:35px;
}

.imgtd{
  width: 100px;
  height: 100px;
}
.close{
  border-width: 0px;
  background-color: white;
}
.modal-content{
  text-align: start;
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
  padding: 10px;
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
  text-align: start;
}


table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
  background-color: #F2F7FA;
}

.form-control {
  background-color: transparent;
  resize: none;
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
