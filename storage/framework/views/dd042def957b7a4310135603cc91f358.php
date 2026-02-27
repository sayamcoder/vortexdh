
<?php $__env->startSection('title', 'New Ticket'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto animate-fade">
    <h1 class="text-2xl font-bold text-white mb-6">Open Support Request</h1>
    
    <form action="<?php echo e(route('support.store')); ?>" method="POST" class="bg-zinc-900 border border-white/5 rounded-xl p-6">
        <?php echo csrf_field(); ?>
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-zinc-400 uppercase mb-2">Subject</label>
                <input type="text" name="subject" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-3 text-white focus:border-indigo-500" required placeholder="e.g. Server crashed">
            </div>
            
            <div>
                <label class="block text-xs font-bold text-zinc-400 uppercase mb-2">Priority</label>
                <select name="priority" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-3 text-white focus:border-indigo-500">
                    <option value="low">Low - General Question</option>
                    <option value="medium">Medium - Technical Issue</option>
                    <option value="high">High - System Down</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-zinc-400 uppercase mb-2">Message</label>
                <textarea name="message" rows="5" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-3 text-white focus:border-indigo-500" required placeholder="Describe your issue..."></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-lg transition-colors">Submit Ticket</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/support/create.blade.php ENDPATH**/ ?>