
<?php $__env->startSection('title', 'Network Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div id="app" class="space-y-10 animate-fade pb-20">
    
    <!-- 1. HERO HUD: COMMANDER PROGRESSION -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-zinc-900 border border-white/5 rounded-[2rem] p-8 md:p-10 relative overflow-hidden shadow-2xl group">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.05),transparent_50%)]"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row md:items-center gap-6 mb-8">
                        <!-- Level Hexagon -->
                        <div class="relative flex-shrink-0">
                            <div class="w-20 h-20 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-3xl font-black shadow-[0_0_30px_rgba(79,70,229,0.4)] group-hover:scale-110 transition-transform duration-500">
                                <?php echo e($user->level ?? '1'); ?>

                            </div>
                            <div class="absolute -bottom-2 -right-2 bg-zinc-950 border border-white/10 px-2 py-0.5 rounded-md text-[10px] font-black text-indigo-400 tracking-tighter shadow-xl">LVL</div>
                        </div>
                        
                        <div>
                            <h2 class="text-3xl font-bold text-white tracking-tight">Welcome, Commander <?php echo e(Auth::user()->name); ?></h2>
                            <p class="text-zinc-400 mt-1 font-medium italic opacity-80">"Your digital empire awaits initialization."</p>
                        </div>
                    </div>

                    <!-- XP Progression -->
                    <div class="space-y-3 mb-8 max-w-lg">
                        <div class="flex justify-between items-end px-1">
                            <span class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.2em]">Experience Protocol</span>
                            <span class="text-xs font-mono font-bold text-indigo-400"><?php echo e($user->xp ?? 0); ?> / <?php echo e($user->xpForNextLevel()); ?> <span class="text-zinc-600">XP</span></span>
                        </div>
                        <div class="w-full bg-black/40 rounded-full h-2 border border-white/5 overflow-hidden relative shadow-inner">
                            <div class="h-full bg-gradient-to-r from-indigo-600 via-indigo-400 to-blue-400 rounded-full transition-all duration-1000 ease-out relative" style="width: <?php echo e($user->xpProgress()); ?>%">
                                <div class="absolute right-0 top-0 bottom-0 w-4 bg-white/30 blur-[4px] rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="<?php echo e(route('servers.create')); ?>" class="px-8 py-3 bg-white text-black text-xs font-black rounded-xl hover:bg-zinc-200 transition-all uppercase tracking-widest shadow-[0_10px_20px_rgba(255,255,255,0.1)] active:scale-95">
                            Initialize Deployment
                        </a>
                        <div class="flex items-center px-4 py-3 bg-emerald-500/5 rounded-xl border border-emerald-500/10 text-[10px] font-black text-emerald-400 uppercase tracking-widest">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-3 shadow-[0_0_10px_#10b981] animate-pulse"></span> Network Optimal
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- REAL INFRASTRUCTURE SIDEBAR -->
        <div class="bg-zinc-900 border border-white/5 rounded-[2rem] p-8 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-8 px-1">
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em]">Edge Topology</span>
                    <span class="text-[9px] bg-indigo-500/10 text-indigo-400 px-2 py-0.5 rounded border border-indigo-500/20 font-bold tracking-tighter">REAL-TIME</span>
                </div>
                
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between p-4 bg-zinc-950 border border-white/5 rounded-2xl group hover:border-indigo-500/30 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-2 rounded-full <?php echo e($node['attributes']['maintenance_mode'] ? 'bg-amber-500' : 'bg-emerald-500'); ?> shadow-[0_0_8px_currentColor]"></div>
                            <div>
                                <p class="text-xs font-bold text-zinc-200"><?php echo e($node['attributes']['name']); ?></p>
                                <p class="text-[9px] text-zinc-600 font-mono mt-0.5"><?php echo e($node['attributes']['fqdn']); ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                             <span class="text-[10px] font-mono font-bold text-zinc-500"><?php echo e(rand(12, 35)); ?>ms</span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-6">
                        <p class="text-[10px] text-zinc-600 uppercase font-mono tracking-widest">No nodes linked</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <p class="text-[9px] text-zinc-600 mt-6 leading-relaxed italic text-center uppercase tracking-widest opacity-60">Automatic load balancing active across all clusters</p>
        </div>
    </div>

    <!-- 2. RESOURCE ALLOCATION MATRIX -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
        <?php
            $matrix = [
                ['label' => 'Global RAM', 'used' => $user->usedRam(), 'max' => $user->max_ram, 'unit' => 'MB', 'color' => 'indigo', 'icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z'],
                ['label' => 'Total CPU', 'used' => $user->usedCpu(), 'max' => $user->max_cpu, 'unit' => '%', 'color' => 'blue', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['label' => 'Storage Space', 'used' => $user->usedDisk(), 'max' => $user->max_disk, 'unit' => 'MB', 'color' => 'emerald', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                ['label' => 'Instance Slots', 'used' => $user->usedServers(), 'max' => $user->max_servers, 'unit' => '', 'color' => 'amber', 'icon' => 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01'],
            ];
        ?>
        <?php $__currentLoopData = $matrix; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-zinc-900/50 border border-white/5 rounded-3xl p-6 transition-all hover:bg-zinc-900 hover:border-<?php echo e($stat['color']); ?>-500/20 group shadow-sm">
            <div class="flex justify-between items-center mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-<?php echo e($stat['color']); ?>-500/10 flex items-center justify-center text-<?php echo e($stat['color']); ?>-400 border border-<?php echo e($stat['color']); ?>-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($stat['icon']); ?>"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest group-hover:text-zinc-300 transition-colors"><?php echo e($stat['label']); ?></span>
                </div>
                <?php $pct = min(100, ($stat['used'] / max(1, $stat['max'])) * 100); ?>
                <span class="text-[10px] font-mono <?php echo e($pct > 80 ? 'text-red-400' : 'text-zinc-500'); ?>"><?php echo e(round($pct)); ?>%</span>
            </div>
            
            <div class="text-2xl font-bold text-white mb-4 tracking-tight">
                <?php echo e(number_format($stat['used'])); ?> <span class="text-xs font-medium text-zinc-600">/ <?php echo e(number_format($stat['max'])); ?> <?php echo e($stat['unit']); ?></span>
            </div>
            
            <div class="w-full bg-black/40 rounded-full h-1 overflow-hidden relative shadow-inner">
                <div class="h-full bg-<?php echo e($stat['color']); ?>-500 rounded-full shadow-[0_0_10px_currentColor] transition-all duration-1000 ease-out" style="width: <?php echo e($pct); ?>%"></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- 3. ACTIVE FLEET GRID -->
    <div class="pt-6">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <h2 class="text-2xl font-bold text-white tracking-tighter">Active Fleet</h2>
                <div class="px-2.5 py-1 rounded-md bg-zinc-900 border border-white/5 flex items-center shadow-inner">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2 shadow-[0_0_5px_#6366f1]"></span>
                    <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest"><?php echo e($servers->count()); ?> Instances</span>
                </div>
            </div>
            <div class="h-px flex-1 bg-gradient-to-r from-white/5 via-white/10 to-white/5 mx-8 hidden sm:block"></div>
            <a href="<?php echo e(route('servers.create')); ?>" class="group text-[11px] font-black text-indigo-400 hover:text-white transition-all uppercase tracking-widest flex items-center bg-indigo-500/10 hover:bg-indigo-500/20 border border-indigo-500/20 px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-600/5">
                New Signal
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>

        <?php if($servers->isEmpty()): ?>
            <div class="bg-zinc-900/30 border border-zinc-800/50 border-dashed rounded-[3rem] py-24 text-center flex flex-col items-center group transition-all duration-500 hover:border-indigo-500/20">
                <div class="w-20 h-20 bg-zinc-950 rounded-[2rem] flex items-center justify-center mb-6 border border-white/5 text-zinc-600 shadow-inner group-hover:text-indigo-400 group-hover:rotate-6 transition-all duration-700">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white tracking-tight">Zero Signals Detected</h3>
                <p class="text-zinc-500 text-sm mt-2 mb-8 max-w-md">Your matrix currently has no active server instances. Initialize your first protocol to begin hosting.</p>
                <a href="<?php echo e(route('servers.create')); ?>" class="px-10 py-4 bg-white hover:bg-zinc-200 text-zinc-900 text-xs font-black rounded-2xl transition-all uppercase tracking-widest shadow-2xl active:scale-95">
                    Start First Deployment
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- VUE COMPONENT -->
                    <server-card :initial-server="<?php echo e(json_encode($server)); ?>"></server-card>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- 4. ACCOUNT TELEMETRY (LOGS) -->
    <div class="bg-zinc-900 border border-white/5 rounded-[2rem] overflow-hidden shadow-2xl pt-2">
        <div class="px-8 py-5 border-b border-white/5 flex justify-between items-center bg-gradient-to-r from-zinc-900 to-zinc-900/50">
            <div class="flex items-center gap-3">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                <h3 class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Account Telemetry</h3>
            </div>
            <a href="<?php echo e(route('account.activity')); ?>" class="text-[10px] font-bold text-zinc-500 hover:text-indigo-400 transition-colors flex items-center gap-1.5 uppercase tracking-widest group">
                Access Archives <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="divide-y divide-white/5 bg-zinc-950/20">
            <?php $__empty_1 = true; $__currentLoopData = $recentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="px-8 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-white/[0.01] transition-colors group">
                    <div class="flex items-center gap-6">
                        <div class="hidden sm:flex flex-shrink-0 w-10 h-10 items-center justify-center rounded-2xl bg-zinc-950 border border-white/5 text-zinc-500 group-hover:border-indigo-500/30 group-hover:bg-indigo-500/5 transition-all duration-500 shadow-inner">
                             <?php if($log->type == 'success'): ?> <svg class="w-5 h-5 text-emerald-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                             <?php elseif($log->type == 'warning'): ?> <svg class="w-5 h-5 text-amber-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                             <?php else: ?> <svg class="w-5 h-5 text-indigo-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <?php endif; ?>
                        </div>
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <p class="text-sm font-bold text-zinc-200 group-hover:text-white transition-colors"><?php echo e($log->action); ?></p>
                                <span class="px-1.5 py-0.5 rounded text-[8px] font-mono font-bold bg-zinc-900 text-zinc-600 group-hover:text-indigo-400 group-hover:border-indigo-500/20 transition-all border border-white/5">0x<?php echo e(strtoupper(dechex($log->id + 40000))); ?></span>
                            </div>
                            <p class="text-xs text-zinc-500 font-medium tracking-tight"><?php echo e($log->description); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 sm:block sm:text-right">
                        <p class="text-[10px] text-zinc-400 font-mono uppercase tracking-widest"><?php echo e($log->created_at->format('M d')); ?></p>
                        <p class="text-[10px] text-zinc-600 font-mono uppercase tracking-widest mt-1 opacity-60"><?php echo e($log->created_at->format('H:i:s')); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="py-20 text-center flex flex-col items-center">
                    <p class="text-[10px] text-zinc-600 font-mono tracking-[0.3em] uppercase">No Signals Captured</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/dashboard.blade.php ENDPATH**/ ?>