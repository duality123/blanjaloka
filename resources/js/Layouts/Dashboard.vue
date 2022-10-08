<template>

  <Head>
    <title>Blanjaloka - Dashboard {{ title }}</title>
    <meta name="description" content="Your page description">
  </Head>
  <div class="container-fluid position-relative">
    <div class="row position-relative">
      <div class="col-lg-3 left_content bg-neutral-white" :class="{'active': isHamburgerMenuActive}">
        <div class="d-flex justify-content-center">
          <Link href="/dashboard">
          <img src="../assets/images/blanjaloka_logo_blue.png" alt="blanjaloka logo" class="img-fluid">
          </Link>
        </div>
        <div class="section_one mt-4">
          <h2 class="text-neutral-gray-4">Menu</h2>
          <ul class="mt-4">
            <li class="rounded p-4" :class="{'bg-primary-blue-2': $page.url === '/dashboard'}">
              <Link href="/dashboard" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
              <img src="../assets/icons/icon_dashboard_dashboard.png" alt="icon dashboard" class="img-fluid">Dashboard
              </Link>
            </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': $page.url === '/dashboard/kegiatan'}">
              <Link href="/dashboard/kegiatan"
                class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
              <img src="../assets/icons/icon_kegiatan_dashboard.png" alt="icon kegiatan" class="img-fluid">Kegiatan
              </Link>
            </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': $page.url === '/funding'}">
              <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
                <img src="../assets/icons/icon_funding_dashboard.png" alt="icon funding" class="img-fluid">Funding
              </a>
            </li>
            <li>
              <a class="text-decoration-none">
                <div @click="toggleMenuPengguna"
                  class="d-flex justify-content-between align-items-center text-neutral-black rounded p-4"
                  :class="{'bg-primary-blue-2': $page.url === '/pengguna'}">
                  <div class="d-flex align-items-center gap-2">
                    <img src="../assets/icons/icon_pengguna_dashboard.png" alt="icon pengguna"
                      class="img-fluid">Pengguna
                  </div>
                  <font-awesome-icon :icon="iconMenuPenggunaType" class="text-primary-blue-6" />
                </div>
                <ul v-if="isMenuPenggunaActive" class="sub_menu">
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/dashboard/pengguna/admin'}">
                    <Link href="/dashboard/pengguna/admin" class="text-decoration-none text-neutral-black">
                    Admin</Link>
                  </li>
                  <li class="rounded p-3">
                    <a href="#" class="text-decoration-none text-neutral-black">Investor</a>
                  </li>
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/dashboard/pengguna/umkm'}">
                    <Link href="/dashboard/pengguna/umkm" class="text-decoration-none text-neutral-black">
                    UMKM</Link>
                  </li>
                </ul>
              </a>
            </li>
            <li class="rounded py-3 px-4" :class="{'bg-primary-blue-2': $page.url === '/pesan'}">
              <a href="#" class="d-flex justify-content-between text-decoration-none text-neutral-black">
                <div class="d-flex align-items-center gap-2">
                  <img src="../assets/icons/icon_pesan_dashboard.png" alt="icon pesan" class="img-fluid">Pesan
                </div>
                <div class="bg-primary-blue-6 text-neutral-white fw-normal py-2 px-3 rounded">10</div>
              </a>
            </li>
          </ul>
        </div>
        <div class="section_two">
          <h2 class="text-neutral-gray-4">Profile</h2>
          <div class="d-flex flex-row align-items-center gap-3 mt-4">
            <img src="../assets/images/user_profile_img.png" alt="user profile img" class="img-fluid">
            <div>
              <h2 class="text-neutral-black">Admin 1</h2>
              <p class="text-neutral-gray-3 mb-0">adminadmin@gmail.com</p>
            </div>
          </div>
          <div class="d-grid mt-5">
            <a href="#" class="btn btn-semantic-error-1 text-semantic-error-4 py-3">
              <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" />
              Log out
            </a>
          </div>
        </div>
      </div>
      <div class="col right_content bg-neutral-white-2 min-vh-100">
        <slot />
      </div>
    </div>
    <div class="bg-neutral-white shadow menu_toggle" @click="toggleHamburgerMenu">
      <font-awesome-icon :icon="iconHamburgerMenuType" />
    </div>
  </div>
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue';

const isMenuPenggunaActive = ref(false);
const iconMenuPenggunaType = ref('fa-solid fa-chevron-right');
const isHamburgerMenuActive = ref(false);
const iconHamburgerMenuType = ref('fa-solid fa-ellipsis');

const props = defineProps({
  title: {
    type: String,
    default: 'Berikan judul disini'
  }
});

const toggleMenuPengguna = () => {
  isMenuPenggunaActive.value = !isMenuPenggunaActive.value;
  iconMenuPenggunaType.value = isMenuPenggunaActive.value ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-right';
}
const toggleHamburgerMenu = () => {
  isHamburgerMenuActive.value = !isHamburgerMenuActive.value;
  iconHamburgerMenuType.value = isHamburgerMenuActive.value ? 'fa-solid fa-ellipsis-vertical' : 'fa-solid fa-ellipsis';
}

onMounted(() => {
  const { url } = usePage();

  if (url.value == '/dashboard/pengguna/umkm' || url.value == '/dashboard/pengguna/admin') {
    isMenuPenggunaActive.value = true;
  };
});
</script>

<style scoped>
.menu_toggle {
  display: none;
}

.left_content {
  padding: 1.5rem;
}

.left_content h2 {
  font-size: 1rem;
  font-weight: 600;
}

.left_content ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.left_content ul li {
  cursor: pointer;
  margin-bottom: 1.5rem;
  transition: 300ms;
}

.left_content ul li:hover {
  background-color: #E4F0F6;
  transform: scale(1.010);
}

.left_content ul li:nth-child(4):hover {
  background-color: transparent;
}

.left_content ul li a {
  font-weight: 600;
}

.left_content ul.sub_menu {
  padding-left: 1rem;
  margin-left: 2rem;
  border-left: 1px solid #D7E8F1;
}

.left_content .section_two {
  margin-top: 4rem;
}

.left_content .section_two img {
  transform: scale(1.3);
}

.left_content .section_two a {
  font-weight: 600;
}

.right_content {
  padding: 2rem
}

@media (max-width: 575.98px) {
  .menu_toggle {
    width: 3rem;
    height: 3rem;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    border-radius: 50%;
    z-index: 99;
  }

  .menu_toggle svg {
    font-size: 1.5rem;
  }

  .left_content {
    display: none;
  }

  .left_content.active {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1;
  }
}
</style>