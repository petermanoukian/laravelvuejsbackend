<template>


<div>

	<section class="our-sponsor-client-area section-padding-100">
		<div class="container">
		
            <div class="row">
			
                <!-- Heading -->
                <div class="col-12">
                    <div class="section-heading-2 text-center wow fadeInUp" data-wow-delay="300ms">
                     
                        <h4> Armenian Tourism </h4>
                    </div>
                </div>
            </div>

            <div class="row">
			
                <div class="col-12">
                    
                    <div class="our-sponsor-area d-flex flex-wrap">
					
                        
                        <div class="single-sponsor " v-for="gal, index in homegals.data" >
						
							   <div class='blocklear1008-8 center'> 
								<router-link :to="{ name: 'galdetail' , params: { galid: gal.id} }" class = 'white'>
									<img v-bind:src="'/images/thumb/' + gal.logo" v-bind:alt = gal.name  v-bind:title = gal.name  
									class= 'zindex99 center'/>
								</router-link>
								</div>
						
							    <div class='blocklear1008-8 center'> 
								<router-link :to="{ name: 'galdetail' , params: { galid: gal.id} }" class = 'white'> 
								&rsaquo; {{ gal.name }} </router-link>
								</div>
													
							
							
                        </div>
                        
                       
                       
                     
                    </div>
                </div>

			</div>
                
						
			<div class = 'row margintop8'>

				<div v-for="vid, index in homevids.data" class="single-client-content col-sm-12 col-md-12 col-lg-4 col-xl-4 col-12  white">
			
			
						<div class="single-client-text">
							<div class="blocklear1008-8 center">
								<iframe v-bind:src=vid.url class = 'iframe'>
								
								</iframe>
							</div>
					   
							<div class="blocklear1008-8 left">
								<!-- Single client Thumb -->
								<div class="blocklear1008-8 center">
									<img v-bind:src="'/images/thumb/' + vid.logo" v-bind:alt = vid.name  v-bind:title = vid.name  >
								</div>
								
								<div class="blocklear1008-8 center">
									
									<router-link :to="{ name: 'galdetail' , params: { galid: vid.id} }" class = 'white'> 
									&rsaquo; {{ vid.name }} </router-link>
									
									
									
								</div>
							</div>
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
	name: 'app-gal1',
	
	data: function() 
	{
		return {
		
			homegals: {},
			homevids: {},
			 
		}
	},
	created: function()
	{
		const vr1 = this.$router;
		this.fetchGals1();
		this.fetchVids1();
	

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	computed: {

			imagepathhomegal : function (logo) 
			{
				return "/images/thumb/";
		    },
	},
	methods: 
	{

		fetchGals1() 
		{
			axios.get('/galhome/json').then((res) => 
			{
				console.log( ' blogs linne 217 ' + res);
				this.homegals = res;
			});

		},
		fetchVids1() 
		{
		axios.get('/vidhome/json').then((res) => 
			{
				console.log( ' blogs linne 217 ' + res);
				this.homevids = res;
			});

		},
		
	
	},
	

	
	
	
	
}
</script>

