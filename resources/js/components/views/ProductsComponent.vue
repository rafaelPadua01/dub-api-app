<template>
	<v-card class="mx-auto my-12">
		<v-tabs
			v-model="tab"
			background-color="red"
			dark
		>
			<v-tab
				v-for="tab in items_tab"
				:key="tab.tab">{{tab.tab}}</v-tab>
		</v-tabs>

		<v-tabs-items v-model="tab">
			<v-tab-item>
				<v-card flat>
					<v-card-title>
						Produtos
						<v-spacer></v-spacer>
						
						<v-text-field
							v-model="search"
							append-icon="mdi-magnify"
							label="Search"
							single-llne
							hide-details
						></v-text-field>
					</v-card-title>
					<v-card-text>
						
						<v-data-table
							:headers="headers"
							:items="products"	
							:search="search"
							sort-by="id"
							class="elevation-1"
						>
				<template v-slot:item.product_image="{ item }">
					<div class="p-2">
						<v-img
							v-bind:src="'../storage/products/' + item.product_name + '/'  + item.product_image"
							:alt="item.product_name"
							max-height="100"
 							 max-width="200"
						>
		
						</v-img>					
					</div>
				</template>
				<template v-slot:item.actions="{item}">
					
					<v-icon
						small
						@click="editItem(item)"
					>
						mdi-pencil
					</v-icon>
					<v-icon
						small
						@click="removeItem(item)"
						>mdi-delete</v-icon>
				</template>
			</v-data-table>
						
					</v-card-text>
				</v-card>
			</v-tab-item>

			<v-tab-item>
				<v-card flat>
					<v-card-text>
						<!-- Formulario de cadastro de produtos -->
						<v-form
							ref="form"
							v-model="valid"
							lazy-validation
							@submit.prevent
							
						>
							<v-card>
								<v-row>
									<v-col>
										<v-text-field
											v-model="product_name"
											:rules="nameRules"
											:counter="10"
											label="Product Name:"
											required
										>

										</v-text-field>
										<!-- Quantidade do produto -->
										<v-text-field
											v-model.number="product_quantity"
											label="quantity"
											type="number"
											step="any">
											min="0"	
											:rules="[numberRule]"
											>
										
										</v-text-field>
									</v-col>
								</v-row>

								<v-row>
									<v-col>
										<v-select
											v-model="select"
											:items="items"
											item-text="category_name"
											label="Categories"
											return-object
											required
										>
										</v-select>
									</v-col>
								</v-row>

							<v-row>
								<v-col>
									<v-file-input
										v-model="files"
										ref="files"
										accept="image/"
										placeholder="escolha uma imagem"
										prepend-icon="mdi-camera"
										truncate-length="15"
										label="Photo"
										:rules="imageRules"
									>
									</v-file-input>
								</v-col>
							</v-row>
								<v-container fluid>
									<v-row>
										<v-col cols="4">
											<v-subheader>Price: </v-subheader>
										</v-col>
											<v-col cols="8">
												<v-text-field
													v-model="price_product"
													label="Amount"
													value="10.00"
													prefix="$"
													required
												></v-text-field>
											</v-col>
										</v-row>
								</v-container>
								

							<v-row>
								<v-col>
									<v-textarea
										v-model="description_product"
										class="mx-2"
										label="descrição"
										rows="1"
										prepend-icon="mdi-comment"
									>
									</v-textarea>	
								</v-col>
							</v-row>
							<v-card-actions>
								<v-btn
									:disable="!valid"
									class="mr-4"
									color="success"	
									@click="save"		
									>
										Salvar
								</v-btn>
								<v-btn
									class="mr-2"
									color="reset"
								>
									Reset
								</v-btn>
							</v-card-actions>
							</v-card>
						</v-form>
					</v-card-text>
					<v-divider></v-divider>
					
				</v-card>
				
			</v-tab-item>
		</v-tabs-items>

		<!-- update dialog -->
				<v-dialog
					v-model="editDialog"
					transition="dialog-bottom-transition"
					max-height="600"
				>
					<template v-slot:default="editDialog">
						<v-card>
						<v-toolbar 
							color="red"
							dark
						>
								<v-card-title>
									Edit Product {{editedItem.product_name}}
								</v-card-title>
							</v-toolbar>
						<v-card-text>
							<!-- Formulario de Edição de produtos -->
						<v-form
							ref="form"
							v-model="valid"
							lazy-validation
							@submit.prevent
						>
							<v-card>
								<v-row>
									<v-col>
										<v-text-field
											v-model="editedItem.product_name"
											:rules="nameRules"
											:counter="10"
											label="Product Name:"
											required
										>

										</v-text-field>
										<!-- Quantidade do produto -->
										<v-text-field
											v-model.number="editedItem.product_quantity"
											label="quantity"
											type="number"
											step="any">
											min="0"	
											:rules="[numberRule]"
											>
										
										</v-text-field>
									</v-col>
								</v-row>

								<v-row>
									<v-col>
										<v-select
											v-model="select"
											:items="items"
											item-text="category_name"
											label="Categories"
											return-object
											required
										>
										</v-select>
									</v-col>
								</v-row>

							<v-row>
								<v-col>
									<v-file-input
										v-model="editedItem.files"
										accept="image/"
										placeholder="escolha uma imagem"
										prepend-icon="mdi-camera"
										truncate-length="15"
										label="Photo"
										:rules="imageRules"
									>
									</v-file-input>
								</v-col>
							</v-row>
								<v-container fluid>
									<v-row>
										<v-col cols="4">
											<v-subheader>Price: </v-subheader>
										</v-col>
											<v-col cols="8">
												<v-text-field
													v-model="editedItem.price_product"
													label="Amount"
													value="10.00"
													prefix="$"
													required
												></v-text-field>
											</v-col>
										</v-row>
								</v-container>
								

							<v-row>
								<v-col>
									<v-textarea
										v-model="editedItem.description_product"
										class="mx-2"
										label="descrição"
										rows="1"
										prepend-icon="mdi-comment"
									>
									</v-textarea>	
								</v-col>
							</v-row>
						
							</v-card>
						</v-form>
						</v-card-text>
				
						<v-card-actions>
							<v-btn
								color="success"
								text
								@click="save"
							>
								Confirmar
							</v-btn>
							<v-btn
								color="reset"
								text
								>
									Reset
								</v-btn>
							<v-btn
								color="error"
								text
								@click="close"
							>
								Close
							</v-btn>
						</v-card-actions>
					</v-card>
					</template>
					
				</v-dialog>	
			<!-- Delete Dialog -->
			<v-dialog
				v-model="removeDialog"
			>
				<v-card>
					<v-toolbar
						color="red"
						dark
				>
					<v-card-title>
					  remove this {{editedItem.product_name}} 
					</v-card-title>
				</v-toolbar>
					<v-card-text>
						<p class="h3">
							Are you shure you want  remove 
							this {{editedItem.product_name}}
							 product ?
						</p>
					</v-card-text>
					<v-divider></v-divider>
					<v-card-actions>
						<v-btn
							color="success"
							text
							@click="deleteItemConfirm"
						>
							Remove
						</v-btn>
						<v-btn
							color="error"
							text
							@click="closeDelete">
								Close
						</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>
		
				
	</v-card>
	
</template>

<script>
	import axios from 'axios'
	export default {
		name: 'MyProducts',
		data: () => ({
			tab: null,
			items_tab: [
				{tab: 'Products', content: 'Produtos'},
				{tab: 'Novo Produto', content: 'Form'},
			],
			headers: [
				{text: 'product name: ', align: 'start', sortable: false, value: 'product_name'},
				{text: 'product description: ', value: 'description_product'},
				{text: 'product price: ',  value: 'product_price'},
				{text: 'product image: ', value: 'product_image'},
				{text: 'product category: ', value: 'category_name'},
				{text: 'product quantity: ', value: 'product_quantity'},
				{text: 'Actions ', sortable: false, value: 'actions'},
			],
			search: '',
			valid: true,
			value: true,
			items: [],
			editedIndex: -1,
			editedItem: {},
			defaultItem: {},
			editDialog: false,
			removeDialog: false,
			products: [],
			select: null,
			product_name: '',
			nameRules: [
				v => !!v || 'Name product is required',
				v => (v && v.length <= 10) || 'Name product must be less 10 characters',
			],
			product_quantity: 0,
			numberRule: val => {
				if(val < 0) return 'Please enter a positive number...'
				return true
			},
			price_product: '',
			files: [],
			imageRules: [
				value => !value || value.size <= 1000000 || 'image shold be less than 10Mb',
			],
			description_product: ' ',
			product_quantity: '',
		}),
		computed: {
			formTitle() {
				return this.editedIndex === -1 ? 'New Item'  :  'Edit item'
			}
		},	
		watch: {
			editDialog(val) {
				val || this.close();
			},
		},
		methods: {
			getCategories(){
				axios.get('http://localhost:8000/api/categories')
				.then((response) => {
					 this.items = response.data;
					//return this.items.push(response.data);
				})
				.catch((response) => {
					return window.alert('Não foi possível conectar a api:' + response);
				});
			},
			getProducts(){
				axios.get('http://localhost:8000/api/products')
				.then((response) => {
					this.products = response.data;
					//window.alert(response.data);
				})
				.catch((response) => {
					window.alert('erro: ' + response.error);
				});		
			},
			initialize(){
				this.items = [];
				this.products = [];
			},
			validate(){
				this.$refs.form[0].validate();
				//return this.save();
				//return insert(data);
			},
			reset(){
				this.$refs.form.reset();
			},
			editItem (item) {
				this.editedIndex = this.products.indexOf(item);
				this.editedItem = Object.assign({}, item);
				this.editDialog = true;
			},
			close () {
				this.editDialog = false;
				this.$nextTick(() => {
					this.editedItem = Object.assign({}, this.defaultItem);
					this.editedIndex = -1;
				})
			},
			removeItem(item){
				this.editedIndex = this.products.indexOf(item);
				this.editedItem = Object.assign({}, item);
				this.removeDialog = true;
			},
			deleteItemConfirm(){
				axios.delete(`/products/delete/${this.editedItem.id}`)
				.then((response) => {
					//console.log(response.data);
					this.products.splice(this.editedIndex, response.data.id);
					return this.closeDelete();
				
				})
				.catch((response) =>{
					window.alert('Error: ' + response); 	
				});
				this.closeDelete();
			},
			closeDelete(){
				this.removDialog = false;
				this.$nextTick(() => {
					this.editedItem = Object.assign({}, this.defaultItem);
					this.editedIndex = -1;
				})
			},
			save() {
				if(this.editedIndex > -1) {
					
					let formData = new FormData();
					
					//campos adicionais do form
					formData.append('id', this.editedItem.id);
					formData.append("product_image",  this.editedItem.files);
					formData.append('product_name', this.editedItem.product_name);
					formData.append('category_id', this.select.id);
					formData.append('product_price', this.editedItem.price_product,);
					formData.append('description_product',this.editedItem.description_product);
					formData.append('product_quantity', this.editedItem.product_quantity);
		

			/*		let data = {
						id: this.editedItem.id,
						product_image: this.editedItem.files,
						product_name: this.editedItem.product_name,
						category_id: this.editedItem.select.id,
						product_price: this.editedItem.product_price,
						description_product: this.editedItem.description_product,
						product_quantity: this.editedItem.product_quatity,
					};
			*/		console.log(this.editedItem.files);
					axios.post(`/products/update/${this.editedItem.id}`, formData)
					.then((response) => {
						 //Object.assign(this.products[this.editedIndex], this.item);
						this.products.push(response.data);
						//console.log(this.editedItem.files);
						return window.location.reload();
					})
					.catch((response) => {
						window.alert('Erro: ' + response);
					});
				}
			else {
				let formData = new FormData();		
				formData.append("product_image",  this.files);
				formData.append('product_name', this.product_name);
				formData.append('category_id', this.select.id);
				formData.append('product_price', this.price_product,);
				formData.append('description_product',this. description_product);
				formData.append('product_quantity', this.product_quantity);
				
				/*
				let data = {
						product_image:files,
						product_name: product_name,
						category_id: this.select.id,
						product_price: this.price_product,
						description_product: this.description_product,
						product_quantity: this.product_quatity,
					};
					*/
					if(formData){
						axios.post('/products/insert', formData)
						.then((response) => {
							window.alert('Save successfull');
							return this.products.push(response.data);
						})
						.catch((response) => {
							return window.alert('Error: ' + response.error);
						});
					}
					
				}
				return this.close();
			}
			
		},
		created(){
			this.getCategories();
			this.getProducts();
			this.initialize();
		
	}
}
</script>