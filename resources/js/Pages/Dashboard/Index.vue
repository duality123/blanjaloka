<template>
  <DashboardLayout title="Overview" state='overview'>
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-2">
      <h1 class="text-neutral-gray-5 mb-0">Dashboard</h1>
      <h2 class="text-neutral-gray-5" id="waktuDisplay"></h2>
    </div>
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
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../../Layouts/Dashboard.vue';
import { ref,computed,onMounted,onUnmounted } from 'vue';
import {usePage} from  '@inertiajs/inertia-vue3';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);
const hapusSapa = () =>{
  var target=  document.getElementById('remove')
  target.remove();
}

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


</script>

<style scoped>

@media (max-width: 575.98px) {
  .quit {
    align: start;
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

