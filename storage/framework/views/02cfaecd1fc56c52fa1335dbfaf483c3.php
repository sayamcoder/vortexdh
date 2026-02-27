
<?php $__env->startSection('title', 'Help Desk'); ?>

<?php $__env->startSection('content'); ?>
<div class="animate-fade">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Help Desk</h1>
            <p class="text-gray-400 mt-1 font-medium">Manage incoming support requests.</p>
        </div>
        <a href="<?php echo e(route('admin.index')); ?>" class="px-4 py-2 bg-zinc-900 border border-white/10 text-zinc-300 hover:text-white rounded-lg text-sm font-bold">&larr; Back</a>
    </div>

    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/5 text-zinc-400">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Subject</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 font-mono text-zinc-500">#<?php echo e($ticket->id); ?></td>
                    <td class="px-6 py-4 text-white font-medium"><?php echo e($ticket->user->name); ?></td>
                    <td class="px-6 py-4 text-zinc-300"><?php echo e(Str::limit($ticket->subject, 40)); ?></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                            <?php echo e($ticket->status == 'open' ? 'bg-emerald-500/10 text-emerald-400' : ($ticket->status == 'closed' ? 'bg-zinc-800 text-zinc-500' : 'bg-amber-500/10 text-amber-400')); ?>">
                            <?php echo e($ticket->status); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo e(route('admin.tickets.show', $ticket->id)); ?>" class="text-indigo-400 hover:text-white font-bold">Manage &rarr;</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="p-4"><?php echo e($tickets->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>