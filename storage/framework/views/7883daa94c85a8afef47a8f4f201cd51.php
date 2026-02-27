
<?php $__env->startSection('title', 'Global Leaderboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto animate-fade">
    
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-amber-500/10 text-amber-500 mb-4 shadow-[0_0_30px_rgba(245,158,11,0.2)]">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
        </div>
        <h1 class="text-3xl font-bold text-white tracking-tight">Global Wealth Leaderboard</h1>
        <p class="text-zinc-400 mt-2">The wealthiest commanders on the VortexDash network.</p>
    </div>

    <!-- Top 3 Podium -->
    <div class="flex flex-col md:flex-row justify-center items-end gap-4 md:gap-6 mb-12 mt-8 px-4">
        
        <!-- Rank 2 -->
        <?php if(isset($topUsers[1])): ?>
        <div class="w-full md:w-1/3 bg-zinc-900 border border-white/5 rounded-t-2xl rounded-b-lg p-6 text-center relative flex flex-col items-center order-2 md:order-1 h-[220px] justify-end">
            <div class="absolute -top-6 w-12 h-12 bg-zinc-800 border-4 border-zinc-950 rounded-full flex items-center justify-center text-zinc-300 font-black shadow-lg">2</div>
            <div class="w-16 h-16 rounded-full bg-zinc-800 flex items-center justify-center text-xl font-bold text-zinc-400 mb-3"><?php echo e(substr($topUsers[1]->name, 0, 1)); ?></div>
            <h3 class="text-white font-bold truncate w-full"><?php echo e($topUsers[1]->name); ?></h3>
            <p class="text-amber-500 font-mono text-sm mt-1"><?php echo e(number_format($topUsers[1]->coins)); ?> Coins</p>
        </div>
        <?php endif; ?>

        <!-- Rank 1 -->
        <?php if(isset($topUsers[0])): ?>
        <div class="w-full md:w-1/3 bg-gradient-to-b from-amber-500/10 to-zinc-900 border border-amber-500/30 rounded-t-2xl rounded-b-lg p-6 text-center relative flex flex-col items-center order-1 md:order-2 h-[260px] justify-end shadow-[0_0_40px_rgba(245,158,11,0.1)]">
            <div class="absolute -top-8 w-16 h-16 bg-amber-500 border-4 border-zinc-950 rounded-full flex items-center justify-center text-white text-xl font-black shadow-lg shadow-amber-500/50">1</div>
            <div class="w-20 h-20 rounded-full bg-zinc-950 border-2 border-amber-500/50 flex items-center justify-center text-2xl font-bold text-amber-500 mb-3 shadow-inner"><?php echo e(substr($topUsers[0]->name, 0, 1)); ?></div>
            <h3 class="text-white font-bold text-lg truncate w-full"><?php echo e($topUsers[0]->name); ?></h3>
            <p class="text-amber-500 font-mono font-bold mt-1"><?php echo e(number_format($topUsers[0]->coins)); ?> Coins</p>
        </div>
        <?php endif; ?>

        <!-- Rank 3 -->
        <?php if(isset($topUsers[2])): ?>
        <div class="w-full md:w-1/3 bg-zinc-900 border border-white/5 rounded-t-2xl rounded-b-lg p-6 text-center relative flex flex-col items-center order-3 h-[200px] justify-end">
            <div class="absolute -top-6 w-12 h-12 bg-zinc-800 border-4 border-zinc-950 rounded-full flex items-center justify-center text-orange-400 font-black shadow-lg">3</div>
            <div class="w-14 h-14 rounded-full bg-zinc-800 flex items-center justify-center text-lg font-bold text-zinc-400 mb-3"><?php echo e(substr($topUsers[2]->name, 0, 1)); ?></div>
            <h3 class="text-white font-bold truncate w-full"><?php echo e($topUsers[2]->name); ?></h3>
            <p class="text-amber-500 font-mono text-sm mt-1"><?php echo e(number_format($topUsers[2]->coins)); ?> Coins</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Rest of the Leaderboard (Ranks 4-10) -->
    <div class="bg-zinc-900 border border-white/5 rounded-2xl overflow-hidden">
        <div class="divide-y divide-white/5">
            <?php $__currentLoopData = $topUsers->skip(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center justify-between p-4 px-6 hover:bg-white/[0.02] transition-colors">
                <div class="flex items-center gap-4">
                    <span class="text-zinc-600 font-mono font-bold w-6">#<?php echo e($index + 4); ?></span>
                    <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-400 border border-white/5">
                        <?php echo e(substr($u->name, 0, 1)); ?>

                    </div>
                    <span class="text-zinc-200 font-medium"><?php echo e($u->name); ?></span>
                </div>
                <div class="text-amber-500 font-mono text-sm">
                    <?php echo e(number_format($u->coins)); ?> <span class="text-zinc-600 text-xs">V-C</span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/leaderboard.blade.php ENDPATH**/ ?>