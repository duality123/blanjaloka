<template>
          <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="leavePopup" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "removePopup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
       <img src="../../../assets/images/warning.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-center text-center" style="margin-left: 2rem;">
       <h2>Anda yakin ingin leave dari bisnis ini ??</h2>
         </div>
          <div class="d-flex flex-column flex-lg-row justify-content-center gap-3 gap-lg-4 mt-5">
                    <button @click="popupControl()" class="btn btn-primary-blue-6 text-primary-blue-6 text-white py-2 border-5">Batal</button>
                    <Link :href="`/umkm/dashboard/funding/keluar/${item.id}`" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Ya</Link>
                </div>
      </div>
    </div>
  </div>    
                
                 <Layout state="deskripsi" :title="item.name" :link="item.id">
                  
                <div class="d-flex justify-content-start mt-5">
                <button class="btn btn-semantic-error-1 text-semantic-error-4 py-3" @click="popupControl">
                  <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" />Keluar bisnis</button>
                </div>
                       <div class="container">

          <div id="carouselExampleControlsNoTouching" class="carousel slide mt-4" data-bs-touch="false">

  <div class="carousel-inner">
    <div class="carousel-item active" v-for="gambar in item.foto_bisnis.split(',').filter(item => item)">
      <div class="d-flex  align-items-center" >
                  <img  :src="`${$page.props.asset_url}/${gambar}`" class="d-block w-100 gambar" alt="...">
                </div>
              </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
<div class="card bg-primary-blue-1 border-primary-blue-6 mb-3 mt-3">
  <div class="card-body">
    <ul class="mt-2">
      <li class="active" >
      <h2 >Detail Bisnis</h2>
    </li>
  </ul>
    <div class="row mt-5">
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Grafik Profit ({{item.persentase_hasil_investasi}} %)</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="250" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Rasio Jumlah dan Target Investasi</h3>
            <Bar :chart-options="chartOptions2" :chart-data="chartData2" :height="250" class="mt-4" />
          </div>
        </div>
      </div>
     
    </div>
<div class="d-flex flex-column">
  <div class="p-2">Nama Bisnis : {{item.name}}</div>
 <div class="p-2">Jumlah Investor : {{item.jumlah_investor}} </div>
  <div class="p-2">Minimum Investasi : {{item.minimum_investasi}} </div>
  <div class="p-2">Kategori : {{item.kategori}} </div>
   <div class="p-2">Jumlah Investasi : {{item.jumlah_investasi}} </div>
  <div class="p-2">Target Investasi : {{item.target_investasi}} </div>
   <div class="p-2">Lokasi : {{item.lokasi}} </div>
       <div class="p-2" v-if="item.persentase_hasil_investasi">Persentase hasil Investasi : {{item.persentase_hasil_investasi}} %</div>
     <div class="p-2" v-else>0 %</div>
    <div class="p-2">Waktu balik modal mulai : {{item.waktu_balik_modal_start}} </div>
 <div class="p-2">Waktu balik modal end : {{item.waktu_balik_modal_end}} </div>
  <div class="p-2" v-if="item.status">Status : Aktif </div>
    <div class="p-2" v-else>Status :Tidak Aktif </div>
</div>

  </div>
</div>
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Fundingku.vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);
export default{
  data(props){
    return{
      tabItems:null,
      currentPage:'detail',
      currentLink:window.location.pathname.split('/')[5],
      leavePopup:false,
      chartData:{
          labels: ['Jumlah Investasi','Total Penghasilan'],
          datasets: [{
          label: ['Rasio'],
          data: [props.item.jumlah_investasi,props.item.total_penghasilan],
          backgroundColor: ['#398AB9'],
          borderRadius: 5,
          }]
        },
      chartData2:{
          labels: ['Jumlah Investasi','Target Investasi'],
          datasets: [{
          label: ['Rasio'],
          data: [props.item.jumlah_investasi,props.item.target_investasi],
          backgroundColor: ['#398AB9'],
          borderRadius: 5,
          }]
        },
       chartOptions :{
          responsive: true,
          plugins: {
          legend: {
          display: true,
          position: 'bottom',
          align: 'start'
    }
  }
},
 chartOptions2 :{
          responsive: true,
          plugins: {
          legend: {
          display: true,
          position: 'bottom',
          align: 'start'
    }
  }
}
    }
  },
  components:{
    Layout,
    Link,
    Layout,
    Bar
  },
  mounted(){

  },
  methods:{
    popupControl(){
      this.leavePopup = !this.leavePopup
    }
  },
  props:{
    item:Object,
  }
}







</script>


<style scoped>
.carousel-control-next-icon{
 background-image: url('../../../assets/icons/carousel-right.png');
}
.carousel-item  img{
  width: auto;
  margin:auto;
  display: block;
  max-width:350px;
  height:200px;
}
.carousel-control-prev-icon{
 background-image: url('../../../assets/icons/carousel-left.png');
}
.close{
  border-width: 0px;
  background-color: white;
}
.gambar{
  width: 400px;
  height: 300px;
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

</style>
