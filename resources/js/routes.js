import Home from './components/admin/Home.vue';
import Register from './components/admin/Register.vue';
import Login from './components/admin/Login.vue';
import Dashboard from './components/admin/Dashboard.vue';
import Dashboard2 from './components/admin/Dashboard2.vue';
import AddPortfolioCat from './components/admin/AddPortfolioCat.vue';
import PortfolioCat from './components/admin/PortfolioCat.vue';

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
		path: '/admin/addportfoliocat',
		name: 'addportfoliocat',
		component: AddPortfolioCat,
	}
	,
	{
		path: '/admin/portfoliocat',
		name: 'portfoliocat',
		component: PortfolioCat,
	}

]



