<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Update  Image </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="editportimg"  autocomplete="off" >
						
							<div>
							<span v-if= "portId == ''" > Empty </span>
							<span v-else> Not Empty   {{ portId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name"> Gallery </label>
								<select name = 'portid' class="form-control" v-model="portimg.portid" required placeholder= 'Select One' >
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
								v-model="portimg.name" placeholder="Name">
								
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
							<input type="submit" value="Update Image  " class="btn btn-outline-primary ml-auto">
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
			loader: false,
            portimg:{                    
                    name: '',
					portid: null,
					logo: '',
					image: '' ,
				},
				showimg1: true,
				showimg2: false,
				imagex: {}
          }
		  
        },
		
		computed: {
		   portId() {
			  return this.portimg.portid;
		   },
		   imagepath()
		   {
			return "/images/gallery/thumb/"+this.portimg.logo;
		   },
		   imagepath2()
		   {
			return this.portimg.image;
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
                localStorage.setItem('portimg_id', id)
               
             }
             else
             {
                id = localStorage.getItem('portimg_id')   
             }
			 
			app.portimg.id = id;
			axios.get('/admin/portimg/edit/' + id)
				.then(function (resp) {
					app.portimg = resp.data;
					console.log( '77 '+ resp.data);
					
				})
				.catch(function () {
					alert("Could not load your records")
				});
			this.fetchPortsDropDwon();
			

		},
        methods: 
		{

           editportimg() 
		   {
               // event.preventDefault();
        		this.loader = true; 
                var app = this;
                var newPortimg = app.portimg;
                let uri = `/admin/portimg/update/${app.portimg.id}`;
				const vr3 = this.$router;
                //alert(uri);

                axios.patch(uri, newPortimg)
				.then(function (resp) 
				{
				    app.loader = false;
					let portid = app.portimg.portid; 
				 	let returnurl = `/admin/portfolioimg/${app.portimg.portid}`;
					console.log( ' 165 ' + returnurl);
					vr3.push(returnurl);
				})
				.catch(function (resp) {
					console.log(resp);
					app.loader = false;
					alert("Could not update " + resp + ' id ' + app.portimg.id + 'newdep' + newPortimg + app.name );
					console.log("Could not update " + resp + ' id ' + app.portimg.id + 'newdep' + newPortimg + app.name );
				});


            },
			
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
				this.showimg1 = false;
				this.showimg2 = true;
				
			
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    //vm.port.logo = e.target.result;
					vm.portimg.image = e.target.result;
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