import { observable, action, computed } from 'mobx';
import api from '../lib/api';

class ContactsStore {
  @observable data = null;

  @action fetch() {
    api("contacts")
      .then(data => this.data = data)
  }
}
const contactsStore = new ContactsStore();

export default contactsStore;

