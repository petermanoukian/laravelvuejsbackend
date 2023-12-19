<template>


<div>

    <section class="about-us-countdown-area section-padding-100-0" >
        <div class="container">
            <div class="row align-items-center">
                <!-- About Content -->
                <div class="col-12 col-md-12">
                    <div class=" mb-40">
                        <p class="bold white">About Us</p>
						<div class = 'white'>
							<div v-if = abdetail.data.description>
								<span  v-html="abdetail.data.description"></span>
							</div>
					
						</div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="about-thumb mb-80 wow fadeInUp" >
						<img :src=imagepathhomeab+abdetail.data.img alt = "" class ='maximg92height400'/>
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
	name: 'app-about2',
	
	data: function() 
	{
		return {
		
			abdetail: [],
			 
		}
	},
	created: function()
	{
		const vr1 = this.$router;
		this.fetchAbout1();
	

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	computed: {

			imagepathhomeab : function (logo) 
			{
				return "/images/about/";
		    },
	},
	methods: 
	{

		fetchAbout1() 
		{
			axios.get('/about/json/detail/1').then((res) => 
			{
				console.log( ' linne 87 ' + res);
				this.abdetail = res;
			});

		},
		
	
	},
	

	
	
	
	
}
</script>

