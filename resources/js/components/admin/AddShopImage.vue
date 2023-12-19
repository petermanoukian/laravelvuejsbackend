<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add More Images to Shop </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="addshopimg">		
				
					
	
							<div class="form-group row">
								<label for="name">Shop</label>
								<select name = 'shopid' class="form-control" v-model="formAddShopimg.shopid" required 
								placeholder= 'Select One' >
									<option v-if ="shopId === ''" value = '' disabled> Choose Gallery </option>
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
								v-model="formAddShopimg.name" placeholder="Name">
							</div>
							

							
							<div class="form-group row">
								   <div class="col-md-3" v-if="formAddShopimg.logo">
									  <img :src="formAddShopimg.logo" class="img-responsive" height="70" width="90">
								   </div>
								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' 
									  name = 'filer'>
								  </div>
				
							</div>
							
						  <div class="form-group row">
						      <div class="loader" v-if="loader"> .... Please Wait ...</div>
						  </div>	
							
						  <div class="form-group row">
							<input type="submit" value="Add  Image " class="btn btn-outline-primary ml-auto">
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
            formAddShopimg:{                    
                    name: '',
					shopid: null,
					logo: '' ,
				}
          }
        },
		
		computed: {
		   shopId() {
			  return this.formAddShopimg.shopid;
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
			let idshop = '';
			if(app.$route.params.shopid)
			{
            	idshop = app.$route.params.shopid;
			}
            if(idshop >0)
            {
                localStorage.setItem('shop_id', idshop);
				this.formAddShopimg.shopid = idshop;
            }
            else
            {
                localStorage.setItem('shop_id', '') ;
				this.formAddShopimg.shopid = '';
            }
			 
			 console.log( '78 shopid is ' + idshop);
			 this.fetchShopsDropDwon();
			 
			 console.log( '81 shopid is ' +   this.formAddShopimg.shopid );
		},
        methods: 
		{
          
		   fetchShopsDropDwon() {
                axios.get('/admin/shopper/jsonshopdrop/').then((res) => 
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
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.formAddShopimg.logo = e.target.result;

                };
                reader.readAsDataURL(file);
            },

			
		  
		   addshopimg()
		   {
             let uri = 'admin/shoperimg/post';
			 this.loader = true; 
			 var fm = this;
			 const vr3 = this.$router;
			// console.log('logo ' +  this.formAddShopimg.logo);
			 
             axios.post('/admin/shoperimg/post',  this.formAddShopimg).then(function (resp) {
				// this.$router.push({path: '/admin/login'});
				
				 fm.loader = false;
				 let shopid = fm.formAddShopimg.shopid; 
				 let returnurl = `/admin/shopimg/${fm.formAddShopimg.shopid}`;
				 console.log( ' 165 ' + returnurl);
				
				
				 vr3.push(returnurl);
					//alert("created department" + resp);
				})
				.catch(function (resp) {
				    fm.loader = false;
					console.log(resp);
					alert("Could not create your department" + resp);
				});
          }
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