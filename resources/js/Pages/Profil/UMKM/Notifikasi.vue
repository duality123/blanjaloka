<template>
  <Remove pesan="Anda yakin ingin menghapus notifikasi ini" :popup="deletePopup" :itemDelete="itemDelete" url="/notifikasi/hapus_notif/" @toggleClose="switchClose()" />
   <DashboardLayout title="Notifikasi" page='notifikasi'>
             <section class="mt-10">
      <div class="d-flex flex-column flex-lg-row justify-content-center align-items-lg-center">
          <div class="col-lg-10">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">
                  <h1>Notifikasi</h1>
                  <button @click="tandaiPost()" class="text-primary-blue-6 mb-0 custom-button">Tandai sudah dibaca</button>               
                </div>
                  <div class="row">
                    <div class="col-xl-8 d-flex justify-content-start">
                       <Search url="/notifikasi/UMKM?page=1" judul="Cari notifikasi berdasarkan judul atau tanggal" />  
                         <div class="dropdown mx-3  ">
                            <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          </button>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li><Link preserve-state :data="{tanda:'t'}" class="dropdown-item" href="#">Notifikasi yang ditandai</Link></li>
                                <li><Link preserve-state :data="{tanda:'f'}" class="dropdown-item" href="#">Notifikasi yang tidak ditandai</Link></li>
                              </ul>
                            </div>  
                    </div>   
                  </div>  
                <div class="mt-4">
                  <div :class="[notifikasi.tandai?'bg-primary-blue-4' :'bg-primary-blue-1', 'p-3 mb-4 card-notif']" v-for="notifikasi in items.data"> 
                    <div class=" d-flex justify-content-end">
                          <div class="dropdown mx-3  ">
                                  <button class="dropdown-toggle close" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  </button>
                                              <ul class="dropdown-menu dropdown-menu-end">
                                                 <li><button @click = "switchClose(id_notif=notifikasi.id)" class="dropdown-item ">Hapus</button></li>
                                                   <li><button @click="indexTandaiSingle(id_notif=notifikasi.id)" class="dropdown-item " :href="url">Tandai</button></li>
                                              </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                    <div class="p-2  bd-highlight"> <input type="checkbox" :checked="notifikasi.tandai"  @click="indexTandai(id_notif=notifikasi.id)"></div>
                                    <div class="p-2 flex-grow-1"><h1 class="text-neutral-gray-5">
                      {{notifikasi.pesan}}
                      <template v-if="notifikasi.redirect" class="mt-2">
                      <div class="mt-2">
                      <Link class="btn btn-primary-blue-7 text-neutral-white py-2" :href="`${notifikasi.redirect}`">kunjungi halaman</Link>
                    </div>
                    </template>
                    </h1>
                    <p :class="[notifikasi.tandai?'':'text-neutral-gray-3' ,'mb-0']">{{notifikasi.tanggal}} WIB</p></div>
                      </div>              
                  </div>
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
import DashboardLayout from '../../../Layouts/LayoutUMKM.vue';
import Pagination from '../../../Components/Pagination.vue';
import Remove from '../../../Components/RemoveItem.vue';
import Search from '../../../Components/Search.vue';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';
export default{
data(){
  return{
    tandai:[],
    url:document.location.href,
    itemDelete:null,
    deletePopup:false
  }
},
components:{
  DashboardLayout,
  Link,
  Pagination,
  Search,
  Remove

},
props:{
  items:Object,
},
methods:{
     switchClose(id_notif=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:id_notif}
      },
 
 tandaiPost(){
    Inertia.post('/notifikasi/tandai_notif',{id:this.tandai}, { preserveState: false,preserveScroll:true})
  },
  notifBertanda(){
    Inertia.get(document.location.href,{tanda:1}, { preserveState: true,preserveScroll:true })
  },
  notifNoTanda(){
    Inertia.get(document.location.href,{tanda:0}, { preserveState: true,preserveScroll:true })
  },
 indexTandai(id_notif){
  this.tandai.push(id_notif)
 },
  indexTandaiSingle(id_notif=null){
    this.tandai.push(id_notif)
    Inertia.post('/notifikasi/tandai_notif',{id:this.tandai}, { preserveState: false,preserveScroll:true })
  },
}
}
</script>
<style scoped>
.btndrop{
  border-width: 0px;
  background-color: transparent;
}
.custom-button{
  background-color: transparent;
  border-color: transparent;
}
.close{
  border-width: 0px;
   border-color: transparent;
     background-color: transparent;
  border-color: transparent;
}
section {
  margin-top: 8rem !important;
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
.card a {
  text-decoration: none;
}
.card-notif h1 {
  font-size: 1.25rem;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
  .card-notif h1 {
    font-size: 1rem;
  }
}
@media (max-width: 575.98px) {
  .quit {
    align: start;
  }
}
.dropdown-list-image {
    position: relative;
    height: 2.5rem;
    width: 2.5rem;
}
.dropdown-list-image img {
    height: 2.5rem;
    width: 2.5rem;
}
.btn-light {
    color: #2cdd9b;
    background-color: #e5f7f0;
    border-color: #d8f7eb;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}

h2 {
  font-size: 1.3rem;
  font-weight: 400;
}

.card {
  border: none;
  border-radius: 1.25rem;
}

.fa-times{
  margin-left: 300px;
}

.card h3 {
  font-size: 1rem;
  font-weight: 400;
}
</style>
