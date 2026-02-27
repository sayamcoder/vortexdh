
<?php $__env->startSection('title', 'Support Center'); ?>

<?php $__env->startSection('content'); ?>
<div class="animate-fade">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white">Support Tickets</h1>
            <p class="text-sm text-zinc-400">View your history or open a new request.</p>
        </div>
        <a href="<?php echo e(route('support.create')); ?>" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg transition-colors">
            + Open Ticket
        </a>
    </div>

    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/5 text-zinc-400">
                <tr>
                    <th class="px-6 py-3">Subject</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Last Update</th>
                    <th class="px-6 py-3 text-right">View</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 font-medium text-white"><?php echo e($ticket->subject); ?></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                            <?php echo e($ticket->status == 'open' ? 'bg-emerald-500/10 text-emerald-400' : ($ticket->status == 'closed' ? 'bg-zinc-700 text-zinc-400' : 'bg-amber-500/10 text-amber-400')); ?>">
                            <?php echo e($ticket->status); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-zinc-500"><?php echo e($ticket->updated_at->diffForHumans()); ?></td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo e(route('support.show', $ticket->id)); ?>" class="text-indigo-400 hover:text-white font-bold">Open &rarr;</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="px-6 py-12 text-center text-zinc-500">No support tickets found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/support/index.blade.php ENDPATH**/ ?>