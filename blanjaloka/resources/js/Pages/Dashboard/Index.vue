<template>
  <DashboardLayout title="Overview" state='overview'>
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-2">
      <h1 class="text-neutral-gray-5 mb-0">Dashboard</h1>
      <h2 class="text-neutral-gray-5" id="waktuDisplay"></h2>
    </div>
    <!--
    <div class="row mt-5">
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Total Investasi Batch 1</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="250" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Jumlah Investor Tiap Batch</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="250" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Jenis UMKM</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="250" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Latar Belakang Founder</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="250" class="mt-4" />
          </div>
        </div>
      </div>
    </div>
  -->

       <ul class="tabs mt-4">
      <li class="active" >
          <h3>Daftar Kegiatan Janji Temu Yang Akan Berakhir</h3>
      </li>
    </ul>
       <div class="row">
         <div class="col-xl-12 d-flex justify-content-start">
        <MultiSearchJanjiTemu url="/admin/dashboard?page=1" judul="Cari jadwal janji temu" />
           <div class="dropdown  ">
  <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><Link preserve-state :data="{berakhir:'t'}" class="dropdown-item" :href="url">Sudah selesai</Link></li>
                <li><Link preserve-state :data="{berakhir:'f'}" class="dropdown-item" :href="url">Belum Selesai</Link></li>
              </ul>
            </div>
           </div>
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Mulai</th>
              <th scope="col">Berakhir</th>
              <th scope="col">Investor</th>
                <th scope="col">UMKM</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
               <td>{{index.lokasi}}</td>
               <td>{{index.waktu}}</td>
             <td>{{index.berakhir}}</td>
                  <td><Link :href="`/detail/profil/investor/${index.investor.profil.user_id}`" class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">{{index.investor.profil.nama_lengkap}}</Link>
                  </td>       
                     <td><Link  :href="`/detail/profil/umkm/${index.umkm.profil.user_id}`" class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">{{index.umkm.profil.nama_lengkap}}</Link>
                  </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <Pagination :links="items.links"/>
      </div>

  </DashboardLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import DashboardLayout from '../../Layouts/Dashboard.vue';
import Pagination from '../../Components/Pagination.vue';
import Search from '../../Components/Search.vue';
import { ref,computed,onMounted,onUnmounted } from 'vue';
import {usePage} from  '@inertiajs/inertia-vue3';
import MultiSearchJanjiTemu from '../../Components/JanjiTemuMultiSearch.vue'
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);
const hapusSapa = () =>{
  var target=  document.getElementById('remove')
  target.remove();
}
let url = document.location.href
const day = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
const month =['Januari','Februari',"Maret",'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
let hari = '0';
let bulan = '0';
let jam = '0';
let tahun= '0';
let tanggal = '0';
let detik ='0';
let menit = '0';
let intervalId;
onMounted(()=> {
  intervalId = setInterval(()=>{
    const date = new Date();
    hari = day[date.getDay()];
    bulan = month[date.getMonth()];
    jam = (date.getHours() >= 10)? date.getHours() : "0" + date.getHours()  ;
    tahun = date.getFullYear();
    tanggal = (date.getDate()>= 10)? date.getDate()  : "0" + date.getDate();
    detik = (date.getSeconds() >= 10)? date.getSeconds()  : "0" + date.getSeconds() ;
    menit = (date.getMinutes() >= 10)? date.getMinutes()  : "0" + date.getMinutes() ;
    status = (date.getHours() > 0) ? 'AM':'PM'
    document.getElementById('waktuDisplay').innerHTML = hari +', '+ tanggal  + ' ' + bulan + ' ' + tahun + ' ' + jam + ':' + menit + ':'+ detik+' '+status;
  }, 1000);
})
onUnmounted(() => clearInterval(intervalId))
const removePopup = () => {
  usePage().props.session.success = false;
}


const chartData = ref({
  labels: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'],
  datasets: [{
    label: 'Besar Investasi',
    data: [10, 20, 30, 40, 50, 60, 70, 80, 90],
    backgroundColor: '#398AB9',
    borderRadius: 5,
  }]
});
const chartOptions = ref({
  responsive: true,
  plugins: {
    legend: {
      display: true,
      position: 'bottom',
      align: 'start'
    }
  }
});

const props = defineProps({
   items:Object
});


</script>

<style scoped>

@media (max-width: 575.98px) {
  .quit {
    align: start;
  }
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
.tdnama{
  margin-left: 4px;
}

.tdimg{
  width: 200px;
  height: 100px;
}
table{

}

.close{
  border-width: 0px;
  background-color: white;
}
.modal-content{
  text-align: start;
  height: 450px;
  overflow-y: scroll;
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
.tabs {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}
table{
  width:100%;
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
  overflow-x: none;
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
.hide{
  display: none;
}
.show{
  display: block;
}
section{
  margin-top: 10rem;
}
.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}
.close{
  border-width: 0px;
  background-color: white;
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
h2 {
  font-size: 1.3rem;
  font-weight: 400;
}
.card {
  border: none;
  border-radius: 1.25rem;
}
.card h3 {
  font-size: 1rem;
  font-weight: 400;
}
</style>

