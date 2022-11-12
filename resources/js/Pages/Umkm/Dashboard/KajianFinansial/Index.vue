<template>
  <BaseLayout title="UMKM Profile">
    <section class="mt-4">
      <div class="container">
        <div class="row gap-4">
          <UmkmDashboardSidebar />
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h1>Kajian Finansial</h1>
                <p>
                  Harap masukkan data Anda dengan benar.
                </p>
                <form class="mt-4">
                  <div class="mb-4">
                    <label for="capex" class="form-label text-neutral-gray-5">Capital Expenditure (CAPEX)</label>
                    <input type="text" class="form-control" id="capex" placeholder="Masukkan concession asset Anda">
                  </div>
                  <div class="mb-4">
                    <label for="opex" class="form-label text-neutral-gray-5">Operational Expenditure (OPEX)</label>
                    <input type="text" class="form-control" id="opex" placeholder="Masukkan OPEX Anda">
                  </div>
                  <div class="mb-4">
                    <label for="swot_external" class="form-label text-neutral-gray-5">SWOT (Eksternal)</label>
                    <input type="text" class="form-control" id="swot_external"
                      placeholder="Masukkan SWOT eksternal produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="swot_internal" class="form-label text-neutral-gray-5">SWOT (Internal)</label>
                    <input type="text" class="form-control" id="swot_internal"
                      placeholder="Masukkan SWOT internal produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="payback_period" class="form-label text-neutral-gray-5">Payback Period</label>
                    <input type="text" class="form-control" id="payback_period"
                      placeholder="Masukkan payback period usaha Anda">
                  </div>
                  <div class="mb-4">
                    <label for="key_partner" class="form-label text-neutral-gray-5">Key Partner</label>
                    <input type="text" class="form-control" id="key_partner"
                      placeholder="Masukkan key partner produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="key_activity" class="form-label text-neutral-gray-5">Key Activity</label>
                    <input type="text" class="form-control" id="key_activity"
                      placeholder="Masukkan key activity produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="value_prop" class="form-label text-neutral-gray-5">Value Propotitions</label>
                    <input type="text" class="form-control" id="value_prop"
                      placeholder="Masukkan value propotition produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="customer_relationship" class="form-label text-neutral-gray-5">Customer
                      Relationship</label>
                    <input type="text" class="form-control" id="customer_relationship"
                      placeholder="Masukkan customer relationship usaha Anda">
                  </div>
                  <div class="mb-4">
                    <label for="cost_structure" class="form-label text-neutral-gray-5">Cost Structure</label>
                    <input type="text" class="form-control" id="cost_structure"
                      placeholder="Masukkan cost structure produk Anda">
                  </div>
                  <div class="mb-4">
                    <label for="channels" class="form-label text-neutral-gray-5">Channels</label>
                    <input type="text" class="form-control" id="channels" placeholder="Masukkan channels usaha Anda">
                  </div>
                  <div class="mb-4">
                    <label for="revenue_stream" class="form-label text-neutral-gray-5">Revenue Stream</label>
                    <input type="text" class="form-control" id="revenue_stream"
                      placeholder="Masukkan revenue stream usaha Anda">
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary-blue-3 text-neutral-white">Kirim</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '../../../../Layouts/Layout.vue'
import UmkmDashboardSidebar from '../../../../Components/UmkmDashboardSidebar.vue'
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const refDeskripsiUsaha = ref(null);

const handleResizeDeskripsiUsaha = () => {
  refDeskripsiUsaha.value.style.height = `${refDeskripsiUsaha.value.scrollHeight}px`;
}
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

.input_upload_custom h1,
.input_upload_custom h2 {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0;
}

.input_upload_custom .position-relative {
  overflow: hidden;
  cursor: pointer;
}

.input_upload_custom p {
  font-size: 0.75rem;
  font-weight: 400;
  margin-bottom: 0;
}

.input_upload_custom input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

textarea::-webkit-scrollbar {
  display: none;
}

textarea {
  resize: none;
}

@media (max-width: 575.98px) {
  section {
    margin-top: 15rem !important;
  }
}
</style>