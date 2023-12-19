<template>
	
  <div style = 'z-index:999 !important;'>
  
	<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" v-bind:style='"background: url(img/bg-img/37.jpg);"'>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="page-title">Blog</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><router-link :to="{ name: 'home' }">Home</router-link></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
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
		
			<div   v-if ="ViewBlog.bycat && ViewBlog.cat_id && ViewBlog.cat_id != null  && ViewBlog.bycat == 'bycat' " class = 'row marginbottom11'>
				<div class="col-12">
					Category: <span class='font600'> {{ cat.data.name }} </span>
				</div>
			</div>
			
			
			<div v-else-if ="ViewBlog.bycat && ViewBlog.sub_id && ViewBlog.sub_id != null  && ViewBlog.bycat == 'bysub' "  class = 'row marginbottom11' >
				<div class="col-12">
					<p> Category: <span class='font600'> {{ cat.data.name }} </span> </p>
					<p>SubCategory: <span class='font600'> {{ sub.data.name }} </span></p>
				</div>
			</div>
	
			
			<div v-else class = 'row' >
				<div class="col-12 marginbottom11 font600">
				All Blogs
				</div>
			</div>
			
			
			<div class = 'row margintopbottom10'>
			    <div class="col-12">
					<h5 class="widget-title mb-10">Categories</h5>
						<span>
							<router-link :to="{ name: 'blog' }" class="class='marginright6'"> 
								&rsaquo; All Blogs
							</router-link>
						</span>		
						<span  v-for="cat, index in cats.data"> 
							<router-link :to="{ name: 'blog', params: {   bycat:'bycat', catid: cat.id } }" class='marginright6'
							:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
								&rsaquo;  {{ cat.name }}  
								( {{ cat.blogs_count}} )
							</router-link> 
						</span>

                </div>
			
			</div>
			
			
			
			<div class = 'row margintopbottom10'>
			    <div class="col-12">
					<h5 class="widget-title mb-10">Sub Categories</h5>

						<span  v-for="sub, index2 in subs.data"> 
							<router-link :to="{ name: 'blog', params: {   bycat:'bysub', catid: sub.catid , subid: sub.id } }" class='marginright6'
							:class=" [{bold: classSub(sub.id)},{red: classSub(sub.id)}]"> 
								&rsaquo;  {{ sub.name }}  
								( {{ sub.bloggs_count}} )
							</router-link> 
						</span>

                </div>
			
			</div>
			
	
			
 
			<div class = 'row margintopbottom10'>
				 <div class="col-12 ">
                   
						<input type="search" name="search-form" id="searchForm" placeholder="Search" v-model="keywords" class='search'>
                 
			    </div>
			</div>
			
			
			
            <div id = 'looper' class="row margintop18bottom10" v-if ="typeof blogs.data !== 'undefined' &&  blogs.data.length > 0 ">

				<div class="col-12 col-md-6 col-xl-4" v-for="blog, index in blogs.data">
					<div class="single-blog-area style-2 wow fadeInUp" data-wow-delay="300ms" id = 'ajaxprod'>
						<div v-if="typeof blog.logo !== 'undefined' && blog.logo !== null && blog.logo !== '' " class="single-blog-thumb center" >
							<router-link :to="{ name: 'blogdetail' , params: { blogid: blog.id} }" class = 'white'>
								<img v-bind:src="'/images/blog/thumb/' + blog.logo" v-bind:alt = blog.name  v-bind:title = blog.name  
								class= 'zindex99 center'/>
							</router-link>
						</div>
						
						<div v-else class="single-blog-thumb center" >
							<img v-bind:src="'/images/thumb/nopic.jpg'"  v-bind:alt = blog.name  v-bind:title = blog.name  
								class= 'zindex99 center'/>
						</div>

						<div class="single-blog-text text-center"> 
							<router-link :to="{ name: 'blogdetail' , params: { blogid: blog.id} }" class = 'blog-title'> 
							&rsaquo; {{ blog.name }} </router-link>
							
						</div>
						<div class="blog-btn">
							<router-link :to="{ name: 'blogdetail' , params: { blogid: blog.id} }" > 
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
						<pagination :data="blogs" @pagination-change-page="fetchBlogs"></pagination>  
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


	components: { Footer ,   Contact1  },

	data: function() {
      return {
		blogs: {},
		cats: {},
		subs: {},
		cat:[],
		sub:[],

		
		
		keywords: null,

		ViewBlog:{                    
			cat_id: null,
			bycat:null,
			bysub:null,
			sub_id: null,
		}
		
		
      };
    },
	watch: {
        keywords(after, before) {
            this.fetchsearchblog();
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
			this.ViewBlog.bycat = bycat1;
			console.log(' 164  bycat ' + bycat1);
			
			if(app.$route.params.catid)
			{
				//alert(1);
				if(bycat1 == 'bycat')
				{
					//alert(2);
					idcat = app.$route.params.catid;
					this.ViewBlog.cat_id = idcat;
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
					this.ViewBlog.cat_id = idcat;
					this.ViewBlog.sub_id = idsub;
					console.log(' 181 idcat ' + idcat + ' 181 idsub ' + idsub);
					
					this.fetchCat1(idcat);
					this.fetchSub1(idsub);
				}
		
			}
			
		}
		if(app.$route.params.keywords)
		{
			
			this.keywords = app.$route.params.keywords;
			this.fetchsearchblog();
		
		}
		else
		{
			this.fetchBlogs();

		}
		this.fetchBlogCats() ;
		this.fetchBlogSubs() ;
		this.scrollerpager();

	},
	
	
	computed: {
		categoryId() {
		  return this.ViewBlog.cat_id;
		},

		classCat: function () {
			var vm = this;
			return function (ctid) {
			   
				if(vm.ViewBlog.cat_id == ctid )
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
			   
				if(vm.ViewBlog.sub_id == stid )
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
		fetchBlogs(page) 
		{
			
			var apper = this;
			var url  ='';
			if (typeof page === 'undefined') 
			{
				page = 1;
			}
			if(apper.ViewBlog.cat_id == null && apper.ViewBlog.sub_id == null )
			{
				url = '/blogg/json?page=' + page;
				console.log('line 182 ' + url);
			}
			else if(apper.ViewBlog.cat_id != null || apper.ViewBlog.sub_id != null )
			{
				let bycat2 = apper.ViewBlog.bycat;
				if(apper.ViewBlog.cat_id != null && bycat2 =='bycat')
				{
					let caterid = apper.ViewBlog.cat_id;
					
					url = '/blogg/json/'+bycat2+'/'+caterid+'?page=' + page;
					console.log('line 232 ' + url + ' thecatid ' + caterid);
				}
				else if(apper.ViewBlog.cat_id != null && bycat2 =='bysub')
				{
					let caterid = apper.ViewBlog.cat_id;
					let suberid = apper.ViewBlog.sub_id;
					url = '/blogg/json/'+bycat2+'/'+caterid+'/'+suberid+'?page=' + page;
					console.log('line 232 ' + url + ' thecatid ' + caterid);
				}
		
				
			}
			//alert(url);
			axios.get(url).then((res) => 
			{
				console.log( ' blogs linne 217 ' + res);
				this.blogs = res.data;
			});
			


		},
		fetchsearchblog() {
            axios.get('/blogsearch/search', { params: { keywords: this.keywords } })
                .then(response => this.blogs = response.data)
                .catch(error => {});
        },
		
		fetchCat1(id) 
		{
			axios.get('/blogcatdet/json/detail/'+id).then((res) => 
			{
				console.log( ' linne 249 ' + res);
				this.cat = res;
			});

		},
		
		fetchSub1(id) 
		{
			axios.get('/blogcatdet/json/detail/'+id).then((res) => 
			{
				console.log( ' linne 249 ' + res);
				this.sub = res;
			});

		},
		

		
		fetchBlogCats() 
		{
			axios.get('/blogcaternav/json/bycat').then((res) => 
			{
				//console.log( ' linne 414 ' + res);
				this.cats = res;
			});

		},
		fetchBlogSubs() 
		{
			axios.get('/blogcaternav/json/bysub').then((res) => 
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