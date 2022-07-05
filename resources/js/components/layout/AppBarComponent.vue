<template>
	<v-card class="overflow-hidden">
		<v-row fluid>
				<v-app-bar 
					fixed
					color="#F51720"
					dark
					shrink-on-scroll
					prominent
					 src="https://picsum.photos/1920/1080?random"
					fade-img-on-scroll
					scroll-target="#scrolling-techniques-5"
					scroll-threshold="500"
				>
					<template v-slot:img="{props}">
						<v-img
							v-bind="props"
							gradient="to top right, rgba(244,11,11,0.7399334733893557), rgba(244,123,2,0.5718662464985995)"
						></v-img>
					</template>
		
					<v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>
					
					<v-spacer></v-spacer>
					<!-- titulo da App Bar , Exibe a logo aqui -->
					<v-app-bar-title>
						<v-img
							lazy-src="../storage/logo/dub_icon.png"
							src="../storage/logo/dub_icon.png"
							max-height="100"
							max-width="250"
							alt="Dub Lunge Bar"		
						>
						</v-img>
						<!-- <h4>Dub Lunge Bar --></h4>
					</v-app-bar-title>
		
					 <v-btn icon>
		        			<v-icon
							@click="logout"
						>
							mdi-logout-variant
						</v-icon>
		      			</v-btn>
				</v-app-bar>
		</v-row>
		
		<v-row dense nav>
			<v-col>
			<v-navigation-drawer
			      v-model="drawer"
			      absolute
			      temporary
				src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-HCPIGb7syH4N8kSKa5RxspHpGJzWsBCp3w&usqp=CAU"
				
				dark
			 >
			      <v-list
			        nav
			        dense
			      >

				<v-list-item class="mx-auto">
					<v-list-item-avatar>
						<v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
					</v-list-item-avatar>
					<v-list-item-title>Name: {{ users.name }}</v-list-item-title>
					<v-btn
						icon
						@click.stop="mini = !mini">
							<v-icon>mdi-chevron-left</v-icon>
						</v-btn>
				</v-list-item>
				<v-divider></v-divider>
					
				<!-- agrupa os links em uma lista  -->
			        <v-list-item-group
			          v-model="group"
			          active-class="deep-purple--text text--accent-4"
			        >
				<!-- Link Home -->
			        <router-link to="/home">
				  <v-list-item>
					 <v-list-item-icon>
				              <v-icon>mdi-home</v-icon>
				            </v-list-item-icon>
			            	<v-list-item-title>Home</v-list-item-title>
				</v-list-item>
				</router-link>
			<!-- Link Account ->
			          <v-list-item>
			            <v-list-item-icon>
			              <v-icon>mdi-account</v-icon>
			            </v-list-item-icon>
			            <v-list-item-title>Account</v-list-item-title>
			          </v-list-item>

				<v-divider></v-divider>

			<!-- Link Categorias -->
				<router-link to="/categories">
					<v-list-item>
				       	     <v-list-item-icon>
				              <v-icon>mdi-account</v-icon>
				            </v-list-item-icon>
				            <v-list-item-title>
							Categories
					</v-list-item-title>
					</v-list-item>
				</router-link>
				
				
			         </v-list-item>
		 	<!-- Links Produtos -->
				<router-link to="/products">
				 <v-list-item>
			            <v-list-item-icon>
			              <v-icon>mdi-account</v-icon>
			            </v-list-item-icon>
			            <v-list-item-title>Products</v-list-item-title>
			          </v-list-item>
				</router-link>
				
			        </v-list-item-group>
			      </v-list>
   		 </v-navigation-drawer>
			
			</v-col>
			
		</v-row>
		<v-row></v-row>
		<v-row justify="space-around">
			<v-col>
				
			<v-sheet
				id="scrolling-techniques-5"
      				class="overflow-y-auto pa-12"
   				 max-height="600"
				>
			<v-sheet class="mx-auto">
				<v-row>
					<v-col>
						<v-main>
							
							<v-container style="height: 850px;">
							
							<router-view></router-view>

					</v-container>
				</v-main>
					</v-col>
				</v-row>
						
				</v-sheet>
			<!-- Coteúdo principal -->
			
			</v-sheet>
			</v-col>
		</v-row>
	</v-card>
</template>
<script>
	
	export default {
		data: () => ({
			drawer: false,
			group: null,
			mini: true,
			users: [],
	}),
	methods: {
		getLoggedUser(){
			axios.get('/user')
			.then((response) => {
				return this.users = response.data;
				//window.alert('Get users here' + this.users);
			})
			.catch((response) => {
				console.log('Error ao conectar com o servidor: '+ response.error);
			});
		},
		logout(){
			axios.post('/logout')
			.then((response) => {
				window.alert('Sua sessão foi encerrada');
				return window.location.reload();
			})
			.catch((response) => {
				window.alert('Não foi possível encerrar sua sessão, contate o suporte');
			})
		}
	},
	created(){
		this.$router.push('/home');
		this.getLoggedUser();
	}
}
</script>