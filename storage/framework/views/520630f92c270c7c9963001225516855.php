

<?php $__env->startSection('panel_content'); ?>
<div class="flex-1 p-6 flex flex-col h-full overflow-hidden">
    <!-- Pass the websocket credentials from controller to Vue -->
    <server-console :websocket="<?php echo e(json_encode($websocket)); ?>"></server-console>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('servers.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\SSSSSS\stats\vortexdash\resources\views/servers/console.blade.php ENDPATH**/ ?>