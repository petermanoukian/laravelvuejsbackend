<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Shops</h3>
					</div>
					
					<div>
					 	<p class='marginleft5'> Categories </p>
						<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft'>
								<router-link :to="{ name: 'shop' }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat()},{red: classCat()}]"> 
							    All categories
								</router-link> 
							</span>
							<span v-for="cat, index2 in cats.data" class="marginleft5"  
							:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]">
						
								<router-link :to="{ name: 'shop', params: { bycat: 'bycat' , catid: cat.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
							    {{ cat.name}} ({{cat.shopers_count }})
								</router-link> 
								
								<router-link :to="{ name: 'addshop', params: { bycat: 'bycat' , catid: cat.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
									Add Shop to  {{ cat.name}}  </router-link>   
							</span>
							

							
							
							
							
							<span class = 'marginleft'>
								<router-link to="/admin/addshop" class="btn btn-primary margintop8-4-5"> Add Shop</router-link>
							</span>
							
						
						</div>
					</div>
					
					<div>
					 	<p class='marginleft5'> SubCategories </p>
						<div class = 'marginleft5 margintop8-4-5'>
						
							<span v-for="sub, index3 in subs.data" class="marginleft5"  
							:class=" [{bold: classSubCat(sub.id)},{red: classSubCat(sub.id)}]">
						
								<router-link :to="{ name: 'shop', params: { bycat: 'bysub' , catid: sub.catid ,  subid: sub.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classSubCat(sub.id)},{red: classSubCat(sub.id)}]"> 
							    {{ sub.name}} ({{ sub.shoperrs_count }})
								</router-link> 
								
								<router-link :to="{ name: 'addshop', params: { bycat: 'bysub' , catid: sub.catid ,  subid: sub.id } }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classSubCat(sub.id)},{red: classSubCat(sub.id)}]"> 
									Add Shop to  {{ sub.name}}  </router-link>   
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
								<td >Price</td>
								<td >Image</td>
								<td >Images</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in shops.data" :key="shops.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									
									<td v-if="typeof item.shopcat !== 'undefined' && item.shopcat !== null">  
										<router-link :to="{ name: 'editcatshop', params: { id: item.shopcat.id } }" class="btn btn-primary">  
										{{ item.shopcat.name }} {{ item.shopcat.id }}
										</router-link> 
										
										<router-link :to="{ name: 'addshop', params: { bycat: 'bycat' , catid: item.shopcat.id  } }" 
										class="btn btn-primary"> Add Shop </router-link
										
										
									</td>
									<td v-else>   
										No Category 
									</td>
									
									
									<td v-if="typeof item.shopsub !== 'undefined' && item.shopsub !== null">  
										<router-link :to="{ name: 'editcatshop', params: { id: item.shopsub.id } }" class="btn btn-primary">  
										{{ item.shopsub.name }} {{ item.shopsub.id }}
										</router-link> 
										
										
										<router-link :to="{ name: 'addshop', params: { bycat: 'bysub' , catid: item.shopcat.id ,  subid: item.shopsub.id } }" 
										class="btn btn-primary"> 
										Add Shop </router-link

									</td>
									<td v-else>   
										No SubCategory 
									</td>
									

									<td>
									{{ item.prix }} $
									</td>
									
								
									<td v-if="typeof item.logo !== 'undefined' && item.logo !== null && item.logo !== '' " >  
									<img :src=imagepath+item.logo style = "width:90px;height:90px;"/>
								
									</td>
									<td v-else>   
									No Image added  
									</td>
						
									<td>
									<router-link :to="{ name: 'shopimg', params: { shopid: item.id } }" class="btn btn-primary"> 
									View Images {{ item.shopimages_count}} </router-link>
									<router-link :to="{ name: 'addshopimg', params: { shopid: item.id } }" 
									class="btn btn-primary margintop5"> 
									Add More Images </router-link>

									
									</td>
									
									
									<td  >
									<router-link :to="{ name: 'editshop', params: { id: item.id , catid1: item.shopcat.id} }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td v-lse>  &nbsp; </td>
									
									<td   >
									<button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
									
									
								</tr>
							</tbody>
						</table>
						<pagination :data="shops" @pagination-change-page="fetchShops"></pagination>

						
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
				 shops: {},
				 cats: {},
				 subs: {},
				 ViewShop:{                    
					cat_id: null,
					by_type:null,
					sub_id:null,
				}
			}
		},
		computed: {

			imagepath : function (logo) 
			{
				return "/images/shop/thumb/";
		    },
			
			currentUser(){
			return this.$store.getters.currentUser;
			},
			
			categoryId() {
			  return this.ViewShop.cat_id
		    },
			subcategoryId() {
			  return this.ViewShop.sub_id
		    },
			
			
			classCat: function () {
				 var vm = this;
      			return function (shopid) {
					
				   vm.ViewShop.cat_id == shopid
				   if(vm.ViewShop.cat_id == shopid)
				   {	
						return true;
				   }
				   else
				   {
				   	 //console.log(vm.ViewShop.cat_id  + ' NOT equal to ' + shopid);
					 return false;
				   }
				}
			 },
			
			
			classSubCat: function () {
				 var vm = this;
      			return function (shopid) {
					
				   vm.ViewShop.sub_id == shopid
				   if(vm.ViewShop.sub_id == shopid)
				   {		
						return true;
				   }
				   else
				   {
				   	 //console.log(vm.ViewShop.sub_id  + ' NOT equal to ' + shopid);
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
				this.ViewShop.cat_id = idcat;
				console.log(' idcat 260 ' + idcat);
			}
			if(app.$route.params.subid)
			{
            	idsub = app.$route.params.subid;
				this.ViewShop.sub_id = idsub;
				console.log(' 267 idsub ' + idsub);
			}
			if(app.$route.params.bycat)
			{
            	bycate = app.$route.params.bycat;
				this.ViewShop.by_type = bycate;
				console.log(' 272 bycate ' + bycate);	
			}
			this.fetchShops();
			this.fetchShopCatsDropDown();
			this.fetchShopSubCatsDropDown();
			

		},
		
        methods: 
		{
            fetchShops(page) {
			
			    var apper = this;
				var url = '/admin/shopp/json/';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				
				if(apper.ViewShop.by_type === null)
				{
					url = url;
				}
				else
				{
					let pagetype = apper.ViewShop.by_type;
					url = url+pagetype+'/';
				}

				if(apper.ViewShop.cat_id === null)
				{
					//url = '/admin/shopp/json?page=' + page;
					url=url;
					console.log('line 308 ' + url);
				}
				else
				{
					let caterid = apper.ViewShop.cat_id;
					//url = '/admin/shopp/json/'+caterid+'?page=' + page;
					url = url+caterid+'/';
					console.log('line 314 ' + url + ' thecatid ' + caterid);
				}
				
				if(apper.ViewShop.sub_id === null)
				{
					//url = '/admin/shopp/json?page=' + page;
					url=url;
					console.log('line 321 ' + url);
				}
				else
				{
					let suberid = apper.ViewShop.sub_id;
					//url = '/admin/shopp/json/'+caterid+'?page=' + page;
					url = url+suberid+'/';
					console.log('line 328 ' + url + ' thesubid ' + suberid);
				}
				
				
				url = url+'?page=' + page;	
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 335 ' + res);
					console.log( ' linne 336 ' + res.data);
                    this.shops = res.data;
                });	
            }
            ,

		    fetchShopCatsDropDown() 
		    {
				let urlg = '/admin/shopcaternav/json/bycat/';
				var apper1 = this;
				axios.get(urlg).then((res) => 
				{  
					this.cats = res;
					let crt = this.cats;
					console.log('line 350 ' + crt);
				});
		
            },
			
			
			
			fetchShopSubCatsDropDown() 
		    {
				let urlg = '/admin/shopcaternav/json/bysubshoper/';
				var apper1 = this;
				
	
				if(apper1.ViewShop.cat_id === null)
				{
					urlg = urlg;
					console.log('line 366 ' + urlg);
				}
				else
				{
					let caterid = apper1.ViewShop.cat_id;		
					urlg = urlg+caterid+'/';
					console.log('line 372 ' + urlg + ' thecatid ' + caterid);
				}

				
				axios.get(urlg).then((res) => 
				{  
					this.subs = res;
					let crt = this.subs;
					console.log('line 380 ' + crt);
				});
		
            },
			
			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/deleteshop/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.shops.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
