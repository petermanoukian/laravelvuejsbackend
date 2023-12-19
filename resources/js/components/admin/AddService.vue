<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add Banner </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="addservice">		
				


						
					
							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="formAddService.name" placeholder="Name">
							</div>
							
							
						   <div class="form-group row">
								<label for="name">Details I</label>
								<textarea name="des" class="form-control" v-model="formAddService.des" 
								placeholder="Details I"></textarea>
							</div>	
							
							
						   <div class="form-group row">
								<label for="name">Details II</label>
								<textarea name="des1" class="form-control" v-model="formAddService.des1" 
								placeholder="Details II"></textarea>
							</div>	
							
							<div class="form-group row">
								<label for="name">Details III</label>
								<textarea name="des2" class="form-control" v-model="formAddService.des2" 
								placeholder="Details III"></textarea>
							</div>		
							
							
							<div class="form-group row">
								  <div class="col-md-3" v-if="formAddService.icon">
								  ICON 
									  <img :src="formAddService.icon" class="img-responsive" height="70" width="90">
								   </div>
								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' name = 'filer'>
								  </div>
							</div>
							
							
							<div class="form-group row">
								  <div class="col-md-3" v-if="formAddService.img">
								  Image
									  <img :src="formAddService.img" class="img-responsive" height="70" width="90">
								   </div>
								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange2" class="form-control" id = 'filer2' name = 'filer2'>
								  </div>
							</div>	
							
							
							<div class="form-group row">
								  <div class="loader" v-if="loader"> .... Please Wait ...</div>
							</div>
								
							<div class="form-group row">
								<input type="submit" value="Add Service  " class="btn btn-outline-primary ml-auto">
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
		  

			loader: false,
            formAddService:{                    
                    name: '',
					des: '',
					des1: '',
					des2: '',
					icon: '',
					img: '',
				}
          }
        },
		
		computed: {
	
		},
		
		
		created: function()
        {
			const vr1 = this.$router;
		},
		 mounted: function()
        {
			
			const vr2 = this.$router;
			let app = this;


		},
        methods: 
		{
          

			
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
                    vm.formAddService.icon = e.target.result;

                };
                reader.readAsDataURL(file);
            },
			
  			onImageChange2(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage2(files[0]);
            },
            createImage2(file) {
                let reader2 = new FileReader();
                let vm = this;
                reader2.onload = (e) => {
                    vm.formAddService.img = e.target.result;

                };
                reader2.readAsDataURL(file);
            },
			
		  
		   addservice()
		   {
		     this.loader = true; 
			 let vm = this;
			
             let uri = '/admin/service/post';
			 const vr3 = this.$router;
			 console.log('logo ' +  this.formAddService.logo);
			 console.log('img ' +  this.formAddService.img);
			
             axios.post('/admin/service/post',  this.formAddService).then(function (resp) {
                        // this.$router.push({path: '/admin/login'});
						 vm.loader = false;
						 vr3.push('/admin/service');
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
