<template>
    <div class="h-full flex flex-col">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-semibold text-white">Schedules & Tasks</h2>
                <p class="text-sm text-zinc-400">Automate commands, power actions, and backups.</p>
            </div>
            <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-colors">
                Create Schedule
            </button>
        </div>

        <div class="bg-zinc-950 border border-white/5 rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-white/5 text-zinc-400 font-medium">
                    <tr>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Cron Format</th>
                        <th class="px-6 py-4">Next Run</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr v-for="schedule in schedules" :key="schedule.attributes.id" class="hover:bg-white/[0.02]">
                        <td class="px-6 py-4 text-white font-medium">{{ schedule.attributes.name }}</td>
                        <td class="px-6 py-4 font-mono text-zinc-400 text-xs">
                            {{ schedule.attributes.cron.minute }} 
                            {{ schedule.attributes.cron.hour }} 
                            {{ schedule.attributes.cron.day_of_month }} 
                            {{ schedule.attributes.cron.month }} 
                            {{ schedule.attributes.cron.day_of_week }}
                        </td>
                        <td class="px-6 py-4 text-zinc-300">
                            {{ new Date(schedule.attributes.next_run_at).toLocaleString() }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest" :class="schedule.attributes.is_active ? 'bg-emerald-500/10 text-emerald-400' : 'bg-zinc-800 text-zinc-500'">
                                {{ schedule.attributes.is_active ? 'Active' : 'Paused' }}
                            </span>
                        </td>
                    </tr>
                    <tr v-if="schedules.length === 0">
                        <td colspan="4" class="px-6 py-12 text-center text-zinc-500">No scheduled tasks configured.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const props = defineProps({ initialSchedules: Array });
const schedules = ref(props.initialSchedules);
</script>