<template>
	<v-app>
		<v-spacer></v-spacer>
		<v-card 
			class="mx-auto"
		>
		
		<v-row dense>
					<v-col 
						v-for="card in cards"
						:key="card.itle"
						:cols="card.flex"
					>
						<v-card>
							<v-img
							:src="card.src"
							class="white --text align-end"
							gradient="to botom, rgba(0, 0, 0, .1), rgba(0, 0, 0, .5)"
							height="200px"
						>
							<v-card-title v-text="card.title">Title</v-card-title>
						</v-img>
						</v-card>
						
					</v-col>
				</v-row>
		
		</v-card>
	 </v-app>
</template>

<script>
	export default {
	data: () => ({
		cards: [
			{title: 'Sobradinho', src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', flex: 12},
			{title: 'Sobradinho 2', src:  'https://cdn.vuetifyjs.com/images/cards/road.jpg', flex: 6},
			{title: 'Setor de Mansões', src: 'https://cdn.vuetifyjs.com/images/cards/plane.jpg', flex: 6},
		],
	}),	
}
</script>