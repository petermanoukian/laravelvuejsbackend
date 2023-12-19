<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update City</h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editcity"  autocomplete="off" >

							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="city.name" placeholder="Name">
								
							</div>
						  <div class="form-group row">
							<input type="submit" value="Update" class="btn btn-outline-primary ml-auto">
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
        data: function () {
            return {
                cityId: null,
                city: 
				{
                    name: '',
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
            let id = app.$route.params.id;
            if(id >0)
            {
                localStorage.setItem('city_id', id)
               
             }
             else
             {
                id = localStorage.getItem('city_id')   
             }
			 
			app.cityId = id;
			axios.get('/admin/city/edit/' + id)
				.then(function (resp) {
					app.city = resp.data;
				})
				.catch(function () {
					alert("Could not load your records")
				});
			
			

		},
        methods: 
		{

           editcity() 
		   {
               // event.preventDefault();
        
                var app = this;
                var newCity= app.city;
                let uri = `/admin/city/update/${app.cityId}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newCity)
				.then(function (resp) 
				{
				    vr3.push('/admin/city')
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.cityId + 'newdep' + newCity + app.name );
					console.log("Could not update " + resp + ' id ' + app.cityId + 'newdep' + newCity + app.name );
				});


            }

      }
}
</script>
