<template>
    <div class="bg-zinc-900 border border-white/5 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/30 hover:shadow-[0_10px_40px_rgba(0,0,0,0.4)] group flex flex-col h-full relative overflow-hidden">
        
        <!-- Subtle Background Glow on Hover -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/[0.03] to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

        <!-- Header -->
        <div class="flex justify-between items-start mb-6 relative z-10">
            <div class="pr-3 overflow-hidden">
<a :href="`/server/${server.id}/manage`" class="text-lg font-semibold text-white truncate tracking-tight hover:text-indigo-400 transition-colors">
    {{ server.name }}
</a>
                <div class="flex items-center mt-1.5 gap-2">
                    <span class="inline-flex items-center justify-center bg-zinc-950 border border-white/5 px-2 py-0.5 rounded text-[10px] text-zinc-500 font-mono tracking-wider">
                        {{ server.ip }}<span class="text-zinc-600 mx-0.5">:</span><span class="text-zinc-400">{{ server.port }}</span>
                    </span>
                </div>
            </div>
            
            <!-- Premium Status Badge -->
            <div class="flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest border shadow-sm transition-all" :class="statusBadge.classes">
                <span class="w-1.5 h-1.5 rounded-full mr-2 shadow-sm" :class="statusBadge.dotClass"></span>
                {{ currentState }}
            </div>
        </div>

        <!-- Resources Area -->
        <div class="space-y-5 flex-grow relative z-10">
            <!-- CPU -->
            <div>
                <div class="flex justify-between text-xs mb-2 font-medium">
                    <span class="text-zinc-400">CPU Load</span>
                    <span class="text-zinc-300">{{ cpuUsage }}%</span>
                </div>
                <div class="w-full bg-zinc-950 rounded-full h-1.5 border border-white/5 overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-700 ease-out relative shadow-[0_0_8px_rgba(0,0,0,0.5)]" :class="cpuUsage > 80 ? 'bg-red-500 shadow-red-500/50' : 'bg-indigo-500 shadow-indigo-500/50'" :style="{ width: cpuUsage + '%' }">
                        <div class="absolute right-0 top-0 bottom-0 w-2 bg-white/40 rounded-full blur-[1px]"></div>
                    </div>
                </div>
            </div>
            <!-- RAM -->
            <div>
                <div class="flex justify-between text-xs mb-2 font-medium">
                    <span class="text-zinc-400">Memory Allocation</span>
                    <span class="text-zinc-300">{{ formatBytes(stats.memory_bytes) }} <span class="text-zinc-600 font-normal">/ {{ server.memory }} MB</span></span>
                </div>
                <div class="w-full bg-zinc-950 rounded-full h-1.5 border border-white/5 overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-700 ease-out relative shadow-[0_0_8px_rgba(0,0,0,0.5)]" :class="memoryPercentage > 85 ? 'bg-red-500 shadow-red-500/50' : 'bg-blue-500 shadow-blue-500/50'" :style="{ width: memoryPercentage + '%' }">
                         <div class="absolute right-0 top-0 bottom-0 w-2 bg-white/40 rounded-full blur-[1px]"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Controls -->
        <div class="mt-8 pt-5 border-t border-white/5 flex flex-col gap-3 relative z-10">
            <!-- Power Controls -->
            <div class="flex gap-2">
                <button @click="sendAction('start')" :disabled="isLoading || isOnline" 
                    class="flex-1 py-2.5 text-xs font-bold uppercase tracking-widest text-zinc-300 bg-zinc-800/50 border border-transparent hover:border-emerald-500/30 hover:bg-emerald-500/10 hover:text-emerald-400 rounded-lg transition-all disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-zinc-800/50 disabled:hover:border-transparent disabled:hover:text-zinc-300 shadow-sm">
                    Start
                </button>
                <button @click="sendAction('restart')" :disabled="isLoading || isOffline" 
                    class="flex-1 py-2.5 text-xs font-bold uppercase tracking-widest text-zinc-300 bg-zinc-800/50 border border-transparent hover:border-indigo-500/30 hover:bg-indigo-500/10 hover:text-indigo-400 rounded-lg transition-all disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-zinc-800/50 disabled:hover:border-transparent disabled:hover:text-zinc-300 shadow-sm">
                    Reboot
                </button>
                <button @click="sendAction('stop')" :disabled="isLoading || isOffline" 
                    class="flex-1 py-2.5 text-xs font-bold uppercase tracking-widest text-zinc-300 bg-zinc-800/50 border border-transparent hover:border-amber-500/30 hover:bg-amber-500/10 hover:text-amber-400 rounded-lg transition-all disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-zinc-800/50 disabled:hover:border-transparent disabled:hover:text-zinc-300 shadow-sm">
                    Stop
                </button>
            </div>
            
            <!-- Danger Zone: Delete -->
            <form :action="`/deploy/${server.id}`" method="POST" @submit="confirmDelete">
                <input type="hidden" name="_token" :value="csrfToken">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="w-full flex items-center justify-center py-2.5 text-xs font-bold uppercase tracking-widest text-red-400/80 bg-red-500/5 hover:bg-red-500/10 border border-red-500/10 hover:border-red-500/30 hover:text-red-400 rounded-lg transition-all shadow-sm">
                    <svg class="w-3.5 h-3.5 mr-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Terminate Instance
                </button>
            </form>
        </div>
        
        <!-- Loading Overlay -->
        <div v-if="isLoading" class="absolute inset-0 bg-zinc-950/60 backdrop-blur-sm flex flex-col items-center justify-center z-20 transition-opacity">
            <svg class="animate-spin h-6 w-6 text-indigo-500 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400 animate-pulse">Transmitting Signal</span>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import axios from 'axios';

const props = defineProps({ initialServer: Object });
const server = ref(props.initialServer);
const stats = ref({ state: 'offline', cpu_absolute: 0, memory_bytes: 0 });
const isLoading = ref(false);
let pollingInterval = null;

// FIX: Grab the CSRF token from the meta tag so the delete form works perfectly
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

const confirmDelete = (e) => {
    if (!confirm('CRITICAL WARNING: This will permanently delete your server instance and all associated data. Your resource limits will be refunded. Proceed with termination?')) {
        e.preventDefault();
    }
};

const currentState = computed(() => stats.value.state || 'offline');
const isOnline = computed(() => ['running', 'starting'].includes(currentState.value));
const isOffline = computed(() => ['offline', 'stopping'].includes(currentState.value));
const cpuUsage = computed(() => Math.min(Math.round(stats.value.cpu_absolute || 0), 100));
const memoryPercentage = computed(() => {
    if (!server.value.memory) return 0;
    return Math.min(Math.round(((stats.value.memory_bytes || 0) / (server.value.memory * 1024 * 1024)) * 100), 100);
});

// Premium status badge styling
const statusBadge = computed(() => {
    const states = {
        running: { classes: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', dotClass: 'bg-emerald-400 shadow-[0_0_5px_#34d399]' },
        starting: { classes: 'bg-amber-500/10 text-amber-400 border-amber-500/20', dotClass: 'bg-amber-400 animate-pulse shadow-[0_0_5px_#fbbf24]' },
        stopping: { classes: 'bg-red-500/10 text-red-400 border-red-500/20', dotClass: 'bg-red-400 animate-pulse shadow-[0_0_5px_#f87171]' },
        offline: { classes: 'bg-zinc-900 text-zinc-500 border-white/5', dotClass: 'bg-zinc-600' }
    };
    return states[currentState.value] || states.offline;
});

const fetchStats = async () => {
    try {
        const response = await axios.get(`/api/servers/${server.value.id}/stats`);
        stats.value = response.data;
        // Keep the local DB status in sync for the UI
        server.value.status = response.data.state;
    } catch (error) {
        stats.value.state = 'offline';
        stats.value.cpu_absolute = 0;
        stats.value.memory_bytes = 0;
        server.value.status = 'offline';
    }
};

// FIX: Ensure the power action uses the correct route and handles state optimistically
const sendAction = async (action) => {
    isLoading.value = true;
    
    // Optimistic UI update before server responds
    const previousState = stats.value.state;
    stats.value.state = action === 'start' ? 'starting' : 'stopping';

    try {
        await axios.post(`/api/servers/${server.value.id}/power`, { action });
        // The next fetchStats() tick will grab the actual new state
    } catch (error) {
        console.error("Power action failed:", error);
        // Revert to previous state if API call failed
        stats.value.state = previousState;
        alert('Signal failure. Please check if the Wings node is online.');
    } finally {
        setTimeout(() => isLoading.value = false, 1200);
    }
};

const formatBytes = (bytes) => {
    if (bytes === 0 || !bytes) return '0 MB';
    const mb = bytes / (1024 * 1024);
    return mb >= 1024 ? (mb / 1024).toFixed(2) + ' GB' : Math.round(mb) + ' MB';
};

onMounted(() => { 
    fetchStats(); 
    pollingInterval = setInterval(fetchStats, 4000); // Polling every 4 seconds for a snappier feel
});

onUnmounted(() => { 
    if (pollingInterval) clearInterval(pollingInterval); 
});
</script>