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
          <h3>Data Investor</h3>
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
              <div class="p-2" ><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_profil}`"></div>
              <div class="p-2"><strong>Foto KTP: </strong></div>
               <div class="p-2" ><img  class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_ktp}`"></div>
               <div class="p-2"><strong>Foto dengan KTP: </strong></div>
              <div class="p-2"><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_dengan_ktp}`"></div>
            </div>
          </section>
          <section class="mb-5">
             <div class="d-flex flex-column">
         <div class="p-2"><h2 class="text-neutral-gray-5">Profil Perusahaan</h2></div>
          <div class="p-2"><strong>Nama Lengkap: </strong>{{data.profil_perusahaan.nama_perusahaan}}</div>
          <div class="p-2"><strong>Alamat Perusahaan: </strong>{{data.profil_perusahaan.alamat_perusahaan}}</div>
          <div class="p-2"><strong>Nama PIC: </strong>{{data.profil_perusahaan.nama_pic}}</div>
             <div class="p-2"><strong>Tanggal Berdiri: </strong>{{data.profil_perusahaan.tanggal_berdiri}}</div>
             <div class="p-2"><strong>Nomor Telepon: </strong>{{data.profil_perusahaan.nomor_telepon}}</div>
             <div class="p-2"><strong>Email PIC: </strong>{{data.profil_perusahaan.email_pic}}</div>
             <div class="p-2"><strong>Kategori Perusahaan: </strong>{{data.profil_perusahaan.kategori_perusahaan}}</div>
             <div class="p-2"><strong>Deskripsi Perusahaan: </strong>{{data.profil_perusahaan.deskripsi_perusahaan}}</div>
           </div>
                </section>
           <section class="mb-5">
             <div class="d-flex flex-column">
         <div class="p-2"><h2 class="text-neutral-gray-5">Dokumen Perusahaan</h2></div>
          <div class="p-2"><strong>Nomor Akta Pendirian Perusahaan: </strong>{{data.dokumen_perusahaan.nomor_akta_pendirian_perusahaan}}</div>
          <div class="p-2"><strong>Foto NPWP Perusahaan</strong></div>
          <div class="p-2"><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.dokumen_perusahaan.foto_npwp_perusahaan}`"></div>
    
          <div class="p-2"><strong>No NPWP Perusahaan</strong>{{data.dokumen_perusahaan.no_npwp_perusahaan}}</div>
          <div class="p-2"><strong>Foto KTP PIC: </strong></div>
          <div class="p-2" >
          <img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.dokumen_perusahaan.foto_ktp_pic}`">
          </div>
          <div class="p-2"><strong>No Rekening: </strong>{{data.dokumen_perusahaan.no_rekening}}</div>
          <div class="p-2">
            <img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.dokumen_perusahaan.foto_buku_tabungan}`">
            
          </div>
          
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
 
  methods:{
    submitComment(){
      this.form.post('/detail/profil/'+this.currentPage+'/beri_tanggapan')
    }
  },
  emits:['toggleTutup']
}
</script>

<style scoped>
h1 {
  font-size: 2.1rem;
  font-weight: 600;
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
