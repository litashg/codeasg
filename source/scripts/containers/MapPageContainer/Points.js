import React from "react";
import classNames from "classnames";

const PointProduction = ({item, ...props}) => {
  const size = 40;
  const imageHref = item.status === "active" ? "/media/icons/icon-prod-active.svg" : "/media/icons/icon-prod-plan.svg";
  const [x, y] = [item.coordinates.x - size / 2, item.coordinates.y - size / 2];

  return (
    <image
      className="c-point c-point__image"
      key={item.id}
      xlinkHref={imageHref}
      width={item.status === "active" ? size : size - 4}
      height={item.status === "active" ? size : size - 4}
      style={{transformOrigin: `${x}px ${y}px`}}
      x={x}
      y={y}
      {...props}
    />
  )
};

const PointRepresentation = ({item, ...props}) => {
  const size = 40;
  const typeModifier = `c-point c-point__rect--${item.status}`;
  const [x, y] = [item.coordinates.x - size / 2, item.coordinates.y - size / 2];

  return (
    <rect
      className={classNames("c-point__rect",{
        [typeModifier]: item.status
      })}
      key={item.id}
      width={item.status === "active" ? size : size - 4}
      height={item.status === "active" ? size : size - 4}
      style={{transformOrigin: `${x}px ${y}px`}}
      x={x}
      y={y}
      {...props}
    />
  )
};

const Point = ({type, ...props}) => {
  switch (type) {
    case "representation": return <PointRepresentation {...props} item={props.item}/>;
    case "production": return <PointProduction {...props} item={props.item}/>;
    default: return null;
  }
};

export default Point;

