<template>
  <div class="container">
    <v-row>
      <v-col v-for="blog in blogs" v-bind:key="blog.id" cols="4">
        <blog-post-view :block="blog" :showButton="false" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import axios from "axios";
import BlogPostView from "./BlogPostView.vue";

export default {
  title: "BlogList",
  components: {
    BlogPostView,
  },
  data: () => ({
    loading: false,
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

  methods: {
    getBlogs() {
      if (this.auth.user) {
        axios
          .get(`/api/owner/blog/${this.auth.user.id}`)
          .then((response) => {
            this.blogs = response.data.blogs;
          })
          .catch(() => {
            console.log("Something went wrong");
          });
      } else {
        axios
          .get(`/api/blogs`)
          .then((response) => {
            this.blogs = response.data.blogs;
          })
          .catch(() => {
            console.log("Something went wrong");
          });
      }
    },
  },
};
</script>
