<template>


<div>

<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-100-60" style="background-image: url(img/bg-img/3.jpg);">
        <div class="container">
            <div class="row">
                <!-- Heading -->
                <div class="col-12">
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="300ms">
                       
                        <h4>Our Blog</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Speaker Area -->
                <div  v-for="blog, index in homeblogs.data" class="col-12 col-md-6 col-lg-4">
				
				
                    <div class="single-speaker-area bg-gradient-overlay-2 wow fadeInUp" >
					
                      
                        <div class="speaker-single-thumb">
							<img v-bind:src="'/images/blog/thumb/' + blog.logo" v-bind:alt = blog.name  v-bind:title = blog.name  class= 'zindex99'/>
							
                        </div>
                        
                        <div class="social-info">
                            <a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'blogdetail/'+ blog.id "
							target = '_blank'><i class="zmdi zmdi-facebook"></i></a>
                          
                            <a v-bind:href="'https://twitter.com/share?text='+blog.name+'&url='+globalURL+'blogdetail/'+ blog.id "
							target = '_blank'><i class="zmdi zmdi-twitter"></i></a>
                           
                        </div>
						
						<div class="speaker-info">
                            <h5>  
								<router-link :to="{ name: 'blogdetail' , params: { blogid: blog.id,catid: blog.catid ,subid: blog.subid } }" 
								class = 'white'> {{ blog.name }}  </router-link>    
							</h5>  
                        </div>
                    </div>	
                </div>


                <div class="col-12">
                    <div class="more-speaker-btn text-center mt-20 mb-40 wow fadeInUp" data-wow-delay="300ms">
					
						<router-link :to="{ name: 'blog' }" class="btn confer-btn-white">
							View all Blogs <i class="zmdi zmdi-long-arrow-right"></i>
						</router-link>
                    </div>
                </div>
				
				
            </div>
        </div>
    </section>




</div>


</template>

<script>

import router from '../app2.js'


import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-blog1',
	
	data: function() 
	{
		return {
		
			homeblogs: {
				
			
			},
			 
		}
	},
	created: function()
	{
		const vr1 = this.$router;
		this.fetchBlogs1();
	

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	computed: {

			imagepathhomeblog : function (logo) 
			{
				return "/images/blog/thumb/";
		    },
	},
	methods: 
	{

		fetchBlogs1() 
		{
			axios.get('/blogghome/json').then((res) => 
			{
				console.log( ' blogs linne 217 ' + res);
				this.homeblogs = res;
			});

		},
		
	
	},
	

	
	
	
	
}
</script>

