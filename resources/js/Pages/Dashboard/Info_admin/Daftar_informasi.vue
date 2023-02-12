<template>
        <div class="col-lg-8" v-if="popupTambah" >
              <div id="myModal" class="modal"  >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleTambah()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Tambah Info</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submitTambah()">
    
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan Pesan</label>
         <input type="text" class="form-control" v-model="form.isi" id="provinsi" placeholder="Masukkan pesan info yang ingin anda buat" >
           <small class="text-danger" v-if="form.errors.isi" >{{form.errors.isi}}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
      <div class="col-lg-8" v-if="popupEdit" >
              <div id="myModal" class="modal"  >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleEdit()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Edit Info</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submitEdit()">
    
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan Pesan</label>
         <input type="text" class="form-control" v-model="form.isi" id="provinsi" placeholder="Masukkan pesan info yang ingin anda buat" >
           <small class="text-danger" v-if="form.errors.isi" >{{form.errors.isi}}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
        <Remove pesan="Anda yakin ingin menghapus pesan ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/info_admin/hapus_info" @toggleClose="switchClose()" />
      <Layout state="info" title="Info Admin" >
          <ul class="tabs mt-4">
      <li class="active" >
          <h3>Daftar Info</h3>
      </li>
    </ul>
            <section class="mt-4">
          <div class="row">
                    <div class="col-xl-8 d-flex justify-content-start">
                       <Search url="/admin/info_admin?page=1" judul="Cari notifikasi berdasarkan judul atau tanggal" />  
                      <div class="col d-flex justify-content-end">
                        <div class="dropdown mx-3  ">
                    <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><Link preserve-state :data="{tanda:1}" class="dropdown-item" href="#">Info yang ditandai</Link></li>
                <li><Link preserve-state :data="{tanda:0}" class="dropdown-item" href="#">Info yang tidak ditandai</Link></li>
              </ul>
            </div>  
                    </div>
                    </div>
                       <div class=" col d-flex justify-content-end">
        <button @click="toggleTambah()" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Info
        </button>
      </div>
                  </div>  
              <div class="mt-4">
                  <div :class="[info.tandai?'bg-primary-blue-4' :'bg-primary-blue-1', 'p-3 mb-4 card-notif']" v-for="info in items.data"> 
                    <div class=" d-flex justify-content-end">
                               <div class="dropdown mx-3  ">
                                  <button class="dropdown-toggle dropdown-toggle-info " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  </button>
                                              <ul class="dropdown-menu dropdown-menu-end">
                                                <li><button @click="toggleEdit(info.id,info.isi)" class="dropdown-item " :href="url">Edit</button></li>
                                                 <li><button @click="switchClose(info.id)" class="dropdown-item" >Hapus</button></li>
                                                   <li><button @click="indexTandaiSingle(info.id)" class="dropdown-item" >Tandai</button></li>
                                              </ul>
                                            </div>
                    </div>
                    <div class="d-flex">
                    <div class="p-2 flex-grow-1"><h1 class="text-neutral-gray-5">{{info.isi}}</h1>
                                      <p :class="[info.tandai?'':'text-neutral-gray-3' ,'mb-0']" >{{info.tanggal}} WIB</p></div>
                  </div>
                        
                    
                  </div>
                </div>
                  <div class="d-flex justify-content-center mt-4">
                    <Pagination :links="items.links"/>
                  </div>
    </section>
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Dashboard.vue';
import Pagination from '../../../Components/Pagination.vue';
import Search from '../../../Components/Search.vue';
import Remove from '../../../Components/RemoveItem.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
export default{
  setup(){
    const form = useForm({
      isi:null,
      id:null
    })
    return {form}
  },
   data(){
      return{
        popupTambah:false,
        tandai:[],
        itemDelete:null,
        deletePopup:false,
        url:document.location.href,
        popupEdit:false
      }
    },
    props:{
      items : Object
    },
    components: {
      Layout,
      Link,
      Pagination,
      Search,
      Remove
    },
    
    methods:{
      switchClose(info_id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:info_id}
      },
      toggleTambah(){
        this.form.reset();
        this.popupTambah = !this.popupTambah
      },
       toggleEdit(id=null,isi=null){
        this.form.id = id
        this.form.isi = isi
        this.popupEdit = !this.popupEdit
      },
      submitTambah(){
        this.form.post('/admin/info_admin/tambah_info',{preserveState:true})
      },
      submitEdit(){
        this.form.post('/admin/info_admin/edit_info',{preserveState:true})
      },
      indexTandaiSingle(info_id=null){
        this.tandai.push(info_id)
        Inertia.post('/admin/info_admin/tandai',{id:this.tandai}, { preserveState: false,preserveScroll:true })
      },
    }
}
</script>

<style scoped>
.dropdown-toggle-info{
  border-width:0px;
  border-color: transparent;
  background-color: transparent;
}
.close{
  border-width: 0px;
  background-color: white;
}
.tdimg{
  width: 200px;
  height: 100px;
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
  text-align: start;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;

}
.custom-file-input::before {

  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0\00a0Upload Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload.png');
  background-repeat: no-repeat;
  background-size: 18px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

.custom-file-input2::-webkit-file-upload-button {
  visibility: hidden;

}

.custom-file-input2::before {
  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0  Ambil Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload2.png');
  background-repeat: no-repeat;
  background-size: 18px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input2:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
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

.btndrop{
  border-width: 0px;
  background-color: transparent;
}
.custom-button{
  background-color: transparent;
  border-color: transparent;
}
.close{
  border-width: 0px;
  background-color: transparent;

}
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
form button {
  padding: 0.75rem 1.5rem;

}

@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>