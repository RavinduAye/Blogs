<template>
  <v-app>
    <v-main>
      <carousel-slide />
    </v-main>
    <blog-list />
  </v-app>
</template>

<script>
import CarouselSlide from "../components/CarouselSlide.vue";
import BlogList from "../views/BlogList.vue";

export default {
  name: "HomePage",

  components: {
    CarouselSlide,
    BlogList,
  },
};
</script>
