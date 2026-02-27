
<?php $__env->startSection('title', 'Voucher Manager'); ?>

<?php $__env->startSection('content'); ?>
<div class="animate-fade grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Create Form -->
    <div class="lg:col-span-1">
        <h2 class="text-lg font-semibold text-white mb-4">Generate Voucher</h2>
        <form action="<?php echo e(route('admin.vouchers.create')); ?>" method="POST" class="bg-zinc-900 border border-white/5 rounded-xl p-6 shadow-sm">
            <?php echo csrf_field(); ?>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-zinc-400 mb-1.5">Code (Uppercase)</label>
                    <input type="text" name="code" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-sm text-white focus:border-indigo-500 uppercase font-mono" placeholder="WELCOME2025">
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-400 mb-1.5">Coin Reward</label>
                    <input type="number" name="reward" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-sm text-white focus:border-indigo-500" placeholder="100">
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-400 mb-1.5">Max Uses (Optional)</label>
                    <input type="number" name="max_uses" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-sm text-white focus:border-indigo-500" placeholder="Leave empty for infinite">
                </div>

                <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-medium rounded-lg transition-colors">
                    Create Code
                </button>
            </div>
        </form>
    </div>

    <!-- List -->
    <div class="lg:col-span-2">
        <h2 class="text-lg font-semibold text-white mb-4">Active Vouchers</h2>
        
        <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-white/5 text-zinc-400 font-medium">
                    <tr>
                        <th class="px-6 py-3">Code</th>
                        <th class="px-6 py-3">Reward</th>
                        <th class="px-6 py-3">Usage</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-white/[0.02]">
                        <td class="px-6 py-4 font-mono text-white"><?php echo e($voucher->code); ?></td>
                        <td class="px-6 py-4 text-emerald-400 font-bold">+<?php echo e($voucher->reward); ?></td>
                        <td class="px-6 py-4 text-zinc-400">
                            <?php echo e($voucher->uses); ?> / <?php echo e($voucher->max_uses ?? '∞'); ?>

                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="<?php echo e(route('admin.vouchers.delete', $voucher)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-400 hover:text-red-300 hover:underline text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/admin/vouchers.blade.php ENDPATH**/ ?>