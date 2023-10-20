import axios from "axios";
// @ts-ignore  
import conf from "../conf.yml";

const AUTH_KEY = "app-user-token";

declare const window: any;


 // This module handle the auth user


/* eslint-disable @typescript-eslint/camelcase */
export default {
  TOKEN_KEY: AUTH_KEY,
  authenticated: false,
  user: {
    firstName: "",
    lastName: "",
    email: "",
    token: "",
    expiresAt: null,
    rememberToken: null,
    isRememberToken: false,
    id: null,
  },

  login(credentials: any) {
    const url = conf.default.server.host + "/api/login";
    const uninterceptedAxiosInstance = axios.create();

    return uninterceptedAxiosInstance
      .post(url, credentials)
      .then((response) => {
        if (response.data && response.data.success) {
          this.setAuth(response.data.success);
        }
        return response;
      });
  },
  setAuth(data: any): void {
    this.user.firstName = data.first_name;
    this.user.lastName = data.last_name;
    this.user.email = data.email;
    this.user.token = data.token;
    this.user.rememberToken = data.rememberToken;
    this.user.expiresAt = data.expires_at;
    this.user.id = data.id;
    this.user.isRememberToken = data.isRememberToken;


    this.can = {}; // permissions

    window.localStorage.setItem(AUTH_KEY, JSON.stringify(this.user));

    window.Echo.connector.pusher.config.auth.headers["Authorization"] =
      "Bearer " + data.token;
  },
  updateAuth(data: any, updateLocalstorage = false): void {
    if (!data) {
      return;
    }

    this.user.firstName = data.firstName || this.user.firstName;
    this.user.lastName = data.lastName || this.user.lastName;
    this.user.email = data.email || this.user.email;
    this.user.token = data.token || this.user.token;
    this.user.rememberToken = data.rememberToken || this.user.rememberToken;
    this.user.expiresAt = data.expiresAt || this.user.expiresAt ;
    this.user.id = data.id || this.user.id;
    this.user.isRememberToken = data.isRememberToken || this.user.isRememberToken;

    if (updateLocalstorage === true) {
      window.localStorage.setItem(AUTH_KEY, JSON.stringify(this.user));
    }
  },

  checkAuth(): boolean {
    const authJson = window.localStorage.getItem(AUTH_KEY) as any;
    const authData = JSON.parse(authJson);
    this.updateAuth(authData);
    if (authData && authData.token) {
      this.authenticated = true;
    } else {
      this.authenticated = false;
    }
    return this.authenticated;
  },
  
  getAuthToken(): string {
    return "Bearer " + this.user.token;
  },

  getRememberToken(): string {
    return "Bearer " + this.user.rememberToken;
  },
};
