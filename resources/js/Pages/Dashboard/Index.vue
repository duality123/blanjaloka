<template>
  <DashboardLayout title="Overview">
    <div class="d-flex justify-content-between align-items-center">
      <h1 class="text-neutral-gray-5">Overview</h1>
      <h2 class="text-neutral-gray-5">Senin, 19 September 2022 12.39 PM</h2>
    </div>
    <div class="row mt-5">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Total Investasi Batch 1</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="chartHeight" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Jumlah Investor Tiap Batch</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="chartHeight" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Jenis UMKM</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="chartHeight" class="mt-4" />
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="text-neutral-gray-4">Latar Belakang Founder</h3>
            <Bar :chart-options="chartOptions" :chart-data="chartData" :height="chartHeight" class="mt-4" />
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../../Layouts/Dashboard.vue';
import { ref } from 'vue';

import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const chartData = ref({
  labels: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'],
  datasets: [{
    label: 'Besar Investasi',
    data: [10, 20, 30, 40, 50, 60, 70, 80, 80],
    backgroundColor: '#398AB9',
    borderRadius: 5,
  }]
});
const chartOptions = ref({
  responsive: true,
  plugins: {
    legend: {
      display: true,
      position: 'bottom',
      align: 'start'
    }
  }
});
const chartHeight = ref({
  type: Number,
  default: 250
});
</script>

<style scoped>
h1 {
  font-size: 2.1rem;
  font-weight: 600;
}

h2 {
  font-size: 1.3rem;
  font-weight: 400;
}

.card {
  border: none;
  border-radius: 1.25rem;
}

.card h3 {
  font-size: 1rem;
  font-weight: 400;
}
</style>