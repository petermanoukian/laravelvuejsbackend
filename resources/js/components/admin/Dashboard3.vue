<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Admins</h3>
					</div>
					
					<div>
					 	
						<div class = 'marginleft5 margintop8-4-5'>
							<span class = 'marginleft'>
								<router-link to="/admin/register" class="btn btn-primary margintop8-4-5"> 
								Add Admins </router-link>
							</span>	
						</div>
					</div>
					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>	
								<td>Name</td>
								<td >Email</td>
								<td >Level</td>
								<td >Edit</td>
								<td >Delete</td>
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in users.data" :key="users.data.id">
									<td>{{ item.id }}</td>
									<td>{{ item.name }}</td>
								    <td>   <a href="mailto:item.email" target="_blank">  {{ item.email }} </a> </td>
									<td>{{ item.membertype }}</td>
									
									
									<td ><router-link :to="{ name: 'edituser', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
								</tr>
							</tbody>
						</table>
						<pagination :data="users" @pagination-change-page="fetchUsers"></pagination>
						
						
						
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
				 users: {},
			
			}
		},
		computed: {

			currentUser()
			{
				return this.$store.getters.currentUser
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

			this.fetchUsers();
			
			

		},
		
        methods: 
		{
            fetchUsers(page) {
			
			    var apper = this;
				var url  ='';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }

				url = '/admin/users/json?page=' + page;
				console.log('line 113 ' + url);
	

                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
					console.log( ' linne 88 ' + res.data);
                    this.users = res.data;
                });
		
				
            }
            ,
			
			

			
			
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/users/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.users.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
