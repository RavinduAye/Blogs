<template>
  <v-app-bar
    app
    dark
    class="app-bar"
  >
    <template>
      <div class="app-bar-container">
        <div v-if="auth.user">
          <v-btn class="btn" href="/home">Home</v-btn>
          <v-btn class="btn" href="/new_post">Write</v-btn>
        </div>
        <div v-else>
          <v-btn class="btn" href="/login">Sign in</v-btn>
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
    auth: {
      user: 1,
    },
    blogs: [
      {
        id: 1,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
      {
        id: 2,
        name: "2",
      },
      {
        id: 3,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
      {
        id: 4,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
      {
        id: 5,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
      {
        id: 6,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
      {
        id: 7,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
      {
        id: 8,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
      {
        id: 9,
        title: "Pre-Conference Session: Don't Start a Church, Plant One!",
        content: "Church planting isn't easy",
      },
    ],
  }),
};
</script>

<style lang="scss" scoped>

.btn{
    background-color: unset !important;
    box-shadow: none;
}

.btn {
  border-radius: 50px;
  background: white;
  white-space: nowrap;
  padding: 10px 22px;
  color: linear-gradient(to right, #8e2de2, #4a00e0);;
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


</style>
