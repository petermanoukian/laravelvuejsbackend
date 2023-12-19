<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add Service SubSection </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="addservsub">		
				
							<div>
							<span v-if= "servId == ''" > Empty </span>
							<span v-else> Not Empty   {{ servId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Service</label>
								<select name = 'servid' class="form-control" v-model="formAddSrvSub.servid" required 
								placeholder= 'Select One' >
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
								v-model="formAddSrvSub.name" placeholder="Name">
							</div>
							

							
							<div class="form-group row">
								   <div class="col-md-3" v-if="formAddSrvSub.logo">
									  <img :src="formAddSrvSub.logo" class="img-responsive" height="70" width="90">
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
							<input type="submit" value="Add  " class="btn btn-outline-primary ml-auto">
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
            formAddSrvSub:{                    
                    name: '',
					servid: null,
					logo: '' ,
				}
          }
        },
		
		computed: {
		   servId() {
			  return this.formAddSrvSub.servid;
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
			let idserv = '';
			if(app.$route.params.servid)
			{
            	idserv = app.$route.params.servid;
			}
            if(idserv >0)
            {
                localStorage.setItem('serv_id', idserv);
				this.formAddSrvSub.servid = idserv;
            }
            else
            {
                localStorage.setItem('serv_id', '') ;
				this.formAddSrvSub.servid = '';
            }
			 
			 console.log( '78 servid is ' + idserv);
			 this.fetchServsDropDwon();
			 
			 console.log( '81 servid is ' +   this.formAddSrvSub.servid );
		},
        methods: 
		{
          
		   fetchServsDropDwon() {
                axios.get('/admin/service/jsonservdrop').then((res) => 
				{  
                    this.services = res;
					console.log('102 services are ' + res.data);
					console.log('103 services are ' + res);
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
                    vm.formAddSrvSub.logo = e.target.result;

                };
                reader.readAsDataURL(file);
            },

			
		  
		   addservsub()
		   {
				 let uri = 'admin/servicesub/post';
				 this.loader = true; 
				 var fm = this;
				 const vr3 = this.$router;
				// console.log('logo ' +  this.formAddSrvSub.logo);
			 
             	axios.post('/admin/servicesub/post',  this.formAddSrvSub).then(function (resp) {
				// this.$router.push({path: '/admin/login'});
				
				 fm.loader = false;
				 let servid = fm.formAddSrvSub.servid; 
				 let returnurl = `/admin/servicesub/${fm.formAddSrvSub.servid}`;
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