<template>

  <Layout section='elearning' :title="elearning.judul" :link="elearning.kegiatan_id">
       <div class="d-flex flex-column flex-lg-row justify-content-end align-items-lg-end gap-4">
      <Link :href="`/admin/dashboard/kegiatan/elearning/${currentPage}/tambah_bab`" class="btn btn-primary-blue-6 text-neutral-white py-2">Tambah Bab
      </Link>
    </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Judul</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Link Video</th>
              <th scope="col">Bab</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
             <tr v-for="(index,no) in items">
              <th scope="row">{{++no}}</th>
                <td>{{index.judul}}</td>
                 <td><p>{{index.deskripsi}}</p></td>
                <td><p>{{index.link_video}}</p></td>
                <td><p>{{index.bab}}</p></td>
                 <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                <Link :href="`/admin/dashboard/kegiatan/elearning/bab/${index.id}/edit`" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </Link>
                <Link :href="`/admin/dashboard/kegiatan/${index.id}/hapus_bab`" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </Layout>
        <div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
          <li v-if="prev">
            <Link :href="`/admin/dashboard/users/umkm/${prev}`">
              <font-awesome-icon icon="fa-solid fa-chevron-left" class="text-primary-blue-6" />
            </Link>
          </li>
          <li v-if="first">
              <Link :href="`/admin/dashboard/users/umkm/${first}`">{{first}}</Link>
          </li>
          <li v-if="prevBlok">
              <Link :href="`/admin/dashboard/users/umkm/${prevBlok}`">...</Link>
          </li>
          <div v-for="num in paginationNums">
          <li :class="[currentPage == num ? 'active':'']">
              <Link :href="`/admin/dashboard/users/umkm/${num}`">{{num}}</Link>
          </li>
        </div>
        <li v-if="nextBlok">
          <Link :href="`/admin/dashboard/users/umkm/${nextBlok}`">...</Link>
        </li>
        <li v-if="last">
            <Link :href="`/admin/dashboard/users/umkm/${last}`">{{last}}</Link>
        </li>
          <li v-if="next">
            <Link :href="`/admin/dashboard/users/umkm/${next}`">
              <font-awesome-icon icon="fa-solid fa-chevron-right" class="text-primary-blue-6" />
            </Link>
          </li>
        </ul>
      </div>
</template>

<script>
import Layout from '../../../Layouts/Kegiatan.vue';
import { Link,useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
export default{
   data(){
      return{
        currentPage: document.location.pathname.split('/')[5]
      }
    },
    props:{
      items : Array,
      paginationNums : Array,
      nextBlok:Number,
      prevBlok:Number,
      prev:Number,
      next:Number,
      first:Number,
      last:Number,
      elearning:Object
    },
    components: {
      Link,
      Layout
    },
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
p{
    white-space: nowrap; 
  width: 200px; 
  overflow: hidden;
  text-overflow: ellipsis; 
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