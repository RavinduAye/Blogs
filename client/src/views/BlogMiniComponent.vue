<template>
  <v-main>
    <div class="blog-container-parent">
      <div class="blog-container" @click="postClicked()">
        <div>
          <div class="blog-title">
            {{ blog.title | truncate(255, "...") }}
          </div>
          <div class="blog-content-container col-md-12">
            <div class="blog-content">
              {{ blog.content | truncate(255, "...") }}
              <span style="color: #01bf71">Read More</span>
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
  </v-main>
</template>

<script>
export default {
  title: "BlogMiniComponent",
  data: () => ({
    blog: {},
    cart: true,
    editMode: false,
    menu: true,
    authUser: null,
    blogId: null,
  }),

  props: {
    blogPost: {
      type: Object,
      default: () => {},
    },
  },

  filters: {
    truncate: function (text, stop, clamp) {
      return (
        text && text.slice(0, stop) + (stop < text.length ? clamp || "..." : "")
      );
    },
  },

  async mounted() {
    this.blog = this.blogPost;
  },

  methods: {
    postClicked() {
      {
        this.$router.push({
          name: "Blog",
          params: { id: this.blogPost.id },
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
  width: -webkit-fill-available;
  min-height: 30vh;
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
</style>
