<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add Gallery </h3>
					</div>
					
					<div>
						<span class = 'marginleft5'>
								<router-link to="/admin/portfolio" class="btn btn-primary margintop8-4-5"> View Gallery </router-link>
						</span>
					</div>
					<div class="card-body">
						<form @submit.prevent="addportfolio">		
				
							<div>
							<span v-if= "categoryId == ''" > Empty </span>
							<span v-else> Not Empty   {{ categoryId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Category</label>
								<select name = 'catid' class="form-control" v-model="formAddPort.catid" required placeholder= 'Select One' >
									<option v-if ="categoryId == '' || categoryId == null" value = ''  disabled selected
									:selected="categoryId == '' || categoryId == null ? 'selected' : ''"> Choose Category </option>
         							<option v-for="item, index in cats.data" 
									 :selected="item.id === categoryId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} {{item.id}} {{ categoryId }}
									<b v-if ="item.id == categoryId"> EQUAL </b> 
									</option>
								</select> 			
							</div>
							
							
							<div class="form-group row">
								<label for="name">City</label>
								<select name = 'cityid' class="form-control" v-model="formAddPort.cityid" required placeholder= 'Select One' >
									<option v-if ="citId == '' || citId == null " value = '' disabled selected
										:selected="citId == '' || citId == null ? 'selected' : ''"> Choose City </option>
         							<option v-for="item2, index2 in cities.data" 
									 :selected="item2.id === citId ? 'selected' : ''"
									:value="item2.id">
									{{item2.name}} {{item2.id}} {{ citId }}
							
									</option>
								</select> 			
							</div>
							
							
							<div class="form-group row">
								<label for="name">Tags</label>
								<select name = 'tag[]' class="form-control" v-model="formAddPort.tag"  placeholder= 'Select One' 
								multiple size = 12>
									<option v-if ="taggId == '' || taggId == null " value = '' disabled selected
										:selected="taggId == '' || taggId == null ? 'selected' : ''"> Add Tags </option>
         							<option v-for="item3, index3 in tags.data" 
									 :selected="item3.id === taggId ? 'selected' : ''"
									:value="item3.id">
									{{item3.name}} {{item3.id}} {{ taggId }}
									 
									</option>
								</select> 			
							</div>
							
							
							
						
					
							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="formAddPort.name" placeholder="Name">
							</div>
							
							
						   <div class="form-group row">
								<ckeditor :editor="editor" v-model="formAddPort.description" :config="editorConfig" ></ckeditor>	
							</div>	
							
							
							<div class="form-group row">
								<label for="name">Youtube/Vimeo Link</label>
							
								
								<textarea name="url" class="form-control" v-model="formAddPort.url" 
								placeholder="http://www.youtube.com"></textarea>
								
								
							</div>
							

							
							
							<div class="form-group row">
								   <div class="col-md-3" v-if="formAddPort.logo">
									  <img :src="formAddPort.logo" class="img-responsive" height="120" width="120">
								   </div>
								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' name = 'filer'>
								  </div>
				
							</div>
							
						  <div class="form-group row">
						      <div class="loader" v-if="loader"> .... Please Wait ...</div>
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
			cities: {},
			tags: {},
			loader: false,
			editor: ClassicEditor,
			editorConfig: {
                
				height: 500,

            },
			
			
			
            formAddPort:{                    
                    name: '',
					catid: null,
					cityid: null,
					tag: [],
					description: '',
					url: '',
					logo: '' ,
					
					
				}
          }
        },
		
		computed: {
		   categoryId() {
			  return this.formAddPort.catid;
		   },
		   	citId() {
			  return this.formAddPort.cityid;
		   },
		   	taggId() {
			  return this.formAddPort.tag;
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
			let idcat = '';
			
			if(app.$route.params.bycitycat)
			{
			
				let bycitycat1 = app.$route.params.bycitycat;
				if(app.$route.params.catid)
				{
					idcat = app.$route.params.catid;
				}
				if(bycitycat1 == 'bycat')
				{
					if(idcat >0)
					{
						localStorage.setItem('cat_id', idcat);
						this.formAddPort.catid = idcat;
					}
					else
					{
						localStorage.setItem('cat_id', '') ;
						this.formAddPort.catid = '';
					}
				}
				
				else if(bycitycat1 == 'bycity')
				{
					if(idcat >0)
					{
						localStorage.setItem('city_id', idcat);
						this.formAddPort.cityid = idcat;
					}
					else
					{
						localStorage.setItem('city_id', '') ;
						this.formAddPort.cityid = '';
					}
				}
				
				else if(bycitycat1 == 'bytag')
				{
					if(idcat >0)
					{
						localStorage.setItem('tag_id', idcat);
						this.formAddPort.tag = idcat;
					}
					else
					{
						localStorage.setItem('tag_id', '') ;
						this.formAddPort.tag = '';
					}
				}

			 }
			 this.fetchPortCatsDropDwon();
			 this.fetchPortCitiesDropDwon();
			 this.fetchPortTagsDropDwon();
		},
        methods: 
		{
          
		   fetchPortCatsDropDwon() {
                axios.get('/admin/portcat/jsoncatdrop').then((res) => 
				{  
                    this.cats = res;
					//console.log('102 cats are ' + res.data);
					//console.log('103 cats are ' + res);
                });
		
            },
			
			fetchPortCitiesDropDwon() {
                axios.get('/admin/cities/jsoncitydrop').then((res) => 
				{  
                    this.cities = res;
					//console.log('102 cats are ' + res.data);
					//console.log('103 cats are ' + res);
                });
		
            },
			
			
						
			fetchPortTagsDropDwon() {
                axios.get('/admin/tags/jsontagdrop').then((res) => 
				{  
                    this.tags = res;
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
                    vm.formAddPort.logo = e.target.result;

                };
                reader.readAsDataURL(file);
            },
			
			/*
            uploadImage(){
                axios.post('/admin/logo/store',{logo: this.logo}).then(response => {
                   console.log(response);
                });
            },
			
			*/
			
		  
		   addportfolio()
		   {
		     this.loader = true; 
			 let vm = this;
             let uri = '/admin/port/post';
			 const vr3 = this.$router;
			 console.log('logo ' +  this.formAddPort.logo);
			 
			
             axios.post('/admin/port/post',  this.formAddPort).then(function (resp) {
                        // this.$router.push({path: '/admin/login'});
						 vm.loader = false;
						 vr3.push('/admin/portfolio');
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
