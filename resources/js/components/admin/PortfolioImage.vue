<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View portfolio Image</h3>
					</div>
					
					
					<div>
					 	
						<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft'>
								<router-link :to="{ name: 'portfolio' }" class="btn btn-primary margintop8-4-5"> 
							    Gallery
								</router-link> 
							</span>
				
							
							<span class = 'marginleft'>
								<router-link to="/admin/addportfolio" class="btn btn-primary margintop8-4-5"> Add Gallery </router-link>
							</span>
							
							
							<span class = 'marginleft' v-if="typeof this.ViewPortimg.port_id !== 'undefined' 
								&& this.ViewPortimg.port_id !== null && this.ViewPortimg.port_id !== '' ">
									<router-link :to="{ name: 'addportfolioimg', params: { portid: this.ViewPortimg.port_id } }"
									 class="btn btn-primary"> 
									Add More Images  To {{ this.portname }}   </router-link>
							</span>
							
							
							<span class = 'marginleft' v-else>
									<router-link :to="{ name: 'addportfolioimg' }"
									 class="btn btn-primary"> 
									Add More Images to Gallery </router-link>
							</span>
							
							
						</div>
					</div>
					
					
					
					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>
								
								<td>Name</td>
								<td >Gallery</td>
								<td >Image</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in portimgs.data" :key="portimgs.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									<td v-if="typeof item.portfolio !== 'undefined' && item.portfolio !== null">   
										
										<router-link :to="{ name: 'editportfolio', params: { id: item.portfolio.id } }" class="btn btn-primary"> 
										{{ item.portfolio.name }} {{ item.portfolio.id }}
										</router-link>
										<router-link :to="{ name: 'addportfolioimg', params: { portid: item.portfolio.id  } }"
									     class="btn btn-primary"> Add Image To Gallery </router-link>
									
									
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

							
									
									
									<td ><router-link :to="{ name: 'editportfolioimg', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
								</tr>
							</tbody>
						</table>
						<pagination :data="portimgs" @pagination-change-page="fetchPortimgs"></pagination>
						
						
						
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
				 portimgs: {},
				 portname: '',
				 ViewPortimg:{                    
					port_id: null,
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
			let idport = '';
			if(app.$route.params.portid)
			{
            	idport = app.$route.params.portid;
				this.ViewPortimg.port_id = idport;
				console.log(' idport ' + idport);
				this.fetchPortDetails(idport);
			}
			this.fetchPortimgs();
			
			

		},
		
        methods: 
		{
            fetchPortimgs(page) {
			
			    var apper = this;
				var url  ='';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				if(apper.ViewPortimg.port_id === null)
				{
					url = '/admin/portimg/json?page=' + page;
					console.log('line 113 ' + url);
				}
				else
				{
					let porterid = apper.ViewPortimg.port_id;
					url = '/admin/portimg/json/'+porterid+'?page=' + page;
					console.log('line 117 ' + url + ' theportid ' + porterid);
				}
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
					console.log( ' linne 88 ' + res.data);
                    this.portimgs = res.data;
                });
		
				
            }
            ,
			
			fetchPortDetails(portid) {
				var portvm = this;
                axios.get('/admin/port/detail/' + portid).then((res) => 
				{
				    let prtname = res.data.name;
                    portvm.portname = res.data.name;
					console.log('198 port data is  ' + res.data);
					console.log('199 port is ' + res);
					console.log('200 port is ' + prtname);
                });
		
            },
			
			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/deleteportimg/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.portimgs.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
