<template>
<Layout section="publikasi" :title="kegiatan.tema" :link="kegiatan.id"><section>
<div class="row">

      <div class=" col d-flex justify-content-end">
        <button @click="cetakPDF()" href="/admin/kegiatan/tambah_kegiatan/baru" class="btn btn-primary-blue-6 text-neutral-white py-2">
        Cetak PDF
        </button>
      </div>
</div>

 <MultiSearch :url="`/admin/kegiatan/22/publikasi/${kegiatan.id}/?page=1`"  />
 <div class="d-flex justify-content-center mt-4">
  <h3>Daftar UMKM Lulus Inkubasi {{kegiatan.tema}}</h3>
</div>
<div class="d-flex justify-content-start mt-4">
  <div><strong>Nama Juri</strong> = {{kegiatan.nama_juri}}</div>
</div>


      <div class="table-responsive" >
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto</th>
              <th scope="col">Nama</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Produk</th>
              <th scope="col">No HP</th>
            </tr>
          </thead>
          <tbody>
             <tr  v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
              <td><img class="imgtd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link :href="`/detail/profil/investor/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_produk}}</td>
              <td>{{index.no_hp}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <div class="d-flex justify-content-center mt-4">
         <Pagination :links="items.links"/>
      </div>
      </div>
  </section>
  </Layout>
</template>
<script>
import Layout from '../../../Layouts/Kegiatan.vue';
import Pagination from '../../../Components/Pagination.vue';
import MultiSearch from '../../../Components/MultiSearchUMKM.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
export default{
   
    data(){
      return{
        currentPage: document.location.pathname.split('/')[6]
      }
    },
    props:{
      items : Object,
      paginationNums : Array,
      investor:Array,
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
      Pagination,
      MultiSearch,
    },
    methods:{
      changeStatus(userid){
        Inertia.post('/admin/kegiatan/ubah_status_publikasi',{user_id:userid,slug:this.kegiatan.slug})
      },
      cetakPDF(){
        
      }
    }
}
</script>

  <style scoped>

table{
  width: 100%;
}
.imgtd{
  height: 100px;
  width: 150px;
}
.close{
  border-width: 0px;
  background-color: white;
}

td{
  width: 200px;
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