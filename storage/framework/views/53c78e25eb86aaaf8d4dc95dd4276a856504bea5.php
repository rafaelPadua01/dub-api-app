<?php $__env->startSection('content'); ?>
<v-app>
	<appbar-component app></appbar-component>
		
		<v-main>
						
		</v-main>
	
		<footer-component app></footer-component>
</v-app>

<script>
	export default {
	data: () => ({
	}),
	created(){
		return this.$router.push('/home');
	}
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/lubuntu/Área de Trabalho/dub-api-app/resources/views/home.blade.php ENDPATH**/ ?>