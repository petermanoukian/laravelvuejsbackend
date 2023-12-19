<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update Page </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editpage"  autocomplete="off" >
	
							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="page.name" placeholder="Name" readonly>
							</div>
							

							<div class="form-group row">
								<p><label for="name">Short Details </label> </p>
							</div>	
							<div class="form-group row">
								<ckeditor :editor="editor" v-model="page.description" :config="editorConfig" ></ckeditor>
							</div>



							<div class="form-group row">
								<p><label for="name">Long Details </label> </p>
							</div>	
							<div class="form-group row">
								<ckeditor :editor="editor2" v-model="page.description2" :config="editorConfig" ></ckeditor>
							</div>								

							
						    <div class="form-group row">
								   <div class="col-md-3" > IMAGE
									  <img :src=imagepath3 class="img-responsive" height="70" width="90" v-if="image3">
									  <img :src="imagex2" class="img-responsive" height="70" width="90" v-if="image4">
								   </div>
								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange2" class="form-control" id = 'filer2' name = 'filer2'> 
								  </div>
							</div>	
							
							
							<div class="form-group row">
							   <div class="loader" v-if="loader"> .... Please Wait ...</div>
							</div>
							
						   <div class="form-group row">
						   <input type="submit" value="Update " class="btn btn-outline-primary ml-auto">
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
		  
           
			loader: false,
			editor: ClassicEditor,
			editor2: ClassicEditor,
			editorConfig: {
			},
          
			
			
			
            page:{                    
                    name: '',
					description: '',

					img: '',
					
					image2: '' ,
				},

				
				showimg3: true,
				showimg4: false,
				imagex2: {}
          }
		  
        },
		
		computed: {


	
		   
		   
		   imagepath3()
		   {
			return "/images/about/thumb/"+this.page.img;
		   },
		   imagepath4()
		   {
			return this.page.image2;
		   },
		   image3()
		   {
			return this.showimg3;
		   },
		   image4()
		   {
			return this.showimg4;
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
                localStorage.setItem('pag_id', id)
               
             }
             else
             {
                id = localStorage.getItem('pag_id')   
             }
			 
			app.page.id = id;
			axios.get('/admin/about/edit/' + id)
				.then(function (resp) {
					app.page = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			
			

		},
        methods: 
		{

           editpage() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newServ = app.page;
                let uri = `/admin/about/update/${app.page.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newServ)
				.then(function (resp) 
				{
				    app.loader = false;
					vr3.push('/admin/about');
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.page.id + 'newdep' + newPort + app.name );
					console.log("Could not update " + resp + ' id ' + app.page.id + 'newdep' + newPort + app.name );
				});


            },
			

			
 
			
			
			
			onImageChange2(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage2(files[0]);
				this.showimg3 = false;
				this.showimg4 = true;
				
			
            },
            createImage2(file) {
                let reader2 = new FileReader();
                let vm = this;
                reader2.onload = (e) => {
                   
					vm.page.image2 = e.target.result;
					vm.imagex2 =  e.target.result;
                };
                reader2.readAsDataURL(file);
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

