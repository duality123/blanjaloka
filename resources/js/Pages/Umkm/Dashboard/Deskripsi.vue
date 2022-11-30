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
       <h2>Anda yakin ingin leave dari kegiatan ini ??</h2>
         </div>
          <div class="d-flex flex-column flex-lg-row justify-content-center gap-3 gap-lg-4 mt-5">
                    <button @click="popupControl()" class="btn btn-primary-blue-6 text-primary-blue-6 text-white py-2 border-5">Batal</button>
                    <Link :href="`/umkm/dashboard/kegiatanku/keluar/${item.id}`" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Ya</Link>
                </div>
      </div>
    </div>
  </div>
                 <Layout state="deskripsi" :tema="item.tema" :link="item.id">
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
       
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Kegiatanku.vue'
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
    Layout,
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

</style>
