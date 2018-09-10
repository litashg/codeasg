import React from 'react';
import { NavLink } from 'react-router-dom';
import withLangLink from '../../hocs/withLangLink';
import { observer } from "mobx-react";

const buildUrl = (langUrl, slideUrl) => {

  if(langUrl === "/") {
    return slideUrl;
  }

  if(slideUrl === "/") {
    return langUrl;
  } else {
    return `${langUrl}${slideUrl}`
  }
};

const Navigation = observer(({langPrefix, slides}) => {
  return (
    <div className="c-nav">

      {
        slides.length > 0 && slides.map(slide => {
          return (
            <NavLink exact
                     to={buildUrl(langPrefix, slide.url)}
                     key={slide.id}
                     className='c-nav__item'
                     activeClassName='is-active'>
              <span className="c-nav__label">{ slide.number }</span>
            </NavLink>
          )
        })
      }
    </div>
  )
});

export default Navigation;

