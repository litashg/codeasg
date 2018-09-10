import React from "react";

const langUrl = window.__CONFIG_STORE__.currentLanguage.url;

const buildUrl = (langPrefix, pageUrl) => {
  // console.log("LANG PREFIX", langPrefix, "PAGE", pageUrl);

  if(langPrefix === "/") {
    return pageUrl;
  }

  if(pageUrl === "/") {
    return langPrefix;
  } else {
    return `${langPrefix}${pageUrl}`
  }
};

const withLangRoute = (WrappedComponent) => ({path, ...props}) => {
  const to = buildUrl(langUrl, path);
  // console.log("TO", to);

  return <WrappedComponent path={to} {...props} />
};

export default withLangRoute;
