import React from "react";
import {Link} from "react-router-dom";
import withLangLink from "../../hocs/withLangLink";
import classNames from "classnames";

const PageLink = ({to, title, style, ...props}) => {
  const styleModifier = `c-lang--${style}`;
  const LangLink = withLangLink(Link);

  return (
    <LangLink className={classNames({
      "c-link": true,
      [styleModifier]: style
    })} to={to}>
      <span className="c-link__label">{title}</span>
      <i className="a-icon-arrow-right" />
    </LangLink>
  )
};

export default PageLink;
