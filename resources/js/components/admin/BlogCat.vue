<template>
	<div class="login row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h3>View Blog category</h3>
					</div>
					
					<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft5'>
								<router-link :to="{ name: 'addblogcat' }" class="btn btn-primary margintop8-4-5"> 
								  Add Categories
								</router-link> 
								<router-link to="/admin/blogcat/" class="btn btn-primary">All Categories</router-link>
								<router-link to="/admin/blogcat/bycat" class="btn btn-primary">Top Categories</router-link>
								<router-link to="/admin/blogcat/bysub" class="btn btn-primary">Sub Categories</router-link>
				
								
								
								
							</span>	
					</div>
					
					
					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>
								<td >Parent</td>
								<td>Name</td>
								
								<td >Add Subcategory</td>
								
								<td >View Blog</td>
								<td >Add Blog</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in cats.data">
									<td>{{ item.id }}</td>
									
									<td v-if="typeof item.catid !== 'undefined' && item.catid !== null && item.catid !== ''" >   
										 {{ item.blogcat.name }} 
									</td>
									
									<td v-else >
									<b style = 'color:red;'>
									Top Category</b>
									
									<router-link :to="{ name: 'blogcat', params: { bycat: 'bysub' , catid: item.id } }" class="btn btn-primary"> 
									View Subcategories ( {{ item.subcats_count }} ) </router-link>
									
									
									
									</td>
									
									
									<td>{{ item.name }}</td>
									
									<!-- Subcategory section -->
									
								    <td v-if="typeof item.catid !== 'undefined' && item.catid !== null && item.catid !== ''" >   
									Subcategory
									</td>
									
									<td v-else >
									<router-link :to="{ name: 'addblogcat', params: { catid: item.id } }" class="btn btn-primary"> 
									Add Subcategory {{ item.catid }} </router-link> </td>
									<!-- Subcategory section END -->
									
									<!-- Blog section -->
									
									<td v-if="typeof item.catid !== 'undefined' && item.catid !== null && item.catid !== ''" >
										<router-link :to="{ name: 'blog', params: { bycat: 'bysub' ,  catid: item.catid , subid: item.id} }" class="btn btn-primary"> 
										View Blogs of Subcategory  ( {{ item.bloggs_count }} ) </router-link> 
									</td>
									
									<td v-else >
										<router-link :to="{ name: 'blog', params: { bycat: 'bycat' ,  catid: item.id } }" class="btn btn-primary"> 
										View Blogs of Category ( {{ item.blogs_count }} ) </router-link> 						
									</td>

									
									<td v-if="typeof item.catid !== 'undefined' && item.catid !== null && item.catid !== ''" >
										<router-link :to="{ name: 'addblog', params: { bycat: 'bysub' , catid: item.catid ,  subid: item.id } }" 
										class="btn btn-primary"> 
										Add Blog To Subcategory </router-link> 
									</td>
									
									<td v-else >
									<router-link :to="{ name: 'addblog', params: {  bycat: 'bycat' , catid: item.id } }" class="btn btn-primary"> 
									Add Blog To Category </router-link> 
									</td>
									
									<!-- Blog section END -->
									
									<td ><router-link :to="{ name: 'editcatblog', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
								</tr>
							</tbody>
						</table>
						<pagination :data="cats" @pagination-change-page="fetchBlogCats"></pagination>
						
						
						
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
		data: function() {
			return {
			 cats: {},
			 ViewCat:{                    
					cat_id: null,
					by_type:null,
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
			let idcat = '';
			let bycate = '';
			if(app.$route.params.catid)
			{
            	idcat = app.$route.params.catid;
				//alert('yes ' + idcat );
				this.ViewCat.cat_id = idcat;
				console.log(' idcat ' + idcat);	
			}
			if(app.$route.params.bycat)
			{
            	bycate = app.$route.params.bycat;
				this.ViewCat.by_type = bycate;
				console.log(' bycate ' + bycate);	
			}

			this.fetchBlogCats();
			
			

		},
		computed: {
		
			categoryId() {
			  return this.ViewCat.cat_id
		   },
		}, 
        methods: 
		{
            fetchBlogCats(page) {
			
			    var apper = this;
				var url = '/admin/blogcater/json/';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				if(apper.ViewCat.by_type === null)
				{
					//url = '/admin/blogcater/json/';
					url = url;
				}
				else
				{
					let pagetype = apper.ViewCat.by_type;
					//url = '/admin/blogcater/json/'+pagetype+'/';
					url = url+pagetype+'/';
				}
				if(apper.ViewCat.cat_id === null)
				{
					url = url;
					console.log('line 113 ' + url);
				}
				else
				{
					let caterid = apper.ViewCat.cat_id;
					//url = '/admin/blogcater/json/'+caterid+'?page=' + page;
					url = url+caterid+'/';
					console.log('line 117 ' + url + ' thecatid ' + caterid);
				}
				url = url+'?page=' + page;	
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
                    this.cats = res.data.cats;
                });
	
				
            }
            ,
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/catblog/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.cats.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
