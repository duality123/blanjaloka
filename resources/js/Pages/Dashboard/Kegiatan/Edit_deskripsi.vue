<template>

  <Layout section="deskripsi" :title="kegiatan.tema" :link="kegiatan.id">
     <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popup" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleEdit()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Edit Kegiatan</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submit()">
        <div class="mb-4">
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Gambar</label>
          <div class="card text-white bg-neutral-gray-1 mb-3 " >
               <div v-if="form.gambar != null" class="d-flex justify-content-center pt-3 mb-4">
                   <img :src="`${$page.props.asset_url}/${form.gambar}`" alt="update icon" style="overflow: hidden; width: 5rem;" id="foto1" >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4">
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="foto1" >
                </div>
    
                <div class="row" style="margin-left:2px;" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" ref ="foto_profil" class="custom-file-input " @change="changePicture($event)"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-center">
                <p class="text-primary" style="padding-right: 6px;">atau</p>
                </div>
                  <div class="col d-flex justify-content-end" >
                <input type="file" class="custom-file-input2" style="width: 9rem;">
                </div>
                </div>
                 <small class="text-danger text-center" v-if="form.errors.gambar">{{form.errors.gambar}}</small>
                <div class="text-neutral-gray-3 text-center"><p class="fs-9">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p></div>
            </div>
          </div>
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan deskripsi kegiatan?</label>
         <input type="text" class="form-control" v-model="form.deskripsi" id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger" v-if="form.errors.deskripsi">{{ form.errors.deskripsi }}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
      <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-end align-items-lg-end gap-4">
      <button @click = "toggleEdit()" class="btn btn-primary-blue-6 text-neutral-white py-2">Edit Deskripsi
      </button>
    </div>
        <div class="d-flex justify-content-center pt-3 mb-4" >
                   <img :src="`${$page.props.asset_url}/${kegiatan.gambar}`" alt="update icon" style="width:20rem" id="img" >
        </div>
        <p>{{kegiatan.deskripsi}}</p>
      </div>
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/kegiatan.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
export default{
  data(){
    return{
      popup: false
    }
  },
  setup(props){
    const form = useForm({
     gambar:props.kegiatan.gambar,
     id :window.location.pathname.split('/')[4],
     deskripsi:props.kegiatan.deskripsi,
    })

    return {form}
  },
  props:{
    kegiatan:Object
  },
  components:{
    Layout,
    Link
  },
  mounted(){
    if (this.form.errors.deskripsi) {
      this.popup =true
    }
  },
  methods:{
    submit(){
      this.popup =false
      this.form.post('/admin/dashboard/kegiatan/edit_deskripsi')
    },
    toggleEdit(){
      this.popup = !this.popup
    },
     changePicture(event){
        if(event.target.files[0].type == 'image/jpeg' || event.target.files[0].type == 'image/png'){
        
            if(event.target.files[0].size >= 5000000){
              this.form.errors.gambar  = "Size foto anda lebih dari 5MB !" 
              return
            }
        var image = document.getElementById('img');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.width = '5rem';
        image.style.overflow = 'hidden';
        this.form.gambar = event.target.files[0];
        //console.log(this.process)
      }
      else{
        this.form.errors.gambar  = "File yang anda upload bukanlah gambar !" 
        return
      }
    },
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
h1 {
  font-size: 2.1rem;
  font-weight: 600;
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
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;

}
.custom-file-input::before {

  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0\00a0Upload Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload.png');
  background-repeat: no-repeat;
  background-size: 18px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

.custom-file-input2::-webkit-file-upload-button {
  visibility: hidden;

}

.custom-file-input2::before {
  content: '\00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0 \00a0  Ambil Gambar';
  display: inline-block;
  background-color:white;
  background-image:url('../../../assets/icons/upload2.png');
  background-repeat: no-repeat;
  background-size: 18px 20px;
  border-radius: 3px;
  padding: 8px;
  background-origin: content-box;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  color:black;
  font-size: 12px;
}

.custom-file-input2:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
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

@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }

}

form section h2 {
  font-size: 1.25rem;
}

.form-control {
  background-color: transparent;
  resize: none;
}
.modal-content{
  text-align: start;
}

textarea::-webkit-scrollbar {
  display: none;
}

.desc_count {
  font-size: 0.75rem;
  font-weight: 400;
  color: #3E4041;
  position: absolute;
  right: 0;
  bottom: -1.5rem;
}

.count_input {
  width: 14rem;
}

.count_input_leading {
  position: absolute;
  right: -3.5rem;
  bottom: 0.5rem;
}

.telp_input .form-control {
  padding-left: 2.5rem !important;
}

.telp_input .telp_leading {
  position: absolute;
  left: 0;
  bottom: 0.5rem;
}

form button {
  padding: 0.75rem 1.5rem;

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