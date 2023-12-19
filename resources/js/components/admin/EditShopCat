<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update Blog Category</h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editblogcat"  autocomplete="off" >
						
						
							<div>
								<span v-if= "categoryId == ''" > Empty </span>
								<span v-else> Not Empty   {{ categoryId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Category</label>
								<select name = 'catid' class="form-control" v-model="cat.catid"  placeholder= 'Select One' >
									<option value = '' 
											:selected="categoryId =='' ? 'selected' : ''"> TOP  Category </option>
         							<option   v-for="item, index in cats.data" 
									v-if ="item.id != ID"
									 :selected="item.id === categoryId ? 'selected' : ''"
									:value="item.id" >
									{{item.name}} A {{item.id}} B {{ categoryId }} C {{ ID }}
									<b v-if ="item.id == ID"> EQUAL should not be here </b> 
									<b v-if ="item.id == categoryId"> EQUAL </b> 
									</option>
								</select> 			
							</div>

							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="cat.name" placeholder="Name">
								
							</div>
						   <div class="form-group row">
							 <input type="submit" value="Update Blog Category " class="btn btn-outline-primary ml-auto">
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
				cats: {},
                catId: null,
                cat: 
				{
                    catid: null,
					name: '',
                }
            }
        },
		
		
		computed: {
		   categoryId() {
			  return this.cat.catid;
		   },
		   ID() {
			  return this.catId;
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
            let id = app.$route.params.id;
			//alert(id);
            if(id >0)
            {
                localStorage.setItem('cat_id', id)
               
            }
            else
            {
                id = localStorage.getItem('cat_id')   
            }
			 
			app.catId = id;
			axios.get('/admin/blogcatupd/edit/' + id)
			.then(function (resp) {
				app.cat = resp.data;
			})
			.catch(function () {
				alert("Could not load your records")
			});
			
			this.fetchBlogCatsDropDwon();
			
			

		},
        methods: 
		{

            editblogcat() 
		    {
               // event.preventDefault();
        
                var app = this;
                var newCat = app.cat;
                let uri = `/admin/blogcat/update/${app.catId}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newCat)
				.then(function (resp) 
				{
				    vr3.push('/admin/blogcat')
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.catId + 'newdep' + newCat + app.name );
					console.log("Could not update " + resp + ' id ' + app.catId + 'newdep' + newCat + app.name );
				});


            },
			
			fetchBlogCatsDropDwon() {
                axios.get('/admin/blogcater/jsoncatdrop').then((res) => 
				{
				    
                    this.cats = res;
					console.log('102 cats are ' + res.data);
					console.log('103 cats are ' + res);
                });
		
            },
			
			

      }
}
</script>
