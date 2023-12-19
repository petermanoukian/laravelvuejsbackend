<template>
	<div class="login row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>View Pages</h3>
					</div>
					

					<div class="card-body">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<td>ID</td>
								
								<td>Name</td>
							
								<td >Image</td>
							
								<td >Edit</td>
							
								
							</tr>
							</thead>
				
							<tbody>
								<tr v-for="item, index in abouts.data" :key="abouts.data.id">
									<td>{{ item.id }}</td>
									
									<td>{{ item.name }}</td>
									<td v-if="typeof item.img !== 'undefined' && item.img !== null && item.img !== '' " >  
									<img :src=imagepath+item.img />
									</td>
									
									<td v-else>   
									No Image added  
									</td>
									
							
								
							
							
									
									
									<td ><router-link :to="{ name: 'editabout', params: { id: item.id } }" class="btn btn-primary"> 
									Update </router-link> </td>
									
								</tr>
							</tbody>
						</table>
						<pagination :data="abouts" @pagination-change-page="fetchPages"></pagination>
	
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
	    data: function() 
		{
			return {
				 abouts: {}
			}
		},
		computed: {

			imagepath : function (logo) 
			{
				return "/images/about/thumb/";
		    },



  
		}, 
		  
		created: function()
        {
			const vr1 = this.$router;
			

		},
		 mounted: function()
        {
			const vr2 = this.$router;
			let app = this;

			this.fetchPages();
			
			

		},
		
        methods: 
		{
            fetchPages(page) {
			
			    var apper = this;
				var url  ='';
				if (typeof page === 'undefined') 
				{
                    page = 1;
                }

				
				url = '/admin/abouts/json?page=' + page;
				
		
                axios.get(url).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
					console.log( ' linne 88 ' + res.data);
                    this.abouts = res.data;
                });
		
				
            }
            
			

			
		 
        }
}
</script>
