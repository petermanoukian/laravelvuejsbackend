<template>

    <header class="header-area">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                
                <nav class="classy-navbar justify-content-between" id="conferNav">

                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
  
                    <div class="classy-menu">
                        
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        
                        <div class="classynav">
                            <ul id="nav">
                                <li :class=" [{active: currentpager('home')}]">
									<router-link :to="{ name: 'home' }" class="nav-link"> 
									  Home
									</router-link> 
								
								</li>
								
								 <li><a :class=" [{purple: currentpager2('gallery' , 'bycat')}]">Gallery categories</a>
                                    <ul class="dropdown">
                                       <li>			   
									   		<router-link :to="{ name: 'gallery' }" class="nav-link"> 
												All Galleries 
											</router-link> 
									   </li>
									   <li  v-for="cat, index in catsnav.data"> 
											<router-link :to="{ name: 'gallery', params: { catid: cat.id  , bycitycat:'bycat' } }" class="nav-link"> 
												{{ cat.name }} 
											</router-link> 
									    </li>	
								     </ul>
                                </li>
								
								<li><a :class=" [{purple: currentpager2('gallery' , 'bycity')}]">Cities</a>
                                    <ul class="dropdown">
                                 
                                     <li v-for="city, index in citiesnav.data"> 

										<router-link :to="{ name: 'gallery', params: { catid: city.id  , bycitycat:'bycity' } }" class="nav-link"> 
											{{ city.name }} 
										</router-link> 
									  
									  </li>
															
										
										
								     </ul>
                                </li>
								
								
								<li><a :class=" [{purple: currentpager('blog' )}]">Blog</a>
                                    <ul class="dropdown">
									
									   <li>			   
									   		<router-link :to="{ name: 'blog' }" class="nav-link"> 
												All Blogs
											</router-link> 
									   </li>
									
									  <li v-for="blogcat, index in blogcatsnav.data"> 

										<router-link :to="{ name: 'blog', params: { bycat: 'bycat' ,  catid: blogcat.id } }" class="nav-link"> 
											{{ blogcat.name }}   &nbsp; &rsaquo; 
										</router-link> 
										
										
										    <ul class="dropdown" v-if="blogcat.subcats.length > 0 ">
                                                <li v-for="blogsubcat, index in blogcat.subcats">
												 
												
												  <router-link :to="{ name: 'blog', params: { bycat: 'bysub',catid: blogsubcat.catid ,subid: blogsubcat.id } }" 
												  class="nav-link"> 
													 &rsaquo; &nbsp;  {{ blogsubcat.name }}    
												  </router-link> 
												
												
												</li>
                                          
                                            </ul>
									  
									  </li>
                                 
                              
                                    </ul>
                                </li>
								
								
								<li><a :class=" [{purple: currentpager('shop' )}]">Shop</a>
                                    <ul class="dropdown">
									
									<li>			   
									   		<router-link :to="{ name: 'shop' }" class="nav-link"> 
												All Items
											</router-link> 
									   </li>
									
									  <li v-for="shopcat, index in shopcatsnav.data"> 

										<router-link :to="{ name: 'shop', params: { bycat: 'bycat' ,  catid: shopcat.id } }" class="nav-link"> 
											{{ shopcat.name }}   &nbsp; &rsaquo; 
										</router-link> 
										
										
										    <ul class="dropdown" v-if="shopcat.subcats.length > 0 ">
                                                <li v-for="shopsubcat, index in shopcat.subcats">
												  <router-link :to="{ name: 'shop', params: { bycat: 'bysub',catid: shopsubcat.catid ,subid: shopsubcat.id } }" 
												  class="nav-link"> 
													 &rsaquo; &nbsp;  {{ shopsubcat.name }}    
												  </router-link> 
												</li>
                                            </ul>
									  </li>
                                 
                              
                                    </ul>
                                </li>
								

                                <li><a :class=" [{purple: currentpager('about')}]">Pages</a>
                                    <ul class="dropdown">
                                 
                                        <li>
											<router-link :to="{ name: 'about' }" class="nav-link"
											:class=" [{purple: currentpager('about')}]"> 
												- About
											</router-link> 
										</li>

                                                                        
                                        <li>
											<router-link :to="{ name: 'contact' }" class="nav-link"
											:class=" [{purple: currentpager('contact')}]"> 
												- Contact
											</router-link> 
										</li>
                                   
                                    </ul>
                                </li>

                                <li :class=" [{active: currentpager('contact')}]">
									<router-link :to="{ name: 'contact' }" class="nav-link"> 
									  Contact
									</router-link> 
								
								</li>



                            </ul>

                            
                         
                        </div>
                       
                    </div>
                </nav>
            </div>
        </div>
    </header>





</template>

<script>

import router from '../app2.js'


import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-header',
	
	data: function() 
	{
		return {
		
			catsnav: {},
			citiesnav: {},
			blogcatsnav: {},
			shopcatsnav:{},
			 
		}
	},
	
	computed: {

		currentpager : function () 
		{
			 var vm = this;
			 //return this.$route.path;
				return function (pg) {
				//alert(portfolioid);
			   var pager = vm.$route.path;
			   if(pager == pg ||  pager.includes(pg)   )
			   {
					console.log(pager + ' IS equal to ' + pg);
					return true;
			   }
			   else
			   {
				
				 return false;
			   }
			}
		},
		
		currentpager2 : function () 
		{
			 var vm = this;
			 //return this.$route.path;
				return function (pg , pg2) {
				//alert(portfolioid);
			   var pager = vm.$route.path;
			   if(pager == pg ||  ( pager.includes(pg) && pager.includes(pg2)  ) )
			   {
					console.log(pager + ' IS equal to ' + pg);
					return true;
			   }
			   else
			   {
				
				 return false;
			   }
			}
		},
		
		
		currentpager3 : function () 
		{
			
			let urll = window.location.href;
			
			return urll;

			
		},
		
		
		
		
	},
	
	
	created: function()
	{
		const vr1 = this.$router;
		this.fetchPortCatsNav();
		this.fetchPortCitiesNav() ;
		this.fetchPortBlogCatsNav() ;
		this.fetchPortShopCatsNav() ;

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	
	methods: 
	{
		fetchPortCatsNav() 
		{
			axios.get('/gallerycat/json').then((res) => 
			{
				//console.log( ' linne 172 ' + res);
				this.catsnav = res;
			});

		},
		
		fetchPortCitiesNav() 
		{
			axios.get('/gallerycity/json').then((res) => 
			{
				//console.log( ' linne 182 ' + res);
				this.citiesnav = res;
			});

		},
		
		fetchPortBlogCatsNav() 
		{
			axios.get('/blogcat/json/bycat').then((res) => 
			{
				console.log( ' linne 192 ' + res);
				this.blogcatsnav = res;
			});

		},
		
		fetchPortShopCatsNav() 
		{
			axios.get('/shopcat/json/bycat').then((res) => 
			{
				console.log( ' linne 192 ' + res);
				this.shopcatsnav = res;
			});

		},
		
		
	
	},
	

	
	
	
	
}
</script>

