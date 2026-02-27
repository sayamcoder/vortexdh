<template>
    <div class="w-full h-32">
        <Line :data="chartData" :options="chartOptions" />
    </div>
</template>

<script setup>
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Filler, Tooltip } from 'chart.js'
import { Line } from 'vue-chartjs'
import { ref } from 'vue'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Filler, Tooltip)

const props = defineProps({
    labels: Array,
    dataPoints: Array
})

const chartData = ref({
    labels: props.labels,
    datasets: [{
        fill: true,
        data: props.dataPoints,
        borderColor: '#6366f1',
        backgroundColor: 'rgba(99, 102, 241, 0.1)',
        tension: 0.4,
        pointRadius: 0,
    }]
})

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false }, tooltip: { enabled: true } },
    scales: {
        x: { display: false },
        y: { display: false, beginAtZero: true }
    }
}
</script>