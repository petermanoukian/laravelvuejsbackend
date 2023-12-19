
<template>
	<div class="login row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3>Add portfolio </h3>
					</div>
					<div class="card-body">
						<form @submit.prevent="addportfolioimg">		
				
							<div>
							<span v-if= "portId == ''" > Empty </span>
							<span v-else> Not Empty   {{ portId }} </span>
							</div>
	
							<div class="form-group row">
								<label for="name">Portfolio</label>
								<select name = 'portid' class="form-control" v-model="formAddImg.portid" required placeholder= 'Select One' >
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

							
							<div class="form-group row">
								   <div class="col-md-3" v-if="formAddImg.logo">
									  <img :src="formAddImg.logo" class="img-responsive" height="70" width="90">
								   </div>
								  <div class="col-md-6">
									  <input type="file" 
									 @change="uploadFieldChange"
									   class="form-control" id = 'attachments' name = 'filer'
									  multiple="multiple" >
									  
									<hr>
									<div class="col-md-12">
										<div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in formAddImg.attachments"> 
											<span class="label label-primary">
											{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span> 
											<span class="" style="background: red; cursor: pointer;" @click="removeAttachment(attachment)">
											<button class="btn btn-xs btn-danger">Remove</button></span>
										</div>
									</div> 
								  </div>
							</div>
							

							
							
							
						  <div class="form-group row">
						   
							<input type="submit" value="Add Portfolio  " class="btn btn-outline-primary ml-auto">
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
			
            formAddImg:
			{                    
                    name: '',
					portid: null,
					logo: '' ,
					attachments: [],
					attacher:[],
			},
			form: new FormData,
			    
                attachment_labels: [], // List of old uploaded files coming from the server
             
                // Each file will need to be sent as FormData element
                data: new FormData(),
                percentCompleted: 0,
			
			
          }
        },
		
		computed: {
		   portId() {
			  return this.formAddImg.portid;
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
				this.formAddImg.portid = idport;
            }
            else
            {
                localStorage.setItem('port_id', '') ;
				this.formAddImg.portid = '';
            }
			 
			 console.log( '78 portid is ' + idport);
			 this.fetchPortsDropDown();
			 
			 console.log( '81 portid is ' +   this.formAddImg.portid );
		},
        methods: 
		{
          
		   fetchPortsDropDown() {
                axios.get('/admin/port/jsonportdrop').then((res) => 
				{  
                    this.ports = res;
					console.log('102 cats are ' + res.data);
					console.log('103 cats are ' + res);
                });
		
            },
			
  			onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
				this.uploadFieldChange(e);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.formAddImg.logo = e.target.result;

                };
                reader.readAsDataURL(file);
            },
			
            getAttachmentSize() {
                
                this.upload_size = 0; // Reset to beginningƒ
                this.formAddImg.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },
            prepareFields() {
                console.log( ' line 177 ' );
                if (this.formAddImg.attachments.length > 0) {
				let leng = this.formAddImg.attachments.length ;
                    for (var i = 0; i < this.formAddImg.attachments.length; i++) {
                        let attachment = this.formAddImg.attachments[i];
                        this.data.append('formAddImg.attachments[]', attachment);
						console.log( ' i ' +  i + ' attachemnt ' + attachment + ' lenght ' + leng);
                    }
                }
            },
            removeAttachment(attachment) {
                
                this.formAddImg.attachments.splice(this.formAddImg.attachments.indexOf(attachment), 1);
                
                this.getAttachmentSize();
            },
            // This function will be called every time you add a file
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
					console.log( ' 220 ' + i );
                    this.formAddImg.attachments.push(files[i]);
                }
                // Reset the form to avoid copying these files multiple times into this.formAddImg.attachments
                document.getElementById("attachments").value = [];
				var leng = files.length;
				console.log( ' 226 lenght ' + leng);
				console.log( ' 227 ' + this.formAddImg.attachments);
            },
			
			
			

            // We want to clear the FormData object on every upload so we can re-calculate new files again.
            // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
            resetData() {
                this.data = new FormData(); // Reset it completely
                this.formAddImg.attachments = [];
            },
			

            validate() {
                if (!this.formAddImg.attachments.length) {
                    toastr.warning('Please add files', 'Warning');
                    return false;
                }
                return true;
            },
			
		  
		   addportfolioimg()
		   {
             let uri = '/admin/port/post';
			 const vr3 = this.$router;
			 //console.log('logo ' +  this.formAddImg.logo);
			 
			 let vm = this;
			 for(let i=0; i<this.formAddImg.attachments.length;i++)
			{
                //this.form.append('attachments[]',this.formAddImg.attachments[i]);
				this.createImage(this.formAddImg.attachments[i]);
				console.log('logo261 ' +  this.formAddImg.attachments + ' i ' + i);
				this.formAddImg.logo = this.formAddImg.attachments[i];
				console.log('logo263 ' +  this.formAddImg.attacher  + ' attacher ' + i);
				
				                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                       // window.Event.fire('percent', this.percentCompleted);
                        console.log(this.percentCompleted);
                        this.$forceUpdate();
                    }.bind(this)
                };
				
				console.log('logo275 ' +  this.formAddImg + ' ALLTOTAL ' + i);
				 
				 axios.post('/admin/portimg/post',this.formAddImg   )
				 .then(function (resp) 
				 {
						   
					//vr3.push('/admin/portfolio')
							alert("created department" + resp);
				})
				.catch(function (resp) {
							console.log(resp);
							alert("Could not create your department" + resp);
						}
				);
				
				
            }
			console.log('logo 297' +  this.formAddImg.attachments + ' end 279 ');
			
	
            
			
			 this.prepareFields();
                if (!this.validate()) {
                    return false;
                }
               


			
			
			
			

          }
      }
}
</script>
