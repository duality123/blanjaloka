<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
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
       <h2>Anda yakin ingin leave dari kegiatan ini ??</h2>
         </div>
          <div class="d-flex flex-column flex-lg-row justify-content-center gap-3 gap-lg-4 mt-5">
                    <button @click="popupControl()" class="btn btn-primary-blue-6 text-primary-blue-6 text-white py-2 border-5">Batal</button>
                    <Link :href="`/umkm/dashboard/kegiatanku/keluar/${item.id}`" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Ya</Link>
                </div>
      </div>
    </div>
            <div class="card">
              <div class="card-body">
                <h1>{{item.tema}}</h1>
                 <ul class="mt-4">
                    <li class="active" >
                    <Link class="active" :href="`/umkm/dashboard/kegiatanku/detail/${item.id}`">Deskripsi</Link>                 </li>
                    <li >
                        <Link :href="`/umkm/dashboard/kegiatanku/${item.id}/elearning/1`">Elearning</Link>
                    </li>
                    <li >
                        <Link :href="`/umkm/dashboard/kegiatanku/eventual/${item.id}/`">Eventual</Link>
                    </li>
                    <li >
                        <Link :href="`/umkm/dashboard/kegiatanku/logbook/${item.id}`">Logbook</Link>
                    </li>
                </ul>
                <div class="d-flex justify-content-start mt-5">
                <button class="btn btn-semantic-error-1 text-semantic-error-4 py-3" @click="popupControl">
                  <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" />Keluar kegiatan</button>
                </div>
                 <div class="d-flex flex-column flex-lg-row mt-4">
                  <p class="fw-semibold  mb-0">
                    {{item.deskripsi}}
                  </p>
                </div>
               <div class="card mt-4">
  <div class="card-body">
  <p><strong>Juri : </strong>{{item.nama_juri}}</p>
  <p><strong>Investor : </strong><div v-for="invest in investor">{{invest}}</div></p>
  <p><strong>Masa Inkubasi : </strong>{{item.masa_inkubasi}} Bulan</p>
  <p><strong>PIC : </strong>{{item.pic}} Bulan</p>
  <p><strong>Kontak PIC : </strong>{{item.kontak}}</p>
  </div>
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
import { Inertia } from '@inertiajs/inertia';
export default{
  data(){
    return{
      tabItems:null,
      currentPage:'detail',
      currentLink:window.location.pathname.split('/')[5],
      leavePopup:false
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
    popupControl(){
      this.leavePopup = !this.leavePopup
    }
  },
  props:{
    item:Object,
    investor:Array,
    elearning:Object
  }
}







</script>


<style scoped>
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
section {
  margin-top: 10rem !important;
}
.card-body{
  width: 400px;
}
.fs-btn {
    font-size: .875rem;
}

.lh-90 {
    line-height: 90px;
}

.border-primary-blue-6 {
  border : 2px solid #398ab9;
}

ul {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}

ul li {
  cursor: pointer;
}

ul li {
  padding-bottom: 0.5rem;
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

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 1rem;
}

.step .number {
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.25rem;
  font-weight: 600;
  border-radius: 50%;
  background-color: #D9D9D9;
  color: #FFFFFF;
}

.step h1 {
  font-size: 1.125rem;
  font-weight: 600;
  color: #AEAEAE;
}

.step.clear .number {
  background-color: #398AB9;
}

.step.clear h1 {
  color: #3E4041;
}

h2 {
  font-size: 1.25rem;
  font-weight: 600;
}

table thead tr td,
table thead tr th {
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
  background-color: #F0F0F0;
}

table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
  background-color: #F2F7FA;
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
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>
