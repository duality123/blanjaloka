<template>
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
 <Layout state="record_investasi" :title="bisnis.name" :link="bisnis.id">

                <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4 mb-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    Disini adalah record investasi anda.
                  </p>
                </div>
        <div class="row">
        <div class="col d-flex justify-content-start">
        <Search :url="`/investor/dashboard/bisnisku/investasi/${bisnis.id}?page=1`" judul="Cari berdasarkan tanggal atau nilai Keluar masuk funding" />   
      </div>
      <div class="col d-flex justify-content-end">
         <button @click="togglePopupStat()" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Lihat Statistik
        </button>
    </div>
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
          
            </tr>
          </thead>
          <tbody>
           <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
              <td>{{index.tanggal}}</td>
              <td>{{index.investasi_keluar}}</td>
              <td>{{index.investasi_masuk}}</td>
                <td> <a :href="`${$page.props.asset_url}/${index.bukti}`" class="btn btn-primary-blue-6 text-neutral-white py-2">Lihat Bukti</a></td>
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
import Layout from '../../../Layouts/Bisnisku.vue'
import { useForm, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import Search from '../../../components/Search.vue'
import Pagination from '../../../components/Pagination.vue'
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
)

export default{
  data(){
    return{
      modalStat:false,
        chartData:{},
          chartOptions:{
              responsive: true,
              maintainAspectRatio: false
        
          
      }

    }
  },
     computed:{
      chartData(){
         if(this.statistik){
          {return this.chartData = {
          labels:this.statistik.tanggal,
          datasets: [{
            label: 'Uang Masuk ( Rp )',
            data: this.statistik.investasiMasuk.nilai,
            fill: false,
            borderColor: '#398ab9',
            tension: 0.1
          },
          {
            label: 'Funding Keluar ( Rp )',
            data:  this.statistik.investasiKeluar.nilai,
            fill: false,
            borderColor: '#d64036',
            tension: 0.1
          }]
        }
      }

    }
      
      },
    },
  components:{
    Layout,
    Link,
    Search,
    Line,
    Pagination
  },
  
  props:{
    items:Object,
    bisnis:Object,
    statistik:Object
  },
  methods:{
     togglePopupStat(){
        this.modalStat= true
         Inertia.get('/investor/dashboard/bisnisku/investasi/'+this.bisnis.id+'?page=1',{},{only: ['statistik'],preserveState:true})


      },
     togglePopupStatClose(){
        this.modalStat= false
        Inertia.get('/investor/dashboard/bisnisku/investasi/'+this.bisnis.id+'?page=1',{},{only: ['statistik'],preserveState:false})


      },
  }


}

</script>


<style scoped>
.statData{
  padding:50px;
}
.statData h1{
  font-size: 3rem;
}


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
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>
