import React, { Component } from 'react';
import {inject, observer} from "mobx-react";
import { toJS } from "mobx";
import { Link } from "react-router-dom";
import withLangLink from "../../hocs/withLangLink";
import Picture from "../../components/shared/Picture";
import getPageTitle from "../../lib/getPageTitle";
import {Helmet} from "react-helmet";


const LangLink = withLangLink(Link);

@inject('configStore', 'structureStore')
@observer
class StructurePageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("light", "slide");

    this.store = this.props.structureStore;

    this.state = {
      active: null
    };
  }

  componentDidMount() {
    this.store.fetch(() => {
      this.setState({
        active: this.store.getById(1)
      })
    });
  }

  render() {
    const { active } = this.state;

    if(!active) {
      return null;
    }

    const activeImages = {
      desktop: active.fill,
      tablet: active.fill,
      mobile: active.fill
    };

    if(!this.store.data) {
      return null;
    }

    return (
      <div className="m-structure">
        <Helmet>
          <title>{ getPageTitle(this.store.data.title) }</title>
        </Helmet>
        <div className="m-structure__tabs">
          <div className="c-tabs">
              <h1 className="c-tabs__title a-text-h3 a-color-light">{this.store.data.title}</h1>
            {
              this.store.data.directions.map(direction => {
                return (
                  <div className="c-tabs__item" key={direction.id}
                       onMouseEnter={() => this.mouseEnterHandler(direction.id)}>
                    <div className="c-tabs__wrapper">
                      <h2 className="c-tabs__sub-title a-text-h4 a-color-light">{direction.title}</h2>
                      <span className="a-text-paragraph a-color-light">
                        {
                          direction.companies.length > 0 && direction.companies.map(company => company.title).join(", ")
                        }
                      </span>
                    </div>

                    <LangLink to={`/direction/${direction.slug}`} className="c-link">
                      <span className="c-link__label">Подробнее</span>
                      <i className="a-icon-arrow-right" />
                    </LangLink>
                  </div>
                )
              })
            }
          </div>
          <div className="m-structure__label">{ this.state.active.title }</div>

        </div>
        <div className="m-structure__image">
          <Picture images={this.state.active.picture.images} type="cover"
                   title={this.state.active.picture.title}
                   alt={this.state.active.picture.alt}/>
        </div>
      </div>
    )
  }

  mouseEnterHandler(id) {
    this.setState({
      active: this.store.getById(id)
    });

    console.log(this.state.active);
  }
}

export default StructurePageContainer;

