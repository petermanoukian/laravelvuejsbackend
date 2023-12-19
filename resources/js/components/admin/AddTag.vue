<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add Tag</h3>
					</div>

					<div class = 'marginleft5 margintop8-4-5'>
						<span class = 'marginleft5'>
							<router-link :to="{ name: 'tag' }" class="btn btn-primary margintop8-4-5"> 
							   View Tags
							</router-link> 
						</span>	
					</div>

					<div class="card-body">
						<form @submit.prevent="addtag">

							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="formAddTag.name" placeholder="Name">
							</div>
						  <div class="form-group row">
							<input type="submit" value="Add" class="btn btn-outline-primary ml-auto">
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
            
            formAddTag:{}
          }
        },
		
		created: function()
        {
			const vr1 = this.$router;

		},
		 mounted: function()
        {
			const vr2 = this.$router;

		},
        methods: 
		{
          addtag()
		  {
             let uri = '/admin/tag/post';
			 const vr3 = this.$router;
             axios.post('/admin/tag/post', this.formAddTag).then(function (resp) {
                        // this.$router.push({path: '/admin/login'});
						 vr3.push('/admin/tag')
                            //alert("created department" + resp);
                        })
                        .catch(function (resp) {
                            console.log(resp);
                            alert("Could not create your department" + resp);
                        });

			
          }
      }
}
</script>
