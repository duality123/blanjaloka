<template>
<div class="col-lg-8" v-if="popupRequest">

              <div id="myModal1" class="modal1"  >
      <div class="modal-content1">
        <div class=" d-flex justify-content-end">
         <button @click = "$emit('togglePopup')" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
      <div class=" d-flex justify-content-center">
      <h2>Ajukan janji temu </h2>
    </div>
    <div class="mt-2">
      <form @submit.prevent="submit()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Lokasi ?</label>
         <input type="text" class="form-control" v-model="form.lokasi" id="provinsi" placeholder="Masukkan hal lokasi dimana anda ingin ketemuan" >
           <small class="text-danger" v-if="form.errors.lokasi">{{ form.errors.lokasi }}</small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Waktu (WIB) ?</label>
         <input type="datetime-local" class="form-control" v-model="form.waktu" id="nama_investor" placeholder="(Masukkan waktu ketemuan.)" >
          <small class="text-danger" v-if="form.errors.waktu">{{ form.errors.waktu }}</small>
      </div>
      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
    </div>
  </div>
</div>
</template>
<script>
import { useForm, Link,usePage } from '@inertiajs/inertia-vue3'

import { Inertia } from '@inertiajs/inertia'
export default{
  setup(props){
    const form = useForm({
      lokasi:null,
      waktu:null,
      umkmid:props.umkm_id
    })
    return {form}
  },
 
  methods:{
    submit(){
      form.post('/investor/janjitemu',{preserveState:true})

    },
   
  },
  props:{
    umkm_id:Number,
    popup:Boolean
  },
  emits:['togglePopup']


}

</script>
<style scoped>
.modal-content{
  height: 450px;
  overflow-y: scroll;
  text-align:start;
 }
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
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.1); /* Black w/ opacity */
}

</style>