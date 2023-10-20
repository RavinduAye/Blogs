<template>
  <div>
    <v-row>
      <v-col class="img"  cols="6"/>
      <v-col cols="6" class="form-container">
        <v-card class="field-container">
          <h3 class="headline">Register</h3>
          <v-row>
            <v-col>
                <v-text-field
                    v-model="model.firstName"
                    density="compact"
                    placeholder="First name"
                    prepend-inner-icon="mdi-account-outline"
                    outlined
                    required
                ></v-text-field>
            </v-col>
            <v-col>
                <v-text-field
                    density="compact"
                    placeholder="Last name"
                    prepend-inner-icon="mdi-account-outline"
                    outlined
                    required
                ></v-text-field>
            </v-col>
          </v-row>
          <v-text-field
            density="compact"
            type="email"
            placeholder="Email address"
            prepend-inner-icon="mdi-email-outline"
            outlined
            required
          ></v-text-field>
          <v-text-field
            type="password"
            density="compact"
            placeholder="Enter your password"
            prepend-inner-icon="mdi-lock-outline"
            outlined
            required
          ></v-text-field>
          <v-text-field
            type="password"
            density="compact"
            placeholder="Re-type your password"
            prepend-inner-icon="mdi-lock-outline"
            outlined
            required
          ></v-text-field>
          <button
            class="button"
          >
            Sign Up
          </button>

          <v-card-text class="text-center">
            <div
              class="text-decoration-none"
            >
              Already Registered?
              <a href="/login" class="login-link">Log In</a>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>

export default {
  title: "RegisterPage",
  data: () => ({
    model: {
        firstName: null,
    },
    image: require(`../../assets/blogImage4.jpg`),
  }),
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
  text-align: center;
}

.login-link {
  color: blueviolet !important;
  a {
    color: blueviolet !important;
  }
}

.login-link:hover {
  text-decoration: underline;
}

</style>
