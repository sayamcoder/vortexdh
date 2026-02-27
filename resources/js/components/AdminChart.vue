<template>
    <div class="w-full h-full">
        <Line :data="chartData" :options="chartOptions" />
    </div>
</template>

<script setup>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler
} from 'chart.js'
import { Line } from 'vue-chartjs'
import { ref, onMounted } from 'vue'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
  Filler
)

// Props to receive data from Blade
const props = defineProps({
    dataPoints: {
        type: Array,
        required: true
    },
    labels: {
        type: Array,
        required: true
    }
});

const chartData = ref({
  labels: props.labels,
  datasets: [
    {
      label: 'Network Activity',
      backgroundColor: (context) => {
        const ctx = context.chart.ctx;
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(139, 92, 246, 0.5)'); // Vortex Purple
        gradient.addColorStop(1, 'rgba(139, 92, 246, 0.0)');
        return gradient;
      },
      borderColor: '#8B5CF6',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#8B5CF6',
      pointHoverBackgroundColor: '#8B5CF6',
      pointHoverBorderColor: '#fff',
      fill: true,
      tension: 0.4, // Smooth curves
      data: props.dataPoints
    }
  ]
})

const chartOptions = ref({
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      display: false
    },
    tooltip: {
      backgroundColor: 'rgba(17, 24, 39, 0.9)',
      titleColor: '#fff',
      bodyColor: '#9CA3AF',
      borderColor: 'rgba(75, 85, 99, 0.5)',
      borderWidth: 1,
      padding: 10,
      displayColors: false,
    }
  },
  scales: {
    x: {
      grid: {
        color: 'rgba(75, 85, 99, 0.1)',
        borderColor: 'rgba(75, 85, 99, 0.2)'
      },
      ticks: {
        color: '#6B7280'
      }
    },
    y: {
      grid: {
        color: 'rgba(75, 85, 99, 0.1)',
        borderColor: 'rgba(75, 85, 99, 0.2)'
      },
      ticks: {
        color: '#6B7280',
        callback: function(value) { if (value % 1 === 0) { return value; } }
      },
      beginAtZero: true
    }
  }
})
</script>