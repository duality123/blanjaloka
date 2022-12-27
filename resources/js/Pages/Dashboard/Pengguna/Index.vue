<template>
  <RemoveUserLayout pesan="Anda yakin ingin menghapus user ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/dashboard/pengguna/hapus_user" @toggleClose="switchClose()" />

   <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="ubahPassword" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "closePopup()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Edit Eventual</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submit()">
         <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Jadwal</label>
         <input type="date" class="form-control" v-model="form.jadwal"  id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger"></small>
      </div>
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Link Meeting</label>
         <input type="text" class="form-control" v-model="form.link_meeting" id="provinsi" placeholder="Masukkan deskripsi kegiatan" >
           <small class="text-danger"></small>
      </div>
        <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5 mb-3 mb-2" >Status: </label>
              <select v-model="form.status" id="provinsi">
                <option value="0">Menunggu</option>
                <option value="1">Disetujui</option>
                <option value="2">Selesai</option>              
              </select>
           <small class="text-danger"></small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
  <DashboardLayout title="User Management" state="pengguna">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Pengguna</h1>
    </div>
    <ul class="tabs mt-4">
      <li v-for="item in tabItems.data" :class="[item == this.currentTabItem ? 'active':'']" >
        <Link href="/admin/dashboard/pengguna/1?page=1" v-if="item == 1" :class="[item == this.currentTabItem ?'text-neutral-black': 'text-neutral-gray-4']">Admin</Link>
        <Link href="/admin/dashboard/pengguna/2?page=1" v-else-if="item == 2" :class="[item == this.currentTabItem ?'text-neutral-black': 'text-neutral-gray-4']">UMKM</Link>
        <Link href="/admin/dashboard/pengguna/3?page=1" v-else :class="[item == this.currentTabItem ?'text-neutral-black': 'text-neutral-gray-4']">Investor</Link>
      </li>
    </ul>
    <section>
      <div class="d-flex justify-content-end">
        <a href="#" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah User
        </a>
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Status</th>
              <th scope="col">Akun dibuat pada</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,index) in items.data">
              <th scope="row">{{ ++index}}</th>
              <td v-if="item.accepted"><a  class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">Sudah di acc</a></td>
              <td v-else><a class="btn btn-semantic-warning-4 me-2 px-3 text-neutral-white cursor-pointer">Belum di acc</a></td>
              <td>{{item.created_at}}</td>
              <div>
              <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                <Link :href="`/detail/profil/${item.id}`" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Lihat Profil
                </Link>
                 <button @click="this.changeState(index)" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Ubah Password
                </button>
                <button @click="this.switchClose(user_id=item.id)"  class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus
                </button  >
              </td>
            </div>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
       <Pagination :links = "items.links"/>
      </div>
    </section>
  </DashboardLayout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import RemoveUserLayout from '../../../Components/RemoveItem.vue';
import Pagination from '../../../Components/Pagination.vue';
export default{
    data(){
        return{
          currentTabItem: window.location.pathname.split('/')[4],
          currentPage : window.location.pathname.split('/')[5],
          deletePopup:false,
          tabItems :[1,2,3],
          itemDelete:null

      }
    },
    props:{
      items : Object,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number
    },
    methods:{
      lowerCase(name){
        return name.toLowerCase()
      },
      switchClose(user_id=null){
        this.deletePopup = !this.deletePopup          
        this.itemDelete = {id:user_id}
      }




    },
    components: {
      DashboardLayout,
      Link,
      RemoveUserLayout,
      Pagination
    },

}
</script>

<style scoped>

h1 {
  font-size: 2.1rem;
  font-weight: 600;
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
