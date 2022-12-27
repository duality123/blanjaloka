<template>
   <BaseLayout title="UMKM Profile">
    <section class="mt-10">
      <div class="container">
        <div class="row gap-4">

           <StatusChecked :sessionCondition="checkSessionCondition"/> 
        <!--
           <div id="myModal" class="modal" v-if="this.$page.props.auth.finansialComplete && !this.$page.props.auth.user.accepted && this.popup" >

      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "removePopup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
       <img src="../../../../assets/images/success.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-between text-center" style="margin-left: 2rem;">
       <h2 >Data baru anda sedang diproses</h2>
        </div>
       <p>Rutinlah mengecek email anda tiap hari untuk pemberitahuan status akun anda!.Namun anda sekarang juga masih bisa mengubah data anda :)</p>
      </div>

    </div>   
    -->      
           <UmkmDashboardSidebar section="kajian_finansial" />

           <div class="col-lg-8">
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
                    Anda wajib mengisi profil anda sesuai data anda saat ini !. Perusahaan anda harus legal di Indonesia.
                  </p>
                </div>
              </div>
                <h2 class="mt-4">Finansial Saya</h2>
                <p class="text-neutral-gray-5">Harap masukkan sesuai dengan data diri dan kondisi Anda saat ini!</p>
                <form @submit.prevent="submit()">
                  <div class="mb-4">
                    <label for="nama_lengkap" class="form-label text-neutral-gray-5">CAPEX</label>
                    <input type="text" v-model="form.capex" class="form-control" id="nama_lengkap" placeholder="CAPEX" >
                      <small class="text-danger" v-if="form.errors.capex">{{ form.errors.capex}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="tempat_kelahiran" class="form-label text-neutral-gray-5">OPEX</label>
                    <input type="text" class="form-control" v-model="form.opex" id="tempat_kelahiran" placeholder="OPEX">
                  </div>
                  <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label text-neutral-gray-5">SWOT( Faktor Eksternal )</label>
                      <input type="text" class="form-control" v-model="form.swot_faktor_eksternal" id="tanggal_lahir" placeholder="SWOT( Faktor Eksternal )" >
                        <small class="text-danger" v-if="form.errors.swot_faktor_eksternal">{{ form.errors.swot_faktor_eksternal}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="alamat" class="form-label text-neutral-gray-5">SWOT ( Faktor Internal )</label>
                    <input type="text" class="form-control" id="alamat" v-model="form.swot_faktor_internal" placeholder="Masukkan SWOT ( Faktor Internal )" >
                    <small class="text-danger" v-if="form.errors.swot_faktor_internal">{{ form.errors.swot_faktor_internal}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="pendidikan_terakhir" class="form-label text-neutral-gray-5">Payback Period</label>
                      <input type="number" class="form-control" v-model="form.payback_period" id="pendidikan_terakhir" placeholder="Payback Period" >
                      <small class="text-danger" v-if="form.errors.payback_period">{{ form.errors.payback_period}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kelurahan" class="form-label text-neutral-gray-5">Key Partners</label>
                       <input type="text" class="form-control" v-model="form.key_partners" id="kelurahan" placeholder="Key Partners" >
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Key Activity</label>
                      <input type="text" class="form-control" v-model="form.key_activity" id="provinsi" placeholder="Key Activity" >
                    <small class="text-danger" v-if="form.errors.key_activity">{{ form.errors.key_activity}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kecamatan" class="form-label text-neutral-gray-5">Value Propotions</label>
                       <input type="text" class="form-control" v-model="form.value_propotions" id="kecamatan" placeholder="Value Propotions" >
                       <small class="text-danger" v-if="form.errors.value_propotions">{{ form.errors.value_propotions}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Customer Relationship</label>
                       <input type="text" class="form-control" v-model="form.customer_relationship" id="kabupaten" placeholder="Customer Relationship" >
                      <small class="text-danger" v-if="form.errors.customer_relationship">{{ form.errors.customer_relationship}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Cost Structure</label>
                      <input type="text" class="form-control" v-model="form.cost_structure" id="provinsi" placeholder="Cost Structure" >
                    <small class="text-danger" v-if="form.errors.cost_structure">{{ form.errors.cost_structure}}</small>
                  </div>
                   <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Channels</label>
                      <input type="text" class="form-control" v-model="form.channels" id="provinsi" placeholder="Channels" >
                       <small class="text-danger" v-if="form.errors.channels">{{ form.errors.channels}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Revenue Streams</label>
                      <input type="text" class="form-control" v-model="form.revenue_streams" id="provinsi" placeholder="Revenue Streams" >
                       <small class="text-danger" v-if="form.errors.revenue_streams">{{ form.errors.revenue_streams}}</small>
                  </div>
                
                <div class="d-flex justify-content-end">
                  <button type="submit" :disabled="formCheck" class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">Selanjutnya</button>
                </div>
                 </form>
              </div>
            </div>
            </div>
        </section>
        </BaseLayout>
</template>
<script>
import BaseLayout from '../../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../../Components/UmkmDashboardSidebar.vue'
import StatusChecked from '../../../../Components/StatusChecked.vue'
import { ref } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";
export default{
  data(){
    return{
      currentStep : window.location.pathname.split('/')[2],
      currentPage : window.location.pathname.split('/')[1],
      popup:true
    }
  },
  setup () {
    const form = useForm({
      capex: null,
      opex: null,
      swot_faktor_eksternal: null,
      payback_period: null,
      swot_faktor_internal: null,
      key_partners: null,
      key_activity:null,
      value_propotions: null,
      customer_relationship: null,
      channels:null,
      cost_structure:null,
      revenue_streams:null
    })
    return { form }
  },
   props:{
    popup:{
      type:Boolean,
      default:false
    },
  },
  mounted(){
    //console.log( this.$page.props.auth.profil['tanggal_lahir'])
      this.form.capex= this.$page.props.auth.finansial['capex']
      this.form.opex=this.$page.props.auth.finansial['opex']
      this.form.swot_faktor_eksternal=this.$page.props.auth.finansial['swot_faktor_eksternal']
      this.form.payback_period= this.$page.props.auth.finansial['payback_period']
      this.form.swot_faktor_internal=  this.$page.props.auth.finansial['swot_faktor_internal']
      this.form.key_partners= this.$page.props.auth.finansial['key_partners']
      this.form.value_propotions = this.$page.props.auth.finansial['value_propotions']
      this.form.customer_relationship= this.$page.props.auth.finansial['customer_relationship']
      this.form.channels= this.$page.props.auth.finansial['channels']
      this.form.cost_structure= this.$page.props.auth.finansial['cost_structure']
      this.form.revenue_streams= this.$page.props.auth.finansial['revenue_streams']
      this.form.key_activity= this.$page.props.auth.finansial['key_activity']
  },
  computed:{
    formCheck(){
       if (this.form.capex == null || this.form.opex == null   || this.form.swot_faktor_eksternal == null   || this.form.key_partners == null  || 
        this.form.value_propotions == null  ||  this.form.customer_relationship == null  ||  this.form.channels == null  ||  this.form.cost_structure == null  || this.form.swot_faktor_internal == null  || this.form.payback_period == null || this.form.revenue_streams == null || this.form.key_activity == null) {
        return true
      }
      return false;
    },
    checkSessionCondition(){
     if(this.$page.props.auth.finansialComplete && !this.$page.props.auth.user.accepted){
      return true

     }
     return false
    }
  },
  components:{
    BaseLayout,
    UmkmDashboardSidebar,
    StatusChecked
  },
  methods:{
    submit(){
      if (this.form.capex == null || this.form.opex == null   || this.form.swot_faktor_eksternal == null   || this.form.key_partners == null  || this.form.value_propotions == null  ||  this.form.customer_relationship == null  ||  this.form.channels == null  ||  this.form.cost_structure == null  || this.form.swot_faktor_internal == null  || this.form.payback_period == null && this.form.revenue_streams == null) {
        return 
      }
      this.form.post('/umkm/dashboard/kajian_finansial/')
    },
     removePopup(){
      this.popup =false
    }


  },

}
</script>

<style scoped>
.hide{
  display: none;
}
.show{
  display: block;
}
section{
  margin-top: 10rem;
}
.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
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

.hide{
  display: none;
}
.show{
  display: block;
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
  background-size: 19px 20px;
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
