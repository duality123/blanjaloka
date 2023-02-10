<template>
 <div id="myModal" class="modal" v-if="popupStalk" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "$emit('toggleTutup')" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <ul class="tabs mt-2">
      <li class="active" >
          <h3>Data UMKM</h3>
      </li>
    </ul>
    <div v-if="this.data ==null" class="d-flex justify-content-center mt-4">
    <div class="spinner-border text-primary"></div>
  </div>
    <div class="mt-4" v-else>
       <div class="card-body">
    <section class="mb-5" >
     <div class="d-flex flex-column">
         <div class="p-2"><h2 class="text-neutral-gray-5">Profil Diri</h2></div>
          <div class="p-2"><strong>Nama Lengkap: </strong>{{data.profil.nama_lengkap}}</div>
          <div class="p-2"><strong>Tempat/tanggal lahir: </strong>{{data.profil.tempat_kelahiran}}, {{data.profil.tanggal_lahir}}</div>
          <div class="p-2"><strong>Alamat: </strong>{{data.profil.alamat}}</div>
             <div class="p-2"><strong>Kelurahan: </strong>{{data.profil.kelurahan}}</div>
             <div class="p-2"><strong>Kecamatan: </strong>{{data.profil.kecamatan}}</div>
             <div class="p-2"><strong>Kabupaten: </strong>{{data.profil.kabupaten}}</div>
             <div class="p-2"><strong>Provinsi: </strong>{{data.profil.provinsi}}</div>
              <div class="p-2"><strong>Pendidikan terakhir: </strong>{{data.profil.pendidikan_terakhir}}</div>
              <div class="p-2"><strong>No handphone: </strong>{{data.profil.no_hp}}</div>
              <div class="p-2"><strong>Status: </strong>{{data.profil.status}}</div>
              <div class="p-2"><strong>Agama: </strong>{{data.profil.agama}}</div>
              <div class="p-2"><strong>Kewarganegaraan: </strong>{{data.profil.kewarganegaraan}}</div>
              <div class="p-2"><strong>Pengalaman kerja: </strong>{{data.profil.pengalaman_kerja}}</div>
              <div class="p-2"><strong>Foto profil: </strong></div>
              <div class="p-2" v-if="data.profil.foto_profil"><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_profil}`"></div>
              <div class="p-2" v-else><img  class="mt-2 mb-2" src="../assets/images/user_profile_img.png"></div>
              <div class="p-2"><strong>Foto KTP: </strong></div>
               <div class="p-2" v-if="data.profil.foto_ktp"><img  class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_ktp}`"></div>
              <div class="p-2" v-else><img class="mt-2 mb-2" src="../assets/images/user_profile_img.png"></div>
               <div class="p-2"><strong>Foto dengan KTP: </strong></div>
              <div class="p-2" v-if="data.profil.foto_dengan_ktp" ><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_dengan_ktp}`"></div>
              <div class="p-2" v-else><img  class="mt-2 mb-2" src="../assets/images/user_profile_img.png"></div>
            </div>
          </section>
          <section class="mb-5">
              <div class="d-flex flex-column">
         <div class="p-2"><h2 class="text-neutral-gray-5 mb-4">Profil Usaha</h2></div>
         <div class="p-2"><strong>Nama Perusahaan: </strong>{{data.usaha.nama_perusahaan}}</div>
        <div class="p-2"><strong>Alamat Perusahaan: </strong>{{data.usaha.alamat_perusahaan}}</div>
        <div class="p-2"><strong>Status Perusahaan: </strong>{{data.usaha.status_perusahaan}}</div>
        <div class="p-2"><strong>Dokumen Legalitas: </strong></div>
        <div class="p-2">
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
                           <h1  class="text-neutral-gray-5">
                            <a :href="`${$page.props.asset_url}/${data.usaha.legalitas}`">Lihat File</a>
                          </h1>
                      </div>
                    </div>
                  </div> 
              </div>
             <div class="p-2"><strong>Dokumen Amdal: </strong></div>
             <div class="p-2">
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
                           <h1 class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${data.usaha.dokumen_amdal}`">Lihat File</a></h1>
                      </div>
                    </div>
                  </div>   
                </div>
              <div class="p-2"><strong>Informasi Pajak: </strong>{{data.usaha.informasi_pajak}}</div>
              <div class="p-2"><strong>NPWP: </strong>{{data.usaha.npwp}}</div>
              <div class="p-2"><strong>Deskripsi usaha: </strong>{{data.usaha.deskripsi_usaha}}</div>
              <div class="p-2"><strong>Email Perusahaan: </strong>{{data.usaha.email_perusahaan}}</div>
            </div>
          </section>
           <section class="mb-5">

        <div class="d-flex flex-column">
            <div class="p-2"><h2 class="text-neutral-gray-5">Profil Produk</h2></div>
              <div class="p-2"><strong>Jenis Produk: </strong>{{data.produk.jenis_produk}}</div>
              <div class="p-2"><strong>Jumlah Produk yang dijual: </strong>{{data.produk.jumlah_produk_yang_dijual}}, {{data.produk.tanggal_lahir}}</div>
             <div class="p-2"><strong>Bahan produk: </strong>{{data.produk.bahan_produk}}</div>
             <div class="p-2"><strong>Kategori produk: </strong>{{data.produk.kategori_produk}}</div>
               <div class="p-2"><strong>Harga produk: </strong>{{data.produk.harga_produk}}</div>
               <div class="p-2"><strong>Clearance dokumen: </strong></div>
                <div class="p-2">
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
                           <h1  class="text-neutral-gray-5"><a :href="`${this.$page.props.asset_url}/${data.produk.keterangan_halal}`">Lihat File</a></h1>
                      </div>
                    </div>
                  </div>
                  </div>   
              <div class="p-2"><strong>Manfaat fungsional: </strong>{{data.produk.manfaat_fungsional}}</div>
               <div class="p-2"><strong>Manfaat nonfungsional: </strong>{{data.produk.manfaat_nonfungsional}}</div>
            </div>
          </section>
             <section class="mb-5">
              <div class="d-flex flex-column">
         <div class="p-2"><h2 class="text-neutral-gray-5">Kajian Finansial</h2></div>
          <div class="p-2"><strong>CAPEX: </strong>{{data.finansial.capex}}</div>
          <div class="p-2"><strong>OPEX: </strong>{{data.finansial.opex}}</div>
          <div class="p-2"><strong>SWOT Faktor Eksternal: </strong>{{data.finansial.swot_faktor_eksternal}}</div>
          <div class="p-2"><strong>SWOT Faktor Internal: </strong>{{data.finansial.swot_faktor_internal}}</div>
          <div class="p-2"><strong>Key Partners: </strong>{{data.finansial.key_partners}}</div>
          <div class="p-2"><strong>Key Activity: </strong>{{data.finansial.key_activity}}</div>
          <div class="p-2"><strong>Value Propotions: </strong>{{data.finansial.value_propotions}}</div>
          <div class="p-2"><strong>Customer Relationship: </strong>{{data.finansial.customer_relationship}}</div>
        <div class="p-2"><strong>Channels: </strong>{{data.finansial.channels}}</div>
        <div class="p-2"><strong>Cost Structure: </strong>{{data.finansial.cost_structure}}</div>
        <div class="p-2"><strong>Revenue Streams: </strong>{{data.finansial.revenue_streams}}</div>
        </div>
    </section>
</div>
</div>
</div>
</div>
 </template>
<script>
import { useForm, Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';
export default{
  data(){
    return{
      currentPage : window.location.pathname.split('/')[4],
      comment:false
    }
  },
  props:{
    data:Object,
    popupStalk:Boolean
  },
  components:{
    Link
  },
  methods:{
    submitComment(){
      this.form.post('/detail/profil/'+this.currentPage+'/beri_tanggapan')
    }
  },
  emits:['toggleTutup']
}
</script>

<style scoped>
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
img{
  width: 200px;
  height: 200px;
}
.close{
  border-width: 0px;
  background-color: white;
}
.modal-content{
  text-align: start;
}
.modal {
  position: fixed; /* Stay in place */
  left: 0;
  display: block;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.1); /* Black w/ opacity */
  padding: 2px;
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: 3rem;
  margin-left:4rem;
  padding: 20px;
  border-radius: 25px;
  width: 90%;
  height: 85%;
  overflow-y: scroll;
  text-align: center;
}
.tabs {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}
table{
  width: 100%;
}

.tabletambah{
   width: 100%;
}

.tabs li {
  cursor: pointer;
}

.tabs li {
  padding-bottom: 0.5rem;
}

.tabs li.active {
  border-bottom: 2px solid #398AB9;
}

.tabs li a {
  text-decoration: none;
  font-weight: 600;
}



table thead tr td,
table thead tr th {
  font-weight: 600;
  color: #3E4041;
  border: none;
  text-align: center;
}

table tbody tr td,
table tbody tr th {
  font-weight: 400;
  color: #3E4041;
  border-bottom: none;
  text-align: center;
}

table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
  background-color: #F2F7FA;
}

.pagination {
  display: flex;
  flex-direction: row;
  column-gap: 2rem;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  list-style: none;
  background-color: #FFFFFF;
}


.modal-content{
  text-align: start;
}


.form-control {
  overflow:
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
}

.pagination li {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5px 12px;
  border-radius: 2px;
  cursor: pointer;
  transition: 300ms;
}

.pagination li:hover {
  background-color: #398AB9;
}

.pagination li:hover a,
.pagination li:hover a svg {
  color: #FFFFFF !important;
}

.pagination li a {
  text-decoration: none;
  color: #3E4041;
  font-weight: 600;
}

.pagination li.active {
  background-color: #398AB9;
}

.pagination li.active a {
  color: #FFFFFF;
}

@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }

  .pagination li:nth-child(3),
  .pagination li:nth-child(4) {
    display: none;
  }
}
</style>
