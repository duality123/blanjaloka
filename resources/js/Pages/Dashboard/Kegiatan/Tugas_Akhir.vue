<template>

<div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popupTambahTugas" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "togglePopupTambahTugas()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Tambah Soal</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submitTambahTugas()">

      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan soal </label>
         <input type="text" class="form-control" v-model="form.soal" id="provinsi" placeholder="Masukkan soal" >
           <small class="text-danger" v-if="form.errors.soal">{{ form.errors.soal }}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>


<div class="col-lg-8" v-if="popupLihatJawaban" >

              <div id="myModal" class="modal" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "closePreviewJawaban()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div v-if="this.targetJawaban ==null" class="d-flex justify-content-center mt-4">
        <div class="spinner-border text-primary"></div>
      </div>
        <div v-else class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Review Jawaban </h2>
     </div>
           <div class="mt-2">
       <div class="card-body">

      <div class="d-flex flex-column">
      <div class="p-2"><strong>Jawaban :</strong> </div>
      <div class="p-2" v-if="targetJawaban.jawaban !=null">
        {{targetJawaban.jawaban}}
      </div>
      <div class="p-2" v-else>
        -
      </div>
    </div>
      <div class="p-2"><strong>File :</strong></div>
      <div class="p-2">
        <div v-if="targetJawaban.file !=null">
          <div class="mb-4">
                      <div class="d-flex p-2 gap-2 py-1 px-1 alert alert-success customfile ">
                      <div>
                        <svg width="35" height="20" viewBox="-5 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                       <div class="position-relative">
                           <p class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${targetJawaban.file}`">Lihat  dokumen</a></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else>
                  -
                </div>
          </div>
      <div class="p-2"><strong>Gambar :</strong></div>
      <div class="p-2" v-if="targetJawaban.gambar !=null"> 
        <img class="mt-2 mb-2 gambar_preview " :src="`${this.$page.props.asset_url}/${targetJawaban.gambar}`"> </div>
      <div class="p-2" v-else>
        -
      </div> 
    </div>
      </div>
      </div>
      </div>
    </div>
  </div>
  <RemoveKegiatanLayout :pesan="message" :popup="deletePopup" :itemDelete="itemDelete" :url="url" @toggleClose="switchClose()" />
  <Layout :title="kegiatan.tema" :link="kegiatan.id" section="tugas_akhir">
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Tugas Akhir</h3>
      </li>
    </ul>
    <section>
 <div class=" d-flex justify-content-end">
        <button @click="togglePopupTambahTugas()" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Soal
        </button>
      </div>
     <div class="mt-4 mb-5">
                  <div v-for="(item,no) in tugas">
                 
                <div class="d-flex bd-highlight">
  <div class="p-2 flex-grow-1 bd-highlight"> <p class="fw-semibold text-primary-blue-6 mb-0">
                   {{++no}}. {{item.soal}}  </p></div>
  <div class="p-2 bd-highlight"><button @click="this.switchClose(tugas_id=item.id,url_delete='/admin/kegiatan/hapus_tugas_akhir',message='anda yakin ingin menghapus soal ini ?')" type="button" class="fw-semibold text-primary-blue-6 mb-0 close" data-dismiss="modal" aria-label="Close" style="max-width:2px;"><span aria-hidden="true">&times;</span></button></div>
</div>
              </div>
        </div>

    <ul class="tabs mt-4">
      <li class="active" >
          <h3>Jawaban UMKM</h3>
      </li>
    </ul>
      <div class="row">
         <div class="col d-flex justify-content-start">
        <MultiSearchUMKM :url="`/admin/kegiatan/${kegiatan.id}/tugas_akhir?page=1`" judul="Cari Jawaban UMKM" />
        
      </div>
    </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto Profil</th>
              <th scope="col">Nama Peserta</th>
              <th scope="col">No HP</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Perusahaan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in users.data">
              <th scope="row">{{++no}}</th>
                <td>
                             <div class="row "><img class="imgtd" :src="`${$page.props.asset_url}/${index.foto_profil}`"></div>
                </td>
                <td>  <Link  :href="`/detail/profil/umkm/${index.id}`" >{{index.nama_lengkap}}</Link></td>
                <td>{{index.no_hp}}</td>
                 <td>{{index.nama_perusahaan}}</td>
                  <td>{{index.kategori_produk}}</td>
                <td>  
                 <button @click="previewJawaban(index.id)" class="btn btn-semantic-success-4 text-neutral-white">
                  <div v-if="jawabanLoad" class="d-flex justify-content-center mt-4">
                  <div class="spinner-border text-neutral-white"></div>
                </div>
                <div v-else>
                  <img  src="../../../assets/icons/icon_update.png" alt="update icon">
                  Lihat Jawaban
                </div>
                </button>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
      <Pagination :links="users.links"/> 
      </div>
    </section>
  </Layout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import Layout from '../../../Layouts/Kegiatan.vue';
import RemoveKegiatanLayout from '../../../Components/RemoveItem.vue';
import MultiSearchUMKM from '../../../Components/MultiSearchUMKM.vue';
import Pagination from '../../../Components/Pagination.vue';
import { Inertia } from "@inertiajs/inertia";
export default{
    data(){
        return{
          popup:false,
          deletePopup:false,
          itemDelete:null,
          cari:null,
          popupTambahTugas:false,
          url:null,
          message:null,
          popupLihatJawaban:false,
          jawabanLoad:false

      }
    },
  setup(props){
        const form = useForm({
        soal:null,
        kegiatan_id:props.kegiatan.id
    })

    return {form}
  },
    props:{
      items :Object,
      tugas:Object,
      kegiatan:Object,
      jawaban:Object,
      users:Object,
      targetJawaban:Object
    },
    components: {
      Layout,
      Link,
      RemoveKegiatanLayout,
      Pagination,
      MultiSearchUMKM
    },
    methods:{
       switchClose(delete_id=null,url_delete=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:delete_id}
        this.url = url_delete
      },
      togglePopupTambahTugas(){
        this.popupTambahTugas = !this.popupTambahTugas
      },
      submitTambahTugas(){
        this.form.post('/admin/kegiatan/tambah_tugas_akhir',{onSuccess: () => this.form.reset()})
      },
       closePreviewJawaban(jawaban_userid){
        this.popupLihatJawaban=false;
        let url = document.location.href
        Inertia.get(url,{user_id:jawaban_userid},{preserveState:false})


      },
      previewJawaban(jawaban_userid){
        this.jawabanLoad=true
        this.popupLihatJawaban = true;
        let url = document.location.href
        Inertia.get(url,{user_id:jawaban_userid},{ only: ['targetJawaban'],preserveState:true})


      }
    }

}
</script>

<style scoped>
.gambar_preview{
  width: 450px;
  height: 300px;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
.customfile{
  height:35px;
}
td{
  width:400px;
}
.imgtd{
  width: 250px;
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
