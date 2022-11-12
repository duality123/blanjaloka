<template>
  <BaseLayout title="UMKM Profile">
    <section>
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h1>{{kegiatan.tema}}</h1>
                 <ul class="mt-4">
                    <li>
                      <Link :href="`/umkm/dashboard/kegiatanku/detail/${kegiatan.kegiatan_id}`">Deskripsi</Link>
                    </li>
                   <li class="active">
                      <Link class="active" :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/1`">Elearning</Link>
                    </li>
                    <li >
                        <Link :href="`/umkm/dashboard/kegiatanku/eventual/${kegiatan.kegiatan_id}`" >Eventual</Link>
                    </li>
                    <li >
                        <Link :href="`/umkm/dashboard/kegiatanku/logbook/${kegiatan.kegiatan_id}`">Logbook</Link>
                    </li>
                </ul>
             <p>
                                    E-Learning atau pembelajaran online atau daring (dalam jaringan) pada layanan Blanjaloka adalah pembelajaran yang dikembangkan oleh Tim Blanjaloka dalam bentuk online (dalam jaringan) melalui media website. Materi pembelajaran daring layanan blanjaloka mencakup materi tentang entrepreneurship, bisnis, dan usaha. Selain itu, terdapat pula materi-materi yang lebih teknis dan spesifik terkait cara mengembangkan usaha hingga ke skala internasional.
                                </p>
                                
                                <p>
                                    Setelah menyelesaikan pembelajaran daring ini, pelaku UMKM diharapkan lebih paham bagaimana mengembangkan usaha bisnis mereka.
                                </p>
                                
                    <div class="row row-cols-1 row-cols-md-3 g-4" v-for="item in items">
                      <div class="col">
                        <div class="card h-100">
                          <img :src="`${this.$page.props.asset_url}/${item.foto}`" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">{{item.judul}}</h5>
                            <p class="card-text">{{item.deskripsi}}</p>
                            <Link :href="`/umkm/dashboard/kegiatanku/elearning/materi/overview/${item.id}`" class="btn btn-primary d-block">Ikuti Pembelajaran</Link>
                          </div>
                        </div>
                      </div>
                    </div>
<div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
          <li v-if="prev">
            <Link :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/${prev}`">
              <font-awesome-icon icon="fa-solid fa-chevron-left" class="text-primary-blue-6" />
            </Link>
          </li>
          <li v-if="first">
              <Link :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/${first}`">{{first}}</Link>
          </li>
          <li v-if="prevBlok">
              <Link :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/${prevBlok}`">...</Link>
          </li>
          <div v-for="num in paginationNums">
          <li :class="[currentLink== num ? 'active':'']">
              <Link :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/${num}`">{{num}}</Link>
          </li>
        </div>
        <li v-if="nextBlok">
          <Link :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/${nextBlok}`">...</Link>
        </li>
        <li v-if="last">
            <Link :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/${last}`">{{last}}</Link>
        </li>
          <li v-if="next">
            <Link :href="`/umkm/dashboard/kegiatanku/${kegiatan.kegiatan_id}/elearning/${next}`">
              <font-awesome-icon icon="fa-solid fa-chevron-right" class="text-primary-blue-6" />
            </Link>
          </li>
        </ul>
      </div>
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
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';
export default{
  data(){
    return{
      tabItems:null,
      currentPage:window.location.pathname.split('/')[4],
      currentLink:window.location.pathname.split('/')[6]
    }
  },
  components:{
    BaseLayout,
    UmkmDashboardSidebar,
    Link
  },
  mounted(){

  },
  methods:{
  },
  props:{
      kegiatan:Object,
      items : Array,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number
  }
}







</script>

<style scoped>
section{
  margin-top: 10rem;
}
header{
    border: 1px solid #dbcfcf;
    border-radius: 8px;
}
/* 
a{
    color: #686868;
    text-decoration: none;
    font-size: 20px;
} */
ul {
    display: flex;
    column-gap: 2rem;
    list-style: none;
    border: none;
    padding: 0;
    border-bottom: 1px solid #F0F0F0;
}
ul li {
    cursor: pointer;
}
ul li a.active {
  border-bottom: 2px solid #398AB9;
  color:  #398ab9;
}

ul li a {
  text-decoration: none;
  font-weight: 600;
  color: black;
}
.badge{
    background-color: #F2F7FA;
    color: #398AB9;
    font-size: 16px;
}
.badge-text{
    display:inline-block;
    width:100%;
    word-wrap:break-word;
    white-space: normal;
}
.btn-konsultasi{
    background-color: #398AB9;
}
.btn-konsultasi:hover{
    background-color: #349edb;
}
.form-label{
    font-weight: 600;
    font-size: 15px;
    font-style: 'Inter';
}
.form-control, .form-select{
    border: none;
    border-radius: 0;
    border-bottom: 2px solid #AEAEAE;
    padding: 0;
}
.btn-lanjut{
    background-color: #398AB9;
}
.btn-lanjut:hover{
    background-color: #4398c9;
}
.card-kegiatan{
    border-radius: 10px 10px 2px 2px;
    border:none;
}
.card-kegiatan:hover{
    background-color: #E4F0F6;
}
.card h6{
    font-weight: 600;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.card-text{
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.card .btn{
    font-size: 14px;
}
.card-kegiatan .card-body{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }
}
</style>
