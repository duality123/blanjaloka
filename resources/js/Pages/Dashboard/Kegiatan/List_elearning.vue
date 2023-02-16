<template>
 <RemoveElearningLayout pesan="Anda yakin ingin menghapus bab ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/kegiatan/hapus_elearning" @toggleClose="switchClose()" />
  <Layout section="elearning" :title="kegiatan.tema" :link="kegiatan.id">
     <div class="row">
         <div class="col d-flex justify-content-start">
        <Search :url="`/admin/kegiatan/${kegiatan.id}/elearning?page=1`" judul="Cari Elarning" />
        
      </div>
  <div class=" col d-flex justify-content-end">
      <Link :href="`/admin/kegiatan/${kegiatan.id}/tambah_elearning`" class="btn btn-primary-blue-6 text-neutral-white py-2">Tambah Elearning
      </Link>
    </div>
  </div>
         <div class="row">
                  <div class="col-lg-4" v-for="(item,no) in items.data">

                    <div class="card card_kegiatan mt-2">
                       
                      <div class="card-body">
<div class=" d-flex justify-content-end">
      <div class="dropdown">
  <a href="#" role="button"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
     <font-awesome-icon icon="fas fa-ellipsis-h" />
  </a>

  <ul class="dropdown-menu-end dropdown-menu">
    <li><Link :href="`/admin/kegiatan/elearning/${item.id}/edit`" class="dropdown-item" href="#">Edit</Link></li>
    <li><button @click="switchClose(item.id)" class="dropdown-item delete" href="#">Hapus</button></li>
  </ul>
</div>
      </div>
      <div class="col d-flex justify-content-center">
        <div  class="bg-semantic-success-1 text-semantic-success-4 status">{{item.hari_tanggal_waktu}}</div>
                  <img  :src="`${$page.props.asset_url}/${item.foto}`" class="gambar" alt="...">
                </div>
                 <div> 
                          <h1 class="text-neutral-black mt-2">{{item.judul}}</h1>
                          <p>{{item.deskripsi.substring(0,110)}}...</p>
                        </div>
                        <div class="col d-flex justify-content-center">
                         <button class="btn btn-primary-blue-7 me-2 px-3 text-neutral-white cursor-pointer" @click="redirect(item.id)">Lihat Elearning</button>
                       </div>
              </div> 
                        </div>
                       
                      </div>
                    </div>    
      <div class="d-flex justify-content-center mt-4">
        <Pagination :links="items.links"/>
      </div>
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Kegiatan.vue';
import RemoveElearningLayout from '../../../Components/RemoveItem.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import Pagination from '../../../Components/Pagination.vue';
import Search from '../../../Components/Search.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
export default{
   data(){
      return{
        currentPage: document.location.pathname.split('/')[3],
        deletePopup:false,
        itemDelete:null
      }
    },
    methods:{
       switchClose(elearning_id=null){
          this.deletePopup = !this.deletePopup          
          this.itemDelete = {id:elearning_id}
      },
      redirect(id){
        Inertia.get('/admin/kegiatan/elearning/'+id+'/bab')
    }
    },
    props:{
      items : Object,
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
      RemoveElearningLayout,
      Pagination,
      Search
    }
}
</script>

<style scoped>
.delete{
  border-width:0px;

  border-color: transparent;
}
.gambar{
  width: 190px;
  height: 140px;
  border-radius:25px;
}

.card_kegiatan {
  border: none;
  cursor: pointer;
  transition: 300ms;
}

.card_kegiatan:hover {
  background-color: #F2F7FA;
}

.card_kegiatan .status {
  position: absolute;
  top: 0;
  left: 0;
  font-size: 0.75rem;
  font-weight: 400;
  padding: 0.5rem;
  border-bottom-right-radius: 0.375rem;
}

.card_kegiatan h1 {
  font-size: 1.125rem;
  font-weight: 600;
}

.card_kegiatan p {
  font-size: 0.875rem;
  font-weight: 500;
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
  text-align: center;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
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