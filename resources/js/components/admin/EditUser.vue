<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update User </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="edituser"  autocomplete="off" >
						


							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="user.name" placeholder="Name">
								
							</div>
							
							<div class="form-group row">
							<label for="email">Email</label>
							<input type="email" name="email" required v-validate="'required|email'" class="form-control" 
							v-model="user.email" placeholder="Email address">
						
							</div>
							
							<div class="form-group row">
								<label for="password">Password</label>
								<input type="password" name="password"  class="form-control" v-validate="'min:6'" 
								v-model="user.password" placeholder="password">
							
							</div>	
													
						  <div class="form-group row" v-if="currentUser.membertype=='admin'">
							<label for="password">level</label>
								<select v-model="user.membertype" name="membertype" class="form-control" 
								required v-validate="'required'"  placeholder='LEVEL'>
									 <option value='' disabled>Choose</option>
									<option value = "admin" >Admin</option>
									<option value = "user"> User</option>
								</select>
							</div>
							
							

	

							
							<div class="form-group row">
							   <div class="loader" v-if="loader"> .... Please Wait ...</div>
							</div>
							
						   <div class="form-group row">
							<input type="submit" value="Update User  " class="btn btn-outline-primary ml-auto">
						   </div>
						  
						  
						  
						  
						  
					</form>
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
        data()
        {

          return{
		  
         
			loader: false,
            user:{                    
                    name: '',
					email: '',
					password: '',
					membertype: 'user',

				},

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
            let id = app.$route.params.id;
			
			if(id >0)
            {
                localStorage.setItem('user_id', id)
               
             }
             else
             {
                id = localStorage.getItem('user_id')   
             }

			 
			app.user.id = id;
			axios.get('/admin/user/edit/' + id)
				.then(function (resp) {
					app.user = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			
			

		},
        methods: 
		{

           edituser() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newUser = app.user;
				
				
				
                let uri = `/admin/user/update/${app.user.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newUser)
				.then(function (resp) 
				{
				    app.loader = false;
					let level = app.$store.getters.currentUser.membertype;
					if(level == 'admin')
					vr3.push('/admin/dashboard3');
					else
					vr3.push('/admin/dashboard2');
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.user.id + 'newdep' + newUser + app.name );
					console.log("Could not update " + resp + ' id ' + app.user.id + 'newdep' + newUser + app.name );
				});


            },
			




      }
}
</script>

<style scoped>
    .loader {
        position: relative;
        left:10%;
        top:10%;
        transform: translate(-50%, -50%);
        border: 10px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 75px;
        height: 75px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style> 