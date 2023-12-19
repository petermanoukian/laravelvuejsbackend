<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add Blog category</h3>
				</div>
				

					
					
				<div class = 'marginleft5 margintop8-4-5'>
					<span class = 'marginleft5'>
						<router-link :to="{ name: 'blogcat' }" class="btn btn-primary margintop8-4-5"> 
						   View Categories
						</router-link> 
					</span>	
				</div>
				

					
				<div class="card-body">
					<form @submit.prevent="addblogcat">
					
					
						<div>
							<span v-if= "categoryId == ''" > Empty </span>
							<span v-else> Not Empty   {{ categoryId }} </span>
						</div>
	
						<div class="form-group row">
							<label for="name">Category</label>
							<select name = 'catid' class="form-control" v-model="formAddBlogCat.catid" placeholder= 'Select One' >
								<option v-if ="categoryId === ''" value = '' disabled> Choose Category </option>
								<option v-for="item, index in cats.data" 
								 :selected="item.id === categoryId ? 'selected' : ''"
								:value="item.id">
								{{item.name}} {{item.id}} {{ categoryId }}
								<b v-if ="item.id == categoryId"> EQUAL </b> 
								</option>
							</select> 			
						</div>
					
					
					

						<div class="form-group row">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" required v-validate="'required'" 
							v-model="formAddBlogCat.name" placeholder="Name">
							
						</div>
					  <div class="form-group row">
						<input type="submit" value="Add Blog Category " class="btn btn-outline-primary ml-auto">
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
            formAddBlogCat:
			{
				name: '',
				catid: null
			
			}
          }
        },
		computed: {
		   categoryId() {
			  return this.formAddBlogCat.catid;
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
				this.formAddBlogCat.catid = idcat;
            }
            else
            {
                localStorage.setItem('cat_id', '') ;
				this.formAddBlogCat.catid = '';
            }
			 
			 console.log( '78 catid is ' + idcat);
			 this.fetchBlogCatsDropDwon();
			 
			 console.log( '81 catid is ' +   this.formAddBlog.catid );


		},
        methods: 
		{
          
		  fetchBlogCatsDropDwon() {
                axios.get('/admin/blogcater/jsoncatdrop').then((res) => 
				{  
                    this.cats = res;
					console.log('102 cats are ' + res.data);
					console.log('103 cats are ' + res);
                });
		
          },
		  
		  
		  
		  addblogcat()
		  {
            let uri = '/admin/blogcat/post';
			const vr3 = this.$router;
            axios.post('/admin/blogcat/post', this.formAddBlogCat).then(function (resp) 
			{
                       
				vr3.push('/admin/blogcat')
			})
			.catch(function (resp) {
				console.log(resp);
				alert("Could not create " + resp);
			});

			
          }
      }
}
</script>
