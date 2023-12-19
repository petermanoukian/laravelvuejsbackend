<template>
<nav class="navbar navbar-expand-md navbar-light navbar-laravel mb-4">
<div class="container">
<router-link class="navbar-brand" to="/admin/">Home</router-link>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>


<div class="collapse navbar-collapse" id="navbarSupportedContent"><div class="navbar-nav inline-block ml-auto">

<template v-if="!currentUser">
<ul class='ulnav'>
	<li >
		<router-link to="/admin/login" class="nav-link">Sign In</router-link>
		<router-link to="/admin/register" class="nav-link">Add Admin</router-link>
		<router-link to="/admin/dashboard2" class="nav-link">user</router-link>
	</li>
</ul>
</template>

<template v-else>
	<div class = 'fulldiv'>
		<ul  class='ulnav'>
			<li v-if="currentUser.membertype === 'admin'">
				<router-link to="/admin/register" class="nav-link">Add Admin</router-link>
				<router-link to="/admin/dashboard3" class="nav-link">Admins</router-link>
			
			</li>
			
			<li v-else-if="currentUser.membertype === 'user'">
				<router-link to="/admin/dashboard2" class="nav-link">My Account</router-link>
				<router-link to="/admin/dashboard3" class="nav-link">Admins</router-link>
			</li>
			
			<li v-else>
				None of the above
			</li>
			
	
			<li class="nav-item dropdown">
			<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			{{currentUser.name}} <span class="caret"></span>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			<a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
			</div>
			</li>
		</ul>
	</div>
	<div class = 'divider'> </div>
	<div class = 'fulldiv'>
		<ul  class='ulnav'>
			<li class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Gallery<span class="caret"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<router-link to="/admin/addportfoliocat" class="nav-link"> Add Category</router-link>
					<router-link to="/admin/portfoliocat" class="nav-link">View Categories</router-link>
					
					<router-link to="/admin/addcity" class="nav-link"> Add City</router-link>
					<router-link to="/admin/city" class="nav-link">View Cities</router-link>

					<router-link to="/admin/addportfolio" class="nav-link"> Add Gallery</router-link>
					<router-link to="/admin/portfolio" class="nav-link"> View Gallery </router-link>
					
					<router-link to="/admin/addtag" class="nav-link"> Add Tag</router-link>
					<router-link to="/admin/tag" class="nav-link">View Tags</router-link>
					
					
					
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Banner <span class="caret"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<router-link to="/admin/addservice" class="nav-link"> Add Banner </router-link>
				<router-link to="/admin/service" class="nav-link"> View Banners </router-link>
				</div>
			</li>
			
			<li class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Pages <span class="caret"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				
				<router-link to="/admin/about" class="nav-link"> View Pages </router-link>
				</div>
			</li>
			
	
			<li class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Blog <span class="caret"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<router-link to="/admin/addblogcat" class="nav-link"> Add Categories</router-link>
				<router-link to="/admin/blogcat" class="nav-link">View Categories</router-link>
				<router-link to="/admin/blogcat/bycat" class="nav-link">Top Categories</router-link>
				<router-link to="/admin/blogcat/bysub" class="nav-link">Sub Categories</router-link>
				<router-link to="/admin/addblog" class="nav-link"> Add Blog </router-link>
				<router-link to="/admin/blog" class="nav-link"> View Blog </router-link>
				</div>
			</li>
			
			
			<li class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Shop <span class="caret"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<router-link to="/admin/addshopcat" class="nav-link"> Add Categories</router-link>
				<router-link to="/admin/shopcat" class="nav-link">View Categories</router-link>
				<router-link to="/admin/shopcat/bycat" class="nav-link">Top Categories</router-link>
				<router-link to="/admin/shopcat/bysub" class="nav-link">Sub Categories</router-link>
				<router-link to="/admin/addshop" class="nav-link"> Add Shop </router-link>
				<router-link to="/admin/shop" class="nav-link"> View Shop </router-link>
				</div>
			</li>
			
			
			
			

			

		</ul>
	</div>
</template>
</div>
</div>
</div>
</nav>
</template>

<script>
export default 
{
	name: 'app-header',
	methods:
	{
		logout()
		{
			this.$store.commit('logout');
			this.$router.push('/admin/login');
		}
	},
	computed:
	{
		currentUser()
		{
			return this.$store.getters.currentUser
		}
	}
}
</script>