<template>
  <div>
	<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-200-60" v-bind:style='"background: url(img/bg-img/37.jpg);"'>
		<div class="container">
			<div class="row">
				<!-- Heading -->
				<div class="col-12">
					<div class="section-heading text-center wow fadeInUp " >
					   
						<h4>Blog Detail</h4>
						<nav aria-label="breadcrumb">
						     <ol class="breadcrumb">
                                <li class="breadcrumb-item">
								<router-link :to="{ name: 'home' }"> Home</router-link> </li>
								
								<li class="breadcrumb-item">
									<router-link :to="{ name: 'blog' }" > 
										All Blogs 
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
                            <h4 class="post-title"> 
							 {{ blogdetail.name }} 
							</h4> 
                            <div class="post-blog-thumbnail mb-30" id ='largeimg'>	
								<img v-bind:src="'/images/blog/' + blogdetail.logo"
								v-bind:alt=blogdetail.name v-bind:title =blogdetail.name class='zindex99 center'/>
								
                            </div>

							<h5 v-if = "blogdetail.catid != NULL "> Category: {{ blogdetail.blogcat.name }} </h5>
						
							<h6 v-if = "blogdetail.subid != NULL "> SubCategory: {{ blogdetail.blogsub.name }} </h6>

							<div v-if = blogdetail.description class='margintopbottom10'>
								<span  v-html="blogdetail.description"></span>
							</div>
							
                        
                        </div>

                        <!-- Post Tags & Social Info -->
                        <div class="post-tags-social-area mt-30 pb-5 d-flex flex-wrap align-items-center">
                   

                            <!-- Author Social Info -->
                            <div class="author-social-info">
                                <a href="#"><i class="zmdi zmdi-linkedin"></i></a>
                                <a v-bind:href="'https://twitter.com/share?text='+blogdetail.name+'&url='+globalURL+'blogdetail/'+ blogdetail.id "
							     target = '_blank'>
								<i class="zmdi zmdi-twitter"></i>
								</a>
                                <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                <a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'blogdetail/'+ blogdetail.id " target = '_blank'>
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
                                <form @submit.prevent="fetchsearchblog">
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
                                    <a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'blogdetail/'+ blogdetail.id " target = '_blank'>
									<i class="zmdi zmdi-facebook"></i></a>
                                    <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                    <a v-bind:href="'https://twitter.com/share?text='+blogdetail.name+'&url='+globalURL+'blogdetail/'+ blogdetail.id "
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
									<router-link :to="{ name: 'blog', params: { bycat:'bycat', catid: cat.id   } }" 
									:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
										{{ cat.name }}  {{ cat.id}} {{ categoryId }} 
										( {{ cat.blogs_count}} )
									</router-link> 
								</li>

                            </ul>
                        </div>
						
						
						<div class="single-widget-area">
                            <h5 class="widget-title mb-30">Sub Categories</h5>
                            <ul class="categories-list">
							
								<li  v-for="sub, index2 in subs.data"> 
									<router-link :to="{ name: 'blog', params: {   bycat:'bysub', catid: sub.catid , subid: sub.id } }" class='marginright6'
									:class=" [{bold: classSub(sub.id)},{red: classSub(sub.id)}]"> 
										&rsaquo;  {{ sub.name }}  
										( {{ sub.bloggs_count}} )
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


	components: { Footer  ,   Contact1  },

	data: function() {
      return {
		blogdetail: {
	
	
		},
		
		cats: {},
		subs: {},
		ViewBlog:
		{                    
			blogidx: null,
		},

		keywords: null,
		
		
      };
    },
	
		watch: {
        keywords(after, before) {
            
        }
    },
	
	
	computed: {
		    categoryId() {
			  return this.blogdetail.catid;
		    },
		    subcategoryId() {
			  return this.blogdetail.subid;
		    },


		   
		    classCat: function () {
				var vm = this;
				return function (ctid) {
				    let cath = vm.blogdetail.catid;
					//alert(cath);
					if(vm.blogdetail.catid == ctid )
					{
						//alert(vm.blogdetail.catid + ' ies equal to ' + ctid);
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
			   
				if(vm.blogdetail.subid == stid )
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
		let blogid1 = '';

		
		if(app.$route.params.blogid)
		{
			blogid1 = app.$route.params.blogid;
			this.ViewBlog.blogidx = blogid1;
			console.log(' 371  blogid ' + blogid1);
			this.fetchBlog1(blogid1);
			this.fetchBlogCats() ;
			this.fetchBlogSubs() ;
			
		}
		
	},
	
	methods: 
	{
		
		fetchsearchblog() {
		const vr3 = this.$router;
           
			vr3.push({ name: 'blogsearch', params: { keywords: this.keywords } })
        },
		
		
		fetchBlog1(blogid1) 
		{
			
			var apper = this;
			var url  ='';
			url = '/blogdet/json/' + blogid1;
			//alert(url);
			console.log('line 398 ' + url);

			axios.get(url).then((res) => 
			{
				console.log( ' blogs linne 407 ' + res);
				this.blogdetail = res.data;
			});

		},
		

		
		fetchBlogCats() 
		{
			axios.get('/blogcaternav/json/bycat/').then((res) => 
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