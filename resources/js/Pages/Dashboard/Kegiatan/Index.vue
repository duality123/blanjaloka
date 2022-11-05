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
</style>