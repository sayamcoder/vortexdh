
<?php $__env->startSection('title', 'Account Settings'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto animate-fade">
    
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-white tracking-tight">Account Settings</h1>
        <p class="text-sm text-zinc-400 mt-1">Manage your profile, security, and preferences.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-zinc-900 border border-white/5 rounded-xl p-6 text-center">
                <div class="w-20 h-20 bg-zinc-800 rounded-full mx-auto flex items-center justify-center text-2xl font-bold text-zinc-400 mb-4 border border-zinc-700">
                    <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                </div>
                <h2 class="text-lg font-medium text-white"><?php echo e(Auth::user()->name); ?></h2>
                <p class="text-sm text-zinc-500"><?php echo e(Auth::user()->email); ?></p>
                <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-medium border border-indigo-500/20">
                    Commander
                </div>
            </div>
        </div>

        <!-- Settings Forms -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Personal Info -->
            <div class="bg-zinc-900 border border-white/5 rounded-xl p-6">
                <h3 class="text-base font-medium text-white mb-4">Personal Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-zinc-400 mb-1.5">Username</label>
                        <input type="text" value="<?php echo e(Auth::user()->name); ?>" disabled class="w-full bg-zinc-950 border border-zinc-800 text-zinc-500 text-sm rounded-lg p-2.5 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-400 mb-1.5">Email Address</label>
                        <input type="email" value="<?php echo e(Auth::user()->email); ?>" disabled class="w-full bg-zinc-950 border border-zinc-800 text-zinc-500 text-sm rounded-lg p-2.5 cursor-not-allowed">
                    </div>
                </div>
            </div>

            <!-- Security (Visual Only) -->
            <div class="bg-zinc-900 border border-white/5 rounded-xl p-6">
                <h3 class="text-base font-medium text-white mb-4">Security</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-zinc-400 mb-1.5">Current Password</label>
                        <input type="password" class="w-full bg-zinc-950 border border-zinc-800 text-white text-sm rounded-lg p-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all placeholder-zinc-700" placeholder="••••••••">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-zinc-400 mb-1.5">New Password</label>
                            <input type="password" class="w-full bg-zinc-950 border border-zinc-800 text-white text-sm rounded-lg p-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all placeholder-zinc-700" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-400 mb-1.5">Confirm New Password</label>
                            <input type="password" class="w-full bg-zinc-950 border border-zinc-800 text-white text-sm rounded-lg p-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all placeholder-zinc-700" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="pt-2 flex justify-end">
                        <button type="button" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition-colors">Update Password</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/account.blade.php ENDPATH**/ ?>