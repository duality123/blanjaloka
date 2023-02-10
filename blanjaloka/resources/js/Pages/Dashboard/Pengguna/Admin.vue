<template>
  <DashboardLayout title="Peserta Admin">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4">
      <h1 class="text-neutral-gray-5 mb-0">Pengguna</h1>
    </div>
    <ul class="tabs mt-4">
      <li v-for="item in tabItems" :class="{'active': item.isActive}" @click="handleChangeCurrentTabItem(item.title)">
        <a :class="{'text-neutral-black': item.isActive, 'text-neutral-gray-4': !item.isActive}">{{ item.title }}</a>
      </li>
    </ul>
    <section v-if="currentTabItem == 'Admin'">
      <div class="d-flex justify-content-end">
        <a href="#" class="btn btn-primary-blue-6 text-neutral-white py-2">
          <font-awesome-icon icon="fa-solid fa-plus" /> Tambah Admin
        </a>
      </div>
      <div class="table-responsive">
        <table class="table mt-3">
          <thead class="table-primary-blue-4">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="index in 10">
              <th scope="row">{{ index }}</th>
              <td>Admin {{ index }}</td>
              <td>adminblanjaloka@gmail.com</td>
              <td class="d-flex flex-column flex-lg-row justify-content-center gap-4">
                <a href="#" class="btn btn-primary-blue-6 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Ubah Password
                </a>
                <a href="#" class="btn btn-semantic-success-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_update.png" alt="update icon">
                  Edit
                </a>
                <a href="#" class="btn btn-semantic-error-4 text-neutral-white">
                  <img src="../../../assets/icons/icon_delete.png" alt="delete icon">
                  Hapus
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <ul class="pagination">
          <li class="active">
            <a href="#">1</a>
          </li>
          <li>
            <a href="#">2</a>
          </li>
          <li>
            <a href="#">3</a>
          </li>
          <li>
            <a href="#">4</a>
          </li>
          <li>
            <a href="#">···</a>
          </li>
          <li>
            <a href="#">10</a>
          </li>
          <li>
            <a href="#">
              <font-awesome-icon icon="fa-solid fa-chevron-right" class="text-primary-blue-6" />
            </a>
          </li>
        </ul>
      </div>
    </section>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../../../Layouts/Dashboard.vue';
import { ref } from 'vue';

const tabItems = ref([
  {
    title: 'Admin',
    isActive: true
  },
  {
    title: 'Investor',
    isActive: false
  },
  {
    title: 'UMKM',
    isActive: false
  },
]);
const currentTabItem = ref('Admin');

const handleChangeCurrentTabItem = (title) => {
  tabItems.value = tabItems.value.map((tab) => {
    return tab.title == title ? { ...tab, isActive: true } : { ...tab, isActive: false };
  });
  currentTabItem.value = title;
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