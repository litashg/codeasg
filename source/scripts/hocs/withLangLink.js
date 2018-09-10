import React from "react";
import { getLang } from '../lib/getLang';

const withLangLink = (WrappedComponent) => ({to, ...props}) => {
  const lang = getLang();
  return <WrappedComponent to={`/${lang}${to}`} {...props} />
};

export default withLangLink;
