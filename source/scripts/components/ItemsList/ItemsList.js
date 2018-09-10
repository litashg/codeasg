import React from "react";

const Item = ({item}) => {
  return (
    <div className="c-dashboard__item">
      <h4 className="c-dashboard__title">{ item.title }</h4>
      <span className="c-dashboard__label">{ item.desc }</span>
    </div>
  )
};

const ItemsList = ({items}) => {

  console.log(items);
  return (
    <div className="c-dashboard">
      {
        items.map(item => <Item key={item.id} item={item} />)
      }
    </div>
  )
};

export default ItemsList;
