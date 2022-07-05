<template>
	
	<v-footer 
		dark
		padless
	>
		<v-card
			class="flex"
			flat
			tile
		>
			<v-card-title class="red">
				<strong class="subheading">Get Connect with us on social networks</strong>
			</v-card-title>
			<v-spacer></v-spacer>
			
			<v-btn
				v-for="icon in icons"
				:key="icon"
				class="mx-4"
				dark
				icon
			>		
				<v-icon size="24px">
					{{icon}}
				</v-icon>
			</v-btn>

		</v-card>

		<v-card-text class="py-2 white--text text-center">
			 {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
		</v-card-text>
		
	</v-footer>
</template>

<script>
	export default {
		name: 'MyFooter',
		data: () => ({
			icons: [
				'mdi-facebook',
				'mdi-twitter',	
				'mdi-linkedin',
				'mdi-instagram'
			],
		}),
	}
</script>