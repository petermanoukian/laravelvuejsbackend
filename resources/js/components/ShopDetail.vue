<template>
  <div>
	<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-200-60" v-bind:style='"background: url(img/bg-img/37.jpg);"'>
		<div class="container">
			<div class="row">
				<!-- Heading -->
				<div class="col-12">
					<div class="section-heading text-center wow fadeInUp " >
					   
						<h4>Shop Detail</h4>
						<nav aria-label="breadcrumb">
						     <ol class="breadcrumb">
                                <li class="breadcrumb-item">
								<router-link :to="{ name: 'home' }"> Home</router-link> </li>
								
								<li class="breadcrumb-item">
									<router-link :to="{ name: 'shop' }" > 
										All Shops 
									</router-link>  
								</li>
								
								
                                <li class="breadcrumb-item active" aria-current="page">Blog details</li>
                            </ol>
						</nav>	
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="confer-blog-details-area section-padding-100-0">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Post Details Area -->
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="pr-lg-4 mb-100">
                        <!-- Post Content -->
                        <div class="post-details-content">

							
							<div class="post-blog-thumbnail mb-30" id ='largeimg'>	
								<img v-bind:src=imagepath v-bind:alt=shopdetail.name v-bind:title =shopdetail.name class='zindex99 center'
								v-if="image1"/>
								<img :src="imagex" v-bind:alt=shopdetail.name v-bind:title =shopdetail.name class='zindex99 center' v-if="image2">
                            </div>
							
							<div class="row"  v-if ="typeof shopdetail.shopimages !== 'undefined' &&  shopdetail.shopimages.length > 0 ">
								<div class="col-3 margintopbottom8">
									<img v-bind:src="'/images/shop/thumb/' + shopdetail.logo"
								     v-bind:alt=shopdetail.name v-bind:title =shopdetail.name  class='zindex99 center cursor' 
									v-on:click='onImageChange("/images/shop/" + shopdetail.logo)' />
								
								</div>
								<div class="col-3 margintopbottom8" v-for="gal, index in shopdetail.shopimages">
									<img v-bind:src="'/images/gallery/thumb/' + gal.logo" v-bind:alt=gal.name 
									v-bind:title =gal.name class='zindex99 center cursor' 
									v-on:click='onImageChange("/images/gallery/" + gal.logo)'/>
								</div>

                            </div>
							
					
							<h4 class="post-title"> 
							 {{ shopdetail.name }} 
							</h4> 
							
							<p> Price:  {{ shopdetail.prix }} $ </p>


							<h5 v-if = "shopdetail.catid != NULL "> Category: {{ shopdetail.shopcat.name }} </h5>
						
							<h6 v-if = "shopdetail.subid != NULL "> SubCategory: {{ shopdetail.shopsub.name }} </h6>

							<div v-if = shopdetail.description class='margintopbottom10'>
								<span  v-html="shopdetail.description"></span>
							</div>
							
                        
                        </div>

                        <!-- Post Tags & Social Info -->
                        <div class="post-tags-social-area mt-30 pb-5 d-flex flex-wrap align-items-center">
                   

                            <!-- Author Social Info -->
                            <div class="author-social-info">
                                <a href="#"><i class="zmdi zmdi-linkedin"></i></a>
                                <a v-bind:href="'https://twitter.com/share?text='+shopdetail.name+'&url='+globalURL+'shopdetail/'+ shopdetail.id "
							     target = '_blank'>
								<i class="zmdi zmdi-twitter"></i>
								</a>
                                <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                <a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'shopdetail/'+ shopdetail.id " target = '_blank'>
								 <i class="zmdi zmdi-facebook"></i></a>
                                <a href="#"><i class="zmdi zmdi-share"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Shop Sidebar Area -->
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="confer-sidebar-area mb-100">

                        <!-- Single Widget Area -->
                        <div class="single-widget-area">
                            <div class="search-widget">
                                <form @submit.prevent="fetchsearchshop">
                                    <input type="search" name="search-form" id="searchForm" placeholder="Search" v-model="keywords">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area">
                            <!-- Post Author Widget -->
                            <div class="post-author-widget">
                        
                                <!-- Social Info -->
                                <div class="author-social-info">
                                    <a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'shopdetail/'+ shopdetail.id " target = '_blank'>
									<i class="zmdi zmdi-facebook"></i></a>
                                    <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                    <a v-bind:href="'https://twitter.com/share?text='+shopdetail.name+'&url='+globalURL+'shopdetail/'+ shopdetail.id "
							          target = '_blank'><i class="zmdi zmdi-twitter"></i></a>
                                    <a href="#"><i class="zmdi zmdi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

            

                        <!-- Single Widget Area -->
                        <div class="single-widget-area">
                            <h5 class="widget-title mb-30">Categories</h5>
                            <ul class="categories-list">
							
								<li  v-for="cat, index in cats.data"> 
									<router-link :to="{ name: 'shop', params: { bycat:'bycat', catid: cat.id   } }" 
									:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
										{{ cat.name }}  {{ cat.id}} {{ categoryId }} 
										( {{ cat.shopers_count}} )
									</router-link> 
								</li>

                            </ul>
                        </div>
						
						
						<div class="single-widget-area">
                            <h5 class="widget-title mb-30">Sub Categories</h5>
                            <ul class="categories-list">
							
								<li  v-for="sub, index2 in subs.data"> 
									<router-link :to="{ name: 'shop', params: {   bycat:'bysub', catid: sub.catid , subid: sub.id } }" class='marginright6'
									:class=" [{bold: classSub(sub.id)},{red: classSub(sub.id)}]"> 
										&rsaquo;  {{ sub.name }}  
										( {{ sub.shoperrs_count}} )
									</router-link> 
								</li>

                            </ul>
                        </div>
						
	



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Area End -->
    <Contact1/>
    <!-- Contact Area End -->
	<Footer />
	
</div>

</template>

<script>

import router from '../app2.js'


import Vue from 'vue';
import Router from 'vue-router';


import Footer from './Footer.vue';
import Contact1 from './Contact1.vue';
export default {


	components: { Footer  ,   Contact1  },

	data: function() {
      return {
		shopdetail: {
			logo: '' ,
			image: '' ,
			cat_id: '',
			sub_id: '',
	
	
		},
		
		cats: {},
		subs: {},
		ViewShop:
		{                    
			shopidx: null,
		},
		showimg1: true,
		showimg2: false,
		imagex: {}, 
		keywords: null,
		
		
      };
    },
	
		watch: {
        keywords(after, before) {
            
        }
    },
	
	
	computed: {
		    categoryId() {
			  return this.shopdetail.catid;
		    },
		    subcategoryId() {
			  return this.shopdetail.subid;
		    },


		   
		    classCat: function () {
				var vm = this;
				return function (ctid) {
				    let cath = vm.shopdetail.catid;
					//alert(cath);
					if(vm.shopdetail.catid == ctid )
					{
						//alert(vm.shopdetail.catid + ' ies equal to ' + ctid);
						return true;
					}
					else
					{
					
						return false;
					}
				}
			},
			
	
			classSub: function () {
			var vm = this;
			return function (stid) {
			   
				if(vm.shopdetail.subid == stid )
				{
					
					return true;
				}
				else
				{
				
					return false;
				}
			}
		},

		imagepath()
		{
			return "/images/shop/"+this.shopdetail.logo;
		},
		imagepath2()
		{
			return this.shopdetail.image;
		},
		image1()
		{
			return this.showimg1;
		},
		image2()
		{
			return this.showimg2;
		},		

 
	},

	created: function()
	{
		const vr1 = this.$router;
	},
	mounted: function()
	{
		const vr2 = this.$router;
		
		let app = this;
		let shopid1 = '';

		
		if(app.$route.params.shopid)
		{
			shopid1 = app.$route.params.shopid;
			this.ViewShop.shopidx = shopid1;
			console.log(' 371  shopid ' + shopid1);
			this.fetchShop1(shopid1);
			this.fetchShopCats() ;
			this.fetchShopSubs() ;
			
		}
		
	},
	
	methods: 
	{
		
		fetchsearchshop() {
		const vr3 = this.$router;
           
			vr3.push({ name: 'shopsearch', params: { keywords: this.keywords } })
        },
		
		
		fetchShop1(shopid1) 
		{
			
			var apper = this;
			var url  ='';
			url = '/shopdet/json/' + shopid1;
			//alert(url);
			console.log('line 398 ' + url);

			axios.get(url).then((res) => 
			{
				console.log( ' shops linne 407 ' + res);
				this.shopdetail = res.data;
			});

		},
		
		onImageChange(img) 
		{
			this.showimg1 = false;
			this.showimg2 = true;	
			this.imagex =  img;
			//var elmnt = document.getElementById("largeimg");
			//elmnt.scrollIntoView();
			
			 $('html, body').animate({
				scrollTop: $("#largeimg").offset().top - 100
			}, 2000);
				
        },
		
		fetchShopCats() 
		{
			axios.get('/shopcaternav/json/bycat/').then((res) => 
			{
				//console.log( ' linne 414 ' + res);
				this.cats = res;
			});

		},
		fetchShopSubs() 
		{
			axios.get('/shopcaternav/json/bysub').then((res) => 
			{
				//console.log( ' linne 414 ' + res);
				this.subs = res;
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