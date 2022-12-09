<template>
	   <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popup && notSubmit">
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click="$emit('toggleClose')" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
       <img src="../assets/images/warning.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-center text-center" style="margin-left: 2rem;">
       <h2>{{pesan}}</h2>
         </div>
          <div class="d-flex flex-column flex-lg-row justify-content-center gap-3 gap-lg-4 mt-5">
                    <button @click="$emit('toggleClose')" class="btn btn-primary-blue-6 text-primary-blue-6 text-white py-2 border-5">Batal</button>
                    <button @click="hapusAction()" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Ya</button>
                </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Link,useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from "@inertiajs/inertia";
export default{
	data(){
		return{
				notSubmit : true
		}
	},
	props:{
		pesan:null,
		url:null,
		popup:Boolean,
		itemDelete:Object
	},
	methods:{
		closeQuit(){
			this.popup = false;
		},
		hapusAction(){
			this.notSubmit= false 
			Inertia.post(this.url,this.itemDelete);
		}
	},
	components:{
		Link
	},
	emits: ['toggleClose'],
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


@media (max-width: 575.98px) {
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>