import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../components/views/HomeComponent.vue'
import Categories from '../components/views/CategoriesComponent.vue'
import Products from '../components/views/ProductsComponent.vue'
Vue.use(VueRouter);


const routes = [
		{
			path: '/home',
			name: 'home',
			component: Home
		},
		{
			path: '/categories',
			name: 'categories',
			component: Categories,
		},
		{
			path: '/products',
			name: 'products' ,
			component: Products,
		}
]


const router = new VueRouter({
	routes
})

export default router