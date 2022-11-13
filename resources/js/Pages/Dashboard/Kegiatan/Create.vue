<template>

  <DashboardLayout title="Kegiatan">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Kegiatan</h1>
      <Link href="/admin/dashboard/kegiatan/create" class="btn btn-primary-blue-6 text-neutral-white py-2">
      <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Kegiatan
      </Link>
    </div>
    <ul class="mt-4">
      <li v-for="item in tabItems" :class="{ 'active': item.isActive }" @click="handleChangeCurrentTabItem(item.title)">
        <a :class="{ 'text-neutral-black': item.isActive, 'text-neutral-gray-4': !item.isActive }">{{ item.title }}</a>
      </li>
    </ul>

  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
const tabItems = ref([
  {
    title: 'E-Learning',
    isActive: true
  },
  {
    title: 'Eventual',
    isActive: false
  },
  {
    title: 'Logbook',
    isActive: false
  },
  {
    title: 'Penilaian',
    isActive: false
  },
]);
const handleChangeCurrentTabItem = (title) => {
  tabItems.value = tabItems.value.map((tab) => {
    return tab.title == title ? { ...tab, isActive: true } : { ...tab, isActive: false };
  });
=======
import { useForm, Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';

const form = useForm({
  tema_kegiatan: '',
  deskripsi_kegiatan: '',
  jumlah_partisipan: null,
  nama_juri: null,
  nama_investor: null,
  masa_inkubasi: null,
  kurikulum: '',
  pic: null,
  kontak_nomor_pic: null
});

const refDeskripsiKegiatan = ref(null);
const refJumlahPartisipan = ref(null);
const refMasaInkubasi = ref(null);

const handleResizeDeskripsiKegiatan = () => {
  refDeskripsiKegiatan.value.style.height = `${refDeskripsiKegiatan.value.scrollHeight}px`;
}
const handleResizeJumlahPartisipan = () => {
  refJumlahPartisipan.value.style.width = '1.5rem';
}
const handleResizeMasaInkubasi = () => {
  refMasaInkubasi.value.style.width = '1.5rem';
}

const handleSubmit = () => {
  console.log(form);
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