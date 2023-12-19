<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add Shop </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="addshop">		
				
						
							<div class="form-group row">
								<label for="name">Category</label>
								<select name = 'catid' class="form-control" v-model="formAddShop.catid" required placeholder= 'Select One' 
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
								<select name = 'subid' class="form-control" v-model="formAddShop.subid"  placeholder= 'Select One' >
									<option v-if ="subcategoryId === ''" value = '' disabled> Choose SubCategory </option>
         							<option v-for="item, index in subs.data" 
									 :selected="item.id === subcategoryId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} {{item.id}} {{ subcategoryId }}
									<b v-if ="item.id == subcategoryId"> EQUAL </b> 
									</option>
								</select> 			
							</div>

					
							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="formAddShop.name" placeholder="Name">
							</div>
							
							
							<div class="form-group row">
								<label for="name">Price</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="formAddShop.prix" placeholder="Price">
							</div>
							
							
						   <div class="form-group row">
								<ckeditor :editor="editor" v-model="formAddShop.description" :config="editorConfig" ></ckeditor>		
							</div>	
							

							
							
							<div class="form-group row">
								   <div class="col-md-3" v-if="formAddShop.logo">
									  <img :src="formAddShop.logo" class="img-responsive" height="70" width="90">
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
							<input type="submit" value="Add Shop  " class="btn btn-outline-primary ml-auto">
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
                
				

            },
			
			
            formAddShop:{                    
                    name: '',
					catid: null,
					subid: null,
					description: '',
					logo: '' ,
					userid: ''
				}
          }
        },
		
		computed: {
		   categoryId() {
			  return this.formAddShop.catid;
		   },
		   subcategoryId() {
			  return this.formAddShop.subid;
		   },
		   currentUser(){
			return this.$store.getters.currentUser;
			},
			
			
			
		}
		,
		watch: {
			categoryId1: function (val) {
			  this.formAddShop.catid= val
			}
		}
		,
		created: function()
        {
			const vr1 = this.$router;
		},
		 mounted: function()
        {
			
			const vr2 = this.$router;
			let app = this;
			
			app.formAddShop.userid = this.$store.getters.currentUser.id;
			
			let idcat = '';
			let idsub = '';
			if(app.$route.params.catid)
			{
            	idcat = app.$route.params.catid;
			}
            if(idcat >0)
            {
                localStorage.setItem('cat_id', idcat);
				this.formAddShop.catid = idcat;
            }
            else
            {
                localStorage.setItem('cat_id', '') ;
				this.formAddShop.catid = '';
            }
			 
			if(app.$route.params.subid)
			{
            	idsub = app.$route.params.subid;
			}
            if(idcat >0)
            {
                localStorage.setItem('sub_id', idsub);
				this.formAddShop.subid = idsub;
            }
            else
            {
                localStorage.setItem('sub_id', '') ;
				this.formAddShop.subid = '';
            }
			 
			let catid3 = this.formAddShop.catid;
			 
			console.log( '190 catid is ' + idcat);
			this.fetchShopCatsDropDown();
			this.fetchShopSubCatsDropDown();
			console.log( '193 catid is ' +   this.formAddShop.catid +  'subcatid is ' +   this.formAddShop.subid );
		},
        methods: 
		{
          
		    fetchShopCatsDropDown() {
                axios.get('/admin/shopcater/jsoncatdrop').then((res) => 
				{  
                    this.cats = res;
					//console.log('180 cats are ' + res.data);
					//console.log('181 cats are ' + res);
                });
		
            },
			
			fetchShopSubCatsDropDown() {
				
				let vm1 = this;
				let catid2 = vm1.categoryId;
				console.log('218 catid PARAMETER  ' +catid2 );
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
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.formAddShop.logo = e.target.result;

                };
                reader.readAsDataURL(file);
            },
			

			
		  
		   addshop()
		   {
		     this.loader = true; 
			 let vm = this;
			 console.log( 'loader 187 ' + this.loader);
             let uri = '/admin/shop/post';
			 const vr3 = this.$router;
			 console.log('logo ' +  this.formAddShop.logo);
			 
			
             axios.post('/admin/shop/post',  this.formAddShop).then(function (resp) {
                        // this.$router.push({path: '/admin/login'});
						 vm.loader = false;
						 console.log("add " + resp  + app.name  + app.userid  );
						 vr3.push('/admin/shop');
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
