<template>
  <BaseLayout :page="this.currentPage">
              <div class="card-body">

    <div id="myModal" :class="[this.popup ? 'show':'hide','modal']">

      <div class="modal-content">
        <div class=" d-flex justify-content-between">
       <img src="../../assets/images/plane.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-between text-center" style="margin-left: 2rem;">
       <h2 >Kata Sandi Berhasil Diubah</h2>
        </div>
       <p>Good, kata sandi Anda berhasil diubah. Gunakan kata sandi baru untuk masuk akun Blanjaloka selanjutnya.</p>
      </div>

    </div>
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Ubah Kata Sandi</h1>
                </div>
                <p class="text-neutral-gray-5">Harap ingat kata sandi baru yang Anda buat. Kata sandi baru akan digunakan saat masuk akun Blanjaloka selanjutnya.</p>
               <form class="mt-2" @submit.prevent="submit()">
                  <div class="mb-2">
                      <label for="kata_sandi" class="form-label text-neutral-gray-5">Kata Sandi Lama</label>
                        <div class="position-relative">
                            <input :type="password1" v-model="form.old_password" class="form-control "
                                id="kata_sandi-lama" placeholder="Masukkan kata sandi lama Anda">
                              <small class="text-danger" v-if="this.wrongOldPassword">Password anda salah !</small>
                        </div>
                        <font-awesome-icon @click="changeEye(1)" :icon="icon1"
                                class="position-absolute text-primary-blue-6 icon_eye" />
                      </div>
                      
                      <div class="mb-2">
                        <label for="kata_sandi" class="form-label text-neutral-gray-5">Kata Sandi Baru</label>
                        <div class="position-relative">
                            <input :type="password2" v-model="form.password" class="form-control "
                                id="kata_sandi_bau" placeholder="Masukkan kata sandi baru Anda">
                          </div>
                            <font-awesome-icon @click="changeEye(2)" :icon="icon2"
                                class="position-absolute text-primary-blue-6 icon_eye" />
                        </div>
                       
                        <div class="mb-2">
                        <label for="kata_sandi_baru" class="form-label text-neutral-gray-5">Konfirmasi Kata Sandi</label>
                        <div class="position-relative mb-2">
                          <input :type="password3" v-model="this.konfirmasi_password" class="form-control"
                                id="kata_sandi_baru" placeholder="Masukkan kata sandi baru anda">
                          </div>
                            <font-awesome-icon @click="changeEye(3)" :icon="icon3"
                                class="position-absolute text-primary-blue-6 icon_eye" />
                        </div>
          
                <div class="d-flex justify-content-end mt-5">
                  <button type='submit' class="btn btn-primary-blue-6 text-neutral-white py-2 px-4 " :disabled="formCheck">Selanjutnya</button>
                </div>
              </form>
              </div>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../Layouts/Profile.vue';
import { ref } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
export default{
  data(){
    return{
      currentStep : window.location.pathname.split('/')[2],
      currentPage : window.location.pathname.split('/')[1],
      konfirmasi_password:null,
      password1 :'password',
      password2 : 'password',
      password3 : 'password',
      icon1:'fa fa-eye',
      icon2:'fa fa-eye',
      icon3:'fa fa-eye',
      isVisible1:false,
      isVisible2:false,
      isVisible3:false

    }
  },
  components:{
    BaseLayout
  },
  props:{
    popup:{
      type:Boolean,
      default:false
    },
    wrongOldPassword:{
      type:String,
      default:''
    }
  },
  setup(){
    const form = useForm({
      old_password:null,
      password:null,
    })

    return {form}
  },
  methods:{
    submit(){
      this.form.post('/ubah_password');
    },
    changeEye(id){
      if (id==1) {
        if(this.isVisible1 == false){
          this.password1='text'
          this.icon1='fa-solid fa-eye-slash'
          this.isVisible1=true
        }
        else{
          this.password1='password'
          this.icon1='fa fa-eye'
          this.isVisible1=false
        }
      
      }
      else if(id==2){
         if(this.isVisible2 == false){
          this.password2='text'
          this.icon2='fa-solid fa-eye-slash'
          this.isVisible2=true
        }
        else{
          this.password2='password'
          this.icon2='fa fa-eye'
          this.isVisible2=false
        }
      }
      else{
        if(this.isVisible3 == false){
          this.password3 ='text'
          this.icon3='fa-solid fa-eye-slash'
          this.isVisible3=true
        }
        else{
          this.password3='password'
          this.icon3='fa fa-eye'
          this.isVisible3=false
        }
      }
    }
  },
  computed:{
    formCheck(){
      if (this.form.password != null && this.form.old_password !=null &&  this.konfirmasi_password !=null){
        console.log(this.form.password)
        return false
      }
      return true;
    }
  }
}

</script>

<style scoped>
.hide{
  display: none;
}
.show{
  display: block;
}
.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}

.form-control {
  border: none;
  border-radius: 0;
  border-bottom: 2px solid #AEAEAE;
  padding-left: 0;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
}
.icon_eye {
  bottom: 0.8rem;
  right: 0;
  cursor: pointer;
}

.modal {
  position: fixed; /* Stay in place */
  padding-top: 100px; /* Location of the box */
  left: 0;
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
  .modal-content{
    margin-left: 4rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>

