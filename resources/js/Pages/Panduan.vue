<template>
  <BaseLayout title="Kebijakan Privasi">
    <section class="mt-4">
      <div class="container">
        <h1>Panduan</h1>
        <p>
          Register,login,ikuti kegiatan (investasi) !.
        </p>
      
      </div>
    </section>
  </BaseLayout>
</template>

<script>
import BaseLayout from '../Layouts/UnauthenticatedLayout.vue'
import { ref } from 'vue'
export default{
  data(){
    return{
      isCheckKebijakanPrivasi : null
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

p {
  margin-bottom: 1rem;
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