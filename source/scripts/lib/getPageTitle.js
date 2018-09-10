const getPageTitle = (title) => {
  return `${window.__CONFIG_STORE__.pageTitlePrefix || "BKW Group | "} ${title}`;
};

export default getPageTitle;
