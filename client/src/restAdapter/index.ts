import axios from "axios";
// @ts-ignore  
import * as conf from "../conf.yml"
import auth from "../auth";

/**
 * This module handle the api requests
 */
const TOKEN_INVALID_MESSAGE = 'invalid token';

const isTokenInvalid = (error) => {
  if (
    error.response &&
    error.response.status === 403 &&
    error.response.data.message &&
    error.response.data.message.toLowerCase() === TOKEN_INVALID_MESSAGE
  ) return true;

  return false;
}

const navigateToLogin = () => {
  window.location.href = `${window.location.origin}/#/login`;
}

export default {
  get(route: string) {
    const url = conf.default.server.host + route;
    let options = {};
    if (auth.user.isRememberToken) {
      options = {
        headers: { Authorization: auth.getRememberToken() },
      };
    } else {
      options = {
        headers: { Authorization: auth.getAuthToken() },
      };
    }

    return axios.get(url, options)
      .catch((error) => {
        if (isTokenInvalid(error)) navigateToLogin();
        throw error;
      });
  },
  post(route: string, payload: any, config: any) {
    const url = conf.default.server.host + route;
    const options = {
      ...config,
      headers: { Authorization: auth.getAuthToken() },
    };

    return axios.post(url, payload, options)
      .catch((error) => {
        if (isTokenInvalid(error)) navigateToLogin ();
        throw error;
      });
  },
  put(route: string, payload: any) {
    const url = conf.default.server.host + route;
    const options = {
      headers: { Authorization: auth.getAuthToken() },
    };

    return axios.put(url, payload, options)
      .catch((error) => {
        if (isTokenInvalid(error)) navigateToLogin();
        throw error;
      });
  },
  delete(route: string, payload: any) {
    const url = conf.default.server.host + route;
    const options = {
      headers: { Authorization: auth.getAuthToken() },
      data: payload,
    };

    return axios.delete(url, options)
      .catch((error) => {
        if (isTokenInvalid(error)) navigateToLogin();
        throw error;
      });
  },
};
