<template>
  <BaseLayout title="Kebijakan Privasi">
    <section class="mt-4">
      <div class="container">
        <h1>Hubungi Kami</h1>
        <p>
          Fitur ini digunakan jika user mendapati masalah atau ingin mengkontak admin.
        </p>
    <div class="col d-flex justify-content-center">
      <form @submit.prevent="submit()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Pesan</label>
         <textarea  type="text" class="form-control" v-model="form.isi" rows="4" cols="50"  id="provinsi" placeholder="Masukkan hal yang ingin anda diskusikan" > </textarea>
           <small class="text-danger" v-if="form.errors.isi">{{form.isi}}</small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Email</label>
          <input type="text" class="form-control" v-model="form.email"  id="provinsi" placeholder="Masukkan email atau no kontak anda" >
            <small class="text-danger" v-if="form.errors.email">{{form.errors.email}}</small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label  text-neutral-gray-5">Gambar</label>
          <input type="file" class="form-control" @change="getGambar($e)" id="provinsi" placeholder="Masukkan email atau no kontak anda" >
            <small class="text-danger" v-if="form.errors.gambar">{{form.errors.gambar}}</small>
      </div>

  <div class="col d-flex justify-content-center">
      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </div>
  </form>
      </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../Layouts/UnauthenticatedLayout.vue'
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
export default{
  data(){
    return{
      isCheckKebijakanPrivasi : null
    }
  },
  setup(){
    const form = useForm({
      isi:null,
      email:null,
      gambar:null
      
  });
    return {form}
  },
  methods:{
    ubahGambar(event){
      if(event.target.files[0].type == 'image/jpeg' || event.target.files[0].type == 'image/png'){
        
            if(event.target.files[0].size >= 5000000){
              this.form.errors.gambar = "Size foto anda lebih dari 5MB !" 
              return
            }
        this.form.gambar = event.target.files[0];
      }
      else{
        this.form.errors.gambar = "File yang anda upload bukanlah gambar !" 
         //console.log(event.target.files[0].type)
         return
      }
    },
    submit(){
      this.form.post('/laporan');
    },
    removePopup(){
      this.page.props.session.success = false
    }
  },
  components:{
    BaseLayout
  }
}
</script>

<style scoped>
section {
  margin-top: 10rem !important;
}

h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

p {
  margin-bottom: 1rem;
}

form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: start;
}
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
button{
  margin-left:10rem;
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
    width:40rem;

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
.form-check-label {
  font-weight: 600;
  color: #3E4041;
}
form button {
  padding: 0.5rem 10rem;
}


@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }

  form button {
    width: 100%;
    padding: 0.5rem 0;
  }
}
</style>