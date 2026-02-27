import './bootstrap';
import { createApp } from 'vue';
import ServerCard from './components/ServerCard.vue';
import AdminChart from './components/AdminChart.vue'; // <--- Add this
import UserUsageChart from './components/UserUsageChart.vue';
import ServerDatabases from './components/ServerDatabases.vue';
import ServerSchedules from './components/ServerSchedules.vue';
import ServerConsole from './components/ServerConsole.vue';

const app = createApp({});
app.component('server-console', ServerConsole);
app.component('server-card', ServerCard);
app.component('admin-chart', AdminChart); // <--- Add this
app.component('server-databases', ServerDatabases);
app.component('server-schedules', ServerSchedules);
app.component('user-usage-chart', UserUsageChart);
app.mount('#app');