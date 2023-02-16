<template>
  <DashboardLayout title="Tambah Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-5">Profil Investor</h1>
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
         <small class="text-danger text-center" v-if="form.errors.pesan">{{form.errors.pesan}}</small>
          <div class="mt-2">
          <button type="submit" class="btn btn-primary-blue-6 text-neutral-white">Kirim</button>
        </div>
      </form>
      </div>
</div>
</div>
          <section class="mb-5">
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
              <div class="p-2" ><strong>Foto profil: </strong></div>
              <div class="p-2" v-if="data.profil.foto_profil"><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_profil}`"></div>
              <div class="p-2" v-else><img  class="mt-2 mb-2" src="../../assets/images/user_profile_img.png"></div>
              <div class="p-2"><strong>Foto KTP: </strong></div>
               <div class="p-2" v-if="data.profil.foto_ktp"><img  class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_ktp}`"></div>
               <div class="p-2" v-else><img  class="mt-2 mb-2" src="../../assets/images/user_profile_img.png"></div>
               <div class="p-2"><strong>Foto dengan KTP: </strong></div>
              <div class="p-2" v-if="data.profil.foto_dengan_ktp"><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.profil.foto_dengan_ktp}`"></div>
              <div class="p-2" v-else><img  class="mt-2 mb-2" src="../../assets/images/user_profile_img.png"></div>
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
          <div class="p-2" v-if="data.dokumen_perusahaan.foto_npwp_perusahaan"><img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.dokumen_perusahaan.foto_npwp_perusahaan}`"></div>
          <div class="p-2" v-else><img  class="mt-2 mb-2" src="../../assets/images/user_profile_img.png"></div>
    
          <div class="p-2"><strong>No NPWP Perusahaan: </strong>{{data.dokumen_perusahaan.no_npwp_perusahaan}}</div>
          <div class="p-2"><strong>Foto KTP PIC: </strong></div>
          <div class="p-2" v-if="data.dokumen_perusahaan.foto_ktp_pic">
          <img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.dokumen_perusahaan.foto_ktp_pic}`">
          </div>
            <div class="p-2" v-else><img  class="mt-2 mb-2" src="../../assets/images/user_profile_img.png"></div>
          <div class="p-2"><strong>No Rekening: </strong>{{data.dokumen_perusahaan.no_rekening}}</div>
          <div class="p-2" v-if="data.dokumen_perusahaan.foto_buku_tabungan">
            <img class="mt-2 mb-2" :src="`${this.$page.props.asset_url}/${data.dokumen_perusahaan.foto_buku_tabungan}`">
          </div>
            <div class="p-2" v-else><img  class="mt-2 mb-2" src="../../assets/images/user_profile_img.png"></div>
          
        </div>
          </section>
     
          <div class="d-flex justify-content-center bd-highlight mb-3">
              <div class="p-2 bd-highlight">
              <Link :href="`admin/dashboard/detail/profil/${user_id}/hapus`" type="submit" class="btn btn-danger text-neutral-white">Hapus user ini</Link>
              </div>
              <div class="p-2 bd-highlight">
              <Link :href="`/detail/profil/${role}/${user_id}/accept`" class="btn btn-primary-blue-6 text-neutral-white">Terima user ini</Link>
              </div>
              <div class="p-2 bd-highlight">
             <button @click = "toggleComment()" class="btn btn-semantic-success-4 text-neutral-white">Beri tanggapan</button>
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
      user_id : window.location.pathname.split('/')[4],
      role:window.location.pathname.split('/')[3],
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
  },
  components:{
    DashboardLayout,
    Link
  },
  methods:{
    toggleComment(){
      this.comment = !this.comment
    },
    submitComment(){
      this.form.post('/detail/profil/'+this.role+'/'+this.user_id+'/beri_tanggapan',{onSuccess: () => this.form.reset()},{preserveState:true})
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
