<template>
  <DashboardLayout title="Tambah Janji Temu" state="janjitemu">
     <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Edit Janji Temu</h1>
    </div>
    <div class="d-flex mt-4">
      <Link href="/dashboard/janjitemu?page=1" class="text-decoration-none text-primary-blue-6 me-2">Janji Temu</Link>
      <p class="text-neutral-gray-4">> Edit Janji Temu </p>
    </div>
    <div class="row">
    <div class="col-lg-12"  >
      <div class="mt-4">
    <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih Investor</h3>
      </li>
    </ul>

        <div class="row">
         <div class="col d-flex justify-content-start">
           <small class="text-danger" v-if="form.errors.investor">{{form.errors.investor}}</small>
        <MultiSearchInvestor url="/admin/tambah_janji_temu_view?page=1" />
        
      </div>
    </div>

           <div class="table-responsive ">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto Investor</th>
              <th scope="col">Nama Investor</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Perusahaan</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="investor_all.length <= investorShowValue" v-for="(index,no) in investor_all">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer" :href="`/detail/profil/investor/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_perusahaan}}</td>
              <td>{{index.no_hp}}</td>
              <td>
               <button v-if="form.investor != index.id"  @click="togglePilihInvestor(id_investor=index.id)"  class="btn btn-primary-blue-6 text-neutral-white">
                  <font-awesome-icon icon="fa-solid fa-plus" />
                  Pilih
                </button  >
                <button v-else @click="toggleBatalPilihInvestor" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../assets/icons/icon_delete.png" alt="delete icon">
                  Batal pilih
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
        <div v-if="investorShowValue+10 <= countInvestor" class="d-flex justify-content-center mt-4">
        <button @click="loadMoreInv" class="btn btn-primary-blue-6 text-neutral-white">Lihat lebih banyak Investor</button>
      </div>


      <ul class="tabs mt-2">
      <li class="active" >
          <h3>Pilih UMKM</h3>
      </li>
    </ul>

        <div class="row">
         <div class="col d-flex justify-content-start">
          <small class="text-danger" v-if="form.errors.umkm">{{form.errors.umkm}}</small>
        <MultiSearchUMKM  url="/admin/tambah_janji_temu_view?page=1"   />
        
      </div>
    </div>
           <div class="table-responsive ">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
             <tr>
              <th scope="col">No</th>
              <th scope="col">Foto UMKM</th>
              <th scope="col">Nama UMKM</th>
              <th scope="col">Nama Perusahaan</th>
              <th scope="col">Kategori Produk</th>
              <th scope="col">No HP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-if="umkm_all.length <=umkmShowValue "  v-for="(index,no) in umkm_all">
              <th scope="row">{{++no}}</th>
              <td><img class="imagetd" :src="`${$page.props.asset_url}/${index.foto_profil}`"/></td>
              <td><Link :href="`/detail/profil/umkm/${index.id}/`">{{index.nama_lengkap}}</Link></td>
              <td>{{index.nama_perusahaan}}</td>
              <td>{{index.kategori_produk}}</td>
              <td>{{index.no_hp}}</td>
              <td >
                <button v-if="form.umkm != index.id"  @click="togglePilihUmkm(id_investor=index.id)"  class="btn btn-primary-blue-6 text-neutral-white">
                  <font-awesome-icon icon="fa-solid fa-plus" />
                  Pilih
                </button  >
                 <button v-else @click="toggleBatalPilihUmkm" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../assets/icons/icon_delete.png" alt="delete icon">
                  Batal pilih
                </button  >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
        <div v-if="umkmShowValue+1 <= countUMKM" class="d-flex justify-content-center mt-4">
        <button @click="loadMoreUMKM()" class="btn btn-primary-blue-6 text-neutral-white">Lihat lebih banyak UMKM</button>
      </div>

      </div>
           <div class="mt-2">
      <form @submit.prevent="tambahJanjiTemu()">
  
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Lokasi</label>
         <input type="text" class="form-control" v-model="form.lokasi" id="provinsi" placeholder="Masukkan lokasi" >
           <small class="text-danger" v-if="form.errors.lokasi">{{form.errors.lokasi}}</small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Dimulai</label>
         <input type="datetime-local" class="form-control" v-model="form.dimulai"  id="provinsi" placeholder="Masukkan waktu dimulai" >
           <small class="text-danger" v-if="form.errors.dimulai">{{form.errors.dimulai}}</small>
      </div>
       <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Berakhir</label>
         <input type="datetime-local" class="form-control" v-model="form.berakhir"  id="provinsi" placeholder="Masukkan waktu berakhir" >
           <small class="text-danger" v-if="form.errors.berakhir">{{form.errors.berakhir}}</small>
      </div>

      <button type="submit" class="btn btn-primary-blue-6 text-neutral-white">
                        Kirim</button>
  </form>
      </div>
    </div>

      </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../../Layouts/Dashboard.vue';
import { useForm, Link,usePage } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia'
import MultiSearchUMKM from '../../Components/MultiSearchUMKM.vue';
import MultiSearchInvestor from '../../Components/MultiSearchInvestor.vue';
import {onMounted,watch} from 'vue';
const form = useForm({
         lokasi:props.janjitemu.lokasi,
         dimulai:props.janjitemu.waktu,
         berakhir:props.janjitemu.berakhir,
         investor:props.janjitemu.investor_id,
         umkm:props.janjitemu.umkm_id,
         janji_temu_id:props.janjitemu.id

         
});
let investorShowValue = 10;
let umkmShowValue = 10;

const props = defineProps({
                          umkm_all:{
                            type:Object,
                          },
                          investor_all:{
                            type:Object
                          },
                          countInvestor:{
                            type:Number
                          },
                          countUMKM:{
                            type:Number
                          },
                          janjitemu:{
                            type:Object
                          }

                        });
onMounted(()=>{
     let uri = window.location.search.substring(1)
        let params = new URLSearchParams(uri)
        if (params.get('limitInv')) {
          investorShowValue = params.get('limitInv');
        }
        if(params.get('limitUMKM')) {
           umkmShowValue = params.get('limitUMKM');
        }
        console.log(props.janjitemu)
   
})

     const togglePilihInvestor =(id_investor)=>{
          form.investor = id_investor
          console.log(form.investor)
      }
     const toggleBatalPilihInvestor=()=>{
        form.investor = null
      }
    const togglePilihUmkm=(id_umkm)=>{
          form.umkm = id_umkm
      }
    const toggleBatalPilihUmkm=()=>{
          form.umkm = null
      }
  const loadMoreInv=() =>{
         investorShowValue = parseInt( investorShowValue)+10
        Inertia.get(document.location.href,{limitInv:investorShowValue},{preserveScroll:true,preserveState:true })       
      }

   const loadMoreUMKM=()=>{
        umkmShowValue = parseInt(umkmShowValue)+10
        Inertia.get(document.location.href,{limitUMKM:umkmShowValue},{preserveScroll:true,preserveState:true })       
      }
  const tambahJanjiTemu=()=>{
        form.post('/admin/edit_janji_temu',{onSuccess: () => form.reset()},{preserveState:true});
}



</script>

<style scoped>
.imagetd{
  width: 100px;
  height: 100px;
}
ul {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  
}

ul li {
  cursor: pointer;
  border-bottom: 1px solid #F0F0F0;
}

ul li {
  padding-bottom: 0.5rem;
}

ul li a.active {
  border-bottom: 2px solid #F0F0F0;
  color:  #398ab9;
  margin-bottom: 0px;
}

ul li a {
  text-decoration: none;
  font-weight: 600;
  color: black;
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

.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;

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
