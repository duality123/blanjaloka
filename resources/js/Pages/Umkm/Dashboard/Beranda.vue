<template>
  <BaseLayout title="Syarat dan Ketentuan">
    <section class="mt-4">
      <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col" v-for="item in items">
    <div class="card">
      <img :src="`${this.$page.props.asset_url}/${item.gambar}`" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{item.tema}}</h5>
        <small>{{item.dimulai}} - {{item.berakhir}}</small>
         <p>{{item.total_peserta}}/{{item.jumlah_orang_diundang}} peserta mengikuti kegiatan ini. </p>
        <p class="card-text">{{item.deskripsi}}</p>
         <Link v-if="item.jumlah_orang_diundang > item.total_peserta" :href = "`/umkm/join/${item.id}`" class="btn btn-outline-primary-blue-6 py-2 btn_custom_outline">
                        Join Kegiatan</Link>
           <Link v-else :href = "`/umkm/join/${item.id}`" class="btn btn-danger py-2 btn_custom_outline">
                        Kegiatan sudah penuh !</Link>
      </div>
    </div>
  </div>
</div>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
          <li v-if="prev">
            <Link :href="`/umkm/dashboard/beranda/${prev}`">
              <font-awesome-icon icon="fa-solid fa-chevron-left" class="text-primary-blue-6" />
            </Link>
          </li>
          <li v-if="first">
              <Link :href="`/umkm/dashboard/beranda/${first}`">{{first}}</Link>
          </li>
          <li v-if="prevBlok">
              <Link :href="`/umkm/dashboard/beranda/${prevBlok}`">...</Link>
          </li>
          <div v-for="num in paginationNums">
          <li :class="[currentLink== num ? 'active':'']">
              <Link :href="`/umkm/dashboard/beranda/${num}`">{{num}}</Link>
          </li>
        </div>
        <li v-if="nextBlok">
          <Link :href="`/umkm/dashboard/beranda/${nextBlok}`">...</Link>
        </li>
        <li v-if="last">
            <Link :href="`/umkm/dashboard/beranda/${last}`">{{last}}</Link>
        </li>
          <li v-if="next">
            <Link :href="`/umkm/dashboard/beranda/${next}`">
              <font-awesome-icon icon="fa-solid fa-chevron-right" class="text-primary-blue-6" />
            </Link>
          </li>
        </ul>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../../Layouts/Layout.vue'
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
export default{
  data(){
    return{
      currentLink : window.location.pathname.split('/')[4]
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
      last:Number
  },
  components:{
    BaseLayout,
    Link
  },
  setup(){
      document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
}
</script>

<style scoped>
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
section {
  margin-top: 10rem !important;
}
h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}
ul {
  list-style: decimal;
  padding: 0;
}
ul li {
  margin-left: 1rem;
  margin-bottom: 0.5rem;
}
form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 2.5rem;
  margin-top: 6.25rem;
}
.form-check-label {
  font-weight: 600;
  color: #3E4041;
}
form button {
  padding: 0.5rem 10rem;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
  form button {
    width: 100%;
    padding: 0.5rem 0;
  }
}
</style>
