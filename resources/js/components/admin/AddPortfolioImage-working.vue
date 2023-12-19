<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add portfolio image </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="addportfolioimg">		
				
							<div>
							<span v-if= "portId == ''" > Empty </span>
							<span v-else> Not Empty   {{ portId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Portfolio</label>
								<select name = 'portid' class="form-control" v-model="formAddPortimg.portid" required 
								placeholder= 'Select One' >
									<option v-if ="portId === ''" value = '' disabled> Choose Portfolio</option>
         							<option v-for="item, index in ports.data" 
									 :selected="item.id === portId ? 'selected' : ''"
									:value="item.id">
									{{item.name}} {{item.id}} {{ portId }}
									<b v-if ="item.id == portId"> EQUAL </b> 
									</option>
								</select> 			
							</div>
						
					
							<div class="form-group row">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required v-validate="'required'" 
								v-model="formAddPortimg.name" placeholder="Name">
							</div>
							

							
							<div class="form-group row">
								   <div class="col-md-3" v-if="formAddPortimg.logo">
									  <img :src="formAddPortimg.logo" class="img-responsive" height="70" width="90">
								   </div>
								  <div class="col-md-6">
									  <input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' 
									  name = 'filer'>
								  </div>
				
							</div>
							
							
							
						  <div class="form-group row">
							<input type="submit" value="Add Portfolio Image " class="btn btn-outline-primary ml-auto">
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
		  
            ports: {},
			
            formAddPortimg:{                    
                    name: '',
					portid: null,
					logo: '' ,
				}
          }
        },
		
		computed: {
		   portId() {
			  return this.formAddPortimg.portid;
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
			let idport = '';
			if(app.$route.params.portid)
			{
            	idport = app.$route.params.portid;
			}
            if(idport >0)
            {
                localStorage.setItem('port_id', idport);
				this.formAddPortimg.portid = idport;
            }
            else
            {
                localStorage.setItem('port_id', '') ;
				this.formAddPortimg.portid = '';
            }
			 
			 console.log( '78 portid is ' + idport);
			 this.fetchPortsDropDwon();
			 
			 console.log( '81 portid is ' +   this.formAddPortimg.portid );
		},
        methods: 
		{
          
		   fetchPortsDropDwon() {
                axios.get('/admin/port/jsonportdrop').then((res) => 
				{  
                    this.ports = res;
					console.log('102 ports are ' + res.data);
					console.log('103 ports are ' + res);
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
                    vm.formAddPortimg.logo = e.target.result;

                };
                reader.readAsDataURL(file);
            },

			
		  
		   addportfolioimg()
		   {
             let uri = 'admin/portimg/post';
			 const vr3 = this.$router;
			 console.log('logo ' +  this.formAddPortimg.logo);

             axios.post('/admin/portimg/post',  this.formAddPortimg).then(function (resp) {
                        // this.$router.push({path: '/admin/login'});
						 vr3.push('/admin/portfolio')
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
