<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update  Image </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editshopimg"  autocomplete="off" >
						
					
	
							<div class="form-group row">
								<label for="name"> Shop </label>
								<select name = 'shopid' class="form-control" v-model="shopimg.shopid" required placeholder= 'Select One' >
									<option v-if ="shopId === ''" value = '' disabled> Choose Shop</option>
         							<option v-for="item, index in shops.data" 
									 :selected="item.id === shopId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} 
									</option>
								</select> 			
							</div>

							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="shopimg.name" placeholder="Name">
								
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
							<input type="submit" value="Update Image  " class="btn btn-outline-primary ml-auto">
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
		  
            shops: {},
			loader: false,
            shopimg:{                    
                    name: '',
					shopid: null,
					logo: '',
					image: '' ,
				},
				showimg1: true,
				showimg2: false,
				imagex: {}
          }
		  
        },
		
		computed: {
		   shopId() {
			  return this.shopimg.shopid;
		   },
		   imagepath()
		   {
			return "/images/gallery/thumb/"+this.shopimg.logo;
		   },
		   imagepath2()
		   {
			return this.shopimg.image;
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
            if(id >0)
            {
                localStorage.setItem('shopimg_id', id)
               
             }
             else
             {
                id = localStorage.getItem('shopimg_id')   
             }
			 
			app.shopimg.id = id;
			axios.get('/admin/shopimg/edit/' + id)
				.then(function (resp) {
					app.shopimg = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			this.fetchShopsDropDwon();
			

		},
        methods: 
		{

           editshopimg() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newShopimg = app.shopimg;
                let uri = `/admin/shoperimg/update/${app.shopimg.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newShopimg)
				.then(function (resp) 
				{
				    app.loader = false;
					let shopid = app.shopimg.shopid; 
				 	let returnurl = `/admin/shopimg/${app.shopimg.shopid}`;
					console.log( ' 165 ' + returnurl);
					vr3.push(returnurl);
				})
				.catch(function (resp) {
					console.log(resp);
					app.loader = false;
					alert("Could not update " + resp + ' id ' + app.shopimg.id + 'newdep' + newShopimg + app.name );
					console.log("Could not update " + resp + ' id ' + app.shopimg.id + 'newdep' + newShopimg + app.name );
				});


            },
			
			fetchShopsDropDwon() {
                axios.get('/admin/shopper/jsonshopdrop').then((res) => 
				{
				    
                    this.shops = res;
					console.log('102 shops are ' + res.data);
					console.log('103 shops are ' + res);
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
                    
					vm.shopimg.image = e.target.result;
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