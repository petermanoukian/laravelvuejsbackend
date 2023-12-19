<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update Blog </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editblog"  autocomplete="off" >
						
							<div>
							<span v-if= "categoryId == ''" > Empty </span>
							<span v-else> Not Empty   {{ categoryId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Category</label>
								<select name = 'catid' class="form-control" v-model="blog.catid" required placeholder= 'Select One' 
								@change='fetchBlogSubCatsDropDown()'>
									<option v-if ="categoryId === ''" value = '' disabled> Choose Category </option>
         							<option v-for="item, index in cats.data" 
									 :selected="item.id === categoryId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} {{item.id}} {{ categoryId }}
									<b v-if ="item.id == categoryId"> EQUAL </b> 
									</option>
								</select> 			
							</div>
							
							
							<div>
								<span v-if= "subcategoryId == ''" > Empty </span>
								<span v-else> Not Empty   {{ subcategoryId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">SubCategory</label>
								<select name = 'subid' class="form-control" v-model="blog.subid"  placeholder= 'Select One' >
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
								v-model="blog.name" placeholder="Name">
								
						
								
							</div>
							
							
							
							<div class="form-group row">
							
								
								<ckeditor :editor="editor" v-model="blog.description" :config="editorConfig" ></ckeditor>	
								
								
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
							<input type="submit" value="Update Blog  " class="btn btn-outline-primary ml-auto">
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
			
			
			
            blog:{                    
                    name: '',
					catid: '',
					subid: '',
					description: '',
					logo: '' ,
					image: '' ,
				},
				useridd: '',
				membertype: '',
				showimg1: true,
				showimg2: false,
				imagex: {}
          }
		  
        },
		
		computed: {
		   categoryId() {
			  return this.blog.catid;
		   },
		   subcategoryId() {
			  return this.blog.subid;
		   },
		   currentUser(){
			return this.$store.getters.currentUser;
		   },
		   
		   imagepath()
		   {
			return "/images/blog/thumb/"+this.blog.logo;
		   },
		   imagepath2()
		   {
			return this.blog.image;
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
			this.blog.useridd = this.$store.getters.currentUser.id;
			this.blog.membertype = this.$store.getters.currentUser.membertype;
			
			let app = this;
			

            let id = app.$route.params.id;
			let catid3 = app.blog.catid;
            if(id >0)
            {
                localStorage.setItem('blog_id', id)
               
            }
            else
            {
                id = localStorage.getItem('blog_id')   
            }
			 
			app.blog.id = id;
			
						let catid1 = app.$route.params.catid1;
			if(catid1 >0)
            {
                localStorage.setItem('cat_id1', catid1)
               
            }
            else
            {
                catid1 = localStorage.getItem('cat_id1')   
            }
			app.blog.catid = catid1;
			
			
			
			
			
			axios.get('/admin/blogupd/edit/' + id)
				.then(function (resp) {
					app.blog = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			this.fetchBlogCatsDropDown();
			this.fetchBlogSubCatsDropDown();
			

		},
        methods: 
		{

           editblog() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newBlog = app.blog;
				var useridd = this.$store.getters.currentUser.id;
				var membertype = this.$store.getters.currentUser.membertype;
                let uri = `/admin/blog/update/${app.blog.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, {blog: newBlog,name:newBlog.name,catid:newBlog.catid,subid: newBlog.subid,description: newBlog.description ,image: newBlog.image , useridd: useridd , membertype: membertype} )
				.then(function (resp) 
				{
				    app.loader = false;
					console.log("update " + resp + ' id ' + app.blog.id + 'newdep' + newBlog + '   -- ' + app.name  + ' 2 ' + app.useridd + ' 3 '  + app.membertype);
					vr3.push('/admin/blog');
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.blog.id + 'newdep' + newBlog + app.name );
					console.log("Could not update " + resp + ' id ' + app.blog.id + 'newdep' + newBlog + app.name );
				});


            },
			
			fetchBlogCatsDropDown() {
                axios.get('/admin/blogcater/jsoncatdrop').then((res) => 
				{
				    
                    this.cats = res;
					console.log('102 cats are ' + res.data);
					console.log('103 cats are ' + res);
                });
		
            },
			
			fetchBlogSubCatsDropDown(catid3) {
				
				let vm1 = this;
				let catid2 = vm1.blog.catid;
				console.log('238 catid PARAMETER  ' +catid2 );
                axios.get('/admin/blogsuber/jsonsubdrop/'+catid2).then((res) => 
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
                  
					vm.blog.image = e.target.result;
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