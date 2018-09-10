import React, { Component }  from "react";
import Header from './Header';
import Navigation from './Navigation';
import { inject, observer } from "mobx-react";
import { withRouter } from "react-router-dom";
import classNames from "classnames";

@inject('configStore')
@observer
class Layout extends Component {

  render() {
    const { theme, depth } = this.props.configStore;

    return (
      <div className={classNames("m-layout",{
          [`theme-${theme}`]: true,
          [`page-depth-${depth}`]: true,
      })}>
        <Header store={this.props.configStore} />
        {this.props.children}

        <Navigation langPrefix={this.props.configStore.currentLang.url}
                    slides={this.props.configStore.slides}/>
      </div>
    )
  }
}

export default withRouter(Layout);
