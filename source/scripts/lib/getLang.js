export const getLang = () => {
  let htmlLang = document.documentElement.lang;

  switch (htmlLang) {
    case 'uk-UA': return 'ua';
    case 'en-US': return 'en';
    case 'ru-RU': return 'ru';
    default: return 'ua';
  }
};

