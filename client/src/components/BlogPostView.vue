<template>
  <div class="blog-container">
    <div v-if="!editMode">
      <div class="blog-image-container col-md-12">
        <img class="img-fluid" :src="blog.image" />
      </div>
      <div class="blog-title col-md-12">{{ blog.title }}</div>
      <div class="blog-content-container col-md-12">
        <div class="blog-content">{{ blog.content }}</div>
      </div>
      <div class="col-md-12 button-container">
        <button type="button" @click="editPost">
          <v-icon large>edit</v-icon>
        </button>
        <button type="button" @click="deletePost" class="ml-8">
          <v-icon large>delete</v-icon>
        </button>
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
  </div>
</template>

<script>

import BlogPost from './BlogPost.vue';

export default {
  components: { BlogPost },
  title: "BlogPostView",
  data: () => ({
    blog: {
      image: require(`../assets/blogImage4.jpg`),
      title: "Pre-Conference Session: Don't Start a Church, Plant One!",
      content:
        "Church planting isn't easy, but it also isn't complicated. Nowadays, many church planters believe you need to raise a bunch of money, figure out how to gather a big crowd, and be a funny, relatable, extroverted, bible scholar if you're going to succeed. But the Apostle Paul didn't fit that bill, and you don't have to either. There are just four steps to planting a church, and we'll unpack how each of them gets applied on the ground in this interactive pre-conference:",
    },
    cart: true,
    editMode: false,
  }),

  methods: {
    editPost() {
      if(this.editMode){
        this.editMode = false;
      } else {
        this.editMode = true;
      }
      
    },
    deletePost() {
      console.log("delete");
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
  margin-top: 2%;
  // width: 70%;
}

.blog-image-container {
  position: relative;
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

// .blog-container:hover {
//     box-shadow: 0.625rem 0.625rem 0.6875rem rgba(142, 202, 230, 0.0588235294);
// }

.button-container {
  margin: 20px 0px 10px;
  display: flex;
  justify-content: right;
}

// .child-component-container{
//   display: flex;
//   justify-content: center;
// }

</style>
