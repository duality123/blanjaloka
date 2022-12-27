<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar section="kegiatan" />
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h1>Kegiatanku</h1>
                <div class="row">
                  <div class="col-lg-5" v-for="item in items.data">
                    <div class="card card_kegiatan">
                      <div class="card-body">
                      
                        <div class="position-relative overflow-hidden rounded">
                          <img :src="`${$page.props.asset_url}/${item.gambar}`" alt="kegiatanku image"
                            class="img-fluid w-100 " />
                          <div v-if="new Date(item.berakhir.split(' ')[0]) > this.now" class="bg-semantic-success-1 text-semantic-success-4 status">Sedang Berlangsung</div>
                           <div v-else class="bg-neutral-gray-1 text-neutral-gray-4 status">Selesai</div>
                        </div>
                        <div> 
                          <h1 class="text-neutral-black mt-2">{{item.tema}}</h1>
                          <p class="text-neutral-gray-4 mb-0">{{item.dimulai.split(' ')[0]}} - {{item.berakhir.split(' ')[0]}}</p>
                        </div>
                         <button class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" @click="redirect(item.id)">Lihat Kegiatan</button>
                      </div>
                    </div>
                  </div>
                  </div>          
              </div>
                <div class="d-flex justify-content-center mt-4">
              <Pagination :links="items.links"/>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../Components/UmkmDashboardSidebar.vue'
import Pagination from '../../../Components/Pagination.vue'
import { useForm, Link,usePage } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
export default{
  data(){
    return{
       currentPage : window.location.pathname.split('/')[4],
       now:null
    }
  },
  props:{
     items :Object,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number
  },
  mounted(){
    const date = new Date();
    var bulan = (date.getMonth() >= 10)? date.getMonth()  : "0" + date.getMonth() ;
    var tahun = date.getFullYear();
    var tanggal = (date.getDate()  >= 10)? date.getDate()  : "0" + date.getDate();
    this.now = tahun+ '-' + bulan + '-' + tanggal;
    this.now = new Date(tahun+ '-' + bulan + '-' + tanggal);
  },
  components:{
    BaseLayout,
    Link,
    UmkmDashboardSidebar,
    Pagination
  },
  methods:{
     redirect(data){
    Inertia.get("/umkm/dashboard/kegiatanku/detail/"+data)
  }
  }
}
</script>

<style scoped>

section {
  margin-top: 10rem !important;
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
.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.sidebar ul li {
  padding: 1rem;
  cursor: pointer;
}

.sidebar ul li.active {
  border: 1px solid #AEAEAE;
  border-radius: 0.5rem;
}

.sidebar ul li.active a span,
.sidebar ul li.active a path {
  color: #398AB9;
  fill: #398AB9;
}

.sidebar ul li a {
  width: max-content;
  text-decoration: none;
  font-weight: 600;
  position: relative;
}

.sidebar ul li a span {
  width: max-content;
  position: absolute;
  left: 2rem;
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

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>