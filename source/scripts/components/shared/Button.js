import React from "react";
import classNames from "classnames";

const Button = ({title, isActive, ...props}) => {
  return (
    <button className={classNames({
      "c-button": true,
      "is-active": isActive
    })} onClick={props.onClick}>
      { props.children }
    </button>
  )
};

export default Button;
