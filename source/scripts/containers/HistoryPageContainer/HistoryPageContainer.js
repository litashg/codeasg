import React, { Component } from 'react';
import {inject, observer} from "mobx-react";
import withLangLink from "../../hocs/withLangLink";
import {Link} from "react-router-dom";
import getPageTitle from "../../lib/getPageTitle";
import {Helmet} from "react-helmet";

const BackLink = withLangLink(Link);

const TimelineItem = ({item}) => {
  return (
    <div className="c-timeline__item">
      <span className="c-timeline__date a-text-paragraph">{item.year} г.</span>
      <p className="c-timeline__content a-text-paragraph">{item.description}</p>
    </div>
  )
};

@inject('configStore', 'historyStore')
@observer
class HistoryPageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("light", "inside");
    this.store = this.props.historyStore;
  }

  componentDidMount() {
    console.log('Map Mounted');
    this.store.fetch();
  }

  render() {
    if(!this.store.data) {
      return null;
    }

    const { title, histories } = this.store.data;

    return (
      <div className="m-history">
        <Helmet>
          <title>{ getPageTitle(this.store.data.title) }</title>
        </Helmet>
        <div className="m-history__content">
          <BackLink className="c-back" to="/about">
            <i className="a-icon-arrow-left" />
            <span className="c-back__label">Назад</span>
          </BackLink>
          <h1 className="m-history__title a-text-h3 a-color-dark">{title}</h1>

          <div className="c-timeline">
            {
              (histories.length > 0) && histories.map(item => <TimelineItem key={item.id} item={item} />)
            }
          </div>
        </div>

      </div>
    )
  }
}

export default HistoryPageContainer;

