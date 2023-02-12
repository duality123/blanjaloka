<template>
    <RemoveKegiatanLayout pesan="hapus track record ini ?" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/investasi/hapus_investasi_investor" @toggleClose="switchClose()" />
<div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popupEdit" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "togglePopupEdit()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Edit Track Record</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submitEdit()">

      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan Uang Masuk </label>
         <input type="number" class="form-control" v-model="form.uang_masuk" id="provinsi" placeholder="Masukkan uang masuk" >
           <small class="text-danger" v-if="form.errors.uang_masuk">{{ form.errors.uang_masuk }}</small>
      </div>
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan Uang Keluar </label>
         <input type="number" class="form-control" v-model="form.uang_keluar" id="provinsi" placeholder="Masukkan uang keluar" >
           <small class="text-danger" v-if="form.errors.uang_keluar">{{ form.errors.uang_keluar }}</small>
      </div>
       <div class="mb-4">
         <label for="dokumen_legalitas" class="form-label text-neutral-gray-5 mb-2">Upload file</label>
         <div  class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="flex-grow-1" v-if="form.bukti==null" >
                        <p class="text-neutral-gray-5">Upload your file</p>
                        <p class="text-neutral-gray-3">Format file .pdf, maks 10MB</p>
                      </div>
                       <div class="flex-grow-1" v-else-if="fileReviewer" >
                        <a :href="`${$page.props.asset_url}/${fileReviewer}`" class="text-neutral-gray-5">Lihat Bukti</a>
                      </div>
                       <div class="flex-grow-1" v-else >
                         <p class="text-neutral-gray-5">{{form.bukti.name}}</p>
                      </div>
                      <div class="position-relative">
                        <p class="text-primary-blue-6">Pilih</p>
                        <input @change="inputDokumen($event)" type="file" id="dokumen_legalitas">
                      </div>
                    </div>

                      
                     <small class="text-danger text-center" v-if="form.errors.bukti" >{{form.errors.bukti}}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
<div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popupTambah" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "togglePopupTambah()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Tambah Track Record</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submitTambah()">

      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan Uang Masuk </label>
         <input type="number" class="form-control" v-model="form.uang_masuk" id="provinsi" placeholder="Masukkan uang masuk" >
           <small class="text-danger" v-if="form.errors.uang_masuk">{{ form.errors.uang_masuk }}</small>
      </div>
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan Uang Keluar </label>
         <input type="number" class="form-control" v-model="form.uang_keluar" id="provinsi" placeholder="Masukkan uang keluar" >
           <small class="text-danger" v-if="form.errors.uang_keluar">{{ form.errors.uang_keluar }}</small>
      </div>
       <div class="mb-4">
         <label for="dokumen_legalitas" class="form-label text-neutral-gray-5 mb-2">Upload file</label>
         <div  class="d-flex align-items-center px-4 py-2 bg-primary-blue-1 gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                      <div class="flex-grow-1" v-if="form.bukti==null" >
                        <p class="text-neutral-gray-5">Upload your file</p>
                        <p class="text-neutral-gray-3">Format file .pdf, maks 10MB</p>
                      </div>
                      <div class="flex-grow-1" v-else-if="this.fileReviewer" >
                        <a :href="`${$page.props.asset_url}/${fileReviewer}`" class="text-neutral-gray-5">Lihat File</a>
                      </div>
                       <div class="flex-grow-1" v-else >
                        <p class="text-neutral-gray-5">{{form.bukti.name}}</p>
                      </div>
                      <div class="position-relative">
                        <p class="text-primary-blue-6">Pilih</p>
                        <input @change="inputDokumen($event)" type="file" id="dokumen_legalitas">
                      </div>
                    </div>

                      
                     <small class="text-danger text-center" v-if="form.errors.bukti" >{{form.errors.bukti}}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
  <div class="col-lg-8" v-if="modalStat">
   <div class="modal modal-stat">
      <div class="modal-content-stat">
        <div class=" d-flex justify-content-end">
         <button @click = "togglePopupStatClose()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <ul class="tabs mt-2">
      <li class="active" >
          <h3>Data Statistik</h3>
      </li>
    </ul>
    <div class="mt-5" v-if="statistik == null">
      <div class="spinner-border text-primary"></div>
    </div>
     <div class="row mt-5" v-else>
      <div class="col-lg-6 mb-4">
        <div class="card ">
          <div class="card-body ">
            <h3 class="text-neutral-gray-4">Rasio Uang Keluar dan Masuk</h3>
            <Line :chart-options="chartOptions" :chart-data="chartData" :width="50" :height="210" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4 ">
        <div class="card text-neutral-white bg-primary-blue-6 mb-3 mark" >
  <div class="card-header">Total Investasi Masuk</div>
  <div class="card-body statData">
    <h1 >Rp. {{statistik.investasiMasukTotal}}</h1>
  </div>
</div>
      </div>
      <div class="col-lg-6 mb-4 ">
        <div class="card text-neutral-white bg-primary-blue-6 mb-3 mark" >
  <div class="card-header">Total Investasi Keluar</div>
  <div class="card-body statData">
    <h1 >Rp. {{statistik.investasiKeluarTotal}}</h1>
  </div>
</div>
      </div>
      <div class="col-lg-6 mb-4 ">
        <div class="card text-neutral-white bg-primary-blue-6 mb-3 mark" >
  <div class="card-header">Kontribusi Investor terhadap Penghasilan</div>
  <div class="card-body statData">
    <h1 >{{statistik.kontribusi.toString().substring(0,4)}}%</h1>
  </div>
</div>
      </div>
</div>
  </div>
  </div>
  </div>
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
   <div class="col d-flex justify-content-end mt-4">
          <button @click="togglePopupStat()" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Lihat Statistik
        </button>
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Investasi Keluar</th>
              <th scope="col">Investasi Masuk</th>
              <th scope="col">Bukti</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
           <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
              <td>{{index.tanggal}}</td>
              <td>Rp. {{index.investasi_keluar}}</td>
              <td>Rp. {{index.investasi_masuk}}</td>
                <td> <a _blank :href="`${$page.props.asset_url}/${index.bukti}`" class="btn btn-primary-blue-6 text-neutral-white py-2">
        Lihat Bukti
        </a></td>
        <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                <button @click="this.togglePopupEdit(moneyIn=index.investasi_masuk,moneyOut=index.investasi_keluar,buktiIn=index.bukti)" :href="`/admin/kegiatan/${index.id}/edit`" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </button>
                <button @click="this.switchClose(delete_id=index.id)" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
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
  </Layout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import Layout from '../../../Layouts/Bisnis.vue';
import RemoveKegiatanLayout from '../../../Components/RemoveItem.vue';
import Search from '../../../Components/Search.vue';
import Pagination from '../../../Components/Pagination.vue';
import { Inertia } from "@inertiajs/inertia";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'
ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
);
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
          currentUser:window.location.pathname.split('/')[5],
          chartData:{},
          chartOptions:{
              responsive: true,
              maintainAspectRatio: false
          },
          modalStat:null

    }

      },
     computed:{
      chartData(){
         if(this.statistik){
          {return this.chartData = {
          labels:this.statistik.tanggal,
          datasets: [{
            label: 'Investasi Masuk ( Rp )',
            data: this.statistik.investasiMasuk.nilai,
            fill: false,
            borderColor: '#398ab9',
            tension: 0.1
          },
          {
            label: 'Investasi Keluar ( Rp )',
            data:  this.statistik.investasiKeluar.nilai,
            fill: false,
            borderColor: '#d64036',
            tension: 0.1
          }]
        }
      }

    }
      
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
      statistik:Object,
      investor:null
    },
    components: {
      Layout,
      Link,
      RemoveKegiatanLayout,
      Pagination,
      Search,
      Line
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
        this.form.post('/admin/investasi/submit_record_investor',{onSuccess: () => this.form.reset()},{preserveState:true})
      },
       submitEdit(){
        this.form.post('/admin/investasi/edit_record_investor',{onSuccess: () => this.form.reset()},{preserveState:true})
      },
        togglePopupStat(){
        this.modalStat= true
        Inertia.get('/admin/investasi/'+this.bisnis.id+'/detail_investasi/'+this.investor+'?page=1',{},{ only: ['statistik'],preserveState:true})


      },
      togglePopupStatClose(){
        this.modalStat= false
        Inertia.get('/admin/investasi/'+this.bisnis.id+'/detail_investasi/'+this.investor+'?page=1',{},{preserveState:true})


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

.mark{
  height:290px;
}
.row{
  height:40%;
}

/* Modal Content */
.modal-content-stat {
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
  width: 150px;
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
.modal-stat { 
  padding: 2px; /* Location of the box */
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
  text-align: start;
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

.statData{
  padding:50px;
}
.statData h1{
  font-size: 3rem;
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

.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}

.form-control {
  border: none;
  border-radius: 0;
  border-bottom: 2px solid #AEAEAE;
  padding-left: 0;
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

 
}
</style>
