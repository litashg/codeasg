import axios from "axios";
const API_PAGES_BASE_URL = `${window.__CONFIG_STORE__["apiBaseUrl"]}`;

export const serverRequest = (type, page, lang, params) => {

  console.log({
    type: "ServerRequestStart",
    message: "Start server request, because local data not found"
  });

  const requestParams = Object.assign({}, {lang}, params);

  return axios({
    method: "get",
    url: `${API_PAGES_BASE_URL}/${type}/${page}`,
    params: requestParams,
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json"
    }
  })
};

