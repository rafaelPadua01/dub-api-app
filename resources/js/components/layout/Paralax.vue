<template>
	<v-parallax
		:src="background"	
	>
		<div class="d-flex flex-column fill-height justify-center allign-center text-right">
			<h1>Rafael Pádua</h1>
			<h4 class="subheading">
				tipo colombia 
			</h4>
		</div>
	</v-parallax>
</template>

<script>
	import background from '@/assets/layout/background.jpeg'

	export default {
		data: () => ({
			background,
		}),
	}
</script>