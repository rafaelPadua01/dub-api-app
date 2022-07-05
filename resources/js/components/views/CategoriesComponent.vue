<template>
	  <v-card class="mx-auto my-12">
	    <v-tabs
	      v-model="tab"
	      background-color="red"
	      dark
	    >
	      <v-tab
	        v-for="tab in items_tab"
	        :key="tab.tab"
	      >
	        {{ tab.tab }}
	      </v-tab>
	    </v-tabs>
	
	    <v-tabs-items v-model="tab">
	      <v-tab-item>
	        <v-card flat>
			<v-card-title>
				Categories
				<v-spacer></v-spacer>
				<v-text-field
					v-model="search"
					append-icon="mdi-magnify"
					single-line
					hide-details>
				</v-text-field>
			</v-card-title>
	          <v-card-text>
			
			<!-- Tabela de Categorias -->
			
			<v-data-table
				:headers="headers"
				:items="items"
				sort-by="category_name"
				class="elevation-1"
				:search="search"
			>
				<template v-slot:item.actions="{item}">
					<v-icon
						small
						class="mr-2"
						@click="editItem(item)"
						>
						mdi-pencil
					</v-icon>
					<v-icon
						small
						class="mr-2"
						@click="deleteItem(item)"
					>
						mdi-delete
					</v-icon>
				</template>
				<template v-slot:no-data>
					<v-btn
						color="primary"
						@click="initialize"
					>
						Reset
					</v-btn>
				</template> 
			</v-data-table>
			</v-card-text>
		</v-card>
	      </v-tab-item>
		
		<v-tab-item>
	        <v-card flat>
	          <v-card-text>
			<!-- Formulário de cadastro de novas categoras -->
			<v-form 
				ref="form"	
				v-model="valid"
				lazy-validation
				@submit.prevent>
				<v-container>
					<v-card>
						<v-card-text>
							<v-row>
							<v-col>
								<v-text-field
									v-model="editedItem.category_name"
									:rules="nameRules"
									:counter="10"
									label="Category Name: "
									required 
									>
								</v-text-field>
							</v-col>
						</v-row>
					</v-card-text>
			
					<v-card-actions>
						<v-btn
							:disable="!valid"
							color="red"
							class="mr-4"
							@click="save"
						>
							Salvar
						</v-btn>
						<v-btn 
							color="default"
							class="mr-4"
							@onClick="reset()"
						>
							Limpar
						</v-btn>
					</v-card-actions>
					</v-card>
			
					
				</v-container>
			</v-form>
		</v-card-text>
	        </v-card>
	      </v-tab-item>
	    </v-tabs-items>

		<!-- Edit Dialogs -->
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
						<h3>Update this {{ editedItem.category_name }}</h3> 
					</v-toolbar>
					<v-card-text>
						<div class="text-h2 pa-12">
							<v-form 
							ref="form"	
							v-model="valid"
							lazy-validation
							@submit.prevent>
							<v-container>
								<v-card>
									<v-card-text>
										<v-row>
										<v-col>
											<v-text-field
												v-model="editedItem.category_name"
												:rules="nameRules"
												:counter="10"
												label="Category Name: "
												required 
												>
											</v-text-field>
										</v-col>
									</v-row>
								</v-card-text>
						
								<v-card-actions>
									
									
								</v-card-actions>
								</v-card>
							</v-container>
						</v-form>
						</div>
					</v-card-text>

					<v-card-actions class="justify-end">
						<v-btn
							:disable="!valid"
							color="success"
							class="mr-4"
							@click="save"
							text
						>
							Salvar
						</v-btn>
						<v-btn 
							text
							color="red"
							class="mr-4"
							@click="reset"
						>
							Limpar
						</v-btn>
					</v-card-actions>
				</v-card>
			</template>
		</v-dialog>

		<!-- Delete Dialog -->
		<v-dialog
			v-model="deleteDialog"
			transition="dialog-bottom-transition"
			max-height="600"
		>
			<v-card>
				<v-toolbar 
					color="red"
					dark
					>
				<v-card-title>
					Remove Category {{editedItem.category_name}}
				</v-card-title>
	
				</v-toolbar>
				<v-spacer></v-spacer>
				<v-card-text>
					<p class="h3">
						Remover Item ??? {{editedItem.category_name}}
					</p> 
					<v-divider></v-divider>
					
				</v-card-text>
	
				<v-card-actions>
					<v-btn
						color="success"
						text
						@click="deleteItemConfirm"
					>
						confirmar
					</v-btn>
	
					<v-btn
						
						text
						@click="closeDelete"
					>
						close
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	  </v-card>

</template>

<script>
	import axios from 'axios';

	export default {
		name: 'MyCategories',
		data: () => ({
			tab: null,
			items_tab: [
				{ tab: 'Categorias', content: 'Categorias'},
				{ tab: 'Nova Categoria', content: 'Form'},
			],
			items: [],
			valid: false,
		headers: [{
			text: 'Nome Categoria',
			align: 'start',
			sortable: false,
			value: 'category_name',
		},
		{
			text: 'Criada Em:',
			value: 'created_at'
		},
		{
			text: 'Atualizada Em:',
			value: 'updated_at'
		},
		{ 
			text: 'Actions', value: 'actions', sortable: false	 },
		],
		search: '',
		category_name: ' ',
		nameRules: [
			v => !!v || 'Name is required',
			v => (v && v.length <= 10)  || 'Name must be lass than 10 ',
		],
		editedIndex: -1,
		editedItem: {},
		editDialog: false,
		deleteDialog: false,
		isEditing: false,
		model: null,
		}), 
		computed: {
			formTitle () {
				return this.editedIndex === -1 ?  'New Item' : 'Edit Item'
			}
		},
		watch: {
			editDialog  (val) {
				val || this.close();
			},
			deleteDialog (val) {
				val || this.closeDelete();
			}
		}, 
		methods: {
			receivedCategories() {
				axios.get('http://localhost:8000/api/categories')
				.then((response) => {           
					this.items = response.data;
					//return this.items.push(this.items);
				})
				.catch((response) => {
					return console.log(response.error);
				});
			},
			initialize() {
				this.items = [];	
			},
			reset(){
				this.$refs.form.reset();
			},
			insert() {
				const form = this.$refs.form.validate();
				let data = {name_category: this.category_name};
				if(form){
					axios.post('http://localhost:8000/api/categories/insert', data)
					.then((response) => {
						this.$refs.reset();
						return this.items.push(response.data);
					})
					.catch((response) => {
						return console.log(response.error);
					});
				}
			},
			editItem(item) {
			this.editedIndex = this.items.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.editDialog = true;
		},
		close() {
			this.editDialog = false;
			this.$nextTick(() => {
				this.editedItem = Object.assign({}, this.defaultItem)
				this.editedIndex = -1
			}) 
		},
		deleteItem(item) {
			this.editedItem = this.items.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.deleteDialog = true;
		},
		closeDelete() {
			this.dialogDelete  = false;		
			this.$nextTick(() => {
				this.editeditem = Object.assign({}, this.defaulItem);
				this.editedIndex = -1;
			})
		},
		deleteItemConfirm() {
			axios.delete(`/categories/delete/${this.editedItem.id}`)
			.then((response) =>{
				window.alert(this.editedItem .category_name + 'Item Removido');
				this.items.splice(this.editedIndex, this.editedItem.id);
				return this.closeDelete(); 
			})
			.catch((response) => {
				window.alert('Erro:  ' + response);
			});
			
			this.closeDelete();
		},
		save () {
			if(this.editedIndex > -1){
				let data = {
					name_category: this.editedItem.category_name,	
					id: this.editedItem.id
				};
				axios.put(`/categories/update/${data.id}`, data)
				.then((response) => {
					//window.alert(response);
					return window.location.reload();
					//return this.items.push(response);
				})
				.catch((response) => {
					return window.alert('Erro: ' + response);
				});
			}
			else
			{
				let data = {name_category: this.editedItem.category_name};
				if(data){
					axios.post('/categories/insert', data)
					.then((response) => {
						return	this.items.push(response);
						window.alert(response);
					})
					.catch((response) => {
						window.alert(response.error);
					});
				}
			}
			return this.close();
		} 
},
	created(){
		this.initialize();	
		this.receivedCategories();
	}
}
</script>