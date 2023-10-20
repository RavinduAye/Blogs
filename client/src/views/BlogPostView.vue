<template>
  <v-main>
    <div class="blog-container-parent" v-if="!editMode">
      <div
        :class="!showButton ? 'blog-container' : 'blog-view'"
        @click="postClicked(blog.id)"
      >
        <div>
          <div class="button-container">
            <div class="dropdown" v-if="showButton">
              <div class="dropbtn">
                <v-icon>mdi-dots-vertical</v-icon>
              </div>
              <div class="dropdown-content">
                <div @click="editPost">Edit</div>
                <div @click="deletePost">Delete</div>
              </div>
            </div>
          </div>
          <div
            :class="!showButton ? 'blog-title' : 'blog-title title-background'"
          >
            {{ blog.title | truncate(255, "...")}} 
          </div>
          <div v-if="!showButton" class="blog-content-container col-md-12">
            <div class="blog-content">
              {{ blog.content | truncate(255, "...") }}
              <span style="color: #01bf71">Read More</span>
            </div>
          </div>
          <div v-else class="blog-content-container col-md-12">
            <div class="blog-content">
              {{ blog.content }}
            </div>
          </div>
          <div class="bottom-container">
            <div class="author">{{ blog.creator }}</div>
            <div>{{ blog.date }}</div>
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
      title:
        "Pre-Conference Session: Don't Start a Church, Plant One! Pre-Conference Session: Don't Start a Church, Plant One! Pre-Conference Session: Don't Start a Church, Plant One! ",
      content:
        "Church planting isn't easy, but it also isn't complicated. Nowadays, many church planters believe you need to raise a bunch of money, figure out how to gather a big crowd, and be a funny, relatable, extroverted, bible scholar if you're going to succeed. But the Apostle Paul didn't fit that bill, and you don't have to either. There are just four steps to planting a church, and we'll unpack how each of them gets applied on the ground in this interactive pre-conference:",
      creator: "Ravindu Amaya",
      date: "2022.02.02",
    },
    cart: true,
    editMode: false,
    menu: true,
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
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 10px;
  position: relative;
  cursor: pointer;
}

.blog-view {
  width: 80%;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 10px;
  position: relative;
  margin-top: 25px;
}

.blog-image-container {
  display: flex;
  justify-content: center;
}

.blog-title {
  color: #023047;
  text-align: left;
  font-size: 1.8rem;
  font-weight: 500;
  line-height: 1.4;
  letter-spacing: 0px;
  text-overflow: ellipsis;
  font-family: Poppins, sans-serif;
  margin: 15px 10px 10px;
}

.title-background {
  background-color: #01bf71;
  padding: 20px;
  color: #fff;
}

.blog-content {
  font-family: Poppins, sans-serif;
  text-align: justify;
  line-height: 1.45;
}

.blog-container:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.button-container {
  margin-top: 2%;
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

.bottom-container {
  color: #000;
  padding: 10px;
  text-align: right;
}

.author {
  font-weight: 500;
}

.dropbtn {
  color: white;
  padding: 8px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  border-radius: 50%;
  border: 1px solid grey;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  right: 0;
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.dropdown-content div {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  cursor: pointer;
}

.dropdown-content div:hover {
  background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
