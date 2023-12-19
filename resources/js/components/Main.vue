<template>

    <div class="main">
	

	   <Header />
	    <div class="content">
           <router-view :key="$route.path"></router-view>
        </div>
	   

	   
	   
	</div>




</template>

<script>

import router from '../app2.js'


import Vue from 'vue'
import Router from 'vue-router'
import Header from './Header.vue';
import Footer from './Footer.vue';


export default 
{
    name: 'main-Home',
	components: { Header , Footer }
}
</script>