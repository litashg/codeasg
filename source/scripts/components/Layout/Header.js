import React from "react";
import { withRouter } from "react-router-dom";
import { observer } from "mobx-react";
import Logo from "../shared/Logo";
import classNames from "classnames";


const Header = observer(({store, ...props}) => {

  const currentPage = props.location.pathname;
  const currentLangUrl = store.currentLang.url;


  return (
    <div className="m-header">
      <Logo logo={store.siteLogo} url={store.currentLang.url}/>
      <div className="m-header__languages">
        <nav className="c-languages">
          {
            store.languages.length > 0 && store.languages.map(lang => {
              return (
                <a key={lang.id}
                   className={classNames("c-languages__item", {
                  "is-active": currentLangUrl === lang.url
                })}
                href={lang.url}>
                  {lang.name}
                </a>
              )
            })
          }
        </nav>
      </div>
    </div>
  )
});

export default withRouter(Header);
