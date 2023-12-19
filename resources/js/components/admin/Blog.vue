<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Blogs</h3>
					</div>
					
					<div>
					 	<p class='marginleft5'> Categories </p>
						<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft'>
								<router-link :to="{ name: 'blog' }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat()},{red: classCat()}]"> 
							    All categories
								</router-link> 
							</span>
							<span v-for="cat, index2 in cats.data" class="marginleft5"  
							:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]">
						
								<router-link :to="{ name: 'blog', params: { bycat: 'bycat' , catid: cat.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
							    {{ cat.name}} ({{cat.blogs_count }})
								</router-link> 
								
								<router-link :to="{ name: 'addblog', params: { bycat: 'bycat' , catid: cat.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
									Add Blog to  {{ cat.name}}  </router-link>   
							</span>
							

							
							
							
							
							<span class = 'marginleft'>
								<router-link to="/admin/addblog" class="btn btn-primary margintop8-4-5"> Add Blog</router-link>
							</span>
							
							 {{ currentUser.membertype }}  {{ currentUser.id }} 
						</div>
					</div>
					
					<div>
					 	<p class='marginleft5'> SubCategories </p>
						<div class = 'marginleft5 margintop8-4-5'>
						
							<span v-for="sub, index3 in subs.data" class="marginleft5"  
							:class=" [{bold: classSubCat(sub.id)},{red: classSubCat(sub.id)}]">
						
								<router-link :to="{ name: 'blog', params: { bycat: 'bysub' , catid: sub.catid ,  subid: sub.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classSubCat(sub.id)},{red: classSubCat(sub.id)}]"> 
							    {{ sub.name}} ({{ sub.bloggs_count }})
								</router-link> 
								
								<router-link :to="{ name: 'addblog', params: { bycat: 'bysub' , catid: sub.catid ,  subid: sub.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classSubCat(sub.id)},{red: classSubCat(sub.id)}]"> 
									Add Blog to  {{ sub.name}}  </router-link>   
							</span>
						
						
						
						</div>
					</div>
					
					
					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>
								
								<td>Name</td>
								<td >Category</td>
								<td >SubCategory</td>
								<td >User</td>
								<td >Image</td>

								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in blogs.data" :key="blogs.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									
									<td v-if="typeof item.blogcat !== 'undefined' && item.blogcat !== null">  
										<router-link :to="{ name: 'editcatblog', params: { id: item.blogcat.id } }" class="btn btn-primary">  
										{{ item.blogcat.name }} {{ item.blogcat.id }}
										</router-link> 
										
										<router-link :to="{ name: 'addblog', params: { bycat: 'bycat' , catid: item.blogcat.id  } }" 
										class="btn btn-primary"> Add Blog </router-link
										
										
									</td>
									<td v-else>   
										No Category 
									</td>
									
									
									<td v-if="typeof item.blogsub !== 'undefined' && item.blogsub !== null">  
										<router-link :to="{ name: 'editcatblog', params: { id: item.blogsub.id } }" class="btn btn-primary">  
										{{ item.blogsub.name }} {{ item.blogsub.id }}
										</router-link> 
										
										
										<router-link :to="{ name: 'addblog', params: { bycat: 'bysub' , catid: item.blogcat.id ,  subid: item.blogsub.id } }" 
										class="btn btn-primary"> 
										Add Blog </router-link
										
										
									</td>
									<td v-else>   
										No SubCategory 
									</td>
									

									<td>
									{{ item.user.name }} {{ item.user.id }}
									</td>
									
								
									<td v-if="typeof item.logo !== 'undefined' && item.logo !== null && item.logo !== '' " >  
									<img :src=imagepath+item.logo style = "width:90px;height:90px;"/>
								
									</td>
									<td v-else>   
									No Image added  
									</td>
						
							
									
									
									<td  v-if="currentUser.membertype == 'admin' || currentUser.id  == item.userid  ">
									<router-link :to="{ name: 'editblog', params: { id: item.id , catid1: item.blogcat.id} }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td v-lse>  &nbsp; </td>
									
									<td  v-if="currentUser.membertype == 'admin' || currentUser.id  == item.userid  " >
									<button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
									
									<td v-lse>  &nbsp; </td>
								</tr>
							</tbody>
						</table>
						<pagination :data="blogs" @pagination-change-page="fetchBlogs"></pagination>
						
						
						
					</div>
			</div>
		</div>
	</div>
</template>

<script>



import Header from './Header.vue';
import router from '../../app.js'


import Vue from 'vue'
import Router from 'vue-router'

  export default 
  {
        components: 
        {
              Header
        },
	    data: function() 
		{
			return {
				 blogs: {},
				 cats: {},
				 subs: {},
				 ViewBlog:{                    
					cat_id: null,
					by_type:null,
					sub_id:null,
				}
			}
		},
		computed: {

			imagepath : function (logo) 
			{
				return "/images/blog/thumb/";
		    },
			
			currentUser(){
			return this.$store.getters.currentUser;
			},
			
			categoryId() {
			  return this.ViewBlog.cat_id
		    },
			subcategoryId() {
			  return this.ViewBlog.sub_id
		    },
			
			
			classCat: function () {
				 var vm = this;
      			return function (blogid) {
					
				   vm.ViewBlog.cat_id == blogid
				   if(vm.ViewBlog.cat_id == blogid)
				   {
				   		
						return true;
				   }
				   else
				   {
				   	 //console.log(vm.ViewBlog.cat_id  + ' NOT equal to ' + blogid);
					 return false;
				   }
				}
			 },
			
			
			classSubCat: function () {
				 var vm = this;
      			return function (blogid) {
					
				   vm.ViewBlog.sub_id == blogid
				   if(vm.ViewBlog.sub_id == blogid)
				   {
				   		
						return true;
				   }
				   else
				   {
				   	 //console.log(vm.ViewBlog.sub_id  + ' NOT equal to ' + blogid);
					 return false;
				   }
				}
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
			let idsub = '';
			let idcat = '';
			let bycate = '';
			if(app.$route.params.catid)
			{
            	idcat = app.$route.params.catid;
				this.ViewBlog.cat_id = idcat;
				console.log(' idcat 248 ' + idcat);
			}
			if(app.$route.params.subid)
			{
            	idsub = app.$route.params.subid;
				this.ViewBlog.sub_id = idsub;
				console.log(' 254 idsub ' + idsub);
			}
			if(app.$route.params.bycat)
			{
            	bycate = app.$route.params.bycat;
				this.ViewBlog.by_type = bycate;
				console.log(' 260 bycate ' + bycate);	
			}
			this.fetchBlogs();
			this.fetchBlogCatsDropDown();
			this.fetchBlogSubCatsDropDown();
			

		},
		
        methods: 
		{
            fetchBlogs(page) {
			
			    var apper = this;
				var url = '/admin/blogg/json/';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				
				if(apper.ViewBlog.by_type === null)
				{
					url = url;
				}
				else
				{
					let pagetype = apper.ViewBlog.by_type;
					url = url+pagetype+'/';
				}

				if(apper.ViewBlog.cat_id === null)
				{
					//url = '/admin/blogg/json?page=' + page;
					url=url;
					console.log('line 294 ' + url);
				}
				else
				{
					let caterid = apper.ViewBlog.cat_id;
					//url = '/admin/blogg/json/'+caterid+'?page=' + page;
					url = url+caterid+'/';
					console.log('line 300 ' + url + ' thecatid ' + caterid);
				}
				
				if(apper.ViewBlog.sub_id === null)
				{
					//url = '/admin/blogg/json?page=' + page;
					url=url;
					console.log('line 308 ' + url);
				}
				else
				{
					let suberid = apper.ViewBlog.sub_id;
					//url = '/admin/blogg/json/'+caterid+'?page=' + page;
					url = url+suberid+'/';
					console.log('line 315 ' + url + ' thesubid ' + suberid);
				}
				
				
				url = url+'?page=' + page;	
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 322 ' + res);
					console.log( ' linne 323 ' + res.data);
                    this.blogs = res.data;
                });
		
				
            }
            ,
			
			
		    fetchBlogCatsDropDown() 
		    {
				let urlg = '/admin/blogcaternav/json/bycat/';
				var apper1 = this;
				
	
				
				axios.get(urlg).then((res) => 
				{  
					this.cats = res;
					let crt = this.cats;
					console.log('line 347 ' + crt);
				});
		
            },
			
			
			
			fetchBlogSubCatsDropDown() 
		    {
				let urlg = '/admin/blogcaternav/json/bysubblog/';
				var apper1 = this;
				
	
				if(apper1.ViewBlog.cat_id === null)
				{
					urlg = urlg;
					console.log('line 373 ' + urlg);
				}
				else
				{
					let caterid = apper1.ViewBlog.cat_id;		
					urlg = urlg+caterid+'/';
					console.log('line 379 ' + urlg + ' thecatid ' + caterid);
				}

				
				axios.get(urlg).then((res) => 
				{  
					this.subs = res;
					let crt = this.subs;
					console.log('line 400 ' + crt);
				});
		
            },
			
			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/deleteblog/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.blogs.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
