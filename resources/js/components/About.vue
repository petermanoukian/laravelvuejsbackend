<template>
  <div>
  
	


    <!-- Welcome Area End -->


	<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-200-60" style="background-image: url(img/bg-img/3.jpg);">

		<div class="container">
			<div class="row">
				<!-- Heading -->
				<div class="col-12">
					<div class="section-heading text-center wow fadeInUp white" >
					   
						<h4>About Us</h4>
					</div>
				</div>
			</div>
		</div>
	</section>

	<About2 />






    <!-- Our Speakings Area Start -->
		<Blog1 />
    <!-- Our Speakings Area End -->





    <!-- Our Sponsor And Client Area Start -->
		<Gallery1 />
    <!-- Our Sponsor And Client Area End -->

	<Contact1/>

	<Footer />
    

</div>

</template>

<script>

import router from '../app2.js'


import Vue from 'vue';
import Router from 'vue-router';

import About2 from './About2.vue';
import Blog1 from './Blog1.vue';
import Gallery1 from './Gallery1.vue';
import Header from './Header.vue';
import Contact1 from './Contact1.vue';
import Footer from './Footer.vue';

export default {


components: { About2 ,Blog1 , Gallery1 ,  Header ,    Contact1 , Footer},

 data() {
      return {
        databanner: [
       
        ],
		//bannerdiv:[],
      };
    },
		created: function()
	{
		const vr1 = this.$router;
		this.fetchBanners();
		

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	
	methods: 
	{
		fetchBanners() 
		{
			let bsers = [];
			let bannerdivx = [];
			axios.get('/banner/json').then((res) => 
			{
				console.log( ' linne 1073 ' + res);
				
				//this.bannerdiv = res.data;
				//bsers = this.bannerdiv;
				bsers = res.data;
				for(let bser of bsers)
				{
				   //bannerdivx += "<div class='example-slide'>" + bser.name + "</div>";
				   bannerdivx.push("<div class='example-slide'><div style = 'width:100%;margin-top:14px;margin-bottom:10px;clear:both;text-align:center;'>" + bser.name + "</div><div style = 'width:100%;margin-top:5px;margin-bottom:28px;clear:both;text-align:center;'><img src ='images/service/"+bser.img+ "' alt = '' style = 'clear:both;'/></div></div>");
				   //console.log(' 1083 ' + bser.name);
				}
				//console.log(' 1085 ' + bannerdivx);
				this.databanner = bannerdivx;

			});
			


		},
		
	
	
	},
	


}
</script>

<style>
  .example-slide {
    align-items: center;
	margin-top:100px; 
    background-color: #666;
    color: #FFF;
    display: inline-block;
    font-size: 1.5rem;
    justify-content: center;
    min-height: 10rem;
	width:100%;
  }
</style>