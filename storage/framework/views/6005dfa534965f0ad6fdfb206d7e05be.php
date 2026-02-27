
<?php $__env->startSection('title', 'Broadcast System'); ?>

<?php $__env->startSection('content'); ?>
<div class="animate-fade grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Create Form -->
    <div class="lg:col-span-1">
        <h2 class="text-lg font-semibold text-white mb-4">New Broadcast</h2>
        <form action="<?php echo e(route('admin.announcements.create')); ?>" method="POST" class="bg-zinc-900 border border-white/5 rounded-xl p-6 shadow-sm">
            <?php echo csrf_field(); ?>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-zinc-400 mb-1.5">Alert Title</label>
                    <input type="text" name="title" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="e.g. Scheduled Maintenance">
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-400 mb-1.5">Alert Type</label>
                    <select name="type" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                        <option value="info">Information (Blue)</option>
                        <option value="success">Success (Green)</option>
                        <option value="warning">Warning (Amber)</option>
                        <option value="danger">Critical (Red)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-400 mb-1.5">Message Content</label>
                    <textarea name="message" rows="4" required class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-sm text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors" placeholder="Enter message for all users..."></textarea>
                </div>

                <button type="submit" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition-colors flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    Publish Broadcast
                </button>
            </div>
        </form>
    </div>

    <!-- Active List -->
    <div class="lg:col-span-2">
        <h2 class="text-lg font-semibold text-white mb-4">Active Broadcasts</h2>
        
        <div class="space-y-4">
            <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-zinc-900 border border-white/5 rounded-xl p-5 flex items-start justify-between group">
                <div class="flex items-start gap-4">
                    <div class="mt-1 w-2 h-2 rounded-full flex-shrink-0 
                        <?php if($announcement->type == 'success'): ?> bg-emerald-500 shadow-[0_0_8px_#10B981]
                        <?php elseif($announcement->type == 'warning'): ?> bg-amber-500 shadow-[0_0_8px_#F59E0B]
                        <?php elseif($announcement->type == 'danger'): ?> bg-red-500 shadow-[0_0_8px_#EF4444]
                        <?php else: ?> bg-blue-500 shadow-[0_0_8px_#3B82F6] <?php endif; ?>">
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white"><?php echo e($announcement->title); ?></h3>
                        <p class="text-sm text-zinc-400 mt-1"><?php echo e($announcement->message); ?></p>
                        <p class="text-[10px] text-zinc-600 mt-2"><?php echo e($announcement->created_at->diffForHumans()); ?></p>
                    </div>
                </div>
                
                <form action="<?php echo e(route('admin.announcements.delete', $announcement)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-zinc-600 hover:text-red-500 transition-colors p-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($announcements->isEmpty()): ?>
                <div class="text-center p-12 border border-dashed border-zinc-800 rounded-xl">
                    <p class="text-zinc-500 text-sm">No active broadcasts. The airwaves are silent.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/admin/announcements.blade.php ENDPATH**/ ?>