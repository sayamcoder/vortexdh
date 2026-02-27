
<?php $__env->startSection('title', 'Global Audit Log'); ?>

<?php $__env->startSection('content'); ?>
<div class="animate-fade">
    
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-semibold text-white tracking-tight">Global Audit Log</h1>
            <p class="text-sm text-zinc-400 mt-1">Real-time telemetry of all user actions across the network.</p>
        </div>
        <a href="<?php echo e(route('admin.index')); ?>" class="px-4 py-2 bg-zinc-900 border border-white/10 text-zinc-300 hover:text-white rounded-lg text-sm font-medium transition-colors">
            &larr; Back
        </a>
    </div>

    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/[0.02] border-b border-white/5 text-xs font-medium text-zinc-500 uppercase tracking-wider">
                        <th class="px-6 py-4">User Identity</th>
                        <th class="px-6 py-4">Action Type</th>
                        <th class="px-6 py-4">Details</th>
                        <th class="px-6 py-4 text-right">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            <?php if($log->user): ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-400 border border-white/5">
                                        <?php echo e(substr($log->user->name, 0, 1)); ?>

                                    </div>
                                    <div>
                                        <p class="text-sm text-white font-medium"><?php echo e($log->user->name); ?></p>
                                        <p class="text-xs text-zinc-500"><?php echo e($log->user->email); ?></p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <span class="text-zinc-500 text-xs font-mono uppercase">SYSTEM_KERNEL</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border
                                <?php if($log->type == 'success'): ?> bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                <?php elseif($log->type == 'warning'): ?> bg-amber-500/10 text-amber-400 border-amber-500/20
                                <?php elseif($log->type == 'danger'): ?> bg-red-500/10 text-red-400 border-red-500/20
                                <?php else: ?> bg-indigo-500/10 text-indigo-400 border-indigo-500/20 <?php endif; ?>">
                                <?php echo e($log->action); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-zinc-300 font-mono"><?php echo e($log->description); ?></p>
                        </td>
                        <td class="px-6 py-4 text-right text-xs text-zinc-500 font-mono">
                            <?php echo e($log->created_at->format('Y-m-d H:i:s')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-white/5">
            <?php echo e($logs->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/admin/activity.blade.php ENDPATH**/ ?>