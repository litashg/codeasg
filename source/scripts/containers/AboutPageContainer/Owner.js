import React from "react";
import classNames from "classnames"
import Icon from "../../components/shared/Icon";
import Picture from "../../components/shared/Picture";

const SocialItem = ({url, type}) => {
  return (
    <a href={url} className="c-owner__social" target="_blank">
      <Icon type={type}/>
    </a>
  )
};

const Owner = ({owner, ...props}) => {
  const { linkedInLink, facebookLink = "#", picture, fullName, position, quote} = owner;
  return (
    <div className={classNames("c-owner", {"is-active": props.isActive === true})}
         onClick={props.onClick}>
      <Picture images={picture.images} type="cover" title={fullName} alt={fullName}/>
      <div className="c-owner__info">
        <p className="c-owner__quote a-text-caption">{quote}</p>
        <div className="c-owner__main">
          <h2 className="a-text-h4 a-color-dark">{fullName}</h2>
          <SocialItem url={linkedInLink} type="linkedin" />
          <SocialItem url={facebookLink} type="facebook" />
        </div>
        <p className="a-text-paragraph a-color-dark-disabled">{position}</p>
      </div>
    </div>
  )
};

export default Owner;
