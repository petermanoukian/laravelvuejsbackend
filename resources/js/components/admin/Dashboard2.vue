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
							
								 {{ currentUser.membertype }}  {{ currentUser.id }} {{ currentUserID }}
							</span>	
						</div>
					</div>
					<div class="card-body">
				
							{{user.name }} {{user.email }}
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>	
								<td>Name</td>
								<td >Email</td>
								<td >Level</td>
								<td >Edit</td>
								
								
							</tr>
							</thead>
				
							<tbody>
								<tr >
									<td>{{ user.id }}</td>
									<td>{{ user.name }}</td>
								    <td>   <a :href="'mailto:' + user.email">  {{ user.email }} </a> </td>
									<td>{{ user.membertype }}</td>
									
									
									<td ><router-link :to="{ name: 'edituser', params: { id: user.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									
								</tr>
							</tbody>
						</table>
						<pagination :data="user" @pagination-change-page="fetchUser"></pagination>
						
						
						
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
				 user: {},
			
			}
		},
		computed: {

			currentUser()
			{
				return this.$store.getters.currentUser
			},
			currentUserID()
			{
				return this.$store.getters.currentUser.id
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

			this.fetchUser();
			
			

		},
		
        methods: 
		{
            fetchUser(page) {
			
			    var apper = this;
				var url  ='';
				let usid = this.$store.getters.currentUser.id;
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }

				url = '/admin/user/json/'+usid+'?page=' + page;
				console.log('line 113 ' + url);
	

                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
					console.log( ' linne 88 ' + res.data);
                    this.user = res.data;
                });
		
				
            }
          
		
        }
}
</script>
