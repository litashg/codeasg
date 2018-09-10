import React from "react";
import { Link } from "react-router-dom";

const Logo = ({logo, url}) => {
  return (
    <Link to={url} className="c-logo">
      <img className="c-logo__image"
           src={logo.image}
           alt={logo.alt}
           title={logo.title}/>
    </Link>
  )
};

export default Logo;
