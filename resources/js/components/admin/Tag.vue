<template>
	<div class="login row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h3>View Tags</h3>
				</div>
				
				<div class = 'marginleft5 margintop8-4-5'>
					<span class = 'marginleft5'>
						<router-link :to="{ name: 'addtag' }" class="btn btn-primary margintop8-4-5"> 
						   Add Tags
						</router-link> 
					</span>	
				</div>
					
				
				<div class="card-body">
						
					<table class="table table-hover">
						<thead>
						<tr>
							<td>ID</td>
							<td>Name</td>
							<td >View Gallery</td>
							<td >Add Gallery</td>
							<td >Edit</td>
							<td >Delete</td>
						</tr>
						</thead>
			
						<tbody>
							<tr v-for="item, index in tags.data">
								<td>{{ item.id }}</td>
								
								<td>{{ item.name }}</td>
								<td >
								<router-link :to="{ name: 'portfolio', params: { catid: item.id , bycitycat:'bytag' } }" class="btn btn-primary"> 
								View Gallery   </router-link> </td>
								
								
								<td >
								<router-link :to="{ name: 'addportfolio', params: { catid: item.id , bycitycat:'bytag' } }" 
								class="btn btn-primary"> 
								Add Gallery </router-link> </td>
								
								
								<td ><router-link :to="{ name: 'edittag', params: { id: item.id } }" class="btn btn-primary"> 
								Update </router-link> </td>
								<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
							</tr>
						</tbody>
					</table>
					<pagination :data="tags" @pagination-change-page="fetchTags"></pagination>		
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
		data: function() {
			return {
			 tags: {}
			}
		  },
		created: function()
        {
			const vr1 = this.$router;
			this.fetchTags();

		},
		 mounted: function()
        {
			const vr2 = this.$router;

		},
		
        methods: 
		{
            fetchTags(page) {
			
			    if (typeof page === 'undefined') 
				{
                    page = 1;
                }
				
                axios.get('/admin/tags/json?page=' + page).then((res) => 
				{
				    console.log( ' linne 87 ' + res);
                    this.tags = res.data.tags;
                });
		
				
            }
            ,
		    deleteEntry(id, index) 
			{
                if (confirm("Do you really want to delete " + id)) 
				{
                    var app = this;
                    axios.delete('/admin/tag/deletejson/' + id)
                        .then(function (resp) 
						{
                            app.tags.data.splice(index, 1);
                        })
                        .catch(function (error) {

                            alert("Could not delete company" + error + error.resp + error.req);
                            
                        });
                }
            }
        }
}
</script>
