<template>
    <Layout state="elearning" :link="kegiatan.kegiatan_id" :title="kegiatan.tema">
             <p>
                                    E-Learning atau pembelajaran online atau daring (dalam jaringan) pada layanan Blanjaloka adalah pembelajaran yang dikembangkan oleh Tim Blanjaloka dalam bentuk online (dalam jaringan) melalui media website. Materi pembelajaran daring layanan blanjaloka mencakup materi tentang entrepreneurship, bisnis, dan usaha. Selain itu, terdapat pula materi-materi yang lebih teknis dan spesifik terkait cara mengembangkan usaha hingga ke skala internasional.
                                </p>
                                
                                <p>
                                    Setelah menyelesaikan pembelajaran daring ini, pelaku UMKM diharapkan lebih paham bagaimana mengembangkan usaha bisnis mereka.
                                </p>
                                
                    <div class="row row-cols-1 row-cols-md-3 g-4" >
                      <div class="col" v-for="item in items.data">
                        <div class="card">
                          <img :src="`${this.$page.props.asset_url}/${item.foto}`" style="width:250px; height:250px" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title">{{item.judul}}</h5>
                            <p class="card-text">{{item.deskripsi}}</p>
                            <Link :href="`/umkm/dashboard/kegiatanku/elearning/materi/overview/${item.id}`" class="btn btn-primary d-block">Ikuti Pembelajaran</Link>
                          </div>
                        </div>
                      </div>
                    </div>
<div class="d-flex justify-content-center mt-4">
      <Pagination :links="items.links"/>
  </div>

  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Kegiatanku.vue'
import Pagination from '../../../components/Pagination.vue'
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
    Layout,
    Link,
    Pagination
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
