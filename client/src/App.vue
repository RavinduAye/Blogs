<template>
  <div id="app">
    <app-bar />
    <router-view />
  </div>
</template>

<script>
import AppBar from "./components/AppBar.vue";
export default {
  components: { AppBar },
};
</script>
<style lang="scss">
#app {
  font-family: Poppins, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  // color: #2c3e50;
}
</style>
