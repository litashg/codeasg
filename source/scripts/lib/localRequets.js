const API_LOCAL_BASE = "_local_saved_page_data";

const localRequest = (page, lang) => {
  return new Promise((resolve, reject) => {
    const pageObject = window.sessionStorage.getItem(`${API_LOCAL_BASE}_${page}`);


    if(pageObject) {
      const pageData = JSON.parse(pageObject);

      if(pageData.lang && pageData.lang === lang) {
        resolve(pageData);

        console.log({
          type: "LocalRequestSuccess",
          message: `Local data for (${page}) is found`,
          data: pageData
        })

      } else {
        reject({
          type: "LocalRequestError",
          message: `Saved lang (${pageData.lang}) !== argument lang (${lang})`
        });
      }

    } else {
      reject(reject({
        type: "LocalRequestError",
        message: `There are nothing data for ${page}`
      }))
    }
  })
};

const saveLocal = (page, lang, data) => {
  clearLocal(page);

  const value = {
    lang,
    data,
    modifiedAt: Date.now()
  };
  const key = `${API_LOCAL_BASE}_${page}`;

  window.sessionStorage.setItem(key, JSON.stringify(value))
};

const clearLocal = (page) => {
  console.log("LocalStorage was cleared");
  window.sessionStorage.removeItem(`${API_LOCAL_BASE}_${page}`);
};

export {
  saveLocal,
  localRequest,
  clearLocal
}
