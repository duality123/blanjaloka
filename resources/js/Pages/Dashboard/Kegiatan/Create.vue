<template>

  <DashboardLayout title="Kegiatan">
     <div class="col-lg-8">

              <div id="myModal" class="modal" v-if="popup" >
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "toggleEdit()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="col-lg-12">
       <div class=" d-flex justify-content-center">
       <h2>Edit Kegiatan</h2>
     </div>
           <div class="mt-2">
      <form @submit.prevent="submit()">
      <div class="mb-4">
         <label for="provinsi" class="form-label text-neutral-gray-5">Masukkan deskripsi kegiatan?</label>
         <input type="text" class="form-control" v-model="form.deskripsi" id="provinsi" placeholder="Masukkan hal yang ingin anda diskusikan" >
           <small class="text-danger" v-if="form.errors.deskripsi">{{ form.errors.deskripsi }}</small>
      </div>

      <button type="submit" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Kirim</button>
  </form>
      </div>
    </div>
  </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Kegiatan</h1>
      <button @click = "toggleEdit()" class="btn btn-primary-blue-6 text-neutral-white py-2">Edit Deskripsi
      </button>
    </div>
      <ul class="mt-4">
                    <li class="active">
                      <Link class="active" :href="`/admin/dashboard/kegiatan/5/detail/deskripsi/${kegiatan.id}`">Deskripsi</Link>
                    </li>
                   <li >
                      <Link :href="``">Elearning</Link>
                    </li>
                    <li >
                        <Link :href="``" >Eventual</Link>
                    </li>
                    <li >
                        <Link :href="``">Logbook</Link>
                    </li>
      </ul>
          <section>
      <div class="container">
        <p>{{kegiatan.deskripsi}}</p>
      </div>
    </section>
  </DashboardLayout>
</template>

<script>
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
export default{
  data(){
    return{
      popup: false
    }
  },
  setup(){
    const form = useForm({
     id :window.location.pathname.split('/')[4],
     deskripsi:null,
    })

    return {form}
  },
  props:{
    kegiatan:Object
  },
  components:{
    DashboardLayout,
    Link
  },
  mounted(){
    if (this.form.errors.deskripsi) {
      this.popup =true
    }
  },
  methods:{
    submit(){
      this.popup =false
      this.form.post('/admin/dashboard/kegiatan/edit_deskripsi')
    },
    toggleEdit(){
      this.popup = !this.popup
    }
  }
}
</script>

<style scoped>

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