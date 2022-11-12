<template>
  <BaseLayout title="Syarat dan Ketentuan">
    <section class="mt-4">
      <div class="container text-center">
         <div class="mb-5">
                    <img
                        src="../../assets/images/mail2.png"
                        alt=""
                        style="width: 10rem"
                    />
            </div>
            <h2><b>Verifikasi Email Anda !</b></h2>
            <p>Email akun <span class="text-primary-blue-6">Blanjaloka</span> Anda Berhasil diubah. Gunakan untuk masuk akun <span class="text-primary-blue-6">Blanjaloka</span> selanjutnya!</p>
      </div>
      <div class="form-section" style="margin-left: 32rem;">
         <form>
          <button type="submit"
                            class="btn btn-primary-blue-6 text-neutral-white mt-2">OK</button>
        </form>
      </div>
    </section>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '../../Layouts/Layout.vue'
import { ref } from 'vue'
const isCheckSyaratDanKetentuan = ref(false);
</script>

<style scoped>
form{

}
.form-label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0;
}

.form-control {
  border: none;
  border-radius: 0;
  border-bottom: 2px solid #AEAEAE;
  padding-left: 0;
  max-width: 24rem;
}

.form-control::-webkit-outer-spin-button,
.form-control::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.form-control:focus {
  box-shadow: none;
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
