<template>

   <Layout section="logbook" :title="kegiatan.tema" :link="kegiatan.id">
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Bukti kegiatan</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items.data">
              <th scope="row">{{++no}}</th>
              <td>{{index.waktu}}</td>
              <td class="deskripsi_td">{{index.deskripsi}}</td>
              <td v-if="index.bukti_kegiatan == '-'">
                  -
              </td>
              <td v-else>
                  <img :src="`${$page.props.asset_url}/${index.bukti_kegiatan}`" alt="" style="width:5rem">
              </td>
              <td>
                  <a href="#" class="btn btn-semantic-error-4 px-3 me-2 text-neutral-white cursor-pointer" v-if="index.status ==2">
                            Ditolak
                          </a>
                          <a href="#" class="btn btn-semantic-warning-4 me-2 px-3 text-neutral-white cursor-pointer" v-if="index.status ==0">
                            Menunggu
                          </a>
                          
                          <a href="#" class="btn btn-semantic-success-4 px-3 me-2 text-neutral-white cursor-pointer" v-if="index.status ==1">
                            Disetujui
                          </a>
              </td>
               <td>
                          <button @click="changeStatus(2,index.id,index.waktu)" class="btn btn-semantic-error-4 px-3 me-2 text-neutral-white cursor-pointer" >
                            Tolak
                          </button>
                          
                          <button @click="changeStatus(1,index.id,index.waktu)" class="btn btn-semantic-success-4 px-3 me-2 text-neutral-white cursor-pointer" >
                            Setujui
                          </button>
                        </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
         <Pagination :links="items.links"/>
      </div>
</Layout>
</template>

<script>
import Layout from '../../../Layouts/Kegiatan.vue';
import Pagination from '../../../Components/Pagination.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
export default{
    setup(props){
      const form = useForm({
        status:null,
        id:null,
        user_id:window.location.pathname.split('/')[5],
        kegiatan_id:props.kegiatan.id,
        waktu:null
      })
      return { form }
    },
    data(){
      return{
        currentPage: document.location.pathname.split('/')[6]
      }
    },
    props:{
      items :Object,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number,
      kegiatan:Object
    },
    components: {
      Layout,
      Link,
      Pagination
    },
    methods:{
      changeStatus(num,id,waktu){
        this.form.status = num
        this.form.id = id
        this.form.waktu = waktu
        this.form.post('/admin/kegiatan/logbook/ubah_status')
      }
    }
}
</script>

<style scoped>
.deskripsi_td{
  width:200px;
}
section{
  width: 900px;
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

ul li {
  padding-bottom: 0.5rem;
}

ul li a.active {
  border-bottom: 2px solid #398AB9;
  color:  #398ab9;
}

ul li a {
  text-decoration: none;
  font-weight: 600;
  color: black;
}

@media (max-width: 575.98px) {
  ul {
    gap: 1rem;
    flex-direction: column;
  }

}

form section h2 {
  font-size: 1.25rem;
}

.form-control {
  background-color: transparent;
  resize: none;
}
.modal-content{
  text-align: start;
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