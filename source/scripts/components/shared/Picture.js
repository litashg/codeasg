import * as React from "react";
import classNames from "classnames";

const Picture = ({images, ...props}) => {
  const { desktop, tablet, mobile, large, original } = images;
  const typeModifier = `c-picture--${props.type}`;
  return (
    <picture className={classNames({
      "c-picture": true,
      [typeModifier]: props.type
    })}>
      <source srcSet={mobile} media="(max-width: 767px)" />
      <source srcSet={tablet} media="(min-width: 768px) and (max-width: 1024px)" />
      <source srcSet={desktop} media="(min-width: 1025px) and (max-width: 1599px)" />
      <source srcSet={large} media="(min-width: 1600px)" />
      <img className="c-picture__image"
           src={original}
           alt={props.alt}
           title={props.title} />
    </picture>
  )
};



export default Picture;

