import React, { Component } from 'react';
import {inject, observer} from "mobx-react";
import { Link } from "react-router-dom";
import withLangLink from "../../hocs/withLangLink";
import Owner from "./Owner";
import Structure from "./Structure";
import HistoryLine from "./HistoryLine";
import getPageTitle from "../../lib/getPageTitle";
import {Helmet} from "react-helmet";

const HistoryLink = withLangLink(Link);


@inject('configStore', 'aboutStore')
@observer
class AboutPageContainer extends Component {
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("light", "slide");
    this.store = this.props.aboutStore;

    this.state = {
      activeOwner: 0
    }
  }

  componentDidMount() {
    this.store.fetch();
  }

  render() {
    if(!this.store.data) {
      return null;
    }

    const { title, body } = this.store.data;

    return (
      <div className="m-about">
        <Helmet>
          <title>{ getPageTitle(this.store.data.title) }</title>
        </Helmet>
        <div className="m-about__info">
          <h1 className="m-about__title a-text-h2 a-color-dark">{title}</h1>
          <p className="m-about__lead a-text-paragraph a-color-dark">{body}</p>
          <Structure title="В состав группы входят:" items={this.store.companies}/>
        </div>
        <div className="m-about__owners">

          <div className="m-about__owners-toggle"
               onClick={() => this.changeOwner()}
               role="button">
            <i className="a-icon-arrow-right" />
          </div>

          {
            this.store.founders.length > 0 && this.store.founders.map((owner, index) => {
              return (
                <Owner key={owner.id}
                       owner={owner}
                       onClick={() => this.showOwner(index)}
                       isActive={index === this.state.activeOwner} />
              )
            })
          }
        </div>
        <div className="m-about__footer">

          <div className="c-history-banner">

            <div className="c-history-banner__line" />
            <div className="c-history-banner__content">
              <p className="a-text-paragraph a-color-dark">Бизнес развивается с 2006 года</p>
              <HistoryLink className="c-link" to="/history">
                <span className="c-link__label">Смотреть всю историю</span>
                <i className="a-icon-arrow-right" />
              </HistoryLink>
              <div className="c-history-banner__years">
                <HistoryLine/>
              </div>
            </div>
          </div>

        </div>
      </div>
    )
  }

  changeOwner() {
    this.setState({
      activeOwner: this.state.activeOwner === 0 ? 1 : 0
    })
  }
  showOwner(index) {
    this.setState({
      activeOwner: index
    })
  }
}

export default AboutPageContainer;
