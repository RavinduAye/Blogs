<template>
  <v-app-bar app dark class="app-bar">
    <template>
      <div>
        <div v-if="user">
          <v-btn class="btn" @click="$router.push({ name : 'Home'})">Home</v-btn>
          <v-btn class="btn" @click="$router.push({ name : 'New Blog'})">Write</v-btn>
        </div>
        <div v-else>
          <v-btn class="btn" href="/">Public Posts</v-btn>
          <v-btn class="btn" href="/login">Sign In</v-btn>
        </div>
      </div>
    </template>
  </v-app-bar>
</template>

<script>

export default {
  name: "AppBar",
  data: () => ({
    currentItem: "home",
    blogs: [],
    user: null
  }),

  created(){
    window.addEventListener('user-logged', this.setUser)
  },

  methods: {
    setUser(event){
      this.user = event.detail
    }
  },

  destroyed(){
    window.removeEventListener('user-logged', this.setUser)
  }
};

</script>

<style lang="scss" scoped>
.btn {
  background-color: unset !important;
  box-shadow: none;
}

.btn {
  border-radius: 50px;
  background: white;
  white-space: nowrap;
  padding: 10px 22px;
  color: linear-gradient(to right, #8e2de2, #4a00e0);
  font-size: 16px;
  outline: none;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  text-decoration: none;
}

.btn:hover {
  background: #8e2de2;
  color: #fff;
}

.app-bar {
  background: linear-gradient(to right, #8e2de2, #4a00e0);
  height: 80px;
  display: flex;
  justify-content: right;
  align-items: center;
  font-size: 1rem;
  top: 0;
  z-index: 10;
}

.logo {
  text-align: left;
}
</style>
