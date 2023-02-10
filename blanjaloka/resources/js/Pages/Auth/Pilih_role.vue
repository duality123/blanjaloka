<template>
  <BaseLayout title="Syarat dan Ketentuan">
    <section class="mt-4">
      <div class="container">
        <h1 class="text-center">Anda adalah ?</h1>
        <div class="d-flex justify-content-center bd-highlight mb-3">
        <form @submit.prevent="this.$inertia.visit('/profil/1')">
          <div class="flex-container">
          <div class="form-check">
            <input v-model="isCheckSyaratDanKetentuan" class="form-check-input" type="checkbox" id="kebijakan_privasi">
            <label class="form-check-label" for="kebijakan_privasi">
              Investor
            </label>
          </div>
          <div class="form-check">
            <input v-model="isCheckSyaratDanKetentuan" class="form-check-input" type="checkbox" id="kebijakan_privasi">
            <label class="form-check-label" for="kebijakan_privasi">
              UMKM
            </label>
          </div>
          </div>
          <button type="submit" :disabled="!isCheckSyaratDanKetentuan" class="btn text-neutral-white"
            :class="{'btn-primary-blue-6': isCheckSyaratDanKetentuan, 'btn-primary-blue-3': !isCheckSyaratDanKetentuan}">Lanjutkan</button>
        </form>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../../Layouts/Layout.vue'
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
export default{
  
  data(){
    return{
      role : null
    }
  },
  beforeCreate(){
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  },
  components:{
    BaseLayout
  }
}
</script>

<style scoped>
.flex-container{
   margin-left: 150px;
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
  align-items: center;
  gap: 8rem;
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
  .flex-container{
    margin-left: 10px;
  }

  form button {
    width: 100%;
    padding: 0.5rem 0;
  }
}
</style>