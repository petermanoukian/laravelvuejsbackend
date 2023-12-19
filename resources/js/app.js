require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VeeValidate from 'vee-validate'
//import {routes} from './routes.js';
import storeData from './store.js';
import MainApp from './components/admin/MainApp.vue';
import CKEditor from '@ckeditor/ckeditor5-vue';

import Home from './components/admin/Home.vue';
import Register from './components/admin/Register.vue';
import Login from './components/admin/Login.vue';
import Dashboard from './components/admin/Dashboard.vue';
import Dashboard2 from './components/admin/Dashboard2.vue';
import Dashboard3 from './components/admin/Dashboard3.vue';
import EditUser from './components/admin/EditUser.vue';



import AddPortfolioCat from './components/admin/AddPortfolioCat.vue';
import PortfolioCat from './components/admin/PortfolioCat.vue';
import EditPortfolioCat from './components/admin/EditPortfolioCat.vue';
import AddPortfolio from './components/admin/AddPortfolio.vue';
import Portfolio from './components/admin/Portfolio.vue';
import EditPortfolio from './components/admin/EditPortfolio.vue';
import AddPortfolioImage from './components/admin/AddPortfolioImage.vue';
import AddImage from './components/admin/AddImage.vue';
import PortfolioImage from './components/admin/PortfolioImage.vue';
import EditPortfolioImage from './components/admin/EditPortfolioImage.vue';


import AddService from './components/admin/AddService.vue';
import Service from './components/admin/Service.vue';
import EditService from './components/admin/EditService.vue';


import AddServiceSub from './components/admin/AddServiceSub.vue';
import ServiceSub from './components/admin/ServiceSub.vue';
import EditServiceSub from './components/admin/EditServiceSub.vue';



import AddBlogCat from './components/admin/AddBlogCat.vue';
import BlogCat from './components/admin/BlogCat.vue';
import EditBlogCat from './components/admin/EditBlogCat.vue';

import AddBlog from './components/admin/AddBlog.vue';
import Blog from './components/admin/Blog.vue';
import EditBlog from './components/admin/EditBlog.vue'



import AddCity from './components/admin/AddCity.vue';
import City from './components/admin/City.vue';
import EditCity from './components/admin/EditCity.vue';


import AddTag from './components/admin/AddTag.vue';
import Tag from './components/admin/Tag.vue';
import EditTag from './components/admin/EditTag.vue';


import About from './components/admin/About.vue';
import EditAbout from './components/admin/EditAbout.vue';


import AddShopCat from './components/admin/AddShopCat.vue';
import ShopCat from './components/admin/ShopCat.vue';
import EditShopCat from './components/admin/EditShopCat.vue';


import AddShop from './components/admin/AddShop.vue';
import Shop from './components/admin/Shop.vue';
import EditShop from './components/admin/EditShop.vue';



import AddShopImage from './components/admin/AddShopImage.vue';
import ShopImage from './components/admin/ShopImage.vue';
import EditShopImage from './components/admin/EditShopImage.vue';



Vue.component('pagination', require('laravel-vue-pagination'));
export const routes = [
	{
		path: '/admin/',
		name: 'home',
		component: Home,
	},
	{
		path: '/admin/register',
		name: 'register',
		component: Register,
	},
	{
		path: '/admin/login',
		name: 'login',
		component: Login,
	},
	{
		path: '/admin/dashboard',
		name: 'dashboard',
		component: Dashboard,
	},
	{
		path: '/admin/dashboard2',
		name: 'dashboard2',
		component: Dashboard2,
	},
	{
		path: '/admin/dashboard3',
		name: 'dashboard3',
		component: Dashboard3,
	},	
	{
		path: '/admin/edituser/',
		name: 'edituser',
		component: EditUser,
	}
	,		
	{
		path: '/admin/portfoliocat',
		name: 'portfoliocat',
		component: PortfolioCat,
	},
	
	{
		path: '/admin/addportfoliocat',
		name: 'addportfoliocat',
		component: AddPortfolioCat,
	}
	,
	{
		path: '/admin/editcatport/',
		name: 'editcatportfolio',
		component: EditPortfolioCat,
	}
	,	
	{
		path: '/admin/portfolio/:catid?/:bycitycat?/',
		name: 'portfolio',
		component: Portfolio,
		props: true,
	}
	,
	{
		path: '/admin/addportfolio/:catid?/:bycitycat?/',
		name: 'addportfolio',
		component: AddPortfolio,
	}
	,
	{
		path: '/admin/editport/',
		name: 'editportfolio',
		component: EditPortfolio,
	}
	,
	{
		path: '/admin/addportfolioimg/:portid?/',
		name: 'addportfolioimg',
		component: AddPortfolioImage,
	}
	,
	{
		path: '/admin/addimg/:portid?/',
		name: 'addimg',
		component: AddImage,
	},
	{
		path: '/admin/portfolioimg/:portid?/',
		name: 'portfolioimg',
		component: PortfolioImage,
	},
	{
		path: '/admin/editportimg/',
		name: 'editportfolioimg',
		component: EditPortfolioImage,
	}

	,	
	{
		path: '/admin/city',
		name: 'city',
		component: City,
	},
	{
		path: '/admin/addcity',
		name: 'addcity',
		component: AddCity,
	}
	,
	{
		path: '/admin/editcity/',
		name: 'editcity',
		component: EditCity,
	}
	
	,	
	{
		path: '/admin/tag',
		name: 'tag',
		component: Tag,
	},
	{
		path: '/admin/addtag',
		name: 'addtag',
		component: AddTag,
	}
	,
	{
		path: '/admin/edittag/',
		name: 'edittag',
		component: EditTag,
	}
	,	
	{
		path: '/admin/service/',
		name: 'service',
		component: Service,
		props: true,
	}
	,
	{
		path: '/admin/addservice/',
		name: 'addservice',
		component: AddService,
	}
	,
	{
		path: '/admin/editservice/',
		name: 'editservice',
		component: EditService,
	} 
	,
	
	{
		path: '/admin/addservicesub/:servid?/',
		name: 'addservicesub',
		component: AddServiceSub,
	}
	,

	{
		path: '/admin/servicesub/:servid?/',
		name: 'servicesub',
		component: ServiceSub,
	},
	{
		path: '/admin/editservicesub/',
		name: 'editservicesub',
		component: EditServiceSub,
	}
	
	,
	
		
	{
		path: '/admin/blogcat/:bycat?/:catid?/',
		name: 'blogcat',
		component: BlogCat,
	},
	
	{
		path: '/admin/addblogcat/:catid?/',
		name: 'addblogcat',
		component: AddBlogCat,
	}

	,
	{
		path: '/admin/editcatblog/',
		name: 'editcatblog',
		component: EditBlogCat,
	}

	,	
	
	{
		path: '/admin/blog/:bycat?/:catid?/:subid?/',
		name: 'blog',
		component: Blog,
		props: true,
	}
	,
	{
		path: '/admin/addblog/:bycat?/:catid?/:subid?/',
		name: 'addblog',
		component: AddBlog,
	}
	,
	{
		path: '/admin/editblog/',
		name: 'editblog',
		component: EditBlog,
	}
	
	
	,	
	{
		path: '/admin/about/',
		name: 'about',
		component: About,
		props: true,
	}

	,
	{
		path: '/admin/editabout/',
		name: 'editabout',
		component: EditAbout,
	} 
	,
	
	{
		path: '/admin/shopcat/:bycat?/:catid?/',
		name: 'shopcat',
		component: ShopCat,
	},
	
	
	
	{
		path: '/admin/addshopcat/:catid?/',
		name: 'addshopcat',
		component: AddShopCat,
	} ,
	
	
		
	{
		path: '/admin/editcatshop/',
		name: 'editcatshop',
		component: EditShopCat,
	},
	

	{
		path: '/admin/shop/:bycat?/:catid?/:subid?/',
		name: 'shop',
		component: Shop,
		props: true,
	}
	,
	{
		path: '/admin/addshop/:bycat?/:catid?/:subid?/',
		name: 'addshop',
		component: AddShop,
	}
	,
	
		
	{
		path: '/admin/editshop/',
		name: 'editshop',
		component: EditShop,
	}
	,
	
	{
		path: '/admin/addshopimg/:shopid?/',
		name: 'addshopimg',
		component: AddShopImage,
	}
	,

	{
		path: '/admin/shopimg/:shopid?/',
		name: 'shopimg',
		component: ShopImage,
	},
	{
		path: '/admin/editshopimg/',
		name: 'editshopimg',
		component: EditShopImage,
	}

	,
	
	
	

]





Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use( CKEditor );



const router = new VueRouter({
routes,
mode: 'history'
});

const store = new Vuex.Store(storeData);
const app = new Vue({
el: '#app',
router,
store,
components: 
{
	MainApp
}
});

router.beforeEach((to, from, next) => 
{
      if(  to.path == '/admin/dashboard2' || to.path == '/admin/dashboard' || to.path == '/admin/dashboard2/' 
		 || to.path == '/admin/dashboard/'  || to.path == '/admin/register'   || to.path == '/admin/register/' 
		 || to.path == '/admin/dashboard3'   || to.path == '/admin/dashboard3/' 
		 
		 
		 || to.path == '/admin/portfoliocat' || to.path == '/admin/portfoliocat/'
		 || to.path == '/admin/addportfoliocat' || to.path == '/admin/addportfoliocat/' 
		 || to.path == '/admin/editcatport' || to.path == '/admin/editcatport/' 
		 
	     || to.path == '/admin/portfolio' || to.path == '/admin/portfolio/' 
	  	 || to.path == '/admin/addportfolio' || to.path == '/admin/addportfolio/' 
		 || to.path == '/admin/editport' || to.path == '/admin/editport/'
		 
		 
		 || to.path == '/admin/city' || to.path == '/admin/city/'
		 || to.path == '/admin/addcity' || to.path == '/admin/addcity/' 
		 || to.path == '/admin/editcity' || to.path == '/admin/editcity/'
		 
		 
		 || to.path == '/admin/addportfolioimg' || to.path == '/admin/addportfolioimg/' 
	  	 || to.path == '/admin/portfolioimg' || to.path == '/admin/portfolioimg/' 
		 || to.path == '/admin/editportimg' || to.path == '/admin/editportimg/'
		 
		 || to.path == '/admin/service' || to.path == '/admin/service/' 
	  	 || to.path == '/admin/addservice' || to.path == '/admin/addservice/' 
		 || to.path == '/admin/editservice' || to.path == '/admin/editservice/'
		 
		 || to.path == '/admin/servicesub' || to.path == '/admin/servicesub/' 
	  	 || to.path == '/admin/addservicesub' || to.path == '/admin/addservicesub/' 
		 || to.path == '/admin/editservicesub' || to.path == '/admin/editservicesub/'
		 
		 || to.path == '/admin/blogcat' || to.path == '/admin/blogcat/'
		 || to.path == '/admin/addblogcat' || to.path == '/admin/addblogcat/' 
		 || to.path == '/admin/editcatblog' || to.path == '/admin/editcatblog/' 
		 
		 
		 || to.path == '/admin/blog' || to.path == '/admin/blog/' 
	  	 || to.path == '/admin/addblog' || to.path == '/admin/addblog/' 
		 || to.path == '/admin/editblog' || to.path == '/admin/editblog/'
		 
		 || to.path == '/admin/tag' || to.path == '/admin/tag/'
		 || to.path == '/admin/addtag' || to.path == '/admin/addtag/' 
		 || to.path == '/admin/edittag' || to.path == '/admin/edittag/'
		 
		 
		 || to.path == '/admin/about' || to.path == '/admin/about/' 
		 || to.path == '/admin/editabout' || to.path == '/admin/editabout/'
		 
		 
		 
		 
		 || to.path == '/admin/shopcat' || to.path == '/admin/shopcat/'
		 || to.path == '/admin/addshopcat' || to.path == '/admin/addshopcat/' 
		 || to.path == '/admin/editcatshop' || to.path == '/admin/editcatshop/' 
		 
		 
		 || to.path == '/admin/shop' || to.path == '/admin/shop/' 
	  	 || to.path == '/admin/addshop' || to.path == '/admin/addshop/' 
		 || to.path == '/admin/editshop' || to.path == '/admin/editshop/'
		 
		 || to.path == '/admin/addshopimg' || to.path == '/admin/addshopimg/' 
	  	 || to.path == '/admin/shopimg' || to.path == '/admin/shopimg/' 
		 || to.path == '/admin/editshopimg' || to.path == '/admin/editshopimg/'
		 
		 
		 
		 
		 

	  )
      {          
	      if(checkToken())
          {
  			 //console.log('37  TOKEN PASSED');   
			if(to.path == '/admin/register' || to.path == '/register' || to.path == '/admin/register' || to.path == '/register'
			   
			    || to.path == '/admin/dashboard3' || to.path == '/admin/dashboard3/' 
				
				
				
			   )
			{
				if(checkLevel0())
				{
					//console.log('42  it is full admin');
					next();
				}
				else
				{
					//console.log('47  NOT FULL admin');
					next('dashboard2');
				}
			}
			else
			{
				//console.log('53  ORD USER PASS');
				next();
			}
		}	  
	   else
	   {
		  //console.log('60  NO TOKEN');
		  next('login');
	   }  
    }
  	else
    {
		 // console.log('70 PUBLIC');
          next();
    }
});

function checkToken() 
{
	//console.log('func check token 77');
	let currentUser1 = localStorage.getItem('user');
	if(currentUser1 != null && currentUser1 != '')
	{
		let currentUser1x =JSON.parse(currentUser1);
		let loggedname1 = currentUser1x.name
		let loggedemail1 = currentUser1x.email;
		let level1 = currentUser1x.membertype;
		//console.log(' checking token line 82 ' + currentUser1  + 'name ' + loggedname1 +  'email ' + loggedemail1 + ' level1 ' + level1 );
		if ((level1 == 'admin' || level1 == 'user') && loggedname1 != null && loggedemail1 != null )
		{
			//console.log(' FOUND 2 '+ currentUser1  + 'name ' + loggedname1 +  'email ' + loggedemail1 + ' level1 ' + level1 );
			return true;
		}
		else
		{
			//console.log(' DID NOT FIND ' + currentUser1  + 'name ' + loggedname1 +  'email ' + loggedemail1 + ' level1 ' + level1 );
			return false;
		}
	}
	else
	{
		return false;
	}
}

function checkLevel0() 
{
	console.log('func check level 96');
	let currentUser2 =localStorage.getItem('user');
	let currentUser1 =JSON.parse(currentUser2);
	let loggedname1 = currentUser1.name
	let loggedemail1 = currentUser1.email;
	let level1 = currentUser1.membertype;
	//console.log(' checking token 104 for full admin ' + currentUser1 
	//			+ 'name ' + loggedname1 +  'email ' + loggedemail1 + ' level1 ' + level1 );
	if ((level1 == 'admin' ) && loggedname1 != null && loggedemail1 != null )
	{
		//console.log(' FOUND fuull admin '+ currentUser1  + 'name ' + loggedname1 +  'email ' + loggedemail1 + ' level1 ' + level1 );
		return true;
	}
	else
	{
		//console.log(' DID NOT FIND full admin ' + currentUser1  + 'name ' + loggedname1 +  'email ' + loggedemail1 + ' level1 ' + level1 );
		return false;
	}
}