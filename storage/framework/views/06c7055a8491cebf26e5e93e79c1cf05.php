
<?php $__env->startSection('title', 'Admin Overview'); ?>

<?php $__env->startSection('content'); ?>
<div id="app" class="space-y-10 animate-fade">
    
    <!-- Header & Quick Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-white tracking-tight">Administration</h1>
            <p class="text-sm text-zinc-400 mt-1">Network telemetry and system management.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('admin.users')); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-300 bg-zinc-900 border border-white/10 rounded-lg hover:bg-zinc-800 hover:text-white transition-all">
                <svg class="w-4 h-4 mr-2 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Users
            </a>
            <a href="<?php echo e(route('admin.servers')); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-300 bg-zinc-900 border border-white/10 rounded-lg hover:bg-zinc-800 hover:text-white transition-all">
                <svg class="w-4 h-4 mr-2 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                Fleet
            </a>
            <a href="<?php echo e(route('admin.store')); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-300 bg-zinc-900 border border-white/10 rounded-lg hover:bg-zinc-800 hover:text-white transition-all">
                <svg class="w-4 h-4 mr-2 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Store
            </a>
        </div>
    </div>

    <!-- Key Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Users -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-5 hover:border-white/10 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Commanders</p>
                    <h3 class="text-2xl font-semibold text-white mt-1"><?php echo e(number_format($stats['total_users'])); ?></h3>
                </div>
                <div class="p-2 bg-indigo-500/10 rounded-lg text-indigo-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Active Servers -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-5 hover:border-white/10 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Instances</p>
                    <h3 class="text-2xl font-semibold text-white mt-1"><?php echo e(number_format($stats['total_servers'])); ?></h3>
                </div>
                <div class="p-2 bg-emerald-500/10 rounded-lg text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                </div>
            </div>
        </div>

        <!-- Economy -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-5 hover:border-white/10 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Economy</p>
                    <h3 class="text-2xl font-semibold text-white mt-1"><?php echo e(number_format($stats['total_coins'])); ?></h3>
                </div>
                <div class="p-2 bg-amber-500/10 rounded-lg text-amber-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- RAM Usage -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-5 hover:border-white/10 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">RAM Load</p>
                    <h3 class="text-2xl font-semibold text-white mt-1"><?php echo e(number_format($stats['total_ram'] / 1024, 1)); ?> GB</h3>
                </div>
                <div class="p-2 bg-blue-500/10 rounded-lg text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Network Activity Graph (Spans 2 columns) -->
        <div class="lg:col-span-2 bg-zinc-900 border border-white/5 rounded-xl p-6 shadow-sm flex flex-col h-[450px]">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-medium text-white">Registration Traffic</h3>
                    <p class="text-sm text-zinc-500">User sign-up frequency over the last 7 days.</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-medium text-zinc-400">Live</span>
                </div>
            </div>
            
            <div class="relative w-full flex-grow">
                <!-- Vue Chart Component -->
                <admin-chart 
                    :labels='<?php echo json_encode($labels, 15, 512) ?>' 
                    :data-points='<?php echo json_encode($dataPoints, 15, 512) ?>'>
                </admin-chart>
            </div>
        </div>

        <!-- Recent Activity Feed (Sidebar) -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-0 shadow-sm flex flex-col h-[450px] overflow-hidden">
            <div class="p-6 border-b border-white/5 flex justify-between items-center bg-zinc-900/50">
                <h3 class="text-sm font-medium text-zinc-300">Activity Log</h3>
                <span class="text-xs text-zinc-500">Real-time</span>
            </div>
            
            <!-- Scrollable Log Container -->
            <div class="flex-grow overflow-y-auto custom-scrollbar p-0">
                <div class="divide-y divide-white/5">
                    <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-4 hover:bg-white/5 transition-colors flex items-start gap-3">
                        <!-- Status Dot -->
                        <div class="mt-1.5 w-1.5 h-1.5 rounded-full flex-shrink-0 
                            <?php if($log->type == 'success'): ?> bg-emerald-500
                            <?php elseif($log->type == 'warning'): ?> bg-amber-500
                            <?php elseif($log->type == 'danger'): ?> bg-red-500
                            <?php else: ?> bg-blue-500 <?php endif; ?>">
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-zinc-200 truncate"><?php echo e($log->action); ?></p>
                            <p class="text-xs text-zinc-500 mt-0.5 line-clamp-2"><?php echo e($log->description); ?></p>
                            
                            <div class="flex items-center mt-2 justify-between">
                                 <?php if($log->user): ?>
                                    <div class="flex items-center gap-2">
                                        <div class="w-4 h-4 rounded-full bg-zinc-800 text-[9px] flex items-center justify-center text-zinc-400 border border-zinc-700">
                                            <?php echo e(substr($log->user->name, 0, 1)); ?>

                                        </div>
                                        <span class="text-[10px] text-zinc-400"><?php echo e($log->user->name); ?></span>
                                    </div>
                                 <?php else: ?>
                                    <span class="text-[10px] text-zinc-500 font-mono uppercase">SYSTEM</span>
                                 <?php endif; ?>
                                 <span class="text-[10px] text-zinc-600"><?php echo e($log->created_at->diffForHumans(null, true)); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="flex flex-col items-center justify-center h-full text-center p-6">
                        <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-600 mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs text-zinc-500">No recent activity.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/admin/index.blade.php ENDPATH**/ ?>