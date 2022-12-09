<template>
  <BaseLayout :page="currentPage">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">{{ currentStep }}</span>
                    dari 3</p>
                </div>
                 <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    Anda wajib mengisi profil anda sesuai data anda saat ini !
                  </p>
                </div>
                </div>
                <form @submit.prevent="submit">
                <h2 class="mt-4">Foto KTP</h2>
                <p class="text-neutral-gray-5">Foto yang baik mungkin akan membantu Anda dalam proses inkubasi
                  kedepannya.</p>
                <div class="card text-white bg-neutral-gray-1 mb-3 " >
                <div v-if="$page.props.auth.profil['foto_ktp'] != null" class="d-flex justify-content-center pt-3 mb-4">
                   <img :src="`${$page.props.asset_url}/${$page.props.auth.profil['foto_ktp']}`" alt="update icon" style="overflow: hidden;" id="foto_ktp"  >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4">
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="foto_ktp" >
                </div>
    
                <div class="row" style="margin-left:2px" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" ref ="foto_profil" class="custom-file-input " @change="changePicture($event,'foto_ktp')"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-between">
                <p class="text-primary" style="padding-left:25px;">atau</p>
                </div>
                  <div class="col d-flex justify-content-end" >
                <input type="file" class="custom-file-input2" style="width: 9rem;">
                </div>
                </div>
                 <small class="text-danger text-center" v-if="this.form.errors.foto_ktp">{{this.form.errors.foto_ktp}}</small>
                <div class="text-neutral-gray-3 text-center"><p class="fs-9">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p></div>
            </div>                
            <h2 class="mt-4">Foto Selfie Dengan KTP</h2>
                <p class="text-neutral-gray-5">Foto yang baik mungkin akan membantu Anda dalam proses inkubasi
                  kedepannya.</p>
                <div class="card text-white bg-neutral-gray-1 mb-3 " >
                 <div v-if="$page.props.auth.profil['foto_dengan_ktp'] != null" class="d-flex justify-content-center pt-3 mb-4">
                   <img :src="`${$page.props.asset_url}/${$page.props.auth.profil['foto_dengan_ktp']}`" alt="update icon" style="overflow: hidden;" id="foto_selfie_ktp" >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4">
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="foto_selfie_ktp" >
                </div>
    
                <div class="row" style="margin-left:2px" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" class="custom-file-input " @change="changePicture($event,'foto_selfie_ktp')"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-between">
                <p class="text-primary" style="padding-left: 25px;">atau</p>
                </div>
                  <div class="col d-flex justify-content-end" >
                <input type="file" class="custom-file-input2" style="width: 9rem;">
                </div>
                </div>
                 <small class="text-danger text-center" v-if="this.form.errors.foto_selfie_ktp">{{this.form.errors.foto_selfie_ktp}}</small>
                <div class="text-neutral-gray-3 text-center"><p class="fs-9">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p></div>
            </div>
                <div class="d-flex justify-content-end">
                  <button type='submit' class="btn btn-primary-blue-6 text-neutral-white py-2 px-4 " :disabled="formCheck">Selanjutnya</button>
                </div>
            </form>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Profile.vue'
import { Inertia } from "@inertiajs/inertia";
import { useForm,usePage } from "@inertiajs/inertia-vue3";
export default{
  data(){
    return{
      currentStep : parseInt(window.location.pathname.split('/')[2]),
      currentPage : window.location.pathname.split('/')[1],
      process : false,
    }
  },

  components:{
    BaseLayout
  },
  setup () {
    const form = useForm({
      foto_ktp: usePage().props.value.auth.profil.foto_ktp,
      foto_selfie_ktp:usePage().props.value.auth.profil.foto_dengan_ktp
    })

    return { form  }
  },
   computed:{
      formCheck(){
        if(this.form.foto_ktp == '' ||  this.form.foto_selfie_ktp == ''){
          return true
        }
        return false;
      }
    },

watch: {
  form: {
     handler(newVal, oldVal){ 
        if (newVal) {
          this.process = true;
          console.log(this.process);
        }
     },
     deep: true, 
  }
},

  methods:{
    changePicture(event,id){
        if(event.target.files[0].type == 'image/jpeg' ||event.target.files[0].type == 'image/png'){
          if(event.target.files[0].size >= 5000000){
              this.form.errors[id] = "Size foto anda lebih dari 5MB!" 
            return
          }

        var image = document.getElementById(id);
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.width = '25rem';
        image.style.overflow = 'hidden';
        this.form[id] = event.target.files[0]
        }
        else{
           this.form.errors[id] = "File yang anda upload bukanlah gambar !";
        }
        
    },
   submit() {
      if (this.form.foto_ktp == '' ||this.form.foto_selfie_ktp == '' ){
        if (this.form.foto_ktp == '' ){
           this.form.errors.foto_ktp = "Mohon upload foto anda terlebih dahulu !"
         }
       if (this.form.foto_selfie_ktp == '' ){
          this.form.errors.foto_selfie_ktp = "Mohon upload foto anda terlebih dahulu !"
         }
         return
      }
      if (this.process){
        this.form.post('/profil/proses/wizard_ketiga');
      }
     else{
        if (this.$page.props.auth.user_role == 2 ) {
          Inertia.get('/umkm/dashboard/profil_usaha');
        }
        else if (this.$page.props.auth.user_role == 3 ){
          Inertia.get('/investor/dashboard/profil_perusahaan');
        }
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