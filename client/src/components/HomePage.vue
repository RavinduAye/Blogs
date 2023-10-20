<template>
  <v-app>
    <v-app-bar 
      app
      color="to top right, rgba(55,236,186,.7), rgba(25,32,72,.7)"
      dark
    >
      <template>
        <v-tabs v-model="currentItem" slider-color="white">
          <v-spacer></v-spacer>
          <v-tab href="#home">Home</v-tab>
          <v-tab href="#new_post">Write</v-tab>
        </v-tabs>
      </template>
    </v-app-bar>
    <template>
      <v-tabs-items v-model="currentItem">
        <v-tab-item value="home">
          <v-card flat>
            <v-main>
              <carousel-slide/>
              <div class="container">
                <div class="component-container">
                  <blog-post-view/>
                </div>
              </div>
            </v-main>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
      <v-tabs-items v-model="currentItem">
        <v-tab-item value="new_post">
          <v-card flat>
            <v-main>
                <div class="container">
                <div class="component-container mb-10">
                    <blog-post/>
                </div>
                </div>
            </v-main>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </template>
  </v-app>
</template>

<script>
import BlogPost from '../components/BlogPost.vue';
import BlogPostView from "../components/BlogPostView.vue";
import CarouselSlide from "../components/CarouselSlide.vue";

export default {
  name: "HomePage",

  components: {
    BlogPostView,
    CarouselSlide,
    BlogPost,
  },

  data: () => ({
    currentItem: "home",
  }),
};
</script>

<style lang="scss" scoped>

.container{
  display: flex;
  justify-content: center;
}

.component-container{
  width: 70%;
}
</style>
