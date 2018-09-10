import React from "react";
import classNames from "classnames";
import numberWithSpace from "../../lib/numberWithSpace";

import { toJS } from 'mobx'


const StatsValueItem = ({item}) => {
  return (
    <div className="c-stat">
      <h2 className="c-stat__title a-text-h4 a-color-dark">{item.info.title}</h2>
      <p className="c-stat__value a-color-dark">
        {
          item.value ? `${item.prefix}${numberWithSpace(item.value)}${item.suffix}`: "N/A"
        }
      </p>
        {
          item.info.description &&
          <span className="c-stat__desc a-text-paragraph a-color-dark-disabled">{item.info.description}</span>
        }
    </div>
  )
};


const StatsValueList = ({years, type}) => {
  const typeModifier = `c-stat-list--${type}`;

  return (
    <div className={classNames({
      "c-stat-list": true,
      [typeModifier]: type
    })}>
      {
        years.metrics.map(metric => (
          <div className="c-stat-list__item" key={metric.id}>
            <StatsValueItem item={metric}/>
          </div>
        ))
      }
    </div>
  )
};


export default StatsValueList;
