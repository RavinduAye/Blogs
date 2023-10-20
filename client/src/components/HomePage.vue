<template>
  <v-app>
    <v-app-bar
      app
      color="to top right, rgba(55,236,186,.7), rgba(25,32,72,.7)"
      dark
    >
      <template>
        <v-tabs v-model="currentItem" slider-color="white" v-if="auth.user">
          <v-spacer></v-spacer>
          <v-tab href="#home">Home</v-tab>
          <v-tab href="#new_post">Write</v-tab>
        </v-tabs>
        <v-tabs v-else>
          <v-spacer></v-spacer>
          <v-tab href="/login">Sign in</v-tab>
        </v-tabs>
      </template>
    </v-app-bar>
    <template>
      <v-tabs-items v-model="currentItem">
        <v-tab-item value="home">
          <v-card flat>
            <v-main>
              <carousel-slide />
              <div class="container">
                <div class="component-container">
                  <v-row>
                    <v-col v-for="blog in blogs" v-bind:key="blog.id" cols="4">
                      <blog-post-view :block="blog" :showButton="false" />
                    </v-col>
                  </v-row>
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
                  <blog-post />
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
import BlogPost from "../components/BlogPost.vue";
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
    auth: {
      user: null,
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

  mounted() {},

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

<style lang="scss" scoped>
.container {
  display: flex;
  justify-content: center;
}

.component-container {
  width: 100%;
}
</style>
