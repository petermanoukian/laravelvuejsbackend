<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update Shop </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editshop"  autocomplete="off" >

							<div class="form-group row">
								<label for="name">Category</label>
								<select name = 'catid' class="form-control" v-model="shop.catid" required placeholder= 'Select One' 
								@change='fetchShopSubCatsDropDown()'>
									<option v-if ="categoryId === ''" value = '' disabled> Choose Category </option>
         							<option v-for="item, index in cats.data" 
									 :selected="item.id === categoryId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} 
									</option>
								</select> 			
							</div>

	
							<div class="form-group row">
								<label for="name">SubCategory</label>
								<select name = 'subid' class="form-control" v-model="shop.subid"  placeholder= 'Select One' >
									<option v-if ="subcategoryId === ''" value = '' disabled> Choose SubCategory </option>
         							<option v-for="item, index in subs.data" 
									 :selected="item.id === subcategoryId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} 
									
									</option>
								</select> 			
							</div>

							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="shop.name" placeholder="Name">	
							</div>
							
							<div class="form-group row">
								<label for="name">Price</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="shop.prix" placeholder="Price">	
							</div>
							
							
							
							<div class="form-group row">
							
								
								<ckeditor :editor="editor" v-model="shop.description" :config="editorConfig" ></ckeditor>	
								
								
							</div>	
							

							
							
							<div class="form-group row">
								   <div class="col-md-3" >
									  <img :src=imagepath class="img-responsive" height="70" width="90" v-if="image1">
									  <img :src="imagex" class="img-responsive" height="70" width="90" v-if="image2">
								   </div>

								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' name = 'filer'>
									 
								  </div>
				
							</div>
							
							<div class="form-group row">
							   <div class="loader" v-if="loader"> .... Please Wait ...</div>
							</div>
							
						   <div class="form-group row">
						    {{ currentUser.membertype }}  {{ currentUser.id }} 
							<input type="submit" value="Update Shop  " class="btn btn-outline-primary ml-auto">
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


import Vue from 'vue';
import Router from 'vue-router';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

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
			subs: {},
			loader: false,
			editor: ClassicEditor,
			editorConfig: {
                
				height: 500,

            },
			
			
			
            shop:{                    
                    name: '',
					catid: '',
					subid: '',
					prix: '',
					description: '',
					logo: '' ,
					image: '' ,
				},
			
				showimg1: true,
				showimg2: false,
				imagex: {}
          }
		  
        },
		
		computed: {
		   categoryId() {
			  return this.shop.catid;
		   },
		   subcategoryId() {
			  return this.shop.subid;
		   },
		   currentUser(){
			return this.$store.getters.currentUser;
		   },
		   
		   imagepath()
		   {
			return "/images/shop/thumb/"+this.shop.logo;
		   },
		   imagepath2()
		   {
			return this.shop.image;
		   },
		   image1()
		   {
			return this.showimg1;
		   },
		   image2()
		   {
			return this.showimg2;
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
			let catid3 = app.shop.catid;
            if(id >0)
            {
                localStorage.setItem('shop_id', id)
               
            }
            else
            {
                id = localStorage.getItem('shop_id')   
            }
			 
			app.shop.id = id;
			
			let catid1 = app.$route.params.catid1;
			if(catid1 >0)
            {
                localStorage.setItem('cat_id1', catid1)
               
            }
            else
            {
                catid1 = localStorage.getItem('cat_id1')   
            }
			app.shop.catid = catid1;
			
			
			
			
			
			axios.get('/admin/shopupd/edit/' + id)
				.then(function (resp) {
					app.shop = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			this.fetchShopCatsDropDown();
			this.fetchShopSubCatsDropDown();
			

		},
        methods: 
		{

           editshop() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newShop = app.shop;
			
                let uri = `/admin/shop/update/${app.shop.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, {shop: newShop,name:newShop.name,catid:newShop.catid,subid: newShop.subid,prix:newShop.prix,description: newShop.description ,image: newShop.image  } )
				.then(function (resp) 
				{
				    app.loader = false;
					console.log("update " + resp + ' id ' + app.shop.id + 'newdep' + newShop + '   -- ' + app.name  + ' 2 ' );
					vr3.push('/admin/shop');
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.shop.id + 'newdep' + newShop + app.name );
					console.log("Could not update " + resp + ' id ' + app.shop.id + 'newdep' + newShop + app.name );
				});


            },
			
			fetchShopCatsDropDown() {
                axios.get('/admin/shopcater/jsoncatdrop').then((res) => 
				{
				    
                    this.cats = res;
					console.log('102 cats are ' + res.data);
					console.log('103 cats are ' + res);
                });
		
            },
			
			fetchShopSubCatsDropDown(catid3) {
				
				let vm1 = this;
				let catid2 = vm1.shop.catid;
				console.log('238 catid PARAMETER  ' +catid2 );
                axios.get('/admin/shopsuber/jsonsubdrop/'+catid2).then((res) => 
				{  
                    this.subs = res;
					console.log('215 subcats are ' + res.data);
					console.log('216 subcats are ' + res);
                });
		
            },
			
  			onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
				this.showimg1 = false;
				this.showimg2 = true;
				
			
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                  
					vm.shop.image = e.target.result;
					vm.imagex =  e.target.result;
                };
                reader.readAsDataURL(file);
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