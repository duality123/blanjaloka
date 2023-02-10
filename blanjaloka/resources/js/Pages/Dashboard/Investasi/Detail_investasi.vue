<template>

  <Layout section="deskripsi" :title="bisnis.name" :link="bisnis.id">
 
      <div class="container">

          <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">

  <div class="carousel-inner">
    <div class="carousel-item active" v-for="gambar in bisnis.foto_bisnis.split(',').filter(item => item)">
      <div class="d-flex  align-items-center" >
                  <img  :src="`${$page.props.asset_url}/${gambar}`" class="d-block w-100 carouselsize" alt="...">
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
            <h3 class="text-neutral-gray-4">Grafik Profit ({{bisnis.persentase_hasil_investasi}} %)</h3>
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
  <div class="p-2">Nama Bisnis : {{bisnis.name}}</div>
 <div class="p-2">Jumlah Investor : {{bisnis.jumlah_investor}} </div>
  <div class="p-2">Minimum Investasi : {{bisnis.minimum_investasi}} </div>
  <div class="p-2">Kategori : {{bisnis.kategori}} </div>
   <div class="p-2">Jumlah Investasi : {{bisnis.jumlah_investasi}} </div>
  <div class="p-2">Target Investasi : {{bisnis.target_investasi}} </div>
   <div class="p-2">Lokasi : {{bisnis.lokasi}} </div>
    <div class="p-2" v-if="bisnis.persentase_hasil_investasi">Persentase hasil Investasi : {{bisnis.persentase_hasil_investasi}} %</div>
     <div class="p-2" v-else>0 %</div>
    <div class="p-2">Waktu balik modal mulai : {{bisnis.waktu_balik_modal_start}} </div>
 <div class="p-2">Waktu balik modal end : {{bisnis.waktu_balik_modal_end}} </div>
  <div class="p-2" v-if="bisnis.status">Status : Aktif </div>
    <div class="p-2" v-else>Status :Tidak Aktif </div>
</div>

  </div>

      </div>
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Bisnis.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);
export default{
  data(props){
    return{
      popup: false,
      chartData:{
          labels: ['Jumlah Investasi','Total Penghasilan'],
          datasets: [{
          label: ['Rasio'],
          data: [props.bisnis.jumlah_investasi,props.bisnis.total_penghasilan],
          backgroundColor: ['#398AB9'],
          borderRadius: 5,
          }]
        },
      chartData2:{
          labels: ['Jumlah Investasi','Target Investasi'],
          datasets: [{
          label: ['Rasio'],
          data: [props.bisnis.jumlah_investasi,props.bisnis.target_investasi],
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
  setup(props){
    const form = useForm({
  
    })

    return {form}
  },
  props:{
    bisnis:Object
  },
  components:{
    Layout,
    Link,
    Bar
  },
 
  methods:{
    submit(){
      this.popup =false
      this.form.post('/admin/dashboard/kegiatan/edit_deskripsi')
    },
    toggleEdit(){
      this.popup = !this.popup
    },
     changePicture(event){
        if(event.target.files[0].type == 'image/jpeg' || event.target.files[0].type == 'image/png'){
        
            if(event.target.files[0].size >= 5000000){
              this.form.errors.gambar  = "Size foto anda lebih dari 5MB !" 
              return
            }
        var image = document.getElementById('img');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.width = '5rem';
        image.style.overflow = 'hidden';
        this.form.gambar = event.target.files[0];
        //console.log(this.process)
      }
      else{
        this.form.errors.gambar  = "File yang anda upload bukanlah gambar !" 
        return
      }
    },
  }
}
</script>

<style scoped>
.delete{
  border-width:0px;

  border-color: transparent;
}
.carousel-item  img{
  width: auto;
  margin:auto;
  display: block;
  max-width:350px;
  height:200px;
}
.close{
  border-width: 0px;
  background-color: white;
}

.carousel-control-next-icon{
 background-image: url('../../../assets/icons/carousel-right.png');
}

.carousel-control-prev-icon{
 background-image: url('../../../assets/icons/carousel-left.png');
}

ul {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
 
}

ul li {
  cursor: pointer;
   border-bottom: 2px solid #398AB9;

}

ul li {
  padding-bottom: 0.5rem;
}

ul li a.active {
  border-bottom: 2px solid #F0F0F0;
  color:  #398ab9;
  margin-bottom: 0px;
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


</style>