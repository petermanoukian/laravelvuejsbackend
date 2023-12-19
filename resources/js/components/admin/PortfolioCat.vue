<template>
	<div class="login row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h3>View Categories</h3>
				</div>
				
				<div class = 'marginleft5 margintop8-4-5'>
					<span class = 'marginleft5'>
						<router-link :to="{ name: 'addportfoliocat' }" class="btn btn-primary margintop8-4-5"> 
						   Add Categories
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
							<tr v-for="item, index in cats.data">
								<td>{{ item.id }}</td>
								
								<td>{{ item.name }}</td>
								<td >
								<router-link :to="{ name: 'portfolio', params: { catid: item.id , bycitycat:'bycat' } }" class="btn btn-primary"> 
								View Gallery  {{ item.portfolios_count}} </router-link> </td>
								
								
								<td >
								<router-link :to="{ name: 'addportfolio', params: { catid: item.id , bycitycat:'bycat' } }" 
								class="btn btn-primary"> 
								Add Gallery </router-link> </td>
								
								
								<td ><router-link :to="{ name: 'editcatportfolio', params: { id: item.id } }" class="btn btn-primary"> 
								Update </router-link> </td>
								<td ><button class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">Delete</button></td>
							</tr>
						</tbody>
					</table>
					<pagination :data="cats" @pagination-change-page="fetchPortCats"></pagination>		
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
		 cats: {}
		}
	},
	created: function()
	{
		const vr1 = this.$router;
		this.fetchPortCats();

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	
	methods: 
	{
		fetchPortCats(page) {
		
			if (typeof page === 'undefined') 
			{
				page = 1;
			}
			
			axios.get('/admin/portcat/json?page=' + page).then((res) => 
			{
				console.log( ' linne 87 ' + res);
				this.cats = res.data.cats;
			});
			/*
				this.$http.get('/admin/portcat/json?page=' + page)
				.then(response => {
					console.log( ' linne 87 ' + response);
					return response.json();
				}).then(data => {
					this.cats = data;
				});
			*/
			
		}
		,
		deleteEntry(id, index) 
		{
			if (confirm("Do you really want to delete " + id)) 
			{
				var app = this;
				axios.delete('/admin/catportfolio/deletejson/' + id)
					.then(function (resp) 
					{
						app.cats.data.splice(index, 1);
					})
					.catch(function (error) {

						alert("Could not delete company" + error + error.resp + error.req);
						
					});
			}
		}
	}
}
</script>
