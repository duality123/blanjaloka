<template>
  <BaseLayout :page="currentPage">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">{{ currentStep }}</span>
                    dari 3</p>
                </div>
                <form @submit.prevent="submit">
                <h2 class="mt-4">Foto KTP</h2>
                <p class="text-neutral-gray-5">Foto yang baik mungkin akan membantu Anda dalam proses inkubasi
                  kedepannya.</p>
                <div class="card text-white bg-neutral-gray-1 mb-3 " >
                <div v-if="$page.props.auth.profil['foto_ktp'] != null" class="d-flex justify-content-center pt-3 mb-4">
                   <img :src="`${$page.props.asset_url}/${$page.props.auth.profil['foto_ktp']}`" alt="update icon" style="overflow: hidden;" id="foto1" >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4">
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="foto1" >
                </div>
    
                <div class="row" style="margin-left:2px" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" ref ="foto_profil" class="custom-file-input " @change="changePicture($event,'foto1')"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-between">
                <p class="text-primary" style="padding-left:25px;">atau</p>
                </div>
                  <div class="col d-flex justify-content-end" >
                <input type="file" class="custom-file-input2" style="width: 9rem;">
                </div>
                </div>
                 <small class="text-danger text-center" v-if="this.error1">{{this.error1}}</small>
                <div class="text-neutral-gray-3 text-center"><p class="fs-9">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p></div>
            </div>                
            <h2 class="mt-4">Foto Selfie Dengan KTP</h2>
                <p class="text-neutral-gray-5">Foto yang baik mungkin akan membantu Anda dalam proses inkubasi
                  kedepannya.</p>
                <div class="card text-white bg-neutral-gray-1 mb-3 " >
                 <div v-if="$page.props.auth.profil['foto_dengan_ktp'] != null" class="d-flex justify-content-center pt-3 mb-4">
                   <img :src="`${$page.props.asset_url}/${$page.props.auth.profil['foto_dengan_ktp']}`" alt="update icon" style="overflow: hidden;" id="foto2" >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4">
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="foto2" >
                </div>
    
                <div class="row" style="margin-left:2px" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" class="custom-file-input " @change="changePicture($event,'foto2')"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-between">
                <p class="text-primary" style="padding-left: 25px;">atau</p>
                </div>
                  <div class="col d-flex justify-content-end" >
                <input type="file" class="custom-file-input2" style="width: 9rem;">
                </div>
                </div>
                 <small class="text-danger text-center" v-if="this.error2">{{this.error2}}</small>
                <div class="text-neutral-gray-3 text-center"><p class="fs-9">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p></div>
            </div>
                <div class="d-flex justify-content-end">
                  <button type='submit' class="btn btn-primary-blue-6 text-neutral-white py-2 px-4 " :disabled="formCheck">Selanjutnya</button>
                </div>
            </form>
              </div>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Profile.vue'
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
export default{
  data(){
    return{
      currentStep : parseInt(window.location.pathname.split('/')[2]),
      currentPage : window.location.pathname.split('/')[1],
      error1 : null,
      error2 : null,
      process : false,
    }
  },

  components:{
    BaseLayout
  },

  mounted(){
      this.form.foto_ktp = this.$page.props.auth.profil['foto_ktp']
      this.form.foto_selfie_ktp = this.$page.props.auth.profil['foto_dengan_ktp']
  },
  setup () {
    const form = useForm({
      foto_ktp: String,
      foto_selfie_ktp: String,
    })

    return { form  }
},
 computed:{
    formCheck(){
      if(this.form.foto_ktp == null ||  this.form.foto_selfie_ktp == null){
        return true
      }
      return false;
    }
  },


  methods:{
    changePicture(event,id){
        if(event.target.files[0].type == 'image/jpeg' ||event.target.files[0].type == 'image/png'){
          if(event.target.files[0].size >= 5000000){
            if(id == 'foto1'){
              this.error1 = "Size foto anda lebih dari 5MB!" 
            }
            else{
              this.error2 = "Size foto anda lebih dari 5MB!" 
            }
            return
          }

        var image = document.getElementById(id);
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.width = '25rem';
        image.style.overflow = 'hidden';
            if(id =='foto1'){
             this.form.foto_ktp = event.target.files[0]
            }
            else{
              this.form.foto_selfie_ktp = event.target.files[0];
            }
        this.process = ( this.form.foto_ktp &&  this.form.foto_selfie_ktp  )?true:false;
        
        }
        else{
           if(id == 'foto1'){
            this.error1 = "File yang anda upload bukanlah gambar !" 
          }
          else{
            this.error2 = "File yang anda upload bukanlah gambar !" 
          }
          return
        }
        
    },
   submit() {
      if (this.form.foto_ktp == '' ||this.form.foto_selfie_ktp == '' ){
         this.error1 = "Mohon upload foto anda terlebih dahulu !"
         return 
      }
       if (this.form.foto_selfie_ktp == '' ){
         this.error2 = "Mohon upload foto anda terlebih dahulu !"
         return 
      }
    if (this.process){
      this.form.post('/profil/proses/ketiga');
    }
     else{
       Inertia.get('/umkm/dashboard/profil_usaha/1');
    }
    
  }
  }
}

</script>

<style scoped>
section {
  margin-top: 10rem !important;
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

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}
.card h2 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #3E4041;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>