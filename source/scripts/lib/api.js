import {localRequest, saveLocal, clearLocal} from "./localRequets";
import { serverRequest } from "./serverRequets";
import { getLang } from "./getLang";

const lang = getLang();

const report = (start, request = "") => {
  const endTime = Date.now();
  console.info("TimeTracker", {
    report: `${endTime - start}ms`,
    forPage: request,
  });
};

const api = (page, parent = "pages", params = {}) => {
  const startTime = Date.now();

  return new Promise((resolve, reject) => {
    // localRequest(`${parent}_${page}`, lang)
    //   .then(res => {
    //
    //     report(startTime, page);
    //
    //     resolve(res.data);
    //   })
    //   .catch(err => {

        serverRequest(parent, page, lang, params)
          .then(res => {
            const data = res.data;

            console.log({
              type: "ServerRequestSuccess",
              message: `Local data is here`,
              data: data
            });

            saveLocal(`${parent}_${page}`, lang, data);
            report(startTime, page);
            resolve(data);
          })
          .catch(err => {
            reject({
              type: "ServerRequestError",
              page: page,
              message: err.message
            });
          });
      })
  // })

};


export default api;

