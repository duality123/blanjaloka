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
       <div id="myModal" class="modal"  v-else-if="$page.props.session.error">
      <div class="modal-content">
        <div class=" d-flex justify-content-end">
         <button @click = "removePopup" type="button" class="close" data-dismiss="modal" aria-label="Close" style="max-width: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class=" d-flex justify-content-between">
      <img src="../assets/images/warning.png" style="width: 50%; margin-left: 8rem;">
        </div>
       <div class="d-flex justify-content-between text-center" style="margin-left: 2rem;">
       <h2>{{$page.props.session.error}} Admin</h2>
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
             <li class="rounded py-3 px-4" :class="{'bg-primary-blue-2': state === 'notifikasi'}">
                  <Link href="/notifikasi/admin?page=1" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black notification">
                  <svg width="16" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M1 16.875C0.783333 16.875 0.604333 16.8 0.463 16.65C0.321 16.5 0.25 16.325 0.25 16.125C0.25 15.9084 0.321 15.729 0.463 15.587C0.604333 15.4457 0.783333 15.375 1 15.375H2.25V8.12505C2.25 6.79172 2.66667 5.59572 3.5 4.53705C4.33333 3.47905 5.41667 2.80005 6.75 2.50005V1.80005C6.75 1.45005 6.871 1.15405 7.113 0.912049C7.35433 0.670715 7.65 0.550049 8 0.550049C8.35 0.550049 8.64567 0.670715 8.887 0.912049C9.129 1.15405 9.25 1.45005 9.25 1.80005V2.50005C10.5833 2.80005 11.6667 3.47905 12.5 4.53705C13.3333 5.59572 13.75 6.79172 13.75 8.12505V15.375H15C15.2167 15.375 15.396 15.4457 15.538 15.587C15.6793 15.729 15.75 15.9084 15.75 16.125C15.75 16.325 15.6793 16.5 15.538 16.65C15.396 16.8 15.2167 16.875 15 16.875H1ZM8 19.8C7.5 19.8 7.075 19.625 6.725 19.275C6.375 18.925 6.2 18.5 6.2 18H9.8C9.8 18.5 9.625 18.925 9.275 19.275C8.925 19.625 8.5 19.8 8 19.8ZM3.75 15.375H12.25V8.12505C12.25 6.94172 11.8333 5.93738 11 5.11205C10.1667 4.28738 9.16667 3.87505 8 3.87505C6.83333 3.87505 5.83333 4.28738 5 5.11205C4.16667 5.93738 3.75 6.94172 3.75 8.12505V15.375Z"
                      fill="#686868" />
                  </svg>
                  <span> Notifikasi</span>
                     <div style="margin-left:90px" v-if="$page.props.auth.user.notifikasi" class="bg-primary-blue-6 text-neutral-white fw-normal py-2 px-3 rounded">{{$page.props.auth.user.notifikasi}}</div>
                  
                </Link>
              </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': state === 'overview'}">
              <Link href="/admin/dashboard?page=1" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
              <img src="../assets/icons/icon_dashboard_dashboard.png" alt="icon dashboard" class="img-fluid">Dashboard
              </Link>
            </li>
                <li class="rounded py-3 px-4"  :class="{ 'bg-primary-blue-2': state== 'janjitemu' }">
          <Link href="/admin/janjitemu?page=1" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
           <svg width="20" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M12.725 19.375L10.675 17.35C10.5417 17.2 10.475 17.0207 10.475 16.812C10.475 16.604 10.55 16.4333 10.7 16.3C10.8333 16.1667 11.0043 16.1 11.213 16.1C11.421 16.1 11.5917 16.1667 11.725 16.3L13.325 17.9L17.05 14.175C17.2 14.0417 17.375 13.975 17.575 13.975C17.775 13.975 17.95 14.05 18.1 14.2C18.25 14.35 18.325 14.525 18.325 14.725C18.325 14.925 18.25 15.1 18.1 15.25L14 19.375C13.8167 19.5583 13.6 19.65 13.35 19.65C13.1 19.65 12.8917 19.5583 12.725 19.375ZM6 13.05L4.925 14.125C4.775 14.2583 4.6 14.325 4.4 14.325C4.2 14.325 4.025 14.2583 3.875 14.125C3.74167 13.975 3.675 13.796 3.675 13.588C3.675 13.3793 3.74167 13.2083 3.875 13.075L4.95 12L3.875 10.925C3.74167 10.775 3.675 10.5957 3.675 10.387C3.675 10.179 3.74167 10.0083 3.875 9.875C4.025 9.74167 4.20433 9.675 4.413 9.675C4.621 9.675 4.79167 9.74167 4.925 9.875L6 10.95L7.075 9.875C7.225 9.74167 7.40433 9.675 7.613 9.675C7.821 9.675 7.99167 9.74167 8.125 9.875C8.25833 10.0083 8.325 10.179 8.325 10.387C8.325 10.5957 8.25833 10.775 8.125 10.925L7.05 12L8.125 13.075C8.25833 13.225 8.325 13.4 8.325 13.6C8.325 13.8 8.25833 13.975 8.125 14.125C7.99167 14.2583 7.821 14.325 7.613 14.325C7.40433 14.325 7.225 14.2583 7.075 14.125L6 13.05ZM2.3 19.5C1.8 19.5 1.375 19.325 1.025 18.975C0.675 18.625 0.5 18.2 0.5 17.7V4.3C0.5 3.8 0.675 3.375 1.025 3.025C1.375 2.675 1.8 2.5 2.3 2.5H3.7V1.15C3.7 0.933333 3.77067 0.75 3.912 0.6C4.054 0.45 4.23333 0.375 4.45 0.375C4.68333 0.375 4.87067 0.45 5.012 0.6C5.154 0.75 5.225 0.933333 5.225 1.15V2.5H12.8V1.125C12.8 0.925 12.875 0.75 13.025 0.6C13.175 0.45 13.35 0.375 13.55 0.375C13.7667 0.375 13.9457 0.45 14.087 0.6C14.229 0.75 14.3 0.925 14.3 1.125V2.5H15.7C16.2 2.5 16.625 2.675 16.975 3.025C17.325 3.375 17.5 3.8 17.5 4.3V10.35L16 11.875V8.3H2V17.7C2 17.7833 2.02933 17.8543 2.088 17.913C2.146 17.971 2.21667 18 2.3 18H7.975L9.475 19.5H2.3ZM2 6.8H16V4.3C16 4.21667 15.971 4.146 15.913 4.088C15.8543 4.02933 15.7833 4 15.7 4H2.3C2.21667 4 2.146 4.02933 2.088 4.088C2.02933 4.146 2 4.21667 2 4.3V6.8Z"
              fill="#AEAEAE" />
          </svg>
          <span>Janji Temu</span>
        </Link>
      </li>
             <li class="rounded py-3 px-3 " :class="{'bg-primary-blue-2': state === 'info'}">
                  <Link href="/admin/info_admin?page=1" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black notification">
                  <svg width="30px" height="30px" viewBox="20 6 20 50" xmlns="http://www.w3.org/2000/svg" stroke-width="1" stroke="#000000" fill="none">
                    <path d="M11.51,20.66h8.38a0,0,0,0,1,0,0V37.21a0,0,0,0,1,0,0H11.51a2,2,0,0,1-2-2V22.66A2,2,0,0,1,11.51,20.66Z"/><path d="M19.89,37.21V20.66s4.37.1,11.64,0,15.78-4.7,21.31-9.4a1,1,0,0,1,1.65.75V45.9a1,1,0,0,1-1.61.79c-3.56-2.8-12.42-9.06-21-9.32C26.86,37.21,22.8,37.21,19.89,37.21Z"/><path d="M23.29,53h-4.8a2,2,0,0,1-2-2l-1-13.78h8.8l1,13.78A2,2,0,0,1,23.29,53Z"/>
                  </svg>
                  <span>Info Admin</span>
                </Link>
              </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': state === 'kegiatan'}">
              <Link href="/admin/kegiatan?page=1"
                class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
              <img src="../assets/icons/icon_kegiatan_dashboard.png" alt="icon kegiatan" class="img-fluid">Kegiatan
              </Link>
            </li>
            <li class="rounded p-4" :class="{'bg-primary-blue-2': state === 'funding'}">
              <Link href="/admin/investasi?page=1" class="d-flex align-items-center gap-2 text-decoration-none text-neutral-black">
                <img src="../assets/icons/icon_funding_dashboard.png" alt="icon funding" class="img-fluid">Bisnis
              </Link>
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
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/admin/pengguna/1/?page=1'}">
                    <Link href="/admin/pengguna/1?page=1" class="text-decoration-none text-neutral-black">
                    Admin</Link>
                  </li>
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/admin/pengguna/3?page=1'}">
                    <Link href="/admin/pengguna/3?page=1" class="text-decoration-none text-neutral-black">Investor</Link>
                  </li>
                  <li class="rounded p-3" :class="{'bg-primary-blue-2': $page.url === '/admin/pengguna/2?page=1'}">
                    <Link href="/admin/pengguna/2?page=1" class="text-decoration-none text-neutral-black">
                    UMKM</Link>
                  </li>
                </ul>
              </a>
            </li>
            <li class="rounded py-3 px-4" :class="{'bg-primary-blue-2': state === 'pesan'}">
              <Link href="/admin/pesan?page=1" class="d-flex justify-content-between text-decoration-none text-neutral-black">
                <div class="d-flex align-items-center gap-2">
                  <img src="../assets/icons/icon_pesan_dashboard.png" alt="icon pesan" class="img-fluid">Pesan
                </div>
                <div class="bg-primary-blue-6 text-neutral-white fw-normal py-2 px-3 rounded" v-if="$page.props.auth.user.notif_pesan">{{$page.props.auth.user.notif_pesan}}</div>
              </Link>
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
   usePage().props.value.session.error = false;
}
</script>
<style>
  .btn_custom_outline:hover {
    color: #FFFFFF !important;
}
</style>
<style scoped>
.btn_custom_outline:hover {
    color: #FFFFFF !important;
}
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
.left_content ul li:nth-child(7):hover {
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