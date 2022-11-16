<template>
   <BaseLayout title="UMKM Profile">
    <section class="mt-10">
      <div class="container">
        <div class="row gap-4">

    <div id="myModal" class="modal" v-if="$page.props.auth.finansialComplete && !$page.props.auth.user.accepted" >

      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "removePopup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
       <img src="../../../assets/images/success.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-between text-center" style="margin-left: 2rem;">
       <h2 >Data anda sedang diproses</h2>
        </div>
       <p>Rutinlah mengecek email anda tiap hari untuk pemberitahuan status akun anda!.</p>
      </div>

    </div>
          <UmkmDashboardSidebar />

           <div class="col-lg-8">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h1>Profil Saya</h1>
                  <p class="text-neutral-gray-3 mb-0">Langkah <span class="text-neutral-gray-4">1</span>
                    dari 1</p>
                </div>
                <h2 class="mt-4">Finansial Saya</h2>
                <p class="text-neutral-gray-5">Harap masukkan sesuai dengan data diri dan kondisi Anda saat ini!</p>
                <form @submit.prevent="submit()">
                  <div class="mb-4">
                    <label for="nama_lengkap" class="form-label text-neutral-gray-5">CAPEX</label>
                    <input type="text" v-model="form.capex" class="form-control" id="nama_lengkap" placeholder="Masukkan capex Anda" >
                      <small class="text-danger" v-if="form.errors.capex">{{ form.errors.capex}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="tempat_kelahiran" class="form-label text-neutral-gray-5">OPEX</label>
                    <input type="text" class="form-control" v-model="form.opex" id="tempat_kelahiran" placeholder="Masukkan tempat lahir Anda">
                  </div>
                  <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label text-neutral-gray-5">SWOT( Faktor Eksternal )</label>
                      <input type="text" class="form-control" v-model="form.swot_faktor_eksternal" id="tanggal_lahir" placeholder="Masukkan tanggal lahir Anda" >
                        <small class="text-danger" v-if="form.errors.swot_faktor_eksternal">{{ form.errors.swot_faktor_eksternal}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="alamat" class="form-label text-neutral-gray-5">SWOT ( Faktor Internal )</label>
                    <input type="text" class="form-control" id="alamat" v-model="form.swot_faktor_internal" placeholder="Masukkan alamat tinggal Anda" >
                    <small class="text-danger" v-if="form.errors.swot_faktor_internal">{{ form.errors.swot_faktor_internal}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="pendidikan_terakhir" class="form-label text-neutral-gray-5">Payback Period</label>
                      <input type="number" class="form-control" v-model="form.payback_period" id="pendidikan_terakhir" placeholder="pendidikan terakhir Anda" >
                      <small class="text-danger" v-if="form.errors.payback_period">{{ form.errors.payback_period}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kelurahan" class="form-label text-neutral-gray-5">Key Partners</label>
                       <input type="text" class="form-control" v-model="form.key_partners" id="kelurahan" placeholder="Masukkan tempat lahir Anda" >
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Key Activity</label>
                      <input type="text" class="form-control" v-model="form.key_activity" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                    <small class="text-danger" v-if="form.errors.key_activity">{{ form.errors.key_activity}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kecamatan" class="form-label text-neutral-gray-5">Value Propotions</label>
                       <input type="text" class="form-control" v-model="form.value_propotions" id="kecamatan" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.value_propotions">{{ form.errors.value_propotions}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="kabupaten" class="form-label text-neutral-gray-5">Customer Relationship</label>
                       <input type="text" class="form-control" v-model="form.customer_relationship" id="kabupaten" placeholder="Masukkan tempat lahir Anda" >
                      <small class="text-danger" v-if="form.errors.customer_relationship">{{ form.errors.customer_relationship}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Cost Structure</label>
                      <input type="text" class="form-control" v-model="form.cost_structure" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                    <small class="text-danger" v-if="form.errors.cost_structure">{{ form.errors.cost_structure}}</small>
                  </div>
                   <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Channels</label>
                      <input type="text" class="form-control" v-model="form.channels" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.channels">{{ form.errors.channels}}</small>
                  </div>
                  <div class="mb-4">
                    <label for="provinsi" class="form-label text-neutral-gray-5">Revenue Streams</label>
                      <input type="text" class="form-control" v-model="form.revenue_streams" id="provinsi" placeholder="Masukkan tempat lahir Anda" >
                       <small class="text-danger" v-if="form.errors.revenue_streams">{{ form.errors.revenue_streams}}</small>
                  </div>
                
                <div class="d-flex justify-content-end">
                  <button type="submit" :disabled="formCheck" class="btn btn-primary-blue-6 text-neutral-white py-2 px-4">Selanjutnya</button>
                </div>
                 </form>
              </div>
            </div>
            </div>
          </div>
        </section>
        </BaseLayout>
</template>
<script>
import BaseLayout from '../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../Components/UmkmDashboardSidebar.vue'
import { ref } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";
export default{
  data(){
    return{
      currentStep : window.location.pathname.split('/')[2],
      currentPage : window.location.pathname.split('/')[1],
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
    }
  },
  components:{
    BaseLayout,
    UmkmDashboardSidebar
  },
  methods:{
    submit(){
      if (this.form.capex == null || this.form.opex == null   || this.form.swot_faktor_eksternal == null   || this.form.key_partners == null  || this.form.value_propotions == null  ||  this.form.customer_relationship == null  ||  this.form.channels == null  ||  this.form.cost_structure == null  || this.form.swot_faktor_internal == null  || this.form.payback_period == null && this.form.revenue_streams == null) {
        return 
      }
      this.form.post('/umkm/dashboard/kajian_finansial/proses/pertama')
    },
  removePopup(){
    document.getElementById('myModal').style.display='none';
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
