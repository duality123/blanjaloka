<template>
  <BaseLayout title="Investor Bisnis">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <InvestorDashboardSidebar state="bisnis"/>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h1>Investasi</h1>
                   <div class="col-xl-7 d-flex justify-content-end gap-3">
                    <Search url="/investor/dashboard/bisnisku?page=1" judul="Cari Kegiatan" />
                     <div class="dropdown">
                  <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  </button>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li><Link preserve-state :data="{profit:'t'}" class="dropdown-item" :href="url">Profit</Link></li>
                                <li><Link preserve-state :data="{profit:'f'}" class="dropdown-item" :href="url">Belum Profit</Link></li>
              </ul>
            </div>
                </div>
                <div class="row">
                  <div class="col-lg-5" v-for="(item,no) in items.data">
                    <div class="card card_kegiatan">
                      <div class="card-body">

  <div :id="`carouselExampleControlsNoTouching${no}`" class="carousel slide" data-bs-touch="false">
  <div class="carousel-inner">

    <div class="carousel-item active" data-bs-interval="2000" v-for="gambar in item.foto_bisnis.split(',').filter(item => item)">
        <div v-if="item.persentase_hasil_investasi > 0" class="bg-semantic-success-1 text-semantic-success-4 status">Profit ( {{item.persentase_hasil_investasi}} % )</div>
        <div v-else class="bg-neutral-gray-1 text-neutral-gray-4 status">Belum Profit ( {{item.persentase_hasil_investasi}} % )</div>
                  <img  :src="`${$page.props.asset_url}/${gambar}`" class="gambar" alt="...">
                </div>
                          </div>
                          <button class="carousel-control-prev " type="button" :data-bs-target="`#carouselExampleControlsNoTouching${no}`" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon   " aria-hidden="true"></span>
                            <span class="visually-hidden ">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" :data-bs-target="`#carouselExampleControlsNoTouching${no}`" data-bs-slide="next">
                            <span class="carousel-control-next-icon   " aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                        </div>
                         <h1 class="text-neutral-black mt-2">{{item.name}}</h1>
                         <div class="d-flex justify-content-center mt-4 mb-4">
                           <button class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" @click="redirect(item.id)">Lihat Bisnis</button>
                         </div>
                         </div>
                          <div> 
                        </div>
                      </div>
                    </div>               
                  </div>          
              </div>
                <div class="d-flex justify-content-center mt-4">
            <Paginate :links="items.links" />
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/LayoutInvestor.vue'
import InvestorDashboardSidebar from '../../../Components/InvestorDashboardSidebar.vue'
import Paginate from '../../../Components/Pagination.vue'
import Search from '../../../Components/Search.vue'
import { useForm, Link,usePage } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
export default{
  data(){
    return{
       url:document.location.href,
       now:null,
       idCarousel:[]
    }
  },
  props:{
     items : Object,
 
  },
  mounted(){
    for (var i =0;i< this.items.length; i++) {
      idCarousel[i] = this.items[i].name
    }
  },
  components:{
    BaseLayout,
    Paginate,
    Link,
    Search,
    InvestorDashboardSidebar
  },
  methods:{
    redirect(id_bisnis){
      Inertia.get('/investor/dashboard/bisnisku/'+id_bisnis)
    }
  }

}
</script>

<style scoped>

section {
  margin-top: 10rem !important;
}
.carousel-control-next-icon{
 background-image: url('../../../assets/icons/carousel-right.png');
}

.carousel-control-prev-icon{
 background-image: url('../../../assets/icons/carousel-left.png');
}
.gambar{
  width: 250px;
  height: 200px;
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