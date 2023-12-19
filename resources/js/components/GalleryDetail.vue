<template>
  <div>
	<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-200-60" v-bind:style='"background: url(img/bg-img/37.jpg);"'>
		<div class="container">
			<div class="row">
				<!-- Heading -->
				<div class="col-12">
					<div class="section-heading text-center wow fadeInUp " >
					   
						<h4>Gallery Detail</h4>
						<nav aria-label="breadcrumb">
						     <ol class="breadcrumb">
                                <li class="breadcrumb-item">
								<router-link :to="{ name: 'home' }"> Home</router-link> </li>
								
								<li class="breadcrumb-item">
									<router-link :to="{ name: 'gallery' }" > 
										All Galleries 
									</router-link>  
								</li>
								
								
                                <li class="breadcrumb-item active" aria-current="page">Gellery details</li>
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
								<img v-bind:src=imagepath v-bind:alt=galdetail.name v-bind:title =galdetail.name class='zindex99 center'
								v-if="image1"/>
								<img :src="imagex" v-bind:alt=galdetail.name v-bind:title =galdetail.name class='zindex99 center' v-if="image2">
                            </div>
							
							<div class="row"  v-if ="typeof galdetail.portfolioimages !== 'undefined' &&  galdetail.portfolioimages.length > 0 ">
							
							
								<div class="col-3 margintopbottom8">
									<img v-bind:src="'/images/thumb/' + galdetail.logo"
								     v-bind:alt=galdetail.name v-bind:title =galdetail.name  class='zindex99 center cursor' 
									v-on:click='onImageChange("/images/" + galdetail.logo)' />
								
								</div>
								<div class="col-3 margintopbottom8" v-for="gal, index in galdetail.portfolioimages">
									<img v-bind:src="'/images/gallery/thumb/' + gal.logo" v-bind:alt=gal.name 
									v-bind:title =gal.name class='zindex99 center cursor' 
									v-on:click='onImageChange("/images/gallery/" + gal.logo)'/>
								</div>

                            </div>
							
							
							<div  v-if ="typeof galdetail.url !== 'undefined' &&  galdetail.url != '' 
							&&  galdetail.url != null" class="row margintopbottom10">
								<iframe v-bind:src=galdetail.url class = 'iframe full'></iframe>
							</div>
							
							<div v-else class="row margintopbottom4" >
								
							</div>
							

                            <h4 class="post-title"> 
							 {{ galdetail.name }} 
							</h4> 
							<h5> Category: {{ galdetail.portcat.name }} </h5>
							<h5> City: {{ galdetail.portcity.name }} </h5>

							<div v-if = galdetail.description class='margintopbottom10'>
								<span  v-html="galdetail.description"></span>
							</div>
							
                        
                        </div>

                        <!-- Post Tags & Social Info -->
                        <div class="post-tags-social-area mt-30 pb-5 d-flex flex-wrap align-items-center">
                   

                            <!-- Author Social Info -->
                            <div class="author-social-info">
                                <a href="#"><i class="zmdi zmdi-linkedin"></i></a>
                                <a v-bind:href="'https://twitter.com/share?text='+galdetail.name+'&url='+globalURL+'galdetail/'+ galdetail.id "
							     target = '_blank'>
								<i class="zmdi zmdi-twitter"></i>
								</a>
                                <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                <a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'galdetail/'+ galdetail.id " target = '_blank'>
								 <i class="zmdi zmdi-facebook"></i></a>
                                <a href="#"><i class="zmdi zmdi-share"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Blog Sidebar Area -->
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="confer-sidebar-area mb-100">

                        <!-- Single Widget Area -->
                        <div class="single-widget-area">
                            <div class="search-widget">
                                <form @submit.prevent="fetchsearchgal">
                                    <input type="search" name="search-form" id="searchForm" placeholder="Search" v-model="keywords">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </div>
                        </div>
						
						
						<div class="single-widget-area">
						  <input type="text" placeholder="SEARCH" v-model="query" v-on:keyup="autoComplete" class="form-control">
						  <div class="panel-footer" v-if="results.length">
						   <ul class="list-group">
							<li class="list-group-item" v-for="result in results">
								<router-link :to="{ name: 'galdetail' , params: { galid: result.id} }" >
							 {{ result.name }}  </router-link>
							</li>
						   </ul>
						  </div>
						</div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area">
                            <!-- Post Author Widget -->
                            <div class="post-author-widget">
                        
                                <!-- Social Info -->
                                <div class="author-social-info">
                                    <a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'galdetail/'+ galdetail.id " target = '_blank'>
									<i class="zmdi zmdi-facebook"></i></a>
                                    <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                    <a v-bind:href="'https://twitter.com/share?text='+galdetail.name+'&url='+globalURL+'galdetail/'+ galdetail.id "
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
									<router-link :to="{ name: 'gallery', params: { catid: cat.id  , bycitycat:'bycat' } }" 
									:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
										{{ cat.name }}  {{ cat.id}} {{ categoryId }} 
										( {{ cat.portfolios_count}} )
									</router-link> 
								</li>

                            </ul>
                        </div>
						
						
						
						
						<div class="single-widget-area">
                            <h5 class="widget-title mb-30">Cities</h5>
                            <ul class="categories-list">
							
								<li v-for="city, index in cities.data"> 

									<router-link :to="{ name: 'gallery', params: { catid: city.id  , bycitycat:'bycity' } }" 
									:class=" [{bold: classCity(city.id)},{red: classCity(city.id)}]"> 
										{{ city.name }}

										{{ city.id}} {{ citId }} 
										( {{ city.portfolios_count}} )
										
									</router-link> 
									  
								</li>

                            </ul>
                        </div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area">
                            <h5 class="widget-title mb-30">Tag Cloud</h5>

                            <!-- Tag Cloud -->
                            <ul class="tag-cloud">
                                <li v-for="tag, index in tags">
								
								
								<router-link :to="{ name: 'gallery', params: { catid: tag.id  , bycitycat:'bytag' } }" > 
									{{ tag.name }} {{ tag.id }}
								</router-link>
								
								</li>
                           
                            </ul>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
    <Contact1/>
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


	components: { Footer ,   Contact1 },

	data: function() {
      return {
		galdetail: {
			logo: '' ,
			image: '' ,
			cat_id: '',
		},
		tags: [],
		cats: {},
		cities: {},
		ViewPort:
		{                    
			galidx: null,
		},
		showimg1: true,
		showimg2: false,
		imagex: {}, 
		keywords: null,
		
		query: '',
		results: [],
		
		
      };
    },
	
		watch: {
        keywords(after, before) {
            
        }
    },
	
	
	computed: {
		    categoryId() {
			  return this.galdetail.catid;
		    },
		   
		    citId() {
			  return this.galdetail.cityid;
		    }, 
			taggId() {
			  return this.galdetail.tag;
		    }
		    ,
		    imagepath()
		    {
			return "/images/"+this.galdetail.logo;
		    },
		    imagepath2()
		    {
				return this.galdetail.image;
		    },
			image1()
			{
				return this.showimg1;
			},
		    image2()
		    {
				return this.showimg2;
		    },
		   
		    classCat: function () {
				var vm = this;
				return function (ctid) {
				    let cath = vm.galdetail.catid;
					//alert(cath);
					if(vm.galdetail.catid == ctid )
					{
						//alert(vm.galdetail.catid + ' ies equal to ' + ctid);
						return true;
					}
					else
					{
					
						return false;
					}
				}
			},
			
			classCity: function () {
				var vm = this;
				return function (cyid) {
				   
					//alert(cath);
					if(vm.galdetail.cityid == cyid )
					{
						
						return true;
					}
					else
					{
					
						return false;
					}
				}
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
		let galid1 = '';

		
		if(app.$route.params.galid)
		{
			galid1 = app.$route.params.galid;
			this.ViewPort.galidx = galid1;
			console.log(' 323  galid ' + galid1);
			this.fetchGal1(galid1);
			this.fetchPortTags(galid1);
			this.fetchPortCats() ;
			this.fetchCities() ;
		}
		
	},
	
	methods: 
	{
		
		fetchsearchgal() {
		const vr3 = this.$router;
           
			vr3.push({ name: 'gallerysearch', params: { keywords: this.keywords } })
        },
		
		
		fetchGal1(galid1) 
		{
			var apper = this;
			var url  ='';
			url = '/gallerydetail/json/' + galid1;
			console.log('line 336 ' + url);

			axios.get(url).then((res) => 
			{
				console.log( ' gals linne 379 ' + res);
				this.galdetail = res.data;
			});

		},
		
		fetchPortTags(galid1) {
			
			axios.get(`/tags/jsontags/${galid1}`).then((res) => 
			{  
				this.tags = res.data;
				console.log('351 tags are ' + res.data);
				
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
		
		fetchPortCats() 
		{
			axios.get('/gallerycat/json').then((res) => 
			{
				//console.log( ' linne 414 ' + res);
				this.cats = res;
			});

		},
		
		
		fetchCities() 
		{
			axios.get('/gallerycity/json').then((res) => 
			{
				//console.log( ' linne 182 ' + res);
				this.cities = res;
			});

		},
		
		autoComplete()
		{
			this.results = [];
			if(this.query.length > 2){

			axios.get('/galsearch/search2',{params: {query: this.query}}).then(response => {
			this.results = response.data;
			})
            .catch(error => {});
			
			}
			

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