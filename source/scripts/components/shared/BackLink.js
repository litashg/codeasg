import React from "react";
import {Link} from "react-router-dom";
import classNames from "classnames";
import withLangLink from "../../hocs/withLangLink";


const BackLink = ({to, title, style, ...props}) => {
  const LangLink = withLangLink(Link);
  const styleModifier = `c-back--${style}`;
  return (
    <LangLink className={classNames({
      "c-back": true,
      [styleModifier]: style
    })} to={to}>
      <i className="a-icon-arrow-left" />
      <span className="c-back__label">{title}</span>
    </LangLink>
  )
};

export default BackLink;
