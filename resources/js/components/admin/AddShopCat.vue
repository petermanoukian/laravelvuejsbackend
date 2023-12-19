<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add Shop category</h3>
				</div>
				

					
					
				<div class = 'marginleft5 margintop8-4-5'>
					<span class = 'marginleft5'>
						<router-link :to="{ name: 'shopcat' }" class="btn btn-primary margintop8-4-5"> 
						   View Categories
						</router-link> 
					</span>	
				</div>
				

					
				<div class="card-body">
					<form @submit.prevent="addshopcat">
					
					
			
	
						<div class="form-group row">
							<label for="name">Category</label>
							<select name = 'catid' class="form-control" v-model="formAddShopCat.catid" placeholder= 'Select One' >
								<option v-if ="categoryId === ''" value = '' disabled> Choose Category </option>
								<option v-for="item, index in cats.data" 
								 :selected="item.id === categoryId ? 'selected' : ''"
								:value="item.id">
								{{item.name}} {{item.id}} {{ categoryId }}
								
								</option>
							</select> 			
						</div>
					
					
					

						<div class="form-group row">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" required v-validate="'required'" 
							v-model="formAddShopCat.name" placeholder="Name">
							
						</div>
					  <div class="form-group row">
						<input type="submit" value="Add Shop Category " class="btn btn-outline-primary ml-auto">
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
            cats: {},
            formAddShopCat:
			{
				name: '',
				catid: null
			
			}
          }
        },
		computed: {
		   categoryId() {
			  return this.formAddShopCat.catid;
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
			let idcat = '';
			if(app.$route.params.catid)
			{
            	idcat = app.$route.params.catid;
			}
            if(idcat >0)
            {
                localStorage.setItem('cat_id', idcat);
				this.formAddShopCat.catid = idcat;
            }
            else
            {
                localStorage.setItem('cat_id', '') ;
				this.formAddShopCat.catid = '';
            }
			 
			 console.log( '78 catid is ' + idcat);
			 this.fetchShopCatsDropDwon();
			 
			 console.log( '81 catid is ' +   this.formAddShop.catid );


		},
        methods: 
		{
          
		  fetchShopCatsDropDwon() {
                axios.get('/admin/shopcater/jsoncatdrop').then((res) => 
				{  
                    this.cats = res;
					console.log('102 cats are ' + res.data);
					console.log('103 cats are ' + res);
                });
		
          },
		  
		  
		  
		  addshopcat()
		  {
            let uri = '/admin/shopcat/post';
			const vr3 = this.$router;
            axios.post('/admin/shopcat/post', this.formAddShopCat).then(function (resp) 
			{
                       
				vr3.push('/admin/shopcat')
			})
			.catch(function (resp) {
				console.log(resp);
				alert("Could not create " + resp);
			});

			
          }
      }
}
</script>
