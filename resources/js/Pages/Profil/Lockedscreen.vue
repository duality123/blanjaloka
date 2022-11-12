<template>
    <BaseLayout title="UMKM Profile">
    <section class="mt-10">
      <div class="container">
        <div class="row gap-4">
      <UmkmDashboardSidebar />    
          <div class="col-lg-8">
       <div class="d-flex justify-content-center align-items-center">
                <img src="../../assets/icons/pc_fail.png" class="gambar">
     </div>
     <div class="text-center">
              <h2>{{title}}</h2>
              <p>{{desc}}</p>
     </div>
     </div>
   </div>
 </div>
</section>
        </BaseLayout>
</template>

<script>
import BaseLayout from '../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../Components/UmkmDashboardSidebar.vue'
import { ref } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";
export default{
  data(){
    return{
      currentPage : window.location.pathname.split('/')[1],
    }
  },
  components:{
    BaseLayout,
    UmkmDashboardSidebar
  },
  props:{
    title:String,
    desc:String
  }
}
</script>

<style scoped>
.gambar{
  width: 300px;
}
section{
  margin-top: 10rem;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;

}
.hide{
  display: none;
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
  background-size: 19px 20px;
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

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}
.card h2 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #3E4041;
}
@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>
