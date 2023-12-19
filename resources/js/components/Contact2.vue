<template>
    <section class="contact-our-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Heading -->
                <div class="col-12">
                    <div class="section-heading-2 text-center wow fadeInUp" data-wow-delay="300ms">
                     
                        <h4>Contact us</h4>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-12 col-sm-3">
                    <div class="contact-information mb-100">
                        <!-- Single Contact Info -->
               
                        <!-- Single Contact Info -->
                        <div class="single-contact-info wow fadeInUp" data-wow-delay="300ms">
                            <p>Email:</p>
                            <h6>
								<a href = 'mailto:info@bedigm.com' target = '_blank'  class='white'>info@bedigm.com </a>
								
							
							</h6>
                        </div>
                        <!-- Single Contact Info -->
                        <div class="single-contact-info wow fadeInUp" data-wow-delay="300ms">
                            <p>Website:</p>
                            <h6>www.bedigm.com</h6>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-8">
                    <!-- Contact Form -->
                    <div class="contact_from_area mb-100 clearfix wow fadeInUp" data-wow-delay="300ms">
                        <div class="contact_form">
                            <form @submit.prevent="contacter" id="main_contact_form" method = 'post' enctype="multipart/form-data">
                                <div class="contact_input_area">
                                    <div id="success_fail_info"></div>
                                    <div class="row">
                                        <!-- Form Group -->
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-30" name="name" id="name" placeholder="Your Name"
												v-model="formContact.name"  required>
                                            </div>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-30" name="name" id="name2" placeholder="Last Name"
												v-model="formContact.name2"  required>
                                            </div>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control mb-30" name="email" id="email" placeholder="E-mail"
												v-model="formContact.email" required >
                                            </div>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-30" name="phone" id="phone" placeholder="Your Number"
												v-model="formContact.phone"  >
                                            </div>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control mb-30" id="message" cols="30" rows="6" 
												v-model="formContact.message"  placeholder="Your Message *"></textarea>
                                            </div>
                                        </div>
										
										<div class="col-12">
                                            <div class="form-group">
												<input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' 
												 ref="file" name="file" 
												 accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png, image/jpeg, image/jpg, image/gif,application/pdf,text/plain">
												 
												 <b class='white'>Allowed file types: gif, jpeg, png, plain text, word, pdf only </b>
										    </div>
                                        </div>		
												
                                        <!-- Button -->
                                        <div class="col-12"  id = 'result2'>
                                            <button type="submit" class="btn confer-btn">Send Message <i class="zmdi zmdi-long-arrow-right"></i></button>
                                        </div>
										<div class="col-12" id = 'result'>
										
										</div>
										<div class="col-12 3rddiv"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<script>

import router from '../app2.js'


import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-contact1',
	
	data: function() 
	{
		return {
			formContact:{
				name:'',
				name2:'',
				phone:'',
				email:'',
				message:'',
				attachment: '' ,
			}
			 
		}
	},
	created: function()
	{
		const vr1 = this.$router;
	

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	
	methods: 
	{
	
		onImageChange(e) {
			//alert(1);
			//this.formContact.attachment = this.$refs.file.files[0];
			this.formContact.attachment = e.target.files[0];
			/*
			let files = e.target.files || e.dataTransfer.files;
			if (!files.length)
				return;
			this.createImage(files[0]);
			*/
			
		},
		createImage(file) {
			//alert(2);
			let reader = new FileReader();
			let vm = this;
			reader.onload = (e) => {
				vm.formContact.attachment = e.target.result;

			};
			reader.readAsDataURL(file);
		},
		
		contacter(){
		
			$("#result").html("<p><b class='red'>  ..... </b></p>");
            let formData = {
                name:this.formContact.name,
				name2:this.formContact.name2,
				phone:this.formContact.phone,
                email:this.formContact.email,
                message:this.formContact.message,
            };
			/*
            return axios.post('/contacter/', formData).then(data => {
              // Change to notify the user
              console.log('Message sent');
            });
			*/
				let formDatax = new FormData();
				//var form = new FormData();
				formDatax.append('name', this.formContact.name);
				formDatax.append('name2', this.formContact.name2);
				formDatax.append('phone', this.formContact.phone);
				formDatax.append('email', this.formContact.email);
				formDatax.append('attachment', this.formContact.attachment);
				formDatax.append('message', this.formContact.message);
				
				
				//formDatax.append('file', this.formContact.attachment);
				
				
			    axios.post('/contacterattach', formDatax,
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
				
				
				
				).then(function (resp) {
				
				console.log('Message sent' + resp);
				 $("#result").html("<p><b class='red'> " +   resp.data + " </b></p>");
				 $('html, body').animate({
					scrollTop: $("#result").offset().top - 512
				}, 2000);
				 
				 
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not contact" + resp);
				});

			
        }

	},

	
}
</script>

<style>
  #result {
    align-items: center;
	font-size:16px;
	color:red;
	margin:25px 3px 8px 6px;
	display:inline-block;
	width:93%;
	min-height:50px;
	padding:10px;
  }
  
  <style>
  #result p {
	font-size:16px;
	color:red;
  }
  
  #result b {
	font-size:16px;
	color:red;
  }
  
  .red
  {
	color:red;
  }
  .3rddiv
  {
	min-height:10px;
  }
</style>