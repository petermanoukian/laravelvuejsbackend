<template>
  <div>
  
	


    <!-- Welcome Area End -->


	<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-200-60" style="background-image: url(img/bg-img/3.jpg);">

		<div class="container">
			<div class="row">
				<!-- Heading -->
				<div class="col-12">
					<div class="section-heading text-center wow fadeInUp white" >
					   
						<h4>Contact us</h4>
					</div>
				</div>
			</div>
		</div>
	</section>

	



	<Contact2/>

	<Footer />
    

</div>

</template>

<script>

import router from '../app2.js'


import Vue from 'vue';
import Router from 'vue-router';


import Header from './Header.vue';
import Contact2 from './Contact2.vue';
import Footer from './Footer.vue';

export default {


components: {   Header ,    Contact2 , Footer},

 data() {
      return {

      };
    },
	created: function()
	{
		const vr1 = this.$router;
		
		

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	
	methods: 
	{
		

	
	
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