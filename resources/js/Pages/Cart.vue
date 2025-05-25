<template>
  <div class="home-page">
    <AppHeader />
    <Cart1 />
    <AppFooter />
  </div>
</template>

<script setup>
import AppHeader from './Header.vue';
import Cart1 from './Cart1.vue';
import AppFooter from './Footer.vue';
</script>

<script>
export default {
  name: 'Home'
}
</script>

<style scoped>
.home-page{
  background-color: #884535;
}
</style>