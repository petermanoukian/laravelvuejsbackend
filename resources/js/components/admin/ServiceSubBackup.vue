<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Sub Section</h3>
					</div>
					
					
					<div>
					 	
						<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft'>
								<router-link :to="{ name: 'service' }" class="btn btn-primary margintop8-4-5"> 
							   Services
								</router-link> 
							</span>
				
							
							<span class = 'marginleft'>
								<router-link to="/admin/addservice" class="btn btn-primary margintop8-4-5"> Add Service </router-link>
							</span>
							
							
							<span class = 'marginleft' v-if="typeof this.ViewServsub.serv_id !== 'undefined' 
								&& this.ViewServsub.serv_id !== null && this.ViewServsub.serv_id !== '' ">
									<router-link :to="{ name: 'addservicesub', params: { servid: this.ViewServsub.serv_id } }"
									 class="btn btn-primary"> 
									Add   To {{ this.servname }}   </router-link>
							</span>
							
							
							<span class = 'marginleft' v-else>
									<router-link :to="{ name: 'addservicesub' }"
									 class="btn btn-primary"> 
									Add  </router-link>
							</span>
							
							
						</div>
					</div>
					
					
					
					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>
								
								<td>Name</td>
								<td >Service</td>
								<td >Image</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in servsubs.data" :key="servsubs.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									<td v-if="typeof item.service !== 'undefined' && item.service !== null">   
										
										<router-link :to="{ name: 'editservice', params: { id: item.service.id } }" class="btn btn-primary"> 
										{{ item.service.name }} {{ item.service.id }}
										</router-link>
										<router-link :to="{ name: 'addservicesub', params: { servid: item.service.id  } }"
									     class="btn btn-primary"> Add </router-link>
									
									
									</td>
									<td v-else>   
									No Category 
									</td>
									
									
								
									<td v-if="typeof item.logo !== 'undefined' && item.logo !== null && item.logo !== '' " >  
									<img :src=imagepath+item.logo />
								
									</td>
									<td v-else>   
									No Image added  
									</td>

							
									
									
									<td ><router-link :to="{ name: 'editservicesub', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
								</tr>
							</tbody>
						</table>
						<pagination :data="servsubs" @pagination-change-page="fetchServsubs"></pagination>
						
						
						
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
				 servsubs: {},
				 servname: '',
				 ViewServsub:{                    
					serv_id: null
				}
			}
		},
		computed: {

			imagepath : function (logo) 
			{
				return "/images/gallerysub/thumb/";
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
			let idserv = '';
			if(app.$route.params.servid)
			{
            	idserv = app.$route.params.servid;
				this.ViewServsub.serv_id = idserv;
				console.log(' idserv ' + idserv);
				this.fetchServDetails(idserv);
			}
			else
			{
				//this.ViewServsub.serv_id = null;
			}
			this.fetchServsubs();
			
			

		},
		
        methods: 
		{
            fetchServsubs(page) {
			
			    var apper = this;
				var url  ='';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				if(apper.ViewServsub.serv_id === null)
				{
					
					url = '/admin/servicesub/json/?page=' + page;
					//console.log('line 183 ' + url );
				}
				else
				{
					let serverid = apper.ViewServsub.serv_id;
					url = '/admin/servicesub/json/'+serverid+'?page=' + page;
				
				}
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 197 ' + res);
					console.log( ' linne 198 ' + res.data);
                    this.servsubs = res.data;
                });
		
				
            }
            ,
			
			fetchServDetails(servid) {
				var servvm = this;
                axios.get('/admin/service/detail/' + servid).then((res) => 
				{
				    let prtname = res.data.name;
                    servvm.servname = res.data.name;
					console.log('198 serv data is  ' + res.data);
					console.log('199 serv is ' + res);
					console.log('200 serv is ' + prtname);
                });
		
            },
			
			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/deleteservicesub/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.servsubs.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
