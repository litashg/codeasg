import React from "react";
import {Link} from "react-router-dom";
import withLangLink from "../../hocs/withLangLink";

const LangLink = ({to, children,  ...props}) => {
  const LinkWithLang = withLangLink(Link);

  return (
    <LinkWithLang to={to} { ...props }>
      {children}
    </LinkWithLang>
  )
};

export default LangLink;
