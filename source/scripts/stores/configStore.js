import { observable, action, computed } from 'mobx';

const globalConfig = window.__CONFIG_STORE__;

class ConfigStore {
  @observable themeType = 'dark'; // dark, light
  @observable pageDepth = 'welcome'; // welcome, slide, inside, error
  @observable languages = globalConfig.languages;
  @observable currentLang = globalConfig.currentLanguage;
  @observable siteLogo = globalConfig.siteLogo;
  @observable i18n = {};
  @observable slides = globalConfig.slides;


  @action setPageConfig(theme = "dark", pageDepth = "welcome") {
    this.themeType = theme;
    this.pageDepth = pageDepth;
  }

  @computed get theme() {
    return this.themeType;
  }
  @computed get depth() {
    return this.pageDepth;
  }
}
const configStore = new ConfigStore();

export default configStore;
