<template>
          <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popup" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click="togglePopup()"  type="button"  class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
           <div class="mt-2">
      <form @submit.prevent="submit()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Isikan jawaban anda</label>
         <input type="text" class="form-control"  id="provinsi" placeholder="Kerjakan tantangan ini dengan anda sendiri" >
           <small class="text-danger">{{}}</small>
      </div>
     
      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        submit</button>
  </form>
      </div>
  </div>
    </div>
  </div>    
                
                 <Layout state="Tugas" section="kegiatan" :tema="kegiatan.tema" :link="kegiatan.id">
                  
                <div class="d-flex justify-content-start mt-5">
               <button @click ="togglePopup()" class="btn btn-primary-blue-6 text-white">Upload Jawaban</button>
                </div>
                 <div class="d-flex flex-column flex-lg-row mt-4">
                  <p class="fw-semibold  mb-0">
                   
                  </p>
                </div>
               <div class="card mt-4">
  <div class="card-body">

<div class="d-flex flex-column">
  <div v-for="item in items" class="p-2">{{item.soal}}</div>
</div>
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
      popup:false
    }
  },
  setup(){
    const form = useForm({
      jawaban:'',
    })
    return { form }
  },
  components:{
    Layout,
    Link
  },
  methods:{
    togglePopup(){
      this.popup = !this.popup
    }
  
  },
  props:{
    items:Object,
    kegiatan:Object
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
  text-align: left;
}

</style>
