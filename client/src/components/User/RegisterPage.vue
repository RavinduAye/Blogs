<template>
  <div>
    <v-row>
      <v-col class="img"  cols="6"/>
      <v-col cols="6" class="form-container">
        <v-card class="field-container">
          <h3 class="text-subtitle-1 text-medium-emphasis">Register</h3>
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
          <v-btn
            block
            class="mb-3 mt-5 btn"
          >
            Sign Up
          </v-btn>

          <v-card-text class="text-center">
            <a
              class="text-blue text-decoration-none"
              href="#"
              rel="noopener noreferrer"
              target="_blank"
            >
              Log in now
            </a>
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
