import { observable, action } from 'mobx';
import api from "../lib/api";

class HistoryStore {
  @observable data = null;

  @action fetch() {
    api("history")
      .then(data => this.data = data)
  }
}
const historyStore = new HistoryStore();

export default historyStore;

