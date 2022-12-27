<template>

  <Head>
    <title>Blanjaloka - Dashboard {{ title }}</title>
    <meta name="description" content="Your page description">
  </Head>
   <div id="myModal" class="modal"  v-if="$page.props.session.success">
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "removePopup" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
      <img src="../assets/images/success.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-between text-center" style="margin-left: 2rem;">
       <h2>{{$page.props.session.success}} Admin</h2>
        </div>
      </div>
    </div>
  <div class="container-fluid position-relative">
    <div class="row position-relative">
      <div class="col-lg-3 left_content bg-neutral-white" :class="{ 'active': isHamburgerMenuActive }">
        <div class="d-flex justify-content-center">
          <Link href="/dashboard">
          <img src="../assets/images/blanjaloka_logo_blue.png" id="logo" alt="blanjaloka logo" class="img-fluid">
          </Link>
        </div>
        <div class="section_one mt-4">
          <h2 class="text-neutral-gray-4">Menu</h2>
          <ul class="mt-4">
             <li class="rounded p-4" :class="{'bg-primary-blue-2': state === 'notifikasi'}">
                  <Link href="/notifikasi/admin/1" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black notification">
                  <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M1 16.875C0.783333 16.875 0.604333 16.8 0.463 16.65C0.321 16.5 0.25 16.325 0.25 16.125C0.25 15.9084 0.321 15.729 0.463 15.587C0.604333 15.4457 0.783333 15.375 1 15.375H2.25V8.12505C2.25 6.79172 2.66667 5.59572 3.5 4.53705C4.33333 3.47905 5.41667 2.80005 6.75 2.50005V1.80005C6.75 1.45005 6.871 1.15405 7.113 0.912049C7.35433 0.670715 7.65 0.550049 8 0.550049C8.35 0.550049 8.64567 0.670715 8.887 0.912049C9.129 1.15405 9.25 1.45005 9.25 1.80005V2.50005C10.5833 2.80005 11.6667 3.47905 12.5 4.53705C13.3333 5.59572 13.75 6.79172 13.75 8.12505V15.375H15C15.2167 15.375 15.396 15.4457 15.538 15.587C15.6793 15.729 15.75 15.9084 15.75 16.125C15.75 16.325 15.6793 16.5 15.538 16.65C15.396 16.8 15.2167 16.875 15 16.875H1ZM8 19.8C7.5 19.8 7.075 19.625 6.725 19.275C6.375 18.925 6.2 18.5 6.2 18H9.8C9.8 18.5 9.625 18.925 9.275 19.275C8.925 19.625 8.5 19.8 8 19.8ZM3.75 15.375H12.25V8.12505C12.25 6.94172 11.8333 5.93738 11 5.11205C10.1667 4.28738 9.16667 3.87505 8 3.87505C6.83333 3.87505 5.83333 4.28738 5 5.11205C4.16667 5.93738 3.75 6.94172 3.75 8.12505V15.375Z"
                      fill="#686868" />
                  </svg>
                  <span> Notifikasi</span>
                  <span v-if="$page.props.auth.user.notifikasi" class="badge">{{$page.props.auth.user.notifikasi}}</span>
                </Link>
              </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': state === 'overview'}">
              <Link href="/admin/dashboard" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
              <img src="../assets/icons/icon_dashboard_dashboard.png" alt="icon dashboard" class="img-fluid">Dashboard
              </Link>
            </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': state === 'kegiatan'}">
              <Link href="/admin/dashboard/kegiatan?page=1"
                class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
              <img src="../assets/icons/icon_kegiatan_dashboard.png" alt="icon kegiatan" class="img-fluid">Kegiatan
              </Link>
            </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': state === 'funding'}">
              <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
                <img src="../assets/icons/icon_funding_dashboard.png" alt="icon funding" class="img-fluid">Funding
              </a>
            </li>
            <li>
              <a class="text-decoration-none">
                <div @click="toggleMenuPengguna"
                  class="d-flex justify-content-between align-items-center text-neutral-black rounded p-4"
                  :class="{'bg-primary-blue-2': state === 'pengguna'}">
                  <div class="d-flex align-items-center gap-2">
                    <img src="../assets/icons/icon_pengguna_dashboard.png" alt="icon pengguna"
                      class="img-fluid">Pengguna
                  </div>
                  <font-awesome-icon :icon="iconMenuPenggunaType" class="text-primary-blue-6" />
                </div>
                <ul v-if="isMenuPenggunaActive" class="sub_menu">
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/admin/dashboard/pengguna/1/'}">
                    <Link href="/admin/dashboard/pengguna/1?page=1" class="text-decoration-none text-neutral-black">
                    Admin</Link>
                  </li>
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/admin/dashboard/pengguna/3?page=1'}">
                    <Link href="/admin/dashboard/pengguna/3?page=1" class="text-decoration-none text-neutral-black">Investor</Link>
                  </li>
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/admin/dashboard/pengguna/2?page=1'}">
                    <Link href="/admin/dashboard/pengguna/2?page=1" class="text-decoration-none text-neutral-black">
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
              <h2 class="text-neutral-black">{{$page.props.auth.user.name}}</h2>
              <p class="text-neutral-gray-3 mb-0">{{$page.props.auth.user.email}}</p>
            </div>
          </div>
          <div class="d-grid mt-5">
            <form @submit.prevent="logout">
                <button class="btn btn-semantic-error-1 text-semantic-error-4 py-3" type="submit">
                  <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" /> Logout</button>
            </form>

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
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,onUnmounted } from 'vue';
import { computed } from 'vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";

const isPasswordVisible = ref(false);
const passwordInputType = ref('password');
const passwordEyeType = ref('fa-solid fa-eye-slash');
const isMenuPenggunaActive = ref(false);
const iconMenuPenggunaType = ref('fa-solid fa-chevron-right');
const isHamburgerMenuActive = ref(false);
const iconHamburgerMenuType = ref('fa-solid fa-ellipsis');
const currentRotation = ref(0);
const currentSize = ref(100);
const props = defineProps({
  title: {
    type: String,
    default: 'Berikan judul disini'
  },
  state:{
    type:String,
    default:'berikan judul'
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

let intervalId;
onMounted(() => {

  const { url } = usePage();
  console.log(usePage().props.value.auth.user);
  if (url.value == '/admin/dashboard/pengguna/umkm' || url.value == '/admin/dashboard/pengguna/admin') {
    isMenuPenggunaActive.value = true;
  };

intervalId =  setInterval(()=>{
    if(currentRotation.value == 0){
      currentRotation.value = 20
    }
    else{
      currentRotation.value = 0;
    }
    document.getElementById('logo').style.transform = 'rotate('+currentRotation.value+'deg)';
  }, 1000);
});
onUnmounted(() => clearInterval(intervalId))
const logout = () => {
  Inertia.post('/logout',{
    _token: usePage().props.csrf_token
  })
};
const removePopup = () => {
  usePage().props.value.session.success = false;
}
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
.left_content ul li:nth-child(5):hover {
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
.notification {
  color: white;
  text-decoration: none;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {
}

.notification .badge {
  position: absolute;
  top: -20px;
  right: -30px;
  padding: 10px 10px;
  border-radius: 50%;
  background: red;
  color: white;
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


@media (max-width: 575.98px) {
  .modal-content{
    margin-left: 3rem;
    margin-top: 5rem;
    width: 450px;
  }
}
</style>