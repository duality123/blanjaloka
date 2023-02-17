<template>
    <RemoveItemLayout pesan="Anda yakin ingin menghapus pesan ini" :popup="deletePopup" :itemDelete="itemDelete" url="/laporan/hapus" @toggleClose="switchClose()" />
  <Layout state="pesan" title="Pesan" >
      <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pesan Masuk</h3>
      </li>
    </ul>
    <div class="col-xl-7 d-flex justify-content-start">
        <Search :url="`/admin/pesan/?page=1`" judul="Cari Pesan" />
        <div class="dropdown mx-2 ">
          <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><Link preserve-state :data="{tanda:'t'}" class="dropdown-item" href="/admin/pesan?page=1">tandai</Link></li>
                <li><Link preserve-state :data="{tanda:'f'}" class="dropdown-item" href="/admin/pesan?page=1">Tidak Ditandai</Link></li>
              </ul>
            </div>
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Pesan</th>
              <th scope="col">Email</th>
              <th scope="col">Gambar</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
              <td>{{index.tanggal}}</td>
               <td> {{index.pesan}}</td>
              <td> {{index.email}}</td>
              <td >
                  <div v-if="index.gambar" class="row "><img class="tdimg" :src="`${$page.props.asset_url}/${index.gambar}`"  >
                  </div>
                    <div v-else>
                    -
                    </div>
              </td>
              <td>
               <button @click="changeState()" v-if="index.tandai == 1"  class="btn btn-semantic-error-2 me-2 px-3 text-semantic-error-4 cursor-pointer m-2">
                          Batal Tandai
                        </button>
                        <button @click="changeState(index.id)" v-else href="#" class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer m-2">
                            Tandai
                        </button>
                          <button @click="switchClose(index.id)" href="#" class="btn btn-semantic-error-4 me-2 px-3 text-neutral-white cursor-pointer m-2">
                            Hapus
                        </button>
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
import Layout from '../../Layouts/Dashboard.vue';
import RemoveItemLayout from '../../Components/RemoveItem.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Pagination from '../../Components/Pagination.vue';
import Search from '../../Components/Search.vue';
import { ref } from 'vue';
export default{

   data(){
      return{
        currentPage: document.location.pathname.split('/')[4],
        deletePopup:false,
        itemDelete:{},
        url:document.location.href
      }
    },
    props:{
      items : Object,
      kegiatan:Object
    },
    components: {
      Layout,
      Link,
      Pagination,
      Search,
      RemoveItemLayout
    },
    methods:{
      changeState(pesan_id){
        Inertia.post('/laporan/tandai',{id:pesan_id},{preserveScroll:true})
      },
      switchClose(pesan_id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:pesan_id}
      },


    }
}
</script>

<style scoped>

td{
  width:350px;
}
.tdimg{
  width:200;
  height:200;
}
.tabs {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
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