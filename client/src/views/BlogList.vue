<template>
  <div class="container">
    <v-row>
      <v-col v-for="blog in blogs" v-bind:key="blog.id" cols="4">
        <blog-mini-component :blogPost="blog" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import BlogMiniComponent from "./BlogMiniComponent.vue";
import conf from "../conf";
import auth from "../auth";

export default {
  title: "BlogList",
  components: {
    BlogMiniComponent,
  },
  data: () => ({
    loading: false,
    blogs: [],
  }),

  mounted() {
    this.getBlogs();
  },

  methods: {
    async getBlogs() {
      if (auth.user.id) {
        this.blogs = auth.user.blogs;
      } else {
        const response = await fetch(conf.server.host + `/api/blogs`);
        const jsonResponse = await response.json();
        this.blogs = jsonResponse.blogs;
      }
    },
  },
};
</script>
