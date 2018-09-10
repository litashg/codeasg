import React from "react";

const ExternalLink = ({url, title}) => {
  return (
    <a className="c-external-link" href={url} target="_blank">{title || "Подробнее"}</a>
  )
};

export default ExternalLink;
