<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar section="bisnis"/>
          <div class="col-lg-8">
                <div class="my-4 d-flex justify-content-end borderc gap-3">
                    <Link href="/investor/dashboard/tambah_bisnis" class="fs-btn p-2 px-3 btn text-white bg-primary-blue-6 border-primary-blue-6">
                        + Tambah Bisnis
                    </Link>
                </div>
            <div class="card">
              <div class="card-body">
                <h1>Investasi</h1>
                <div class="row">
                  <div class="col-lg-4" v-for="(item,no) in items">
                    <div class="card card_kegiatan">
                      <div class="card-body">

<div :id="item.name" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
     <div class="carousel-item active"  v-for="gambar in item.foto_bisnis.split(',').filter(element => {return element !== ''})">
      <img :src="`${this.$page.props.asset_url}/${gambar}`" style="width:200px;height: 200px;" alt="...">
    </div>
   
  </div>
  <button class="carousel-control-prev" type="button" :data-bs-target="item.name" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
                        </div>
                        <div> 
                          <h1 class="text-neutral-black mt-2">{{item.name}}</h1>
                        </div>
                         <button class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" @click="redirect(item.id)">Lihat Bisnis</button>
                      </div>
                    </div>
                  
                  </div>          
              </div>
                <div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
          <li v-if="prev">
            <Link :href="`/umkm/dashboard/kegiatanku/${prev}`">
              <font-awesome-icon icon="fa-solid fa-chevron-left" class="text-primary-blue-6" />
            </Link>
          </li>
          <li v-if="first">
              <Link :href="`/umkm/dashboard/kegiatanku/${first}`">{{first}}</Link>
          </li>
          <li v-if="prevBlok">
              <Link :href="`/umkm/dashboard/kegiatanku/${prevBlok}`">...</Link>
          </li>
          <div v-for="num in paginationNums">
          <li :class="[currentPage == num ? 'active':'']">
              <Link :href="`/umkm/dashboard/kegiatanku/${num}`">{{num}}</Link>
          </li>
        </div>
        <li v-if="nextBlok">
          <Link :href="`/umkm/dashboard/kegiatanku/${nextBlok}`">...</Link>
        </li>
        <li v-if="last">
            <Link :href="`/umkm/dashboard/kegiatanku/${last}`">{{last}}</Link>
        </li>
          <li v-if="next">
            <Link :href="`/umkm/dashboard/kegiatanku/${next}`">
              <font-awesome-icon icon="fa-solid fa-chevron-right" class="text-primary-blue-6" />
            </Link>
          </li>
        </ul>
      </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../../Components/InvestorDashboardSidebar.vue'
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
     items : Array,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number
  },
  components:{
    BaseLayout,
    Link,
    UmkmDashboardSidebar
  },

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