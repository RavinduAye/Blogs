<template>
  <div>
    <v-row>
      <v-col class="img"  cols="6"/>
      <v-col cols="6" class="form-container">
        <v-card class="field-container">
          <h3 class="text-subtitle-1 text-medium-emphasis">Login</h3>
          <v-text-field
            density="compact"
            placeholder="Email address"
            prepend-inner-icon="mdi-email-outline"
            outlined
          ></v-text-field>
          <v-text-field
            type="password"
            density="compact"
            placeholder="Enter your password"
            prepend-inner-icon="mdi-lock-outline"
            outlined
          ></v-text-field>
          <v-btn
            block
            class="mb-3 mt-5 btn"
          >
            Log In
          </v-btn>

          <v-card-text class="text-center">
            <a
              class="text-blue text-decoration-none"
              href="#"
              rel="noopener noreferrer"
              target="_blank"
            >
              Sign up now
            </a>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>

export default {
  title: "LoginPage",
  data: () => ({
    image: require(`../../assets/blogImage4.jpg`),
  }),
};

</script>

<style lang="scss" scoped>

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

.btn{
    background-color: aqua !important;
    color: #fff;
}

</style>
