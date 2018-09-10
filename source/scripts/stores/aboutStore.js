import { observable, action, computed } from 'mobx';
import api from "../lib/api";

class AboutStore {
  @observable data = null;

  @action fetch() {
    api("about")
      .then(data => this.data = data)
  }

  @computed get companies() {
    return this.data.companies;
  }
  @computed get founders() {
    return this.data.founders;
  }
}
const aboutStore = new AboutStore();

export default aboutStore;

