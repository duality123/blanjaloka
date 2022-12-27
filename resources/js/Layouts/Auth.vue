<template>

  <Head>
    <title>Blanjaloka - {{ title }}</title>
    <meta name="description" content="Your page description">
  </Head>
  <div class="container-fluid">
    <div class="row min-vh-100">
        <div id="myModal" class="modal"  v-if="$page.props.session.status">
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
       <h2>Password anda berhasil direset , silahkan login :)</h2>
        </div>
      </div>
    </div>
      <div class="col-lg " id ="animationsidebar"></div>
      <div class="col-lg right_content">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head,usePage } from '@inertiajs/inertia-vue3'
import {onMounted} from 'vue';
import lottie from 'lottie-web';

const props = defineProps({
  title: {
    type: String,
    default: 'Berikan judul disini'
  }
});
onMounted(()=>{
      lottie.loadAnimation({
      container: document.getElementById('animationsidebar'),
      path: '../storage/loginsidebar.json',
      renderer: 'svg',
      loop: true,
      autoplay: true,
      name: "Demo Animation",
})
});

const removePopup = () => {
  usePage().props.value.session.status = false;
}


</script>

<style>
h1 {
  font-size: 24px;
  font-weight: 600;
  margin-top: 3rem;
}

p {
  font-size: 16px;
  font-weight: 400;
  margin-bottom: 0;
}

form {
  margin-top: 1.5rem;
}

.icon_eye {
  bottom: 0.8rem;
  right: 0;
  cursor: pointer;
}

.oauth_choose {
  display: grid;
  grid-template-columns: 1fr 1.5fr 1fr;
  align-items: center;
  justify-items: center;
  column-gap: 0.5rem;
}

.line {
  width: 100%;
  height: 2px;
  background-color: #AEAEAE;
}

@media (max-width: 575.98px) {
  .left_content {
    display: none;
  }

  .oauth_choose {
    grid-template-columns: 1fr 2fr 1fr;
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
