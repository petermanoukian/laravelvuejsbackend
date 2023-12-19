<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update Service Subsection </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editservimg"  autocomplete="off" >
						
							<div>
							<span v-if= "servId == ''" > Empty </span>
							<span v-else> Not Empty   {{ servId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Service</label>
								<select name = 'servid' class="form-control" v-model="servimg.servid" required placeholder= 'Select One' >
									<option v-if ="servId === ''" value = '' disabled> Choose Service</option>
         							<option v-for="item, index in services.data" 
									 :selected="item.id === servId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} {{item.id}} {{ servId }}
									<b v-if ="item.id == servId"> EQUAL </b> 
									</option>
								</select> 			
							</div>

							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="servimg.name" placeholder="Name">
								
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
							<input type="submit" value="Update Service  " class="btn btn-outline-primary ml-auto">
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
		  
            services: {},
			loader: false,
            servimg:{                    
                    name: '',
					servid: null,
					logo: '',
					image: '' ,
				},
				showimg1: true,
				showimg2: false,
				imagex: {}
          }
		  
        },
		
		computed: {
		   servId() {
			  return this.servimg.servid;
		   },
		   imagepath()
		   {
			return "/images/gallerysub/thumb/"+this.servimg.logo;
		   },
		   imagepath2()
		   {
			return this.servimg.image;
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
                localStorage.setItem('servimg_id', id)
               
             }
             else
             {
                id = localStorage.getItem('servimg_id')   
             }
			 
			app.servimg.id = id;
			axios.get('/admin/servicesub/edit/' + id)
				.then(function (resp) {
					app.servimg = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			this.fetchServsDropDwon();
			

		},
        methods: 
		{

           editservimg() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newServimg = app.servimg;
                let uri = `/admin/servicesub/update/${app.servimg.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newServimg)
				.then(function (resp) 
				{
				    app.loader = false;
					let servid = app.servimg.servid; 
				 	let returnurl = `/admin/servicesub/${app.servimg.servid}`;
					console.log( ' 165 ' + returnurl);
					vr3.push(returnurl);
				})
				.catch(function (resp) {
					console.log(resp);
					app.loader = false;
					alert("Could not update " + resp + ' id ' + app.servimg.id + 'newdep' + newServimg + app.name );
					console.log("Could not update " + resp + ' id ' + app.servimg.id + 'newdep' + newServimg + app.name );
				});


            },
			
			fetchServsDropDwon() {
                axios.get('/admin/service/jsonservdrop').then((res) => 
				{
				    
                    this.services = res;
					console.log('102 servs are ' + res.data);
					console.log('103 servs are ' + res);
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
                    //vm.serv.logo = e.target.result;
					vm.servimg.image = e.target.result;
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