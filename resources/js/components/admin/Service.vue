<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Banners</h3>
					</div>
					
					<div>
					
						<div class = 'marginleft5 margintop8-4-5'>
					
	
							<span class = 'marginleft'>
								<router-link to="/admin/addservice" class="btn btn-primary margintop8-4-5"> Add Banner </router-link>
							</span>
							
							
						</div>
					</div>
					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>
								
								<td>Name</td>
								<td >Icon</td>
								<td >Image</td>
								<td >Subsections</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in services.data" :key="services.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									<td v-if="typeof item.img !== 'undefined' && item.img !== null && item.img !== '' " >  
									<img :src=imagepath+item.img />
									</td>
									
									<td v-else>   
									No Image added  
									</td>
									
							
									<td v-if="typeof item.icon !== 'undefined' && item.icon !== null && item.icon !== '' " >  
									<img :src=imagepath2+item.icon class= 'max150-150'/>
								
									</td>
									<td v-else>   
										No Icon added  
									</td>
									<td>
									<router-link :to="{ name: 'servicesub', params: { servid: item.id } }" class="btn btn-primary"> 
									View </router-link>
									<router-link :to="{ name: 'addservicesub', params: { servid: item.id } }" 
									class="btn btn-primary"> 
									Add   </router-link>

									
									</td>
							
									
									
									<td ><router-link :to="{ name: 'editservice', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
								</tr>
							</tbody>
						</table>
						<pagination :data="services" @pagination-change-page="fetchServices"></pagination>
						
						
						
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
				 services: {}
			}
		},
		computed: {

			imagepath : function (logo) 
			{
				return "/images/service/thumb/";
		    },
			imagepath2 : function (logo) 
			{
				return "/images/service/icon/";
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

			this.fetchServices();
			
			

		},
		
        methods: 
		{
            fetchServices(page) {
			
			    var apper = this;
				var url  ='';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }

				
				url = '/admin/services/json?page=' + page;
				
		
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
					console.log( ' linne 88 ' + res.data);
                    this.services = res.data;
                });
		
				
            }
            ,
			

			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/deleteservice/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.services.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
