<template>
	
	
	<section class="our-blog-area bg-img bg-gradient-overlay section-padding-100-60" style="background-image: url(img/bg-img/17.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Heading -->
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="300ms">
                        <p>Our Shop</p>
                        <h4>Latest items</h4>
                    </div>
                </div>

               
                <div class="col-12 col-md-6 col-lg-4" v-for="shop, index in homeshops.data"> 
			
                    <div class="single-blog-area wow fadeInUp" data-wow-delay="300ms">
                        
                        <div class="single-blog-thumb center">
                            
							<img v-bind:src="'/images/shop/thumb/' + shop.logo" v-bind:alt = shop.name  v-bind:title = shop.name  class= 'zindex99'/>
                        </div>
                        <div class="single-blog-text text-center">
                            <router-link :to="{ name: 'shopdetail' , params: { shopid: shop.id,catid: shop.catid ,subid: shop.subid } }" 
							> {{ shop.name }}  
							</router-link>   
                            <!-- Post Meta -->
							
							<div class="post-meta">
								<span v-if = shop.shopcat.name>
									<router-link :to="{ name: 'shop', params: { bycat: 'bycat' ,  catid: shop.catid } }" > 
									
									{{ shop.shopcat.name }}
									</router-link>
								</span>
								<span v-if = "shop.subid != NULL ">
									<router-link :to="{ name: 'shop', params: { bycat: 'bysub',catid: shop.catid ,subid: shop.subid } }" > 
									
									{{ shop.shopsub.name }}
									</router-link>
								</span>
                            </div>
                      
                            <p>
							
							{{ shop.prix }} $ 
							</p>
                        </div>
                        <div class="blog-btn">
                             <router-link :to="{ name: 'shopdetail' , params: { shopid: shop.id,catid: shop.catid ,subid: shop.subid } }" 
							><i class="zmdi zmdi-long-arrow-right"></i></router-link> 
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- Our Blog Area End -->
	
</template>



<script>

import router from '../app2.js'


import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-shop1',
	
	data: function() 
	{
		return {
		
			homeshops: {
				
			
			},
			 
		}
	},
	created: function()
	{
		const vr1 = this.$router;
		this.fetchShops1();
	

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	computed: {

			imagepathhomeshop : function (logo) 
			{
				return "/images/shop/thumb/";
		    },
	},
	methods: 
	{

		fetchShops1() 
		{
			axios.get('/shopphome/json').then((res) => 
			{
				console.log( ' items linne 139 ' + res);
				this.homeshops = res;
			});

		},
	},

}
</script>