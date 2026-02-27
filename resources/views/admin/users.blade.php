@extends('layouts.app')
@section('title', 'Commander Registry')

@section('content')
<div class="animate-fade-in-up">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Commander Registry</h2>
            <p class="text-gray-400 mt-1 font-medium">Database access to all registered user entities.</p>
        </div>
        <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-900 border border-gray-700 text-gray-300 hover:text-white rounded-lg text-sm font-bold transition-colors">
            &larr; Return to Base
        </a>
    </div>

    <!-- The Data Grid -->
    <div class="bg-gray-900 border border-gray-800 rounded-3xl shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/40 border-b border-gray-800 text-[10px] uppercase tracking-[0.2em] text-gray-500 font-mono">
                        <th class="px-6 py-5">Identity</th>
                        <th class="px-6 py-5">Wallet (V-Coins)</th>
                        <th class="px-6 py-5 text-center">Fleet</th>
                        <th class="px-6 py-5 text-center">Resource Allocations (RAM / CPU / DSK)</th>
                        <th class="px-6 py-5 text-right">Override</th>
                        <!-- Search Filter -->
<div class="mb-6 flex gap-4">
    <div class="flex-1 relative group">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-600 group-focus-within:text-indigo-500 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input type="text" placeholder="Search by name, email, or Ptero ID..." class="w-full bg-zinc-900/50 border border-white/5 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
    </div>
    <div class="px-4 py-2.5 bg-zinc-900 border border-white/5 rounded-xl flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
        <span class="text-xs font-bold text-zinc-300 uppercase tracking-widest">{{ $users->total() }} Active Users</span>
    </div>
</div>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    @foreach($users as $user)
                    <tr class="hover:bg-vortex-purple/5 transition-colors group">
                        <!-- Identity -->
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gray-800 border border-gray-700 flex items-center justify-center text-white font-bold shadow-lg group-hover:border-vortex-purple transition-colors">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <p class="text-white font-bold text-sm">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500 font-mono">{{ $user->email }}</p>
                                    @if($user->is_admin)
                                        <span class="text-[10px] text-red-500 font-black uppercase tracking-wider">Admin Access</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        
                        <!-- Editable Form -->
                        <td colspan="4" class="px-0 py-0 align-middle">
                            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="flex items-center w-full h-full px-6">
                                @csrf
                                
                                <!-- Coins Input -->
                                <div class="w-1/4 pr-6">
                                    <div class="relative group/input">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-yellow-600 group-focus-within/input:text-yellow-400 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.696 6 10 6c.304 0 .792.193 1.264.979a1 1 0 001.715-1.029C12.279 4.784 11.232 4 10 4s-2.279.784-2.979 1.95c-.285.475-.507 1-.67 1.55H6a1 1 0 000 2h.013a9.358 9.358 0 000 1H6a1 1 0 100 2h.343c.163.55.385 1.075.67 1.55C7.721 15.216 8.768 16 10 16s2.279-.784 2.979-1.95a1 1 0 10-1.715-1.029c-.472.786-.96.979-1.264.979-.304 0-.792-.193-1.264-.979a4.265 4.265 0 01-.264-.421H10a1 1 0 100-2H8.017a7.36 7.36 0 010-1H10a1 1 0 100-2H8.472c.08-.154.167-.3.264-.421z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input type="number" name="coins" value="{{ $user->coins }}" class="w-full bg-black/40 border border-gray-700 text-yellow-500 font-mono font-bold text-sm rounded-md py-2 pl-9 focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 block transition-all">
                                    </div>
                                </div>

                                <!-- Server Slots -->
                                <div class="w-1/6 text-center pr-6 flex items-center justify-center space-x-2">
                                    <span class="text-gray-500 text-xs font-mono">{{ $user->servers_count }} /</span>
                                    <input type="number" name="max_servers" value="{{ $user->max_servers }}" class="w-12 bg-black/40 border border-gray-700 text-white font-mono text-sm rounded-md py-1 text-center focus:border-vortex-purple focus:ring-1 focus:ring-vortex-purple">
                                </div>

                                <!-- Resources -->
                                <div class="flex-1 flex justify-center space-x-2">
                                    <input type="number" name="max_ram" value="{{ $user->max_ram }}" class="w-20 bg-black/40 border border-gray-700 text-vortex-purple font-mono text-sm rounded-md py-1 text-center focus:border-vortex-purple focus:ring-1 focus:ring-vortex-purple" placeholder="RAM">
                                    <input type="number" name="max_cpu" value="{{ $user->max_cpu }}" class="w-16 bg-black/40 border border-gray-700 text-blue-400 font-mono text-sm rounded-md py-1 text-center focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="CPU">
                                    <input type="number" name="max_disk" value="{{ $user->max_disk }}" class="w-20 bg-black/40 border border-gray-700 text-green-400 font-mono text-sm rounded-md py-1 text-center focus:border-green-500 focus:ring-1 focus:ring-green-500" placeholder="DISK">
                                </div>

                                <!-- Save Button -->
                                <div class="w-1/6 text-right">
                                    <button type="submit" class="group/btn relative inline-flex items-center justify-center p-0.5 overflow-hidden text-xs font-medium rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-blue-800">
                                        <span class="relative px-4 py-2 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover/btn:bg-opacity-0 font-bold tracking-wider">
                                            SAVE
                                        </span>
                                    </button>
                                        <!-- NEW: Impersonate Button -->
    <a href="{{ route('admin.users.impersonate', $user->id) }}" class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-[10px] font-bold rounded-md transition-colors uppercase border border-white/5">
        Login As
    </a>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-800 bg-black/20">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection