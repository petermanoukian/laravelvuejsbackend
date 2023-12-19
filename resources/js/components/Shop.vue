<template>
	
  <div style = 'z-index:999 !important;'>
  
	<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" v-bind:style='"background: url(img/bg-img/37.jpg);"'>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="page-title">Shop</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><router-link :to="{ name: 'home' }">Home</router-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    <!-- Our Shop Area Start -->
    <div class="our-blog-area section-padding-40">
        <div class="container">
		
			<div   v-if ="ViewShop.bycat && ViewShop.cat_id && ViewShop.cat_id != null  && ViewShop.bycat == 'bycat' " class = 'row marginbottom11'>
				<div class="col-12">
					Category: <span class='font600'> {{ cat.data.name }} </span>
				</div>
			</div>
			
			
			<div v-else-if ="ViewShop.bycat && ViewShop.cat_id && ViewShop.cat_id != null  && ViewShop.bycat == 'bysub' "  class = 'row marginbottom11' >
				<div class="col-12">
					<p> Category: <span class='font600'> {{ cat.data.name }} </span> </p>
					<p>SubCategory: <span class='font600'> {{ sub.data.name }} </span></p>
				</div>
			</div>
	
			
			<div v-else class = 'row' >
				<div class="col-12 marginbottom11 font600">
				All Shops
				</div>
			</div>
			
			
			<div class = 'row margintopbottom10'>
			    <div class="col-12">
					<h5 class="widget-title mb-10">Categories</h5>
						<span>
							<router-link :to="{ name: 'shop' }" class="class='marginright6'"> 
								&rsaquo; All Shops
							</router-link>
						</span>		
						<span  v-for="cat, index in cats.data"> 
							<router-link :to="{ name: 'shop', params: {   bycat:'bycat', catid: cat.id } }" class='marginright6'
							:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
								&rsaquo;  {{ cat.name }}  
								( {{ cat.shopers_count}} )
							</router-link> 
						</span>

                </div>
			
			</div>
			
			
			
			<div class = 'row margintopbottom10'>
			    <div class="col-12">
					<h5 class="widget-title mb-10">Sub Categories</h5>

						<span  v-for="sub, index2 in subs.data"> 
							<router-link :to="{ name: 'shop', params: {   bycat:'bysub', catid: sub.catid , subid: sub.id } }" class='marginright6'
							:class=" [{bold: classSub(sub.id)},{red: classSub(sub.id)}]"> 
								&rsaquo;  {{ sub.name }}  
								( {{ sub.shoperrs_count}} )
							</router-link> 
						</span>

                </div>
			
			</div>
			
	
			
 
			<div class = 'row margintopbottom10'>
				 <div class="col-12 ">
                   
						<input type="search" name="search-form" id="searchForm" placeholder="Search" v-model="keywords" class='search'>
                 
			    </div>
			</div>
			
			
			
            <div id = 'looper' class="row margintop18bottom10" v-if ="typeof shops.data !== 'undefined' &&  shops.data.length > 0 ">

				<div class="col-12 col-md-6 col-xl-4" v-for="shop, index in shops.data">
					<div class="single-blog-area style-2 wow fadeInUp" data-wow-delay="300ms" id = 'ajaxprod'>
						<div v-if="typeof shop.logo !== 'undefined' && shop.logo !== null && shop.logo !== '' " class="single-blog-thumb center" >
							<router-link :to="{ name: 'shopdetail' , params: { shopid: shop.id} }" class = 'white'>
								<img v-bind:src="'/images/shop/thumb/' + shop.logo" v-bind:alt = shop.name  v-bind:title = shop.name  
								class= 'zindex99 center'/>
							</router-link>
						</div>
						
						<div v-else class="single-blog-thumb center" >
							<img v-bind:src="'/images/thumb/nopic.jpg'"  v-bind:alt = shop.name  v-bind:title = shop.name  
								class= 'zindex99 center'/>
						</div>

						<div class="single-blog-text text-center"> 
							<router-link :to="{ name: 'shopdetail' , params: { shopid: shop.id} }" class = 'blog-title'> 
							&rsaquo; {{ shop.name }}  </router-link>
							<p> Price: {{ shop.prix}} $ </p>
						</div>
						<div class="blog-btn">
							<router-link :to="{ name: 'shopdetail' , params: { shopid: shop.id} }" > 
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
						<pagination :data="shops" @pagination-change-page="fetchShops"></pagination>  
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


	components: { Footer  ,   Contact1   },

	data: function() {
      return {
		shops: {},
		cats: {},
		subs: {},
		cat:[],
		sub:[],

		
		
		keywords: null,

		ViewShop:{                    
			cat_id: null,
			bycat:null,
			bysub:null,
			sub_id: null,
		}
		
		
      };
    },
	watch: {
        keywords(after, before) {
            this.fetchsearchshop();
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
		let idsub = '';
		let bycat1 = '';

		
		if(app.$route.params.bycat)
		{
			
			bycat1 = app.$route.params.bycat;
			this.ViewShop.bycat = bycat1;
			console.log(' 164  bycat ' + bycat1);
			
			if(app.$route.params.catid)
			{
				//alert(1);
				if(bycat1 == 'bycat')
				{
					//alert(2);
					idcat = app.$route.params.catid;
					this.ViewShop.cat_id = idcat;
					console.log(' 181 idcat ' + idcat);
					this.fetchCat1(idcat);
				}
				else if(bycat1 == 'bysub')
				{
					
					idcat = app.$route.params.catid;
					//alert(3);
					idsub = app.$route.params.subid;
					//alert(4);
					//alert(' 181 idcat ' + idcat + ' 181 idsub ' + idsub);
					this.ViewShop.cat_id = idcat;
					this.ViewShop.sub_id = idsub;
					console.log(' 181 idcat ' + idcat + ' 181 idsub ' + idsub);
					
					this.fetchCat1(idcat);
					this.fetchSub1(idsub);
				}
		
			}
			
		}
		if(app.$route.params.keywords)
		{
			
			this.keywords = app.$route.params.keywords;
			this.fetchsearchshop();
		
		}
		else
		{
			this.fetchShops();

		}
		this.fetchShopCats() ;
		this.fetchShopSubs() ;
		this.scrollerpager();

	},
	
	
	computed: {
		categoryId() {
		  return this.ViewShop.cat_id;
		},

		classCat: function () {
			var vm = this;
			return function (ctid) {
			   
				if(vm.ViewShop.cat_id == ctid )
				{
					
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
			   
				if(vm.ViewShop.sub_id == stid )
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
		fetchShops(page) 
		{
			
			var apper = this;
			var url  ='';
			if (typeof page === 'undefined') 
			{
				page = 1;
			}
			if(apper.ViewShop.cat_id == null && apper.ViewShop.sub_id == null )
			{
				url = '/shopp/json?page=' + page;
				console.log('line 182 ' + url);
			}
			else if(apper.ViewShop.cat_id != null || apper.ViewShop.sub_id != null )
			{
				let bycat2 = apper.ViewShop.bycat;
				if(apper.ViewShop.cat_id != null && bycat2 =='bycat')
				{
					let caterid = apper.ViewShop.cat_id;
					
					url = '/shopp/json/'+bycat2+'/'+caterid+'?page=' + page;
					console.log('line 232 ' + url + ' thecatid ' + caterid);
				}
				else if(apper.ViewShop.cat_id != null && bycat2 =='bysub')
				{
					let caterid = apper.ViewShop.cat_id;
					let suberid = apper.ViewShop.sub_id;
					url = '/shopp/json/'+bycat2+'/'+caterid+'/'+suberid+'?page=' + page;
					console.log('line 232 ' + url + ' thecatid ' + caterid);
				}
		
				
			}
			//alert(url);
			axios.get(url).then((res) => 
			{
				console.log( ' shops linne 217 ' + res);
				this.shops = res.data;
			});
			


		},
		fetchsearchshop() {
            axios.get('/shopsearch/search', { params: { keywords: this.keywords } })
                .then(response => this.shops = response.data)
                .catch(error => {});
        },
		
		fetchCat1(id) 
		{
			axios.get('/shopcatdet/json/detail/'+id).then((res) => 
			{
				console.log( ' linne 249 ' + res);
				this.cat = res;  
			});

		},
		
		fetchSub1(id) 
		{
			axios.get('/shopcatdet/json/detail/'+id).then((res) => 
			{
				console.log( ' linne 249 ' + res);
				this.sub = res;
			});

		},
		

		
		fetchShopCats() 
		{
			axios.get('/shopcaternav/json/bycat').then((res) => 
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

		}

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