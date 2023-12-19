require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCarousel from '@chenfengyuan/vue-carousel';
import Vuex from 'vuex';
import VeeValidate from 'vee-validate'
//import {routes} from './routes.js';
import storeData from './store.js';

import MainHome from './components/Main.vue';
import Home from './components/Home.vue';
import About from './components/About.vue';
import Contact from './components/Contact.vue';
import Portfolio from './components/Portfolio.vue';
import Gallery from './components/Gallery.vue';
import Blog from './components/Blog.vue';
import BlogDetail from './components/BlogDetail.vue';
import GalleryDetail from './components/GalleryDetail.vue';


import Shop from './components/Shop.vue';
import ShopDetail from './components/ShopDetail.vue';

Vue.component('pagination', require('laravel-vue-pagination'));

export const routes = [

	{
		path: '/',
		name: 'home1',
		component: Home,
	},
	{
		path: '/home',
		name: 'home',
		component: Home,
	},
	{
		path: '/about',
		name: 'about',
		component: About,
	},
	
	{
		path: '/contact',
		name: 'contact',
		component: Contact,
	},
	
	
	
	{
		path: '/portfolio',
		name: 'portfolio',
		component: Portfolio,
	},
	
	{
		path: '/gallery/:catid?/:bycitycat?/',
		name: 'gallery',
		component: Gallery,
		props: true,
	}
	,
	
	
	{
		path: '/gallerysearch/:keywords?/',
		name: 'gallerysearch',
		component: Gallery,
		props: true,
	}
	,
	
	{

		path: '/blog/:bycat?/:catid?/:subid?/',
		name: 'blog',
		component: Blog,
		props: true,
	}
	,
	
	{

		path: '/blogdetail/:blogid?/:catid?/:subid?/',
		name: 'blogdetail',
		component: BlogDetail,
		props: true,
	}
	,
	
	{

		path: '/galdetail/:galid?/',
		name: 'galdetail',
		component: GalleryDetail,
		props: true,
	}
	,
	
	{
		path: '/blogsearch/:keywords?/',
		name: 'blogsearch',
		component: Blog,
		props: true,
	}
	,
	
	{
		path: '/shopsearch/:keywords?/',
		name: 'shopsearch',
		component: Shop,
		props: true,
	}
	,
	
	
	{

		path: '/shop/:bycat?/:catid?/:subid?/',
		name: 'shop',
		component: Shop,
		props: true,
	}
	,
	
	{

		path: '/shopdetail/:shopid?/:catid?/:subid?/',
		name: 'shopdetail',
		component: ShopDetail,
		props: true,
	}
	,
	
	

]

Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueCarousel);
const router = new VueRouter({
	routes,
	mode: 'history'
});

const store = new Vuex.Store(storeData);

Vue.mixin({
  data: function() {
    return {
      globalURL:'http://petermanoukian.xyz/'
    }
  }
})


const app2 = new Vue({
	el: '#app2',
	router,
	store,
	created: function() {
    
  },
	
	
	components: 
	{
		MainHome
	}
});