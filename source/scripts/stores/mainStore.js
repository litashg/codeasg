import { observable, action } from "mobx";
import api from "../lib/api";

class MainStore {
  @observable data = null;

  @action fetch() {
    api("main").then(data => {
      this.data = data
    });
  }
}

const mainStore = new MainStore();

export default mainStore;
