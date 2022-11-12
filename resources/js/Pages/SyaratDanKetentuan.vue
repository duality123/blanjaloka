<template>
  <BaseLayout title="Syarat dan Ketentuan">
    <section class="mt-4">
      <div class="container">
        <h1>Syarat dan Ketentuan</h1>
        <p>Berikut adalah yarat dan ketentuan untuk UMKM dapat mengikuti inkubasi di Blanjaloka Akselerator:</p>
        <ul>
          <li>UMKM Anda telah terdaftar sebagai <strong>seller di Blanjaloka</strong></li>
          <li>Berada pada usia produktif yaitu <strong>15 sampai 64 tahun</strong> (Menurut Badan Pusat Statistik (BPS))
          </li>
          <li>UMKM Anda merupakan <strong>milik Anda sendiri</strong> dan telah berjalan <strong>minimal 6
              bulan</strong></li>
          <li>Melengkapi data pribadi dan usaha yang diperlukan</li>
        </ul>
        <form @submit.prevent="this.$inertia.visit('/profil/1')">
          <div class="form-check">
            <input v-model="isCheckSyaratDanKetentuan" class="form-check-input" type="checkbox" id="kebijakan_privasi">
            <label class="form-check-label" for="kebijakan_privasi">
              Saya telah membaca dan mengerti syarat dan ketentuan inkubasi di Blanjaloka Akselerator seperti yang
              tertera diatas
            </label>
          </div>
          <button type="submit" :disabled="!isCheckSyaratDanKetentuan" class="btn text-neutral-white"
            :class="{'btn-primary-blue-6': isCheckSyaratDanKetentuan, 'btn-primary-blue-3': !isCheckSyaratDanKetentuan}">Lanjutkan</button>
        </form>
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../Layouts/Layout.vue'
import { ref } from 'vue'
export default{
  data(){
    return{
      isCheckSyaratDanKetentuan : null
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
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 2.5rem;
  margin-top: 6.25rem;
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

  form button {
    width: 100%;
    padding: 0.5rem 0;
  }
}
</style>