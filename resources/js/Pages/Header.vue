<template>
  <nav class="navigation-bar">
    <a href="/" class="logo">DigitalStore</a>
    <a href="/catalog" class="catalog">каталог</a>
    <a href="" class="cart">корзина</a>
    <a href="" class="catalog">вход</a>
    <a href="" class="login">регистрация</a>
  </nav>
</template>

<script>
export default {
  name: 'AppHeader'
}
</script>

<style scoped>
.navigation-bar {
  display: flex;
  min-width: 100%;
  background-color: #884535;
  
}

.logo {
  font-family: "Jersey 25";
  font-size: 48px;
  margin: 30px 0 0 150px;
  color: white;
  text-decoration: none;
}

.catalog {
  margin: 50px 0 0 405px;
  font-family: "Montserrat";
  font-size: 26px;
  font-weight: 250;
  color: white;
  text-decoration: none;
}

.cart {
  margin: 50px 0 0 135px;
  font-family: "Montserrat";
  font-size: 26px;
  font-weight: 250;
  color: white;
  text-decoration: none;
}

.login {
  margin: 50px 0 0 55px;
  font-family: "Montserrat";
  font-size: 26px;
  font-weight: 250;
  color: white;
  text-decoration: none;
}
</style>