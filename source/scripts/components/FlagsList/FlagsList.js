import React from "react";


const Flag = ({item}) => {
  return (
    <div className="c-dashboard__item">
      <img className="c-dashboard__logo" src={ item.icon } alt=""/>
      <span className="c-dashboard__label">{ item.label }</span>
    </div>
  )
};

const FlagsList = ({items}) => {

  console.log(items);
  return (
    <div className="c-dashboard">
      {
        items.map(item => <Flag key={item.id} item={item} />)
      }
    </div>
  )
};

export default FlagsList;
