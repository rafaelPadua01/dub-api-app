<template>
	
			<v-navigation-drawer
				permanent
				expand-on-hover
				class="Navigation"
			>
				<v-list class="ItemsHover">
					<v-list-item class="px-2">
						<v-list-item-avatar>
							<v-img src="https://ramdomuser.me/api/portraits/women/85.jpg"
							>
							</v-img>
							
						</v-list-item-avatar>
					</v-list-item>
			
					<v-list-item link>
						<v-list-item-content>
							<v-list-item-title>
								Name User
							</v-list-item-title>
							<v-list-item-subtitle>
								User Emall
							</v-list-item-subtitle>
						</v-list-item-content>
					</v-list-item>
				</v-list>

				<v-divider></v-divider>
				<v-list
					nav
					dense
				>
					<v-list-item link>
						<v-list-item-icon>
							<v-icon>mdi-folder</v-icon>
						</v-list-item-icon>
						<v-list-item-title>My Files</v-list-item-title>
					</v-list-item>
					<v-list-item link>
						<v-list-item-icon>
							<v-icon>mdi-accout-multiple</v-icon>
						</v-list-item-icon>
						<v-list-item-title>Shared with me</v-list-item-title>
					</v-list-item>
					<v-list-item link>
						<v-list-item-icon>
							<v-icon>mdi-star</v-icon>
						</v-list-item-icon>
						<v-list-item-title>Stared</v-list-item-title>
					</v-list-item>
				</v-list>
				
			</v-navigation-drawer>
	
	

</template>

<script>

</script>

