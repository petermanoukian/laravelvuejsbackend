<template>
	
  <div style = 'z-index:999 !important;'>
  
	<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" v-bind:style='"background: url(img/bg-img/37.jpg);"'>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="page-title">Gallery</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><router-link :to="{ name: 'home' }">Home</router-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    <!-- Our Blog Area Start -->
    <div class="our-blog-area section-padding-40">
        <div class="container">
		


			
			<div class = 'row marginbottom11'  v-if ="ViewPort.bycitycat && ViewPort.tag_id && ViewPort.tag_id != null  && ViewPort.bycitycat == 'bytag' ">
				<div class="col-12">
				Tag : <span class='font600'>  {{ tag.data.name }} </span>
				</div>
			</div>
			
			<div class = 'row'  v-else>
				<div class="col-12 marginbottom11 font600">
				All Galleries
				</div>
			</div>
			
			<div class = 'row margintopbottom10'>
			    <div class="col-12">
					<h5 class="widget-title mb-10">Categories</h5>
						<span>
							<router-link :to="{ name: 'gallery' }" class="class='marginright6'"> 
								&rsaquo; All Galleries 
							</router-link>
						</span>		
						<span  v-for="cat, index in cats.data"> 
							<router-link :to="{ name: 'gallery', params: { catid: cat.id  , bycitycat:'bycat' } }" class='marginright6'
							:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
								&rsaquo;  {{ cat.name }}  
								( {{ cat.portfolios_count}} )
							</router-link> 
						</span>

                </div>
			
			</div>
			
			<div class = 'row margintopbottom10'>
				<div class="col-12">
					<h5 class="widget-title mb-10">Cities</h5>
					
					
						<span v-for="city, index in cities.data"> 

							<router-link :to="{ name: 'gallery', params: { catid: city.id  , bycitycat:'bycity' } }" class='marginright6'
							:class=" [{bold: classCity(city.id)},{red: classCity(city.id)}]"> 
								&rsaquo;  {{ city.name }}

								( {{ city.portfolios_count}} )
								
							</router-link> 
							  
						</span>

                </div>
			</div>
			
	
			
			
			
			<div class = 'row margintopbottom10'>
				 <div class="col-12 ">
					<input type="search" name="search-form" id="searchForm" placeholder="Search" v-model="keywords" class='search'>
			    </div>
			</div>
			
			
			<div class = 'row margintopbottom10'>
			  <input type="text" placeholder="SEARCH " v-model="query" v-on:keyup="autoComplete" class="form-control">
			  <div class="panel-footer" v-if="results.length">
			   <ul class="list-group">
				<li class="list-group-item" v-for="result in results">
					<router-link :to="{ name: 'galdetail' , params: { galid: result.id} }" >
				 {{ result.name }}  </router-link>
				</li>
			   </ul>
			  </div>
			</div>
			
			
            <div id = 'looper' class="row margintop18bottom10" v-if ="typeof gals.data !== 'undefined' &&  gals.data.length > 0 ">

				<div class="col-12 col-md-6 col-xl-4" v-for="gal, index in gals.data">
					<div class="single-blog-area style-2 wow fadeInUp" data-wow-delay="300ms" id = 'ajaxprod'>
						<div v-if="typeof gal.logo !== 'undefined' && gal.logo !== null && gal.logo !== '' " class="single-blog-thumb center" >
							<router-link :to="{ name: 'galdetail' , params: { galid: gal.id} }" class = 'white'>
								<img v-bind:src="'/images/thumb/' + gal.logo" v-bind:alt = gal.name  v-bind:title = gal.name  
								class= 'zindex99 center'/>
							</router-link>
						</div>
						
						<div v-else class="single-blog-thumb center" >
							<img v-bind:src="'/images/thumb/nopic.jpg'"  v-bind:alt = gal.name  v-bind:title = gal.name  
								class= 'zindex99 center'/>
						</div>

						<div class="single-blog-text text-center"> 
							<router-link :to="{ name: 'galdetail' , params: { galid: gal.id} }" class = 'blog-title'> 
							&rsaquo; {{ gal.name }} </router-link>
							
						</div>
						<div class="blog-btn">
							<router-link :to="{ name: 'galdetail' , params: { galid: gal.id} }" > 
							<i class="zmdi zmdi-long-arrow-right"></i></router-link>
						</div>
					</div>
				</div>


			
			
			</div>
			




			
			
			<div v-else class="row" >
				No data
			</div>

			
			

            <div class="row">
                <div class="col-12">
                    <div class="more-blog-btn text-center"> 
						<pagination :data="gals" @pagination-change-page="fetchGals"></pagination>  
                    </div>
                </div>
            </div>
        </div>
    </div>

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


	components: { Footer  ,   Contact1  },

	data: function() {
      return {
		gals: {},
		cats: {},
		cities: {},
		cat:[],
		city:[],
		tag:[],
		
		
		keywords: null,
		
		query: '',
		results: [],

		ViewPort:{                    
			cat_id: null,
			bycitycat:null,
			city_id: null,
			tag_id: null,
	
		}
		
		
      };
    },
	watch: {
        keywords(after, before) {
            this.fetchsearchgal();
        }
    },
	
	
	created: function()
	{
		const vr1 = this.$router;
	},
	mounted: function()
	{
		const vr2 = this.$router;
		
		let app = this;
		let idcat = '';
		let bycitycat1 = '';

		
		if(app.$route.params.bycitycat)
		{
			
			bycitycat1 = app.$route.params.bycitycat;
			this.ViewPort.bycitycat = bycitycat1;
			console.log(' 164  bycitycat ' + bycitycat1);
			
			if(app.$route.params.catid)
			{
				if(bycitycat1 == 'bycat')
				{
					idcat = app.$route.params.catid;
					this.ViewPort.cat_id = idcat;
					console.log(' 181 idcat ' + idcat);
					this.fetchCat1(idcat);
				}
				else if(bycitycat1 == 'bycity')
				{
					idcat = app.$route.params.catid;
					this.ViewPort.city_id = idcat;
					console.log(' 188 idcat ' + idcat);
					this.fetchCity1(idcat);
				}
				else if(bycitycat1 == 'bytag')
				{
					
					idcat = app.$route.params.catid;
					this.ViewPort.tag_id = idcat;
					console.log(' 188 idcat ' + idcat);
					//alert('202 ' + bycitycat1 + ' 188 idcat ' + idcat);
					this.fetchTag1(idcat);
				}
			}
			
		}
		if(app.$route.params.keywords)
		{
			
			this.keywords = app.$route.params.keywords;
			this.fetchsearchgal();
		
		}
		else
		{
			this.fetchGals();

		}
		this.fetchPortCats() ;
		this.fetchCities() ;
		this.scrollerpager();

	},
	
	
	computed: {
		    categoryId() {
			  return this.ViewPort.cat_id;
		    },
		   
		    citId() {
			  return this.ViewPort.city_id;
		    }, 

		   
		    classCat: function () {
				var vm = this;
				return function (ctid) {
				   
					if(vm.ViewPort.cat_id == ctid )
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
					if(vm.ViewPort.city_id == cyid )
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
	
	
	
	
	methods: 
	{
		fetchGals(page) 
		{
			
			var apper = this;
			var url  ='';
			if (typeof page === 'undefined') 
			{
				page = 1;
			}
			if(apper.ViewPort.cat_id == null && apper.ViewPort.city_id == null && apper.ViewPort.tag_id == null)
			{
				url = '/gal/json?page=' + page;
				console.log('line 182 ' + url);
			}
			else
			{
				let bycitycat2 = apper.ViewPort.bycitycat;
				let caterid = apper.ViewPort.cat_id;
					
				url = '/gal/json/'+caterid+'/'+bycitycat2+'?page=' + page;
				console.log('line 232 ' + url + ' thecatid ' + caterid);
				 if(apper.ViewPort.city_id != null && bycitycat2 =='bycity')
				{
					let caterid = apper.ViewPort.city_id;
					url = '/gal/json/'+caterid+'/'+bycitycat2+'?page=' + page;
					console.log('line 239 ' + url + ' thecatid ' + caterid);
				}
				else if(apper.ViewPort.tag_id != null && bycitycat2 =='bytag')
				{
					//alert(252);
					let caterid = apper.ViewPort.tag_id;
					
					url = '/gal/json/'+caterid+'/'+bycitycat2+'?page=' + page;
					console.log('line 246 ' + url + ' thecatid ' + caterid);
				}
				
			}
			
			axios.get(url).then((res) => 
			{
				console.log( ' gals linne 217 ' + res);
				this.gals = res.data;
			});
			


		},
		fetchsearchgal() {
            axios.get('/galsearch/search', { params: { keywords: this.keywords } })
                .then(response => this.gals = response.data)
                .catch(error => {});
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
		
		fetchCat1(id) 
		{
			axios.get('/gallerycatsingle/json/detail/'+id).then((res) => 
			{
				console.log( ' linne 249 ' + res);
				this.cat = res;
			});

		},
		
		fetchCity1(id) 
		{
			axios.get('/gallerycity/json/detail/'+id).then((res) => 
			{
				console.log( ' linne 260 ' + res);
				this.city = res;
			});

		},
		
		fetchTag1(id) 
		{
			//alert( ' 295 ' + id) ;
			axios.get('/gallerytag/json/detail/'+id).then((res) => 
			{
				console.log( ' linne 260 ' + res);
				this.tag = res;
			});

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
		
		scrollerpager()
		{
			
			$('.page-link').click(function()
			{
				alert(1);
				$('html, body').animate({
					scrollTop: $("#looper").offset().top - 100
				}, 2000);
			
			}) ;
			
			$('.pagination-page-nav').click(function()
			{
				alert(2);
				$('html, body').animate({
					scrollTop: $("#looper").offset().top - 100
				}, 2000);
			
			}) ;
			
			$('.page-item').click(function()
			{
				alert(3);
				$('html, body').animate({
					scrollTop: $("#looper").offset().top - 100
				}, 2000);
			
			}) ;
			
			$('.pagination').click(function()
			{
				alert(4);
				$('html, body').animate({
					scrollTop: $("#looper").offset().top - 100
				}, 2000);
			
			}) ;
			
			


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