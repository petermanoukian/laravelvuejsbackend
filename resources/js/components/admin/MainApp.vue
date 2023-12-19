<template>
    <div class="main">
       <Header />
       <div class="content">
           <router-view :key="$route.path"></router-view>
       </div>
    </div>
</template>

<script>
import Header from './Header.vue';
export default {
    name: 'main-App',
    components: { Header }
}
</script>
