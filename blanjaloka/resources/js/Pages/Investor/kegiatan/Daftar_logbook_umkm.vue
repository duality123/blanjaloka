<template>
  
<Layout state='daftar_umkm' :link="kegiatan.id" :title="nama.profil.nama_lengkap">
              
                <div class="d-flex flex-column flex-lg-row gap-2 bg-primary-blue-1 rounded px-3 py-2 mt-4 mb-4">
                  <div>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M10 14.75C10.2167 14.75 10.396 14.6793 10.538 14.538C10.6793 14.396 10.75 14.2167 10.75 14V9.725C10.75 9.525 10.6793 9.354 10.538 9.212C10.396 9.07067 10.2167 9 10 9C9.78333 9 9.60433 9.07067 9.463 9.212C9.321 9.354 9.25 9.53333 9.25 9.75V14.025C9.25 14.225 9.321 14.396 9.463 14.538C9.60433 14.6793 9.78333 14.75 10 14.75ZM10 7.3C10.2333 7.3 10.425 7.22067 10.575 7.062C10.725 6.904 10.8 6.70833 10.8 6.475C10.8 6.25833 10.725 6.07067 10.575 5.912C10.425 5.754 10.2333 5.675 10 5.675C9.76667 5.675 9.575 5.754 9.425 5.912C9.275 6.07067 9.2 6.25833 9.2 6.475C9.2 6.70833 9.275 6.904 9.425 7.062C9.575 7.22067 9.76667 7.3 10 7.3ZM10 19.5C8.68333 19.5 7.446 19.25 6.288 18.75C5.12933 18.25 4.125 17.575 3.275 16.725C2.425 15.875 1.75 14.8707 1.25 13.712C0.75 12.554 0.5 11.3167 0.5 10C0.5 8.68333 0.75 7.44567 1.25 6.287C1.75 5.129 2.425 4.125 3.275 3.275C4.125 2.425 5.12933 1.75 6.288 1.25C7.446 0.75 8.68333 0.5 10 0.5C11.3167 0.5 12.5543 0.75 13.713 1.25C14.871 1.75 15.875 2.425 16.725 3.275C17.575 4.125 18.25 5.129 18.75 6.287C19.25 7.44567 19.5 8.68333 19.5 10C19.5 11.3167 19.25 12.554 18.75 13.712C18.25 14.8707 17.575 15.875 16.725 16.725C15.875 17.575 14.871 18.25 13.713 18.75C12.5543 19.25 11.3167 19.5 10 19.5ZM10 18C12.2167 18 14.1043 17.221 15.663 15.663C17.221 14.1043 18 12.2167 18 10C18 7.78333 17.221 5.89567 15.663 4.337C14.1043 2.779 12.2167 2 10 2C7.78333 2 5.896 2.779 4.338 4.337C2.77933 5.89567 2 7.78333 2 10C2 12.2167 2.77933 14.1043 4.338 15.663C5.896 17.221 7.78333 18 10 18Z"
                        fill="#398AB9" />
                    </svg>
                  </div>
                  <p class="fw-semibold text-primary-blue-6 mb-0">
                    Disini adalah halaman logbook yang ditulis oleh UMKM selama mengikuti kegiatan.
                  </p>
                </div>
               <Topbar section="logbook" :link="kegiatan.id" :link2="nama.id"/>
               <div class=" col d-flex justify-content-end mb-4">
                 <Link :href="`/investor/janjitemu/${nama.id}/`" method="post" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Ajukan Janji temu
                </Link>
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
                          <a class="btn btn-semantic-error-4 px-3 me-2 text-neutral-white cursor-pointer" v-if="event.status ==2">
                            Ditolak ( revisi ulang )
                          </a>
                          <a class="btn btn-semantic-warning-4 me-2 px-3 text-neutral-white cursor-pointer" v-else-if="event.status ==0">
                            Menunggu
                          </a>
                          
                          <a class="btn btn-semantic-success-4 px-3 me-2 text-neutral-white cursor-pointer" v-else-if="event.status ==1">
                            Disetujui
                          </a>
                          
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
import Layout from '../../../Layouts/KegiatanInvestor.vue'
import Topbar from '../../../Layouts/SeleksiUmkmSidebar.vue'
import { useForm, Link } from '@inertiajs/inertia-vue3'
export default{
  data(){
    return{
    }
  },
  setup(props){
    const form = useForm({
     perihal:null,
     kontak:null,
     mentor:null,
     kegiatan_id: props.kegiatan.id
    })

    return {form}
  },
  components:{
    Layout,
    Link,
    Topbar
  },
  methods:{
    submit(){
      this.popup=false;
      this.form.post('/umkm/dashboard/kegiatanku/tambah_eventual',{onSuccess: () => this.form.reset()})

    },
 
  },
  props:{
    logbook:Object,
    kegiatan:Object,
    nama:String
  }


}

</script>


<style scoped>

td{
  width:300px;
}

.tdimg{
  width: 200px;
  height: 100px;
}
.card{
  width: 900px
}
section {
  margin-top: 10rem !important;
}
.modal-content{
  text-align: start;
}
.fs-btn {
    font-size: .875rem;
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
 .modal-content{
  height: 450px;
  overflow-y: scroll;
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

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 1rem;
}

.step .number {
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 1.25rem;
  font-weight: 600;
  border-radius: 50%;
  background-color: #D9D9D9;
  color: #FFFFFF;
}

.step h1 {
  font-size: 1.125rem;
  font-weight: 600;
  color: #AEAEAE;
}
 .modal-content{
  height: 450px;
  overflow-y: scroll;
 }
.step.clear .number {
  background-color: #398AB9;
}

.step.clear h1 {
  color: #3E4041;
}

h2 {
  font-size: 1.25rem;
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
  background-color: #F0F0F0;
}

table tbody tr:nth-child(2n) td,
table tbody tr:nth-child(2n) th {
  background-color: #F2F7FA;
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
