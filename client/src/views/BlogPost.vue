<template>
  <v-main>
    <div class="field-container" @click="postClicked(postId)">
      <div v-if="!isEdit">Create New</div>
      <div class="mt-5">
        <v-text-field
          v-model="model.title"
          label="Title"
          maxlength="255"
          counter
          :rules="[rules.required, rules.titleCounter]"
          clearable
        ></v-text-field>
      </div>
      <div class="col-md-12">
        <v-textarea
          v-model="model.content"
          label="Content"
          maxlength="1000"
          counter
          :rules="[rules.required, rules.contentCounter]"
          clearable
        ></v-textarea>
      </div>
      <div class="button-container">
        <div v-if="isEdit">
          <v-btn
            class="btn"
            color="blue"
            :disabled="!model.title || !model.content"
            @click="save"
            >Save</v-btn
          >
          <v-btn class="btn" color="#ff6347" @click="cancel">Cancel</v-btn>
        </div>
        <div v-else>
          <v-btn
            class="btn"
            color="blue"
            :disabled="!model.title || !model.content"
            @click="publish"
            >Publish</v-btn
          >
        </div>
      </div>
    </div>
  </v-main>
</template>

<script>

import axios from "axios";

export default {
  title: "BlogPost",
  data: () => ({
    blog: {
      image: require(`../assets/blogImage4.jpg`),
    },
    loading: false,
    model: {
      title: "",
      content: "",
    },
    rules: {
      required: (value) => !!value || "This field is Required.",
      titleCounter: (value) => value.length <= 255 || "Max 255 characters",
      contentCounter: (value) => value.length <= 1000 || "Max 1000 characters",
    },
  }),

  props: {
    title: {
      type: String,
      default: "",
    },
    content: {
      type: String,
      default: "",
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
  },

  mounted() {
      this.model.title = this.title;
      this.model.content = this.content;
  },

  methods: {

    postClicked(id){
      console.log(id);
    },

    publish(){
      const data = {
        title: this.model.title,
        content: this.model.content,
      };
      axios
        .post(`/api/blog`, data)
        .then(() => {
          console.log("Blog published successfully");
        })
        .catch(() => {
          console.log("Something went wrong");
        });
    },

    save() {
      const data = {
        title: this.model.title,
        content: this.model.content,
      };
      axios
        .put(`/blog/${this.blog.id}`, data)
        .then(() => {
          console.log("Blog updated successfully");
        })
        .catch(() => {
          console.log("Something went wrong");
        });
    },

    cancel() {
      this.$emit("edit-post", false);
    },
  },
};
</script>

<style lang="scss" scoped>
.field-container {
  transition: box-shadow 0.3s;
  background-color: #fff;
  border-radius: 1rem;
  padding: 0.625rem;
  text-align: left;
  letter-spacing: 0.01rem;
  font-size: 1rem;
  margin-top: 5%;
  width: 70%;
}

.button-container {
  margin: 50px 0px 10px 0px;
  display: flex;
  justify-content: right;
}

.btn {
  margin-left: 20px;
  color: #fff;
}

::v-deep .v-main__wrap{
  display: flex;
  justify-content: center;
}

</style>