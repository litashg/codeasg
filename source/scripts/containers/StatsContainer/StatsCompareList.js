import React from "react";
import classNames from "classnames";
import numberWithSpace from "../../lib/numberWithSpace";


const StatsCompareItem = ({data}) => {

  const max = Math.max(...data.items.map(item => item.value));

  return (
    <div className="c-chart">
      <h2 className="c-chart__title a-text-h4 a-color-dark">{data.title}</h2>
      <div className="c-chart__body" data-cols={data.items.length}>
        {
          data.items.map(item => (
            <div key={item.id} className="c-chart__col">
              <div className="c-chart__bar" style={{ height: `${ (item.value / max) * 100 }%` }}>
                <span className="c-chart__value a-text-caption a-color-dark">
                  {
                    item.value ? `${item.prefix}${numberWithSpace(item.value)}${item.suffix}`: "N/A"
                  }
                </span>
              </div>
              <span className="c-chart__label">{item.title}</span>
            </div>
          ))
        }
      </div>
    </div>
  )
};


const StatsCompareList = ({data, type}) => {

  const typeModifier = `c-stat-list--${type}`;

  return (
    <div className={classNames({
      "c-stat-list": true,
      [typeModifier]: type
    })}>
      {
        data.map(item => (
          <div className="c-stat-list__item" key={item.id}>
            <StatsCompareItem data={item}/>
          </div>
        ))
      }
    </div>
  )
};


export default StatsCompareList;
