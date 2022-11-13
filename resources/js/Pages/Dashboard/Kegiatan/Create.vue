<template>

  <DashboardLayout title="Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Kegiatan</h1>
      <Link href="/admin/dashboard/kegiatan/create" class="btn btn-primary-blue-6 text-neutral-white py-2">
      </Link>
    </div>
      <ul class="mt-4">
                    <li class="active">
                      <Link class="active" :href="`/admin/dashboard/kegiatan/5/detail/deskripsi/${kegiatan.id}`">Deskripsi</Link>
                    </li>
                   <li class="active">
                      <Link class="active" :href="``">Elearning</Link>
                    </li>
                    <li >
                        <Link :href="``" >Eventual</Link>
                    </li>
                    <li >
                        <Link :href="``">Logbook</Link>
                    </li>
      </ul>

  </DashboardLayout>
</template>

<script>
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
export default{
  props:{
    kegiatan:Object
  },
  components:{
    DashboardLayout
  }
}
</script>

<style scoped>
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
ul li.active {
  border-bottom: 2px solid #398AB9;
}
ul li a {
  text-decoration: none;
  font-weight: 600;
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
</style>