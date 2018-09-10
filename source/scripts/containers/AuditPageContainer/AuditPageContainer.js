import React, { Component } from 'react';
import {inject, observer} from "mobx-react";
import { toJS } from 'mobx';
import StatsContainer from "../StatsContainer/StatsContainer";
import getPageTitle from "../../lib/getPageTitle";
import {Helmet} from "react-helmet";

@inject('configStore', 'auditStore')
@observer
class AuditPageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("light", "slide");
    this.store = this.props.auditStore;
  }

  componentDidMount() {
    this.store.fetch();

    console.log('Audit Mounted');
  }
  render() {

    if(!this.store.data) {
      return null;
    }

    const { title, footnoteImage, footnote, years, chartsData } = this.store.data;

    console.log(toJS(this.store.data));

    return (
      <div className="m-audit">
        <Helmet>
          <title>{ getPageTitle(this.store.data.title) }</title>
        </Helmet>
        <h1 className="m-audit__title a-text-h3 a-color-dark">{title}</h1>
        <div className="m-audit__body">
          {
            (years && years.length > 0 && chartsData && chartsData.length > 0)
            ? <StatsContainer years={years} chartsData={chartsData} />
            : <h2>Sorry, cant find data</h2>
          }
        </div>

        <div className="m-audit__footer">
          <p className="c-structure__caption a-text-paragraph a-color-dark-disabled">
            {footnote}
            <img src={footnoteImage.image}
                 alt={footnoteImage.alt}
                 title={footnoteImage.title}/>
          </p>
        </div>
      </div>
    )
  }
}

export default AuditPageContainer;

