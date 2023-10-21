<template>
  <v-main>
    <div class="blog-container-parent" v-if="!editMode">
      <div class="blog-view">
        <div>
          <div class="button-container" v-if="authUser">
            <div class="dropdown">
              <div class="dropbtn">
                <v-icon>mdi-dots-vertical</v-icon>
              </div>
              <div class="dropdown-content">
                <div @click="editPost">Edit</div>
                <div @click="deletePost">Delete</div>
              </div>
            </div>
          </div>
          <div class="blog-title title-background">
            {{ blog.title }}
          </div>
          <div class="blog-content-container col-md-12">
            <div class="blog-content">
              {{ blog.content }}
            </div>
          </div>
          <div class="bottom-container">
            <div class="author" v-if="!authUser">
              {{ blog.owner.first_name }} {{ blog.owner.last_name }}
            </div>
            <div>{{ blog.published_date }}</div>
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
import conf from "../conf";
import auth from "../auth";

export default {
  components: { BlogPost },
  title: "BlogPostView",
  data: () => ({
    image: require(`../assets/blogImage4.jpg`),
    blog: {},
    cart: true,
    editMode: false,
    menu: true,
    authUser: null,
    blogId: null,
  }),

  filters: {
    truncate: function (text, stop, clamp) {
      return (
        text && text.slice(0, stop) + (stop < text.length ? clamp || "..." : "")
      );
    },
  },

  async mounted() {
    this.blogId = this.$route.params.id;
    this.authUser = auth.user.id;
    this.getBlogData();
  },

  methods: {
    async getBlogData() {
      await axios
        .get(conf.server.host + `/api/blogs/${this.blogId}`)
        .then((response) => {
          this.blog = response.data.blog;
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
          .delete(conf.server.host + `/api/blogs/${this.blogId}`, {
            headers: { Authorization: auth.getAuthToken() },
          })
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
.blog-view {
  width: 80%;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 10px;
  position: relative;
  margin-top: 25px;
  width: 80vw !important;
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

.button-container {
  margin-top: 2%;
  display: flex;
  justify-content: right;
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
