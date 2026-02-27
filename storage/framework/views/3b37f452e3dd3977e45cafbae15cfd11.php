
<?php $__env->startSection('title', 'Audit Log'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto animate-fade">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white tracking-tight">Audit Log</h1>
        <p class="text-sm text-zinc-400 mt-1">A complete history of actions performed on your account.</p>
    </div>

    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/5 text-zinc-400">
                <tr>
                    <th class="px-6 py-3">Action</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3 text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-white/[0.02]">
                    <td class="px-6 py-4 font-medium text-white"><?php echo e($log->action); ?></td>
                    <td class="px-6 py-4 text-zinc-400"><?php echo e($log->description); ?></td>
                    <td class="px-6 py-4 text-right text-zinc-500 font-mono"><?php echo e($log->created_at->format('Y-m-d H:i:s')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="3" class="px-6 py-12 text-center text-zinc-500">No logs recorded.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-4 border-t border-white/5">
            <?php echo e($logs->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/account/activity.blade.php ENDPATH**/ ?>