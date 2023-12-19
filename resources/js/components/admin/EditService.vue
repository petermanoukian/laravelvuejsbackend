<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update Banner </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editservice"  autocomplete="off" >
						


							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="service.name" placeholder="Name">
								
							</div>
							
							
							
							<div class="form-group row">
								<label for="name">Details I</label>
								<textarea name="des" class="form-control" v-model="service.des" placeholder="Details I"></textarea>
							</div>	
							
							<div class="form-group row">
								<label for="name">Details II</label>
								<textarea name="des1" class="form-control" v-model="service.des1" placeholder="Details II"></textarea>
							</div>	
							
							<div class="form-group row">
								<label for="name">Details III</label>
								<textarea name="des2" class="form-control" v-model="service.des2" placeholder="Details III"></textarea>
							</div>	

							
							<div class="form-group row">
								   <div class="col-md-3" > ICON
									  <img :src=imagepath class="img-responsive" height="70" width="90" v-if="image1">
									  <img :src="imagex" class="img-responsive" height="70" width="90" v-if="image2">
								   </div>
								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' name = 'filer'> 
								  </div>
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
			loader: false,
            service:{                    
                    name: '',
					des: '',
					des1: '',
					des2: '',
					icon: '',
					img: '',
					customer: '',
					image: '' ,
					image2: '' ,
				},
				showimg1: true,
				showimg2: false,
				imagex: {},
				
				showimg3: true,
				showimg4: false,
				imagex2: {}
          }
		  
        },
		
		computed: {

		   imagepath()
		   {
			return "/images/service/icon/"+this.service.icon;
		   },
		   imagepath2()
		   {
			return this.service.image;
		   },
		   image1()
		   {
			return this.showimg1;
		   },
		   image2()
		   {
			return this.showimg2;
		   },
		   
		   
		   
		   imagepath3()
		   {
			return "/images/service/thumb/"+this.service.img;
		   },
		   imagepath4()
		   {
			return this.service.image2;
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
                localStorage.setItem('serv_id', id)
               
             }
             else
             {
                id = localStorage.getItem('serv_id')   
             }
			 
			app.service.id = id;
			axios.get('/admin/service/edit/' + id)
				.then(function (resp) {
					app.service = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			
			

		},
        methods: 
		{

           editservice() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newServ = app.service;
                let uri = `/admin/service/update/${app.service.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newServ)
				.then(function (resp) 
				{
				    app.loader = false;
					vr3.push('/admin/service');
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not update " + resp + ' id ' + app.service.id + 'newdep' + newPort + app.name );
					console.log("Could not update " + resp + ' id ' + app.service.id + 'newdep' + newPort + app.name );
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
                   
					vm.service.image = e.target.result;
					vm.imagex =  e.target.result;
                };
                reader.readAsDataURL(file);
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
                   
					vm.service.image2 = e.target.result;
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