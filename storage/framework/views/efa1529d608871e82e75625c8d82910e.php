
<?php $__env->startSection('title', 'Developer API'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto animate-fade">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white tracking-tight">Developer API</h1>
        <p class="text-sm text-zinc-400 mt-1">Manage personal access tokens for external integrations.</p>
    </div>

    <!-- Generate Box -->
    <div class="bg-zinc-900 border border-white/5 rounded-xl p-6 mb-8">
        <h2 class="text-lg font-semibold text-white mb-2">Generate New Token</h2>
        <p class="text-sm text-zinc-500 mb-6">Tokens allow third-party applications to control your servers. Treat them like passwords.</p>
        
        <div class="flex gap-4">
            <input type="text" class="flex-1 bg-zinc-950 border border-zinc-800 rounded-lg p-2.5 text-white focus:border-indigo-500 transition-colors" placeholder="Token Name (e.g. Billing Bot)">
            <button class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-lg transition-colors">Generate</button>
        </div>
    </div>

    <!-- Active Tokens -->
    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/5 bg-zinc-900/50">
            <h3 class="text-sm font-bold text-zinc-300">Active Tokens</h3>
        </div>
        <div class="p-8 text-center">
            <div class="w-12 h-12 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4 text-zinc-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
            </div>
            <p class="text-sm text-zinc-500">No active API tokens found.</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/account/api.blade.php ENDPATH**/ ?>