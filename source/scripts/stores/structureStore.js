import { observable, action, computed } from 'mobx';
import api from "../lib/api";

class StructureStore {
  @observable data = null;
  @observable active = null;
  @observable nextSlug = null;
  @observable prevSlug = null;

  @action
  fetch(callback) {

    if(!this.data) {
      api("structure").then(data => {
        this.data = data;
        callback();
      })
    } else {
      callback();
    }
  }

  @action
  getById(id) {
    return this.data.directions.filter(item => item.id === id)[0];
  }
  @action
  getBySlug(id) {
    return this.data.directions.filter(item => item.slug === id)[0];
  }

  @action
  getIndexBySlug(slug) {
    return this.data.directions.findIndex(item => item.slug === slug);
  }

  @action
  setPrevId(currentIndex) {
    let prevIndex;
    if(currentIndex === 0) {
      prevIndex = this.count - 1;
    } else {
      prevIndex = currentIndex - 1;
    }

    this.prevSlug = this.data.directions[prevIndex].slug;
  }
  @action
  setNextId(currentIndex) {
    let nextIndex;
    if(currentIndex + 1 === this.count) {
      nextIndex = 0;
    } else {
      nextIndex = currentIndex + 1;
    }

    this.nextSlug = this.data.directions[nextIndex].slug;
  }


  setActive(slug) {
    const index = this.getIndexBySlug(slug);

    if(index !== -1) {
      this.active = this.data.directions[index];
      this.setNextId(index);
      this.setPrevId(index);

    } else {
      console.log({
        type: "ReferenceError",
        message: `Item with id: ${slug} is not exist`
      })
    }
  }

  @computed get prevTitle() {
    if(this.prevSlug) {
      return this.getBySlug(this.prevSlug).title;
    }

  }
  @computed get nextTitle() {
    if(this.nextSlug) {
      return this.getBySlug(this.nextSlug).title;
    }
  }

  @computed
  get count() {
    return this.data.directions.length;
  }
}
const structureStore = new StructureStore();

export default structureStore;

