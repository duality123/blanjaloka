<template>
         <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popup" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "closePopup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Edit Eventual</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submit()">
         <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Jadwal</label>
         <input type="date" class="form-control" v-model="form.jadwal"  id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger"></small>
      </div>
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Link Meeting</label>
         <input type="text" class="form-control" v-model="form.link_meeting" id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger"></small>
      </div>
        <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5 mb-3 mb-2" >Status: </label>
              <select v-model="form.status" id="provinsi">
                <option value="0">Menunggu</option>
                <option value="1">Disetujui</option>
                <option value="2">Selesai</option>              
              </select>
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
  <Layout section="eventual" :title="kegiatan.tema" :link="kegiatan.id">
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Perihal</th>
              <th scope="col">UMKM</th>
              <th scope="col">mentor</th>
              <th scope="col">Dikontak Via</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
               <td> {{index.perihal}}</td>
              <td> <Link :href="`/detail/profil/${index.profil.user_id}`">{{index.profil.nama_lengkap}}</Link></td>
              <td>{{index.nama_mentor}}</td>
              <td>{{index.kontak}}</td>
              <td>
               <button @click="" v-if="index.status == 0" href="#" class="btn btn-semantic-warning-4 me-2 px-3 text-neutral-white cursor-pointer">
                          Menunggu
                        </button>
                        <button @click="" v-if="index.status == 1" href="#" class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">
                            Disetujui
                          </button>
                         <button @click="" v-if="index.status == 2" href="#" class="btn btn-semantic-success-4 me-2 px-3 text-neutral-white cursor-pointer">
                            Selesai
                          </button>
                </td>
                 <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                <button @click="toggleEdit(index.jadwal,index.link_meeting,index.status,index.id)" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </button>
                <Link :href="`/admin/dashboard/kegiatan/${index.id}/hapus_eventual`" method="post" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <Pagination :links="items.links"/>
      </div>
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Kegiatan.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import Pagination from '../../../Components/Pagination.vue';
import { ref } from 'vue';
export default{
  setup(){
    const form = useForm({
      jadwal:null,
      link_meeting:null,
      status:null,
      id:null
    })
    return {form}
  },
   data(){
      return{
        currentPage: document.location.pathname.split('/')[4],
        popup:false
      }
    },
    props:{
      items : Object,
      eventual:Object,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number,
      kegiatan:Object
    },
    components: {
      Layout,
      Link,
      Pagination
    },
    methods:{
      toggleEdit(jadwal,link_meeting,status,id){
        this.popup = !this.popup
        this.form.jadwal = jadwal
        this.form.link_meeting = link_meeting
        this.form.status = status
        this.form.id = id
      },
      closePopup(){
        this.popup = !this.popup
      },
      submit(){
        this.popup=false;
        this.form.post('/admin/dashboard/kegiatan/ubah_eventual_status')
      }
    }
}
</script>

<style scoped>

table{
  width: 900px;
}

.close{
  border-width: 0px;
  background-color: white;
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
ul {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}

ul li {
  cursor: pointer;
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
p{
    white-space: nowrap; 
  width: 300px; 
  overflow: hidden;
  text-overflow: ellipsis; 
}
ul li {
  padding-bottom: 0.5rem;
}

ul li a.active {
  border-bottom: 2px solid #398AB9;
  color:  #398ab9;
}

ul li a {
  text-decoration: none;
  font-weight: 600;
  color: black;
}

@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }

}

form section h2 {
  font-size: 1.25rem;
}

.form-control {
  background-color: transparent;
  resize: none;
}
.modal-content{
  text-align: start;
}

textarea::-webkit-scrollbar {
  display: none;
}

.desc_count {
  font-size: 0.75rem;
  font-weight: 400;
  color: #3E4041;
  position: absolute;
  right: 0;
  bottom: -1.5rem;
}

.count_input {
  width: 14rem;
}

.count_input_leading {
  position: absolute;
  right: -3.5rem;
  bottom: 0.5rem;
}

.telp_input .form-control {
  padding-left: 2.5rem !important;
}

.telp_input .telp_leading {
  position: absolute;
  left: 0;
  bottom: 0.5rem;
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