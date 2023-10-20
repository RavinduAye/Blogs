<template>
  <div>
    <v-row>
      <v-col class="img"  cols="6"/>
      <v-col cols="6" class="form-container">
        <v-card class="field-container">
          <h3 class="headline">Login</h3>
          <v-text-field
            v-model="model.email"
            density="compact"
            placeholder="Email address"
            prepend-inner-icon="mdi-email-outline"
            outlined
          ></v-text-field>
          <v-text-field
            v-model="model.password"
            type="password"
            density="compact"
            placeholder="Enter your password"
            prepend-inner-icon="mdi-lock-outline"
            outlined
          ></v-text-field>
          <button
            class="button"
            @click="login"
          >
            Log In
          </button>

          <v-card-text class="text-center">
            <div
              class="text-decoration-none"
            >
              New User? 
              <a href="/register">Sign up</a>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import axios from "axios";

export default {
  title: "LoginPage",
  data: () => ({
    image: require(`../../assets/blogImage4.jpg`),
    model: {
      email: null,
      password: null
    }
  }),

  methods : {
    login(){
      if (
        !this.model.email ||
        !this.model.password
      ) {
        return;
      }

      const data = {
        email: this.model.email,
        password: this.model.password
      }
      axios
        .post(`/api/login`, data)
        .then(() => {
          console.log("logged successfully");
        })
        .catch(() => {
          console.log("Something went wrong");
        });
    }
  }
};

</script>

<style lang="scss" scoped>

.headline{
  text-align: center;
  margin-bottom: 40px;
  font-size: 36px;
}

.img{
  background: url(../../assets/blogImage4.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
}

.form-container{
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 5px;
  padding: 10px;
}

.field-container{
  width: 35vw;
  box-shadow: unset !important;
}

.button{
  border-radius: 50px;
  background: linear-gradient(to right, #8e2de2, #4a00e0);;
  white-space: nowrap;
  padding: 10px 22px;
  color: white;
  font-size: 16px;
  outline: none;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  text-decoration: none;
  width: 100%;
  height: 50px;
}

</style>
