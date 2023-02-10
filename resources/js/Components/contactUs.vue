<template>
	   <div class="help">
      <div class='clear step' v-if="!popupQuestion" >
            <div class="number"><button class="open" @click="openPopup">? Pusat Bantuan</button></div>
        </div>
        <div v-else >
             <div  id="myModal" class="modal" >

      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click="openPopup" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="col-lg-12">
      <div class=" d-flex justify-content-center">
      <h2>Hubungi Kami</h2>
    </div>
    <div class="mt-2">
      <form @submit.prevent="submit()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Isi</label>
         <textarea  type="text" class="form-control" rows="4" cols="50"  id="provinsi" placeholder="Masukkan hal yang ingin anda diskusikan" > </textarea>
           <small class="text-danger" ></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Email</label>
          <input type="text" class="form-control"  id="provinsi" placeholder="Masukkan email atau no kontak anda" >
            <small class="text-danger"></small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Gambar</label>
          <input type="file" class="form-control"  id="provinsi" placeholder="Masukkan email atau no kontak anda" >
            <small class="text-danger"></small>
      </div>


      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
</div>
  </div>
        </div>
      </div>
</template>
<script>
export default{
	data(){
		return{
			popupQuestion:false
		}
	},
	methods:{
		openPopup(){
		this.popupQuestion = !this.popupQuestion
	}
	}
}
</script>
<style scoped>
.buttonSubmit{
	color: white;
}
.open{
	background-color: transparent;
	border: 0px;
	border-color: 0px;
	color: white;
}
	.step {
  row-gap: 1rem;
  position:sticky;
  bottom:0px;
}
.step .number {
  width: 9rem;
  height: 3rem;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size:0.8rem;
  font-weight: 600;
  border-radius: 9%;
  background-color: #D9D9D9;
  color: #FFFFFF;
  cursor: pointer;
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
.help{
  position: fixed;
  bottom: 0px; /* Location of the box */
  left: -30rem;
  display: block;
  top: 600px;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: transparent; /* Fallback color */
  background-color: transparent; /* Black w/ opacity */
}
  .modal {
  position: fixed; /* Stay in place */
  bottom: 0rem; /* Location of the box */
  left: 20rem;
  display: block;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: transparent; /* Fallback color */
  background-color: transparent; /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin-top: 3rem;
  margin-left: 25rem;
  padding: 20px;
  border-radius: 25px;
  width: 40%;
  text-align: start;
}
.form-control,
.form-select,
.vs__dropdown-toggle {
    border-width: 1px !important;
   border-radius: 5px!important;
   border: 1px solid #aeaeae !important;
    padding:5px !important;

}

.vs__search {
    padding-left: 0 !important;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
}


.form-control:focus {
  box-shadow: none;
   border: 1px solid  #398ab9 !important;
}
.form-control:click {
  border: 1px solid #3ccede !important;
}

</style>