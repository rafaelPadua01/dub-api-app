<template>
	<v-card  class="mx-auto my-12">
		<v-card-title>
			<p class="h4">Welcome to the Dub Lounge {{user.name}}</p>
		</v-card-title>
		<v-divider></v-divider>
	 	<v-card-text>
			<p ><strong>Overview</strong></p>
		</v-card-text>
		<v-card-text>
			<v-row>
				<v-col>
					<v-card 
						class="text-white" 
						dark
						width="250"
					> 
						<v-img
							lazy-src="../storage/images/product.jpg"
							src="../storage/images/category.jpeg"
							alt="Category image"
							height="150px"
							
							
						>
							<v-card-title>
									Categories
									<p class="4">
										{{categories.length}} 
									</p>
							</v-card-title>
							<v-divider></v-divider>
							<v-card-text>
							 	
								
							</v-card-text>
					</v-img>
					
					</v-card>
				</v-col>
				<v-col>
					<v-card 
						class="text-white"
						dark
						width="250px"
					>
						<v-img
							lazy-src="../storage/images/product.jpg"
							src="/storage/images/product2.jpg"
							alt="products image"
							height="150px"
							
						>
							<v-card-title>
								Products
								<p class="h4">{{products.length}}</p>
							</v-card-title>
							<v-divider></v-divider>
							
						</v-img>	
			
					</v-card>	
				</v-col>
				<v-col>
					<v-card 
						class="text-white"
						dark
						width="250px"
					>
						<v-img
							lazy-src="../storage/images/product.jpg"
							src="/storage/images/product2.jpg"
							alt="products image"
							height="150px"
							
						>
							<v-card-title>
								Sales
								<p class="h4">Vendas aqui...</p>
							</v-card-title>
							<v-divider></v-divider>
							
						</v-img>	
			
					</v-card>	
				</v-col>

			</v-row>
		</v-card-text>
		<v-divider></v-divider>

		<v-card-text>
			<p><strong>Secondary</strong></p>
		</v-card-text>
		<v-card-text>
			<v-row>
				<v-col>
					<v-card
						class="mx-auto text-center"
						color="red"
						dark
						max-width="600"
					>
						<v-card-title>Graphics</v-card-title>
							<v-card-text>
								<v-sheet color="rgba(0. 0, 0, .12)">
									<v-sparkline
										:value="value"
										color="rgba(255, 255, 255, .7)"
										height="100"
										padding="24"
										stroke-linecap="round"
										smooth
									>
										<template v-slot:label="item">
											${{item.value}}
										</template>
								</v-sparkline>
								</v-sheet>
							</v-card-text>
						<v-card-text>
							<div class="text0-h4 font-weight-thin">
								Sales last 24h
							</div>
						</v-card-text>

						<v-divider></v-divider>

						
					</v-card>
				</v-col>
			</v-row>
		</v-card-text>
	</v-card>
	
</template>

<script>
	export default {
	data: () => ({
		user: [],
		categories: [],
		products: [],
		value: [
			 423,
		        446,
		        675,
		        510,
		        590,
		        610,
		        760,
		],
	}),
	methods: {
		getLoggedUser(){
			axios.get('/user')
			.then((response) => {
				this.user = response.data;
				return this.user;
		})
			.catch((response) => {
				return window.alert('Você está acessando uma área não permitida, volte e faça login');
				
			})
		},
		getCategories(){
			axios.get('/categories')
			.then((response) => {
				this.categories = response.data;
			
				
				return this.categories ;
			})
			.catch((response) => {
				console.log('Erro:  ' + response.error);
			});
		},
		getProducts() {
			axios.get('/products')
			.then((response) => {
				this.products = response.data;
				return this.products;
			})
			.catch((response) => {
				console.log('Error :' + response.error);
			});
		}
	},
	created() {
		this.getLoggedUser();
		this.getCategories();
		this.getProducts();
	}
	
}
</script>