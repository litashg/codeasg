import React, { Component } from 'react';
import {inject, observer} from "mobx-react/index";
import Video from "../../components/shared/Video";
import getPageTitle from "../../lib/getPageTitle";
import {Helmet} from "react-helmet";

@inject('mainStore', 'configStore')
@observer
class MainPageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("dark", "welcome");

    this.store = this.props.mainStore;
  }

  componentDidMount() {
    console.log('Welcome Mounted');
    this.store.fetch();
  }

  render() {

    if(!this.props.mainStore.data) {
      return null;
    }

    const { title, body, bullets, video } = this.props.mainStore.data;

    return (
      <div className="m-welcome">
        <Helmet>
          <title>{ getPageTitle(this.store.data.title) }</title>
        </Helmet>
        <h1 className="m-welcome__title a-text-h1 a-color-brand">
          { title }
        </h1>

        <div className="m-welcome__content">
          <p className="m-welcome__lead a-text-caption a-color-light-disabled">
            { body }
          </p>

          <ul className="m-welcome__list">
            {
              bullets.length > 0 && bullets.map(bullet => (
                <li className="m-welcome__list-item a-text-caption a-color-light-disabled"
                    key={bullet.id}>
                  {bullet.text}
                  </li>
              ))
            }
          </ul>

          <div className="c-scroll a-color-brand">
            <i className="c-scroll__icon a-icon-arrow-down" />
            <span className="c-scroll__title">
              Скроль
              вниз
            </span>
          </div>
        </div>

        <div className="m-welcome__video">
          {
            (video && video.picture && video.video) && <Video picture={video.picture} videoUrl={video.video} />
          }
        </div>
      </div>
    )
  }
}

export default MainPageContainer;
