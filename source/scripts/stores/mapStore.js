import { observable, action, computed } from "mobx";
import api from "../lib/api";

const MAP_PLAN_KEY = "_map_shown_status_";

class MapStore {
  @observable data = {};
  // @observable points = [];
  // @observable countries = [];
  @observable isPlansShown = JSON.parse(window.localStorage.getItem(MAP_PLAN_KEY)) || false;

  @action
  fetch(callback) {
      api("map", "pages").then(data => {
        this.data = data;
        callback();
      });
  }

  @computed
  get countries() {
    return this.data.countries;
  }

  @computed
  get points() {
    return this.data.points;
  }

  @computed
  get controls() {
    return this.data.controls;
  }

  @action
  togglePlans() {
    this.isPlansShown = !this.isPlansShown;
    window.localStorage.setItem(MAP_PLAN_KEY, this.isPlansShown);
  }
}

const mapStore = new MapStore();

export default mapStore;
