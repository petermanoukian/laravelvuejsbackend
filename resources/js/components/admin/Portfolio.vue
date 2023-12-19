<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Gallery</h3>
					</div>
					
					<div>
					 	<p class='marginleft5'> Categories </p>
						<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft5'>
								<router-link :to="{ name: 'portfolio' }" class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat()},{red: classCat()}]"> 
							    All Galleries
								</router-link> 
							</span>

							
							<span class = 'marginleft5'>
								<router-link to="/admin/addportfolio" class="btn btn-primary margintop8-4-5"> Add Gallery </router-link>
							</span>
							
							
						</div>
						
						<div class = 'marginleft5 margintop8-4-5'>
						
						  <span v-for="cat, index2 in cats.data" class="marginleft5"  
							:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]">
								<router-link :to="{ name: 'portfolio', params: { catid: cat.id  , bycitycat:'bycat' } }" 
								class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
							    {{ cat.name}} 
								</router-link> 
								
								<router-link :to="{ name: 'addportfolio', params: { catid: cat.id  , bycitycat:'bycat'} }" 
								class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCat(cat.id)},{red: classCat(cat.id)}]"> 
									Add Gallery to  {{ cat.name}}  </router-link> 
								
								  
							</span>
						</div>
						
						
					<div class = 'marginleft5 margintop8-4-5'>
						
						  <span v-for="city, index3 in cities.data" class="marginleft5"  
							:class=" [{bold: classCity(city.id)},{red: classCity(city.id)}]">
								<router-link :to="{ name: 'portfolio', params: { catid: city.id  , bycitycat:'bycity'} }" 
								class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCity(city.id)},{red: classCity(city.id)}]"> 
							    {{ city.name}} 
								</router-link> 
								
								<router-link :to="{ name: 'addportfolio', params: { catid: city.id  , bycitycat:'bycity'} }" 
								class="btn btn-primary margintop8-4-5"
								:class=" [{bold: classCity(city.id)},{red: classCity(city.id)}]"> 
									Add Gallery to  {{ city.name}}  </router-link> 
								
								  
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
								<td >City</td>
								<td style ="width:150px;word-break:break-all;">Website</td>
								<td >Image</td>
								<td >Images</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in ports.data" :key="ports.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									<td v-if="typeof item.portcat !== 'undefined' && item.portcat !== null">  
										<router-link :to="{ name: 'editcatportfolio', params: { id: item.portcat.id } }" 
										class="btn btn-primary">  
										{{ item.portcat.name }} {{ item.portcat.id }}
										</router-link> 
										
										<router-link :to="{ name: 'addportfolio', params: { catid: item.portcat.id  , bycitycat:'bycat'} }" 
										class="btn btn-primary margintop5"> Add Gallery </router-link
										
										
									</td>
									<td v-else>   
										No Category 
									</td>
									
									<td v-if="typeof item.portcity !== 'undefined' && item.portcity !== null">  
										<router-link :to="{ name: 'editcity', params: { id: item.portcity.id } }" 
										class="btn btn-primary">  
										{{ item.portcity.name }} {{ item.portcity.id }}
										</router-link> 
										<router-link :to="{ name: 'addportfolio', params: { catid: item.portcity.id  , bycitycat:'bycity'} }" 
										class="btn btn-primary margintop5"> Add Gallery </router-link
									</td>
									<td v-else>   
										No City
									</td>
		
									<td style ="width:150px;word-break:break-all;">   <a :href="item.url" target="_blank">  {{ item.url }} </a> </td>
									<td v-if="typeof item.logo !== 'undefined' && item.logo !== null && item.logo !== '' " >  
									<img :src=imagepath+item.logo style = "width:90px;height:90px;"/>
								
									</td>
									<td v-else>   
									No Image added  
									</td>
									<td>
									<router-link :to="{ name: 'portfolioimg', params: { portid: item.id } }" class="btn btn-primary"> 
									View Images {{ item.portfolioimages_count}} </router-link>
									<router-link :to="{ name: 'addportfolioimg', params: { portid: item.id } }" 
									class="btn btn-primary margintop5"> 
									Add More Images  </router-link>

									
									</td>
							
									
									
									<td ><router-link :to="{ name: 'editportfolio', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
								</tr>
							</tbody>
						</table>
						<pagination :data="ports" @pagination-change-page="fetchPorts"></pagination>
						
						
						
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
				 ports: {},
				 cats: {},
				 cities: {},
				 ViewPort:{                    
					cat_id: null,
					bycitycat:null,
					city_id: null,
				}
			}
		},
		computed: {

			imagepath : function (logo) 
			{
				return "/images/thumb/";
		    },
			
			categoryId() {
				  return this.ViewPort.cat_id
			},
			classCat: function () {
					 var vm = this;
					return function (portfolioid) {
						//alert(portfolioid);
					   //vm.ViewPort.cat_id == portfolioid
					   if(vm.ViewPort.cat_id == portfolioid && vm.ViewPort.bycitycat == 'bycat')
					   {
							console.log(vm.ViewPort.cat_id  + ' IS equal to ' + portfolioid);
							return true;
					   }
					   else
					   {
						 console.log(vm.ViewPort.cat_id  + ' NOT equal to ' + portfolioid);
						 return false;
					   }
					}
			},
			  
			  
			  
			classCity: function () {
				 var vm = this;
      			return function (portfolioid) {
					//alert(portfolioid);
				   
				   if(vm.ViewPort.city_id == portfolioid && vm.ViewPort.bycitycat == 'bycity')
				   {
				   		console.log(vm.ViewPort.cat_id  + ' IS equal to ' + portfolioid);
						return true;
				   }
				   else
				   {
				   	 console.log(vm.ViewPort.cat_id  + ' NOT equal to ' + portfolioid);
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
			let idcat = '';
			let bycitycat1 = '';

			
			if(app.$route.params.bycitycat)
			{
            	bycitycat1 = app.$route.params.bycitycat;
				this.ViewPort.bycitycat = bycitycat1;
				console.log(' bycitycat ' + bycitycat1);
				
				if(app.$route.params.catid)
				{
					if(bycitycat1 == 'bycat')
					{
						idcat = app.$route.params.catid;
						this.ViewPort.cat_id = idcat;
						console.log(' idcat ' + idcat);
					}
					else if(bycitycat1 == 'bycity')
					{
						idcat = app.$route.params.catid;
						this.ViewPort.city_id = idcat;
						console.log(' idcat ' + idcat);
					}
				}
				
			}
			
			
			this.fetchPorts();
			this.fetchPortCatsDropDwon();
			this. fetchPortCitiesDropDwon();

		},
		
        methods: 
		{
            fetchPorts(page) {
			
			    var apper = this;
				var url  ='';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				if(apper.ViewPort.cat_id === null && apper.ViewPort.city_id === null)
				{
					url = '/admin/port/json?page=' + page;
					console.log('line 113 ' + url);
				}
				else
				{
					let bycitycat2 = apper.ViewPort.bycitycat;
					if(apper.ViewPort.cat_id != null && bycitycat2 =='bycat')
					{
						let caterid = apper.ViewPort.cat_id;
						
						url = '/admin/port/json/'+caterid+'/'+bycitycat2+'?page=' + page;
						console.log('line 117 ' + url + ' thecatid ' + caterid);
					}
					else if(apper.ViewPort.city_id != null && bycitycat2 =='bycity')
					{
						let caterid = apper.ViewPort.city_id;
						
						url = '/admin/port/json/'+caterid+'/'+bycitycat2+'?page=' + page;
						console.log('line 117 ' + url + ' thecatid ' + caterid);
					}
					
					
				}
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
					console.log( ' linne 88 ' + res.data);
                    this.ports = res.data;
                });
		
				
            }
            ,
			
			
		  fetchPortCatsDropDwon() {
                axios.get('/admin/portcat/jsoncatdrop').then((res) => 
				{  
                    this.cats = res;
                });
		
            },
			
			
			
			fetchPortCitiesDropDwon() {
                axios.get('/admin/cities/jsoncitydrop').then((res) => 
				{  
                    this.cities = res;
                });
		
            },
			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/deleteportfolio/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.ports.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
