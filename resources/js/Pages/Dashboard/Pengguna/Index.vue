<template>
  <RemoveUserLayout pesan="Anda yakin ingin menghapus user ini" :popup="deletePopup" :itemDelete="itemDelete" url="/admin/pengguna/user/hapus_user" @toggleClose="switchClose()" />
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
       <h2>Ubah Password</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submit()">
         <div class="mb-4">
         <label for="ubahPassword" class="form-label text-neutral-gray-5">Password Baru</label>
         <input type="text" class="form-control" v-model="form.password_baru"  id="ubahPassword" placeholder="Masukkan password Baru" >
           <small class="text-danger">{{form.errors.password_baru}}</small>
        </div>
      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>

  </form>
      </div>
    </div>
  </div>
</div>

    <div id="myModal" class="modal" v-if="addUser" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "newUser()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Tambah Pengguna</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submitNewUser()">
          <div class="mb-4">
         <label for="ubahPassword" class="form-label text-neutral-gray-5">Nama Lengkap</label>
         <input type="text" class="form-control" v-model="formAddUser.name"  id="ubahPassword" placeholder="Masukkan Nama Lengkap" >
           <small class="text-danger">{{formAddUser.errors.name}}</small>
        </div>
         <div class="mb-4">
         <label for="ubahPassword" class="form-label text-neutral-gray-5">Email</label>
         <input type="text" class="form-control" v-model="formAddUser.email"  id="ubahPassword" placeholder="Masukkan Email" >
           <small class="text-danger">{{formAddUser.errors.email}}</small>
        </div>
         <div class="mb-4">
         <label for="ubahPassword" class="form-label text-neutral-gray-5">No HP</label>
         <div class="input-group">
         <span class="input-group-text bg-white  numberCasual">+62</span>
         <input type="text" class="form-control" v-model="formAddUser.no_hp"  id="ubahPassword" placeholder="Masukkan No HP" >
         </div>
           <small class="text-danger">{{formAddUser.errors.no_hp}}</small>
        </div>
        <div class="mb-4">
         <label for="ubahPassword" class="form-label text-neutral-gray-5">Password</label>
         <input type="text" class="form-control" v-model="formAddUser.password"  id="ubahPassword" placeholder="Masukkan password " >
           <small class="text-danger">{{formAddUser.errors.password}}</small>
        </div>
      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline ">
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
      <li v-for="(item,no) in tabItems" :class="[item == this.currentTabItem ? 'active':'']" >
        <Link :href="`/admin/pengguna/${item}?page=1`" :class="[item == this.currentTabItem ?'text-neutral-black': 'text-neutral-gray-4']">{{tabItemsNama[no++]}}</Link>
        
      </li>
    </ul>
    <section>
      <div class="row">
       <div class="col d-flex justify-content-start">
      <Search :url="`/admin/pengguna/${currentTabItem}?page=1`" judul="Cari Pengguna" /> 
      </div> 
       
      <div class="col d-flex justify-content-end" v-if="currentTabItem == 1" >
        <button @click="newUser(1)" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Admin
        </button>
      </div>
      <div class="col d-flex justify-content-end" v-if="currentTabItem == 2" >
        <button @click="newUser(2)" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah UMKM
        </button>
      </div>
      <div class="col d-flex justify-content-end" v-if="currentTabItem == 3" >
        <button @click="newUser(3)" href="#" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Investor
        </button>
      </div>
    </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">No Telepon</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,index) in items.data">
              <th scope="row">{{ ++index}}</th>
              <td v-if="currentTabItem==2">
                 <Link :href="`/detail/profil/umkm/${item.id}`"> 
                 {{item.nama_lengkap}}
                 </Link>
              </td>
              <td v-else-if="currentTabItem==3">
                 <Link :href="`/detail/profil/investor/${item.id}`"> 
                 {{item.nama_lengkap}}
                 </Link>
              </td>
               <td v-else>
                {{item.name}}
               </td>
                <td v-if="currentTabItem==1">
                {{item.no_handphone}}
              </td>
               <td v-else>
                {{item.no_hp}}
              </td>
             <td>
              <p>{{item.email}}</p>
            </td>
             
              <td v-if="item.accepted">
                <a  class="btn btn-primary-blue-6 me-2 px-3 text-neutral-white cursor-pointer">Sudah di acc</a>
              </td>
              <td v-else>
                <a class="btn btn-semantic-warning-4 me-2 px-3 text-neutral-white cursor-pointer">Belum di acc</a>
              </td>
              <div>
              <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                 <button @click="this.closePopup(userid=item.id)" class="btn btn-semantic-success-4 text-neutral-white">
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
import Search from '../../../Components/Search.vue';
import RemoveUserLayout from '../../../Components/RemoveItem.vue';
import Pagination from '../../../Components/Pagination.vue';
export default{
    setup(props){
      const form = useForm({
        user_id:null,
        password_baru:null
      })

      const formAddUser = useForm({
        name:null,
        password:null,
        email:null,
        role:null,
        no_hp:null
      })
      return {form,formAddUser}
    },
    data(){
        return{
          currentTabItem: window.location.pathname.split('/')[3],
          deletePopup:false,
          tabItems :[1,2,3],
          tabItemsNama:['Admin','UMKM','Investor'],
          itemDelete:null,
          url:document.location.href,
          ubahPassword:false,
          addUser:false


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
      },
      closePopup(userid=null){
        this.form.user_id = userid,
        this.ubahPassword = !this.ubahPassword

      },
      submit(){
        this.form.post('/admin/pengguna/ubah_password',{onSuccess: () => form.reset()},{preserveState:true})
      },
      submitNewUser(){
        this.formAddUser.post('/admin/pengguna/tambah_user',{onSuccess: () => form.reset()},{preserveState:true})
      },
      newUser(user_role=null){
        this.addUser = !this.addUser
        this.formAddUser.role = user_role
      }




    },
    components: {
      DashboardLayout,
      Link,
      RemoveUserLayout,
      Pagination,
      Search
    },

}
</script>

<style scoped>

.numberCasual {
    border: none !important;
    border-radius: 0 !important;
    border-bottom: 2px solid #aeaeae !important;
    padding-left: 0 !important;

}
.imgtd{
  width:150px;
  height: 100px;
}
.form-label {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 0;
}
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}
.close{
  border-width: 0px;
  background-color: white;
}

.modal {
  position: fixed; /* Stay in place */
  padding-top: 70px; /* Location of the box */
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
  text-align: start;
}
.tabs {
  display: flex;
  column-gap: 2rem;
  list-style: none;
  padding: 0;
  border-bottom: 1px solid #F0F0F0;
}

td{
  word-wrap: break-word;
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
word-wrap: break-word;
}
table{
  overflow-x: scroll;
}


.form-control,
.form-select,
.vs__dropdown-toggle {
    border: none !important;
    border-radius: 0 !important;
    border-bottom: 2px solid #aeaeae !important;
    padding-left: 0 !important;
}

.vs__search {
    padding-left: 0 !important;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
}

.form-control:focus,
.form-select:focus {
    box-shadow: none;
}

.form-control::placeholder,
.form-select,
.vs__search::placeholder {
    color: #aeaeae !important;
}

.vs__selected {
    background-color: #398ab9 !important;
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
