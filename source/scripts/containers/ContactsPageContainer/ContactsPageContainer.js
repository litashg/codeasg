import React, { Component } from 'react';
import {inject, observer} from "mobx-react/index";
import Map from "../../components/Map";
import { toJS } from "mobx";
import getPageTitle from "../../lib/getPageTitle";
import {Helmet} from "react-helmet";

@inject('configStore', 'contactsStore')
@observer
class ContactsPageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("dark", "slide");
    this.store = this.props.contactsStore;
  }

  componentDidMount() {
    console.log('Contacts Mounted');
    this.store.fetch();
  }

  render() {

    console.log(toJS(this.store.data));

    if(!this.store.data) {
      return null;
    }

    const { title, contacts } = this.store.data;

    return (
      <div className="m-contacts">
        <Helmet>
          <title>{ getPageTitle(this.store.data.title) }</title>
        </Helmet>
        <div className="m-contacts__head">
          <h1 className="m-contacts__title a-text-h2 a-color-light">{title}</h1>
          <div className="m-contacts__label a-text-decor">{contacts.companyName}</div>
        </div>

        <div className="m-contacts__content">
          <div className="m-contacts__info">

            <div className="c-contact-info">
              <div className="c-contact-info__group">
                <h2 className="c-contact-info__title a-text-lead a-color-dark">{contacts.companyName}</h2>
                <div className="c-contact-info__list">
                  {
                    contacts.address && contacts.address.map(item => (
                      <span key={item.id} className="a-text-paragraph a-color-dark-disabled">{item.value}</span>
                    ))
                  }
                </div>
              </div>
              <div className="c-contact-info__group">
                <h2 className="c-contact-info__title a-text-lead a-color-dark">Phone</h2>
                <div className="c-contact-info__list">
                {
                  contacts.phone && contacts.phone.map(item => (
                    <a href={`tel:${item.value}`} key={item.id} className="a-text-paragraph a-color-dark-disabled">{item.value}</a>
                  ))
                }
                </div>
              </div>
              <div className="c-contact-info__group">
                <h2 className="c-contact-info__title a-text-lead a-color-dark">Email</h2>
                <div className="c-contact-info__list">
                {
                  contacts.email && contacts.email.map(item => (
                    <a href={`mailto:${item.value}`} key={item.id} className="a-text-h5 a-color-brand">{item.value}</a>
                  ))
                }
                </div>
              </div>
            </div>


          </div>
          <div className="m-contacts__map">
            <Map position={contacts.position} />
          </div>

        </div>

      </div>
    )
  }
}

export default ContactsPageContainer;

