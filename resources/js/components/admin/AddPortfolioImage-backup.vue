<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add portfolio Images</h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="addportfolioimg">		
				
							<div>
							<span v-if= "portId == ''" > Empty </span>
							<span v-else> Not Empty   {{ portId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Portfolio</label>
								<select name = 'prodid' class="form-control" v-model="formAddImg.prodid" required placeholder= 'Select One' >
									<option v-if ="portId === ''" value = '' disabled> Choose Main Portfolio </option>
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
								v-model="formAddImg.name" placeholder="Name">
							</div>
							

							
						<div class="form-group col-md-12">
							<label for="logo" class="control-label">Attachments</label>
							<br><br>
							 <div class="col-md-12">
								    <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange">
								<hr>
								<div class="col-md-12">
									<div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments"> 
										<span class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span> 
										<span class="" style="background: red; cursor: pointer;" @click="removeAttachment(attachment)"><button class="btn btn-xs btn-danger">Remove</button></span>
									</div>
								</div>
							</div>
						</div>
													
							
							
						  <div class="form-group row">
							<input type="submit" value="Add Portfolio Image  " class="btn btn-outline-primary ml-auto">
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
		
		    props: [
            'settings'
        ],
		
        data()
        {

          return{
			data: new FormData(),
            ports: {},
			attachments: [],
            formAddImg:{                    
                    name: '',
					prodid: null,	
					logo: '',

				},

                percentCompleted: 0,
          }
        },
		      watch: {
        },
		computed: {
		   portId() {
			  return this.formAddImg.prodid;
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
			if(app.$route.params.prodid)
			{
            	idport = app.$route.params.prodid;
			}
            if(idport >0)
            {
                localStorage.setItem('port_id', idport);
				this.formAddImg.prodid = idport;
            }
            else
            {
                localStorage.setItem('cat_id', '') ;
				this.formAddImg.prodid = '';
            }
			 
			 console.log( '78 prodid is ' + idport);
			 this.fetchPortCatsDropDwon();
			 
			 console.log( '81 prodid is ' +   this.formAddImg.prodid );
		},
        methods: 
		{
          
		   fetchPortCatsDropDwon() {
                axios.get('/admin/port/jsonportdrop').then((res) => 
				{  
                    this.ports = res;
					console.log('102 cats are ' + res.data);
					console.log('103 cats are ' + res);
                });
		
            },
			
            getAttachmentSize() {
                
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },
            prepareFields() {
                
                if (this.attachments.length > 0) {
                    for (var i = 0; i < this.attachments.length; i++) {
                        let attachment = this.attachments[i];
                        this.data.append('attachments[]', attachment);
                    }
                }
            },
            removeAttachment(attachment) {
                
                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                
                this.getAttachmentSize();
            },
            // This function will be called every time you add a file
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }
                // Reset the form to avoid copying these files multiple times into this.attachments
                document.getElementById("attachments").value = [];
            },
			
			/*
            uploadImage(){
                axios.post('/admin/logo/store',{logo: this.logo}).then(response => {
                   console.log(response);
                });
            },
			
			*/
			
		  
		   addportfolioimg()
		   {
             let uri = '/admin/port/post';
			 const vr3 = this.$router;
			 console.log('logo ' +  this.formAddImg.logo);
			 
			 this.prepareFields();
                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.$forceUpdate();
                    }.bind(this)
                };

				axios.post(this.settings.file_management.upload_files, this.data, config)
                .then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        console.log('Successfull Upload');
                        toastr.success('Files Uploaded!', 'Success');
                        this.resetData();
                    } else {
                        console.log('Unsuccessful Upload');
                        this.errors = response.data.errors;
                    }
                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log(error);
                });
	
	
	
	
          },
		  
		              resetData() {
                this.data = new FormData(); // Reset it completely
                this.attachments = [];
            },
		  
		  
		  
      }
}
</script>
