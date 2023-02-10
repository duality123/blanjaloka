<template>
    <RemoveKegiatanLayout pesan="Anda yakin ingin menghapus kegiatan ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/kegiatan/hapus_kegiatan" @toggleClose="switchClose()" />
  <DashboardLayout title="Daftar kegiatan" state="kegiatan">
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Daftar Kegiatan</h3>
      </li>
    </ul>
    <section>
      <div class="row">
         <div class="col d-flex justify-content-start">
        <Search url="/admin/kegiatan?page=1" judul="Cari Kegiatan" />
        <div class="dropdown mx-3  ">
  <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><Link preserve-state :data="{berakhir:'t'}" class="dropdown-item" :href="url">Sudah selesai</Link></li>
                <li><Link preserve-state :data="{berakhir:'f'}" class="dropdown-item" :href="url">Belum Selesai</Link></li>
              </ul>
            </div>
           </div>
      <div class=" col d-flex justify-content-end">
        <Link href="/admin/kegiatan/tambah_kegiatan" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Kegiatan
        </Link>
      </div>
    </div>
            <div class="row card-body mt-4">
                  <div class="col-lg-4" v-for="(item,no) in items.data">
                    <div class="card card_kegiatan mt-2">                  
                      <div class="card-body">
<div class=" d-flex justify-content-end">
      <div class="dropdown">
  <a href="#" role="button"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
     <font-awesome-icon icon="fas fa-ellipsis-h" />
  </a>

  <ul class="dropdown-menu-end dropdown-menu">
    <li><Link :href="`/admin/kegiatan/${item.id}/edit`" class="dropdown-item">Edit</Link></li>
    <li><button @click="switchClose(item.id)" class="dropdown-item delete" >Hapus</button></li>
  </ul>
</div>
      </div>
      <div class="col d-flex justify-content-center">
                  <div v-if="new Date(item.berakhir.split(' ')[0]) > this.now" class="bg-semantic-success-1 text-semantic-success-4 status">Sedang Berlangsung </div>
                   <div v-else-if="new Date(item.dimulai.split(' ')[0]) > this.now" class="bg-neutral-gray-1 text-semantic-success-4 status">Belum dimulai </div>
                           <div v-else class="bg-neutral-gray-1 text-neutral-gray-4 status">Selesai </div>
                  <img  :src="`${$page.props.asset_url}/${item.gambar}`" class="gambar" alt="...">
                </div>
                 <div> 
                          <h1 class="text-neutral-black mt-2">{{item.tema}}</h1>
                        </div>
                        <div class="col d-flex justify-content-center">
                         <button class="btn btn-primary-blue-7 me-2 px-3 text-neutral-white cursor-pointer" @click="redirect(item.id)">Lihat Kegiatan</button>
                       </div>
              </div> 
                        </div>             
                      </div>
                    </div>         
      <div class="d-flex justify-content-center mt-4">
      <Pagination :links="items.links"/>
      </div>
    </section>
  </DashboardLayout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import RemoveKegiatanLayout from '../../../Components/RemoveItem.vue';
import Search from '../../../Components/Search.vue';
import Pagination from '../../../Components/Pagination.vue';
import { Inertia } from "@inertiajs/inertia";
export default{
    data(){
        return{
          popup:false,
          deletePopup:false,
          itemDelete:null,
          cari:null,
          now:null,
          url: document.location.href

      }
    },
  setup(props){
        const form = useForm({
         id:null,
         tema:null,
         mulai:null,
         berakhir:null,
         jumlah_peserta:null,
         status:null,
    })

    return {form}
  },
  mounted(){
    let uri = window.location.search.substring(1)
    let params = new URLSearchParams(uri)
    if (params.get('cari')) {
      this.cari = params.get('cari')
    }
    const date = new Date();
    var month = ['01','02','03','04','05','06','07','08','09','10','11','12']
    var bulan = month[date.getMonth()]
    var tahun = date.getFullYear();
    var tanggal = (date.getDate()  >= 10)? date.getDate()  : "0" + date.getDate();
    this.now = new Date(tahun+ '-' + bulan + '-' + tanggal);
    console.log(this.now)
  },
    props:{
      items :Object,
    },
    components: {
      DashboardLayout,
      Link,
      RemoveKegiatanLayout,
      Pagination,
      Search
    },
    methods:{
       switchClose(kegiatan_id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:kegiatan_id}
      },
      search(){
        Inertia.get('/admin/kegiatan?page=1',{cari:this.cari})
      },
       redirect(link){
        Inertia.get('/admin/kegiatan/'+link+'/detail')
      }
    }

}
</script>

<style scoped>
.delete{
  border-width:0px;

  border-color: transparent;
}
.gambar{
  width: 190px;
  height: 140px;
  border-radius:25px;
}

.card_kegiatan {
  border: none;
  cursor: pointer;
  transition: 300ms;
}

.card_kegiatan:hover {
  background-color: #F2F7FA;
}

.card_kegiatan .status {
  position: absolute;
  top: 0;
  left: 0;
  font-size: 0.75rem;
  font-weight: 400;
  padding: 0.5rem;
  border-bottom-right-radius: 0.375rem;
}

.card_kegiatan h1 {
  font-size: 1.125rem;
  font-weight: 600;
}

.card_kegiatan p {
  font-size: 0.875rem;
  font-weight: 500;
}

h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
td{
  width:300px;
}
.imgtd{
  width: 150px;
  height: 100px;
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


</style>
