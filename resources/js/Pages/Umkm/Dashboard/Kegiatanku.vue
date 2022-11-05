<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h1>Kegiatanku</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../Components/UmkmDashboardSidebar.vue'
</script>

<style scoped>
section {
  margin-top: 10rem !important;
}

.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.sidebar ul li {
  padding: 1rem;
  cursor: pointer;
}

.sidebar ul li.active {
  border: 1px solid #AEAEAE;
  border-radius: 0.5rem;
}

.sidebar ul li.active a span,
.sidebar ul li.active a path {
  color: #398AB9;
  fill: #398AB9;
}

.sidebar ul li a {
  width: max-content;
  text-decoration: none;
  font-weight: 600;
  position: relative;
}

.sidebar ul li a span {
  width: max-content;
  position: absolute;
  left: 2rem;
}

.card h1 {
  font-size: 2rem;
  font-weight: 600;
  color: #181A1B;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>