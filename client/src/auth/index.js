import axios from "axios"; 
import conf from "../conf";

const AUTH_KEY = "app-user-token";

 // This module handle the auth user

export default {
  TOKEN_KEY: AUTH_KEY,
  authenticated: false,
  user: {
    firstName: "",
    lastName: "",
    email: "",
    token: "",
    id: null,
    blogs: null,
  },

  login(credentials) {
    const url = conf.server.host + "/api/login";
    const uninterceptedAxiosInstance = axios.create();

    return uninterceptedAxiosInstance
      .post(url, credentials)
      .then((response) => {
        if (response.data && response.data.success) {
          this.setAuth(response.data.success);
          window.dispatchEvent(new CustomEvent('user-logged', { detail: this.user }));
        }
        return response;
      });
  },
  setAuth(data) {
    this.user.firstName = data.first_name;
    this.user.lastName = data.last_name;
    this.user.email = data.email;
    this.user.token = data.token;
    this.user.id = data.id;
    this.user.blogs = data.blog_posts;
    window.localStorage.setItem(AUTH_KEY, JSON.stringify(this.user));
  },
  
  getAuthToken() {
    return "Bearer " + this.user.token;
  },
};
