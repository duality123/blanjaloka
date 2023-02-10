<template>
    <RemoveInvestasiLayout pesan="Anda yakin ingin menghapus kegiatan ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/investasi/hapus_investasi" @toggleClose="switchClose()" />
  <DashboardLayout section = "funding" title="Daftar Bisnis" state="funding">
    <ul class="tabs mt-4">
      <li class="active" >
      		<h3>Daftar Investasi</h3>
      </li>
    </ul>
    <section>
       <div class="row">
         <div class="col d-flex justify-content-start">
      <Search :url="`/admin/investasi?page=1`" judul="Cari Bisnis" /> 
         <div class="dropdown mx-3  ">
  <button class="btn btn-primary-blue-6 dropdown-toggle text-neutral-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><Link preserve-state :data="{profit:'t'}" class="dropdown-item" :href="url">Profit</Link></li>
                <li><Link preserve-state :data="{profit:'f'}" class="dropdown-item" :href="url">Belum Profit</Link></li>
              </ul>
            </div>
      </div>  
      <div class="col d-flex justify-content-end">
        <Link href="/admin/investasi/tambah_investasi" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Bisnis
        </Link>
      </div>
    </div>
     <div class="card-body mt-4">
                <div class="row">
                  <div class="col-lg-4" v-for="(item,no) in items.data">

                    <div class="card card_kegiatan mt-2">
                       
                      <div class="card-body">
<div class="col d-flex justify-content-start">
   <div v-if="item.persentase_hasil_investasi > 0" class="bg-semantic-success-1 text-semantic-success-4 status">Profit ( {{item.persentase_hasil_investasi}} % )</div>
        <div v-else class="bg-neutral-gray-1 text-neutral-gray-4 status">Belum Profit ( {{item.persentase_hasil_investasi}} % )</div>
</div>
<div class=" d-flex justify-content-end">
      <div class="dropdown-">
  <a href="#" role="button"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
     <font-awesome-icon icon="fas fa-ellipsis-h" />
  </a>

  <ul class="dropdown-menu-end dropdown-menu">
    <li><Link :href="`/admin/investasi/${item.id}/edit`" class="dropdown-item" href="#">Edit</Link></li>
    <li><button @click="switchClose(item.id)" class="dropdown-item delete" href="#">Hapus</button></li>
  </ul>
</div>
      </div>
  <div :id="`carouselExampleControlsNoTouching${no}`" class="carousel slide" data-bs-touch="false">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="2000" v-for="gambar in item.foto_bisnis.split(',').filter(item => item)">
      <div class="col d-flex justify-content-center">
                  <img  :src="`${$page.props.asset_url}/${gambar}`" class="gambar" alt="...">
                </div>
              </div>
  </div>
  <button class="carousel-control-prev " type="button" :data-bs-target="`#carouselExampleControlsNoTouching${no}`" data-bs-slide="prev">
    <span class="carousel-control-prev-icon   " aria-hidden="true"></span>
    <span class="visually-hidden ">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" :data-bs-target="`#carouselExampleControlsNoTouching${no}`" data-bs-slide="next">
    <span class="carousel-control-next-icon   " aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div> 
<h1 class="text-neutral-black mt-2">{{item.name}}</h1>
<div class="col d-flex justify-content-center">
                          <button class="btn btn-primary-blue-7 me-2 px-3 text-neutral-white cursor-pointer" @click="redirect(item.id)">Lihat Bisnis</button>
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
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import RemoveInvestasiLayout from '../../../Components/RemoveItem.vue';
import Pagination from '../../../Components/Pagination.vue';
import Search from '../../../Components/Search.vue';
export default{
    data(){
        return{
          popup:false,
          deletePopup:false,
          itemDelete:null,
          url:document.location.href

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
    props:{
      items :Object,
    },
    components: {
      DashboardLayout,
      Link,
      RemoveInvestasiLayout,
      Pagination,
      Search
    },
    methods:{
       switchClose(id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:id}
      },
      redirect(link){
        Inertia.get('/admin/investasi/'+link+'/detail')
      }
    }

}
</script>

<style scoped>
.delete{
  border-width:0px;

  border-color: transparent;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
.carousel-control-next-icon{
 background-image: url('../../../assets/icons/carousel-right.png');
}

.carousel-control-prev-icon{
 background-image: url('../../../assets/icons/carousel-left.png');
}
.gambar{
  width: 190px;
  height: 140px;
  border-radius:25px;
}
table{
	width: 100%;
}
.tabs {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
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

.tabs li a {
  text-decoration: none;
  font-weight: 600;
}



table tbody tr td,
table tbody tr th {
  font-weight: 600;
  color: #3E4041;
  border-bottom: none;
  text-align: start;
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
