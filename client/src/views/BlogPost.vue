<template>
  <v-main>
    <div class="field-container">
      <div v-if="!isEdit" class="titile-heading">Create New</div>
      <div class="mt-5">
        <v-text-field
          v-model="blog.title"
          label="Title"
          maxlength="255"
          counter
          :rules="[rules.required, rules.titleCounter]"
          clearable
        ></v-text-field>
      </div>
      <div>
        <v-textarea
          v-model="blog.content"
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
            :disabled="!blog.title || !blog.content"
            @click="save"
            >Save</v-btn
          >
          <v-btn class="cancel-btn" color="#ff6347" @click="cancel"
            >Cancel</v-btn
          >
        </div>
        <div v-else>
          <v-btn
            class="btn"
            :disabled="!blog.title || !blog.content"
            @click="publish()"
            >Publish</v-btn
          >
        </div>
      </div>
    </div>
  </v-main>
</template>

<script>
import axios from "axios";
import conf from "../conf";
import auth from "../auth";

export default {
  title: "BlogPost",
  data: () => ({
    loading: false,
    blog: {
      id: null,
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
    this.blog.id = this.$route.params.id;
    this.blog.title = this.title;
    this.blog.content = this.content;
  },

  methods: {
    publish() {
      const data = {
        title: this.blog.title,
        content: this.blog.content,
      };
      axios
        .post(conf.server.host + `/api/blogs`, data, {
          headers: { Authorization: auth.getAuthToken() },
        })
        .then(() => {
          console.log("Blog published successfully");
        })
        .catch(() => {
          console.log("Something went wrong");
        });
    },

    save() {
      const data = {
        title: this.blog.title,
        content: this.blog.content,
      };
      axios
        .put(conf.server.host + `/api/blogs/${this.blog.id}`, data, {
          headers: { Authorization: auth.getAuthToken() },
        })
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
.cancel-btn {
  margin-left: 20px;
  color: #fff;
  width: 150px;
  height: 45px !important;
}

.btn {
  width: 150px;
  height: 45px !important;
  margin-left: 20px;
  color: #fff;
  background: linear-gradient(to right, #8e2de2, #4a00e0);
}

::v-deep .v-main__wrap {
  display: flex;
  justify-content: center;
}

.titile-heading {
  margin-bottom: 3%;
  color: #01bf71;
  font-size: 36px;
  font-weight: 600;
}
</style>
