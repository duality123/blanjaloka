<template>
  <DashboardLayout title="Tambah Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-5">Profil UMKM</h1>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
            <div id="myModal" v-if="comment" class="modal" >

    <div  id="myModal" class="modal show" >

      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleComment()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="submitComment()">
        <small>Contoh : ( Foto KTP kurang jelas )</small>
        <input type="text" v-model="form.pesan" class="form-control">
          <div class="mt-2">
          <button type="submit" class="btn btn-primary-blue-6 text-neutral-white">Kirim</button>
        </div>
      </form>
      </div>
</div>
    </div>
          <section class="mb-5">
            <h2 class="text-neutral-gray-5">Profil Diri</h2>
              <p><strong>Nama Lengkap: </strong>{{data['nama_lengkap']}}</p>
              <p><strong>Tempat/tanggal lahir: </strong>{{data['tempat_kelahiran']}}, {{data['tanggal_lahir']}}</p>
              <p><strong>Alamat: </strong>{{data['alamat']}}</p>
              <p><strong>Kelurahan: </strong>{{data['kelurahan']}}</p>
              <p><strong>Kecamatan: </strong>{{data['kecamatan']}}</p>
              <p><strong>Kabupaten: </strong>{{data['kabupaten']}}</p>
              <p><strong>Provinsi: </strong>{{data['provinsi']}}</p>
              <p><strong>Pendidikan terakhir: </strong>{{data['pendidikan_terakhir']}}</p>
              <p><strong>No handphone: </strong>{{data['no_hp']}}</p>
              <p><strong>Status: </strong>{{data['status']}}</p>
              <p><strong>Agama: </strong>{{data['agama']}}</p>
              <p><strong>Kewarganegaraan: </strong>{{data['kewarganegaraan']}}</p>
              <p><strong>Pengalaman kerja: </strong>{{data['pengalaman_kerja']}}</p>
              <p><strong>Foto profil: </strong></p>
              <img v-if="data['foto_profil']" class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data['foto_profil']}`">
              <img else class="mt-2 mb-2" src="../../assets/images/user_profile_img.png">
               <p><strong>Foto KTP: </strong></p>
              <img v-if="data['foto_ktp']" class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data['foto_ktp']}`">
              <img else class="mt-2 mb-2" src="../../assets/images/user_profile_img.png">
               <p><strong>Foto dengan KTP: </strong></p>
              <img v-if="data['foto_dengan_ktp']" class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data['foto_dengan_ktp']}`">
              <img else class="mt-2 mb-2" src="../../assets/images/user_profile_img.png">
          </section>
          <section class="mb-5">
            <h2 class="text-neutral-gray-5 mb-4">Profil Usaha</h2>
              <p><strong>Nama Perusahaan: </strong>{{data['nama_perusahaan']}}</p>
              <p><strong>Alamat Perusahaan: </strong>{{data['alamat_perusahaan']}}</p>
              <p><strong>Alamat: </strong>{{data['alamat_perusahaan']}}</p>
              <p><strong>Status Perusahaan: </strong>{{data['status_perusahaan']}}</p>
              <p><strong>Dokumen Legalitas: </strong></p>
               <div class="mb-4">
                      <div class="d-flex align-items-center px-4 py-2 alert alert-success gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                       <div class="flex-grow-1">
                           <h1 v-if="data['legalitas'] != null" class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${data['legalitas']}`">{{data['legalitas'].split('/')[2]}}</a></h1>
                      </div>
                    </div>
                  </div> 
              <p><strong>Dokumen Amdal: </strong></p>
              <div class="mb-4">
                      <div class="d-flex align-items-center px-4 py-2 alert alert-success gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                       <div class="flex-grow-1">
                           <h1 v-if="data['dokumen_amdal'] != null" class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${data['dokumen_amdal']}`">{{data['dokumen_amdal'].split('/')[2]}}</a></h1>
                      </div>
                    </div>
                  </div>   
              <p><strong>Informasi Pajak: </strong>{{data['informasi_pajak']}}</p>
              <p><strong>NPWP: </strong>{{data['npwp']}}</p>
              <p><strong>Deskripsi usaha: </strong>{{data['deskripsi_usaha']}}</p>
              <p><strong>Email Perusahaan: </strong>{{data['email_perusahaan']}}</p>
          </section>
           <section class="mb-5">
            <h2 class="text-neutral-gray-5">Kajian Finansial</h2>
              <p><strong>Jenis Produk: </strong>{{data['jenis_produk']}}</p>
              <p><strong>Jumlah Produk yang dijual: </strong>{{data['jumlah_produk_yang_dijual']}}, {{data['tanggal_lahir']}}</p>
              <p><strong>Bahan produk: </strong>{{data['bahan_produk']}}</p>
              <p><strong>Kategori produk: </strong>{{data['kategori_produk']}}</p>
              <p><strong>Harga produk: </strong>{{data['harga_produk']}}</p>
              <p><strong>Clearance dokumen: </strong></p>
               <div class="mb-4">
                      <div class="d-flex align-items-center px-4 py-2 alert alert-success gap-2 input_upload_custom">
                      <div>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M7.25 11.95V15.625C7.25 15.8417 7.321 16.021 7.463 16.163C7.60433 16.3043 7.78333 16.375 8 16.375C8.21667 16.375 8.396 16.3043 8.538 16.163C8.67933 16.021 8.75 15.8417 8.75 15.625V11.95L10.075 13.275C10.1417 13.3417 10.225 13.396 10.325 13.438C10.425 13.4793 10.521 13.496 10.613 13.488C10.7043 13.4793 10.7957 13.4583 10.887 13.425C10.979 13.3917 11.0583 13.3333 11.125 13.25C11.275 13.1 11.35 12.925 11.35 12.725C11.35 12.525 11.275 12.35 11.125 12.2L8.625 9.7C8.54167 9.61667 8.446 9.554 8.338 9.512C8.22933 9.47067 8.11667 9.45 8 9.45C7.88333 9.45 7.771 9.47067 7.663 9.512C7.55433 9.554 7.45833 9.61667 7.375 9.7L4.875 12.2C4.725 12.35 4.65 12.525 4.65 12.725C4.65 12.925 4.73333 13.1 4.9 13.25C5.05 13.4 5.221 13.4793 5.413 13.488C5.60433 13.496 5.78333 13.4167 5.95 13.25L7.25 11.95ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V2.3C0.5 1.8 0.675 1.375 1.025 1.025C1.375 0.675 1.8 0.5 2.3 0.5H9.5C9.75 0.5 9.98333 0.545667 10.2 0.637C10.4167 0.729 10.6083 0.858333 10.775 1.025L14.975 5.225C15.1417 5.39167 15.271 5.58333 15.363 5.8C15.4543 6.01667 15.5 6.25 15.5 6.5V17.7C15.5 18.2 15.325 18.625 14.975 18.975C14.625 19.325 14.2 19.5 13.7 19.5H2.3ZM9.5 5.6V2H2.3C2.23333 2 2.16667 2.03333 2.1 2.1C2.03333 2.16667 2 2.23333 2 2.3V17.7C2 17.7667 2.03333 17.8333 2.1 17.9C2.16667 17.9667 2.23333 18 2.3 18H13.7C13.7667 18 13.8333 17.9667 13.9 17.9C13.9667 17.8333 14 17.7667 14 17.7V6.5H10.4C10.15 6.5 9.93733 6.41233 9.762 6.237C9.58733 6.06233 9.5 5.85 9.5 5.6Z"
                            fill="#265C7B" />
                        </svg>
                      </div>
                       <div class="flex-grow-1">
                           <h1 v-if="data['keterangan_halal'] != null" class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${data['keterangan_halal']}`">{{data['keterangan_halal'].split('/')[2]}}</a></h1>
                      </div>
                    </div>
                  </div>   
              <p><strong>Manfaat fungsional: </strong>{{data['manfaat_fungsional']}}</p>
              <p><strong>Manfaat nonfungsional: </strong>{{data['manfaat_nonfungsional']}}</p>
          </section>
             <section class="mb-5">
            <h2 class="text-neutral-gray-5">Kajian Finansial</h2>
              <p><strong>CAPEX: </strong>{{data['capex']}}</p>
              <p><strong>OPEX: </strong>{{data['opex']}}, {{data['opex']}}</p>
              <p><strong>SWOT Faktor Eksternal: </strong>{{data['swot_faktor_eksternal']}}</p>
              <p><strong>SWOT Faktor Internal: </strong>{{data['swot_faktor_internal']}}</p>
              <p><strong>Key Partners: </strong>{{data['key_partners']}}</p>
              <p><strong>Key Activity: </strong>{{data['key_activity']}}</p>
              <p><strong>Value Propotions: </strong>{{data['value_propotions']}}</p>
              <p><strong>Customer Relationship: </strong>{{data['customer_relationship']}}</p>
              <p><strong>Channels: </strong>{{data['channels']}}</p>
              <p><strong>Cost Structure: </strong>{{data['cost_structure']}}</p>
              <p><strong>Revenue Streams: </strong>{{data['revenue_streams']}}</p>
          </section>
          <div class="d-flex justify-content-center bd-highlight mb-3">
              <div class="p-2 bd-highlight">
              <Link :href="`admin/dashboard/detail/profil/${currentPage}/hapus`" type="submit" class="btn btn-danger text-neutral-white">Hapus user ini</Link>
              </div>
              <div class="p-2 bd-highlight">
              <Link :href="`/detail/profil/${currentPage}/accept`" class="btn btn-primary-blue-6 text-neutral-white">Terima user ini</Link>
              </div>
              <div class="p-2 bd-highlight">
             <button @click = "toggleComment()" class="btn btn-warning text-neutral-white">Beri tanggapan</button>
             </div>
            </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
<script>
import DashboardLayout from '../../Layouts/Dashboard.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';
export default{
  data(){
    return{
      currentPage : window.location.pathname.split('/')[3],
      comment:false
    }
  },
  setup(){
    const form = useForm({
      pesan:null
    })
    return { form }
  },
  props:{
    data:Object,
    id:Number
  },
  components:{
    DashboardLayout,
    Link
  },
  mounted(){
    console.log(this.data)
  },
  methods:{
    toggleComment(){
      this.comment = !this.comment
    },
    submitComment(){
      this.form.post('/detail/profil/'+this.currentPage+'/beri_tanggapan')
    }
  }
}
</script>

<style scoped>
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
.close{
  border-width: 0px;
  background-color: white;
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

.input_upload_custom h1,
.input_upload_custom h2 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0;
}
.input_upload_custom .position-relative {
  overflow: hidden;
  cursor: pointer;
}
.input_upload_custom p {
  font-size: 0.75rem;
  font-weight: 400;
  margin-bottom: 0;
}
.input_upload_custom input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.card{
  width: 800px;
  padding: 20px;
}
img{
  max-width: 300px;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
form section h2 {
  font-size: 1.25rem;
}
.form-control {
  background-color: transparent;
  resize: none;
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
</style>
