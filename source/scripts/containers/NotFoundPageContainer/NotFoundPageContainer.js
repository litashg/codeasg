import React, { Component } from 'react';
import {inject, observer} from "mobx-react/index";
import Logo from "../../components/shared/Logo";
import Picture from "../../components/shared/Picture";
import PageLink from "../../components/shared/PageLink";
import getPageTitle from "../../lib/getPageTitle";
import {Helmet} from "react-helmet";

@inject('configStore')
@observer
class NotFoundPageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("dark", "error");
    this.picture = {
      title: '404',
      images: {
        origin: "/media/images/404-img.png",
        large: "/media/images/404-img.png",
        desktop: "/media/images/404-img.png",
        tablet: "/media/images/404-img.png",
        mobile: "/media/images/404-img.png"
      }
    };
  }

  render() {
    return (
      <div className="m-error">
        <Helmet>
          <title>{ getPageTitle("Sorry, 404") }</title>
        </Helmet>
        <div className="m-error__content">
          <Logo logo={this.props.configStore.siteLogo} url={this.props.configStore.currentLang.url}/>
          <Picture images={this.picture.images} title={this.picture.title} type="auto-height" />
          <p className="a-text-paragraph a-color-light">
            К сожалению,  страница которую Вы искали не существует.
          </p>
          <PageLink to="/" title="На главную" />
        </div>
      </div>
    )
  }
}

export default NotFoundPageContainer;
