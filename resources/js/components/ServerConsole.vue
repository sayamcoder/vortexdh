<template>
    <div class="h-full flex flex-col bg-[#09090b] rounded-xl border border-white/5 overflow-hidden shadow-inner">
        <!-- Header -->
        <div class="bg-zinc-900 border-b border-white/5 px-4 py-2 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full" :class="connected ? 'bg-emerald-500' : 'bg-red-500 animate-pulse'"></div>
                <span class="text-[10px] text-zinc-500 font-mono tracking-widest">
                    {{ connected ? 'SECURE_CONNECTION_ESTABLISHED' : 'CONNECTING_TO_SOCKET...' }}
                </span>
            </div>
        </div>
        
        <!-- XTerm Container -->
        <div ref="terminalContainer" class="flex-1 p-1 overflow-hidden bg-[#09090b]"></div>

        <!-- Input -->
        <div class="bg-zinc-950 border-t border-white/5 p-3 flex items-center gap-3">
            <span class="text-indigo-500 font-black">></span>
            <input type="text" v-model="command" @keyup.enter="sendCommand" 
                class="flex-1 bg-transparent border-none text-white text-sm font-mono focus:ring-0 outline-none placeholder-zinc-700" 
                placeholder="Type a command...">
            <button @click="sendCommand" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-colors">Send</button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Terminal } from 'xterm';
import { FitAddon } from 'xterm-addon-fit';
import { io } from 'socket.io-client';
import 'xterm/css/xterm.css';

const props = defineProps({
    websocket: Object
});

const terminalContainer = ref(null);
const command = ref('');
const connected = ref(false);
let socket = null;
let term = null;
let fitAddon = null;

onMounted(() => {
    if (!props.websocket) return;

    // 1. Setup XTerm
    term = new Terminal({
        theme: { background: '#09090b', foreground: '#d4d4d8', cursor: '#6366f1' },
        fontFamily: 'Menlo, Monaco, "Courier New", monospace',
        fontSize: 12,
        cursorBlink: true,
        disableStdin: true,
    });
    fitAddon = new FitAddon();
    term.loadAddon(fitAddon);
    term.open(terminalContainer.value);
    fitAddon.fit();

    // 2. Connect to Wings Socket
    socket = io(props.websocket.socket, {
        path: '/api/client/servers/' + props.websocket.token.substring(0, 36) + '/ws', // Wings specific path
        query: { token: props.websocket.token },
        transports: ['websocket']
    });

    // 3. Handle Events
    socket.on('connect', () => {
        connected.value = true;
        term.writeln('\x1b[32m[VortexDash] Connected to Server Stream.\x1b[0m');
        // Request logs
        socket.emit('send', 'logs');
    });

    socket.on('console output', (data) => {
        term.writeln(data);
    });

    socket.on('status', (status) => {
        term.writeln(`\x1b[33m[System] Server marked as ${status}\x1b[0m`);
    });

    socket.on('disconnect', () => {
        connected.value = false;
        term.writeln('\x1b[31m[VortexDash] Connection Lost.\x1b[0m');
    });
    
    // Resize observer
    window.addEventListener('resize', fitTerm);
});

const fitTerm = () => fitAddon.fit();

const sendCommand = () => {
    if(command.value && socket) {
        socket.emit('send', 'command', command.value);
        command.value = '';
    }
};

onBeforeUnmount(() => {
    if(socket) socket.disconnect();
    if(term) term.dispose();
    window.removeEventListener('resize', fitTerm);
});
</script>