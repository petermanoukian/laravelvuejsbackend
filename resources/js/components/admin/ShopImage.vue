<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Shop Images</h3>
					</div>
					
					
					<div>
					 	
						<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft'>
								<router-link :to="{ name: 'shop' }" class="btn btn-primary margintop8-4-5"> 
							    Shop
								</router-link> 
							</span>
				
							
							<span class = 'marginleft'>
								<router-link to="/admin/addshop" class="btn btn-primary margintop8-4-5"> Add Shop </router-link>
							</span>
							
							
							<span class = 'marginleft' v-if="typeof this.ViewShopimg.shop_id !== 'undefined' 
								&& this.ViewShopimg.shop_id !== null && this.ViewShopimg.shop_id !== '' ">
									<router-link :to="{ name: 'addshopimg', params: { shopid: this.ViewShopimg.shop_id } }"
									 class="btn btn-primary"> 
									Add More Images  To {{ this.shopname }}   </router-link>
							</span>
							
							
							<span class = 'marginleft' v-else>
									<router-link :to="{ name: 'addshopimg' }"
									 class="btn btn-primary"> 
									Add More Images To Shop </router-link>
							</span>
							
							
						</div>
					</div>
					
					
					
					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>
								
								<td>Name</td>
								<td >Shop</td>
								<td >Image</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in shopimgs.data" :key="shopimgs.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									<td v-if="typeof item.shoper !== 'undefined' && item.shoper !== null">   
										
										<router-link :to="{ name: 'editshop', params: { id: item.shoper.id } }" class="btn btn-primary"> 
										{{ item.shoper.name }} {{ item.shoper.id }}
										</router-link>
										<router-link :to="{ name: 'addshopimg', params: { shopid: item.shoper.id  } }"
									     class="btn btn-primary"> Add Image  </router-link>
									
									
									</td>
									<td v-else>   
									No Category 
									</td>
									
									
								
									<td v-if="typeof item.logo !== 'undefined' && item.logo !== null && item.logo !== '' " >  
									<img :src=imagepath+item.logo style = "width:90px;height:90px;"/>
								
									</td>
									<td v-else>   
									No Image added  
									</td>

							
									
									
									<td ><router-link :to="{ name: 'editshopimg', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
								</tr>
							</tbody>
						</table>
						<pagination :data="shopimgs" @pagination-change-page="fetchShopimgs"></pagination>
						
						
						
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
				 shopimgs: {},
				 shopname: '',
				 ViewShopimg:{                    
					shop_id: null,
				}
			}
		},
		computed: {

			imagepath : function (logo) 
			{
				return "/images/gallery/thumb/";
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
			let idshop = '';
			if(app.$route.params.shopid)
			{
            	idshop = app.$route.params.shopid;
				this.ViewShopimg.shop_id = idshop;
				console.log(' idshop ' + idshop);
				this.fetchshopDetails(idshop);
			}
			this.fetchShopimgs();
			
			

		},
		
        methods: 
		{
            fetchShopimgs(page) {
			
			    var apper = this;
				var url  ='';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				if(apper.ViewShopimg.shop_id === null)
				{
					url = '/admin/shoperimg/json?page=' + page;
					console.log('line 113 ' + url);
				}
				else
				{
					let shperid = apper.ViewShopimg.shop_id;
					url = '/admin/shoperimg/json/'+shperid+'?page=' + page;
					console.log('line 117 ' + url + ' theshopid ' + shperid);
				}
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
					console.log( ' linne 88 ' + res.data);
                    this.shopimgs = res.data;
                });
		
				
            }
            ,
			
			fetchshopDetails(shopid) {
			//alert(shopid);
				var shopvm = this;
                axios.get('/admin/shopdet/detail/' + shopid).then((res) => 
				{
				    let shpname = res.data.name;
                    shopvm.shopname = res.data.name;
					console.log('198 shop data is  ' + res.data);
					console.log('199 shop is ' + res);
					console.log('200 shop is ' + prtname);
                });
		
            },
			
			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/deleteshopimg/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.shopimgs.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
