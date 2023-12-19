<template>
<div class="container">
<h1>Hallo {{ currentUser.name }} {{ currentUser.email }}  {{ currentUser.membertype }} . . . welcome to your work space.</h1>
</div>
</template>

<script>
export default {
computed:{
currentUser(){
return this.$store.getters.currentUser
}
}
}
</script>