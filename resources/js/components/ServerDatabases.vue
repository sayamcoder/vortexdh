<template>
    <div class="h-full flex flex-col relative">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-semibold text-white">Databases</h2>
                <p class="text-sm text-zinc-400">Manage your server's MySQL databases.</p>
            </div>
            <!-- Toggle Modal -->
            <button @click="showModal = true" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-colors">
                New Database
            </button>
        </div>

        <!-- Database List Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div v-for="db in databases" :key="db.attributes.id" class="bg-zinc-950 border border-white/5 rounded-xl p-5 hover:border-indigo-500/30 transition-colors group">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center border border-indigo-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-white font-medium">{{ db.attributes.name }}</h3>
                        <p class="text-xs text-zinc-500 font-mono">{{ db.attributes.host.address }}:{{ db.attributes.host.port }}</p>
                    </div>
                </div>
                <!-- ... rest of card ... -->
            </div>
        </div>

        <!-- CREATE MODAL OVERLAY -->
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
            <div class="bg-zinc-900 border border-white/10 rounded-2xl w-full max-w-md p-6 shadow-2xl relative">
                <button @click="showModal = false" class="absolute top-4 right-4 text-zinc-500 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <h3 class="text-lg font-bold text-white mb-1">Create Database</h3>
                <p class="text-sm text-zinc-400 mb-6">Enter a name for your new database.</p>

                <!-- Form submits to Laravel Controller -->
                <form :action="createRoute" method="POST">
                    <input type="hidden" name="_token" :value="csrfToken">
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-1">Database Name</label>
                            <input type="text" name="database" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" placeholder="s1_...">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase mb-1">Connections From</label>
                            <input type="text" name="remote" value="%" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" placeholder="%">
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="button" @click="showModal = false" class="flex-1 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white text-sm font-bold rounded-lg transition-colors">Cancel</button>
                        <button type="submit" class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg transition-colors">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const props = defineProps({ 
    initialDatabases: Array,
    createRoute: String 
});
const databases = ref(props.initialDatabases);
const showModal = ref(false);
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>