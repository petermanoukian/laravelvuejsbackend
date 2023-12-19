<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update Category</h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editportcat"  autocomplete="off" >

							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="cat.name" placeholder="Name">
								
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
                catId: null,
                cat: 
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
                localStorage.setItem('cat_id', id)
               
             }
             else
             {
                id = localStorage.getItem('cat_id')   
             }
			 
			app.catId = id;
			axios.get('/admin/portcat/edit/' + id)
				.then(function (resp) {
					app.cat = resp.data;
				})
				.catch(function () {
					alert("Could not load your records")
				});
			
			

		},
        methods: 
		{

           editportcat() 
		   {
               // event.preventDefault();
        
                var app = this;
                var newCat = app.cat;
                let uri = `/admin/portcat/update/${app.catId}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newCat)
				.then(function (resp) 
				{
				    vr3.push('/admin/portfoliocat')
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.catId + 'newdep' + newCat + app.name );
					console.log("Could not update " + resp + ' id ' + app.catId + 'newdep' + newCat + app.name );
				});


            }

      }
}
</script>
