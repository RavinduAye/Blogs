<template>
  <v-main>
    <div class="blog-container-parent">
      <div
        :class="!showButton ? 'blog-container' : 'blog-view'"
        @click="postClicked(blog.id)"
      >
        <div v-if="!editMode">
          <div class="col-md-12 button-container" v-if="showButton">
            <button type="button" @click="editPost">
              <v-icon large>edit</v-icon>
            </button>
            <button type="button" @click="deletePost" class="ml-8">
              <v-icon large>delete</v-icon>
            </button>
          </div>
          <div class="blog-title col-md-12">{{ blog.title }}</div>
          <div v-if="!showButton" class="blog-content-container col-md-12">
            <div class="blog-content">
              {{ blog.content | truncate(280, "...") }}
              <span style="color: red">Read More</span>
            </div>
          </div>
          <div v-else class="blog-content-container col-md-12">
            <div class="blog-content">
              {{ blog.content }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="child-component-container" v-if="editMode">
      <blog-post
        :title="blog.title"
        :content="blog.content"
        :isEdit="true"
        @edit-post="editPost()"
      />
    </div>
  </v-main>
</template>

<script>
import BlogPost from "./BlogPost.vue";
import axios from "axios";

export default {
  components: { BlogPost },
  title: "BlogPostView",
  data: () => ({
    image: require(`../assets/blogImage4.jpg`),
    blog: {
      id: 1,
      title: "Pre-Conference Session: Don't Start a Church, Plant One!",
      content:
        "Church planting isn't easy, but it also isn't complicated. Nowadays, many church planters believe you need to raise a bunch of money, figure out how to gather a big crowd, and be a funny, relatable, extroverted, bible scholar if you're going to succeed. But the Apostle Paul didn't fit that bill, and you don't have to either. There are just four steps to planting a church, and we'll unpack how each of them gets applied on the ground in this interactive pre-conference:",
    },
    cart: true,
    editMode: false,
  }),

  props: {
    block: {
      type: Object,
      default: () => {},
    },
    showButton: {
      type: Boolean,
      default: true,
    },
  },

  filters: {
    truncate: function (text, stop, clamp) {
      return (
        text && text.slice(0, stop) + (stop < text.length ? clamp || "..." : "")
      );
    },
  },

  mounted() {
    this.blog.id = this.$route.params.id;
    this.getBlogData();
  },

  methods: {
    postClicked(id) {
      console.log(id);
      if (!this.showButton) {
        this.$router.push({
          name: "Blog",
          params: { id: id },
        });
      }
    },

    getBlogData() {
      axios
        .get(`/api/blog/${this.blog.id}`)
        .then((response) => {
          this.model.title = response.data.title;
          this.model.content = response.data.content;
        })
        .catch(() => {
          console.log("Something went wrong");
        });
    },

    editPost() {
      if (this.editMode) {
        this.editMode = false;
      } else {
        this.editMode = true;
      }
    },

    deletePost() {
      if (confirm("Do you want to delete this blog?")) {
        axios
          .delete(`/api/blog/${this.blog.id}`)
          .then(() => {
            console.log("Blog deleted successfully");
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
.blog-container {
  transition: box-shadow 0.3s;
  background-color: #fff;
  border-radius: 1rem;
  padding: 0.625rem;
  text-align: left;
  letter-spacing: 0.01rem;
  font-size: 1rem;
  border: 1px solid rgb(77, 73, 73);
  cursor: pointer;
}

.blog-view {
  width: 80%;
}

.blog-image-container {
  display: flex;
  justify-content: center;
}

.blog-title {
  color: #023047;
  text-align: left;
  font-size: 1.8rem;
  line-height: 1.4;
  letter-spacing: 0px;
  text-overflow: ellipsis;
  font-family: "komu-a", Verdana, Arial, sans-serif;
  font-weight: 400;
  margin: 25px 0px;
}

.blog-content {
  color: #219ebc;
  font-family: "Work Sans", sans-serif;
  text-align: justify;
  line-height: 1.45;
}

.blog-container:hover {
  box-shadow: 0.625rem 0.625rem 0.6875rem rgba(142, 202, 230, 0.0588235294);
}

.button-container {
  margin-top: 2%;
  background-color: grey;
  display: flex;
  justify-content: right;
}

.img {
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
}

.blog-container-parent {
  display: flex;
  justify-content: center;
}
</style>
