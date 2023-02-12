<template>    
  
  
          <div id="myModal"  class="modal" v-if="popupEdit" >

      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "togglePopupEdit()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="col-lg-12">
      <div class=" d-flex justify-content-center">
      <h2>Kirim Laporan</h2>
    </div>
    <div class="mt-2">
      <form @submit.prevent="submitEdit()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Berikan laporan anda ?</label>
         <input type="text" class="form-control" v-model="form.deskripsi" id="provinsi" placeholder="Masukkan laporan anda" >
           <small class="text-danger" v-if="form.errors.deskripsi">{{ form.errors.deskripsi }}</small>
      </div>
       <div class="mb-4">
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Gambar</label>
          <div class="card text-white bg-neutral-gray-1 mb-3 " >
            <div class="d-flex justify-content-center pt-3 mb-4" v-if="this.previewImage">
                   <img :src="`${$page.props.asset_url}/${this.previewImage}`" alt="update icon" style="overflow: hidden; width: 250px;" id="img" >
                </div>
                <div v-else class="d-flex justify-content-center pt-3 mb-4" >
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="img" >
                </div>
    
                <div class="row" style="margin-left:2px;" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" ref ="foto_profil" class="custom-file-input " @change="ubahGambar($event)"  style="width: 9rem;">
                </div >
                <div class="col d-flex justify-content-center">
                <p class="text-primary" style="padding-right: 6px;">atau</p>
                </div>
                  <div class="col d-flex justify-content-end" >
                <input type="file" class="custom-file-input2" style="width: 9rem;">
                </div>
                </div>
                 <small class="text-danger text-center" v-if="formEdit.errors.gambar">{{formEdit.errors.gambar}}</small>
                <div class="text-neutral-gray-3 text-center"><p class="fs-9">Format file .jpg/.jpeg/.png, ukuran file maksimal 5 MB</p></div>
            </div>
          </div>
      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
</div>
    </div>

  <!---new logbokk -->
    <div id="myModal"  class="modal"  v-if="this.popupNewLogbook">

    <div  id="myModal" class="modal" >

      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "togglePopupNewLogbook()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="col-lg-12">
      <div class=" d-flex justify-content-center">
      <h2>Kirim Laporan</h2>
    </div>
    <div class="mt-2">
      <form @submit.prevent="submitNewLogbook()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Berikan laporan anda ?</label>
         <input type="text" class="form-control" v-model="form.deskripsi" id="provinsi" placeholder="Masukkan laporan anda" >
           <small class="text-danger" v-if="form.errors.deskripsi">{{ form.errors.deskripsi }}</small>
      </div>
       <div class="mb-4">
              <label for="kontak_nomor_pic" class="form-label text-neutral-gray-5">Gambar</label>
          <div class="card text-white bg-neutral-gray-1 mb-3 " >
                <div  class="d-flex justify-content-center pt-3 mb-4" >
                   <img src="../../../assets/icons/photo.png" alt="update icon" style="width:10%" id="img" >
                </div>
    
                <div class="row" style="margin-left:2px;" >
                <div class="col d-flex justify-content-start"  >
                <input type="file" ref ="foto_profil" class="custom-file-input " @change="ubahGambar($event)"  style="width: 9rem;">
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
      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
</div>
    </div>
  </div>
        <Layout :title="kegiatan.tema" state="logbook" :link = "kegiatan.id">   
                <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                        Anda disarankan menulis logbook setiap harinya untuk laporan kegiatan. <span class="text-neutral-black"> Tulis laporan harian dengan  detail dan lengkap karena itu bisa menjadi faktor penentu Investor memilih anda</span> Jika laporan anda ditolak tolong hendak ubah ulang laporan anda</p>
                </div>
                <div class="mt-5 mb-4 d-flex align-items-center borderc gap-3">
                    <h2 class="text-neutral-gray-5 m-0 me-auto">Daftar Laporan Harian</h2>
                   <button @click="togglePopupNewLogbook()" class="fs-btn p-2 px-3 btn text-primary-blue-6 border-primary-blue-6">
                        Unggah Logbook
                    </button> 
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="table-primary-blue-4">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th class="desc_logbook" scope="col">Deskripsi Kegiatan</th>
                        <th scope="col">Bukti Kegiatan</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(event,number) in logbook">
                        <td>{{++number}}</td>
                         <td>{{event.waktu}}</td>
                        <td>{{event.deskripsi}}</td>
                        <td v-if="event.bukti_kegiatan != '-'">
                            <img :src="`${$page.props.asset_url}/${event.bukti_kegiatan}`" alt="" style="width:10rem">
                        </td>
                        <td v-else>
                            -
                        </td>
                        <td>
                          <button  @click="togglePopupEdit(id=event.id,gambar=event.bukti_kegiatan,deskripsi=event.deskripsi)" class="btn btn-semantic-error-4 px-3 me-2 text-neutral-white cursor-pointer" v-if="event.status ==2">
                            Ditolak ( revisi ulang )
                          </button>
                          <button href="#" class="btn btn-semantic-warning-4 me-2 px-3 text-neutral-white cursor-pointer" v-else-if="event.status ==0">
                            Menunggu
                          </button>
                          
                          <button href="#" class="btn btn-semantic-success-4 px-3 me-2 text-neutral-white cursor-pointer" v-else-if="event.status ==1">
                            Disetujui
                          </button>
                           <button v-else @click="togglePopupNewLogbook()" class="fs-btn p-2 px-3 btn text-white bg-primary-blue-6 border-primary-blue-6">
                        + Buat laporan
                        </button>
                          <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 14.75C9.71667 14.75 9.896 14.6793 10.038 14.538C10.1793 14.396 10.25 14.2167 10.25 14V9.725C10.25 9.525 10.1793 9.354 10.038 9.212C9.896 9.07067 9.71667 9 9.5 9C9.28333 9 9.10433 9.07067 8.963 9.212C8.821 9.354 8.75 9.53333 8.75 9.75V14.025C8.75 14.225 8.821 14.396 8.963 14.538C9.10433 14.6793 9.28333 14.75 9.5 14.75ZM9.5 7.3C9.73333 7.3 9.925 7.22067 10.075 7.062C10.225 6.904 10.3 6.70833 10.3 6.475C10.3 6.25833 10.225 6.07067 10.075 5.912C9.925 5.754 9.73333 5.675 9.5 5.675C9.26667 5.675 9.075 5.754 8.925 5.912C8.775 6.07067 8.7 6.25833 8.7 6.475C8.7 6.70833 8.775 6.904 8.925 7.062C9.075 7.22067 9.26667 7.3 9.5 7.3ZM9.5 19.5C8.18333 19.5 6.946 19.25 5.788 18.75C4.62933 18.25 3.625 17.575 2.775 16.725C1.925 15.875 1.25 14.8707 0.75 13.712C0.25 12.554 0 11.3167 0 10C0 8.68333 0.25 7.44567 0.75 6.287C1.25 5.129 1.925 4.125 2.775 3.275C3.625 2.425 4.62933 1.75 5.788 1.25C6.946 0.75 8.18333 0.5 9.5 0.5C10.8167 0.5 12.0543 0.75 13.213 1.25C14.371 1.75 15.375 2.425 16.225 3.275C17.075 4.125 17.75 5.129 18.25 6.287C18.75 7.44567 19 8.68333 19 10C19 11.3167 18.75 12.554 18.25 13.712C17.75 14.8707 17.075 15.875 16.225 16.725C15.375 17.575 14.371 18.25 13.213 18.75C12.0543 19.25 10.8167 19.5 9.5 19.5ZM9.5 18C11.7167 18 13.6043 17.221 15.163 15.663C16.721 14.1043 17.5 12.2167 17.5 10C17.5 7.78333 16.721 5.89567 15.163 4.337C13.6043 2.779 11.7167 2 9.5 2C7.28333 2 5.396 2.779 3.838 4.337C2.27933 5.89567 1.5 7.78333 1.5 10C1.5 12.2167 2.27933 14.1043 3.838 15.663C5.396 17.221 7.28333 18 9.5 18Z" fill="#686868"/>
                          </svg>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
  </Layout>
</template>

<script>
import Layout from '../../../Layouts/Kegiatanku.vue'
import { useForm, Link } from '@inertiajs/inertia-vue3'
export default{
  data(){
    return{
      popupEdit:false,
      popupNewLogbook:false,
      previewImage:null,
      url:document.location.href
    }
  },
  setup(props){
    const form = useForm({
     id:null,
     gambar:null,
     deskripsi:'',
     kegiatan_id : props.kegiatan.id
    })

    const formEdit = useForm({
     id:null,
     gambar:null,
     deskripsi:'',
     kegiatan_id : props.kegiatan.id
    })

    return {formEdit,form}
  },
  components:{
    Layout,
    Link
  },
  methods:{
    submitEdit(){
      this.form.post('/umkm/dashboard/kegiatanku/edit_logbook',{onSuccess: () => this.form.reset()},{preserveState:true})

    },
    submitNewLogbook(){
      this.form.post('/umkm/dashboard/kegiatanku/buat_logbook',{onSuccess: () => this.form.reset()},{preserveState:true})

    },
    togglePopupEdit(id = null,gambar=null,deskripsi=null){
        this.previewImage= gambar,
        this.form.id=id,
        this.form.deskripsi = deskripsi,
        this.popupEdit = !this.popupEdit
    },
    togglePopupNewLogbook(){
      this.form.reset()
      this.popupNewLogbook = !this.popupNewLogbook
    },

    ubahGambar(event){
      if(event.target.files[0].type == 'image/jpeg' || event.target.files[0].type == 'image/png'){
        
            if(event.target.files[0].size >= 5000000){
              this.form.errors.gambar = "Size foto anda lebih dari 5MB !" 
              return
            }
        var image = document.getElementById('img');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.width = '10rem';
        image.style.overflow = 'hidden';
        this.form.gambar = event.target.files[0];
      }
      else{
        this.form.errors.gambar = "File yang anda upload bukanlah gambar !" 
         //console.log(event.target.files[0].type)
         return
      }
    }
  },
  props:{
   logbook:Object,
  kegiatan:Object
  }


}

</script>


<style scoped>
.desc_logbook{
  width:200px;
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
 .modal-content{
  height: 450px;
  overflow-y: scroll;
  text-align:start;
 }
 @media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
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
