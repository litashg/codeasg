import React, { Component } from 'react';
import {inject, observer} from "mobx-react/index";
import {toJS} from "mobx";
import BackLink from "../../components/shared/BackLink";
import LangLink from "../../components/shared/LangLink";
import ExternalLink from "../../components/shared/ExternalLink";
import Accordion from "../../components/Accordion";
import ItemsList from "../../components/ItemsList";
import FlagsList from "../../components/FlagsList/";
import StatsContainer from "../StatsContainer";

const Company = ({company, ...props}) => {

  const {title, description, logo, siteLink} = company;

  return (
    <div className="c-company">
      <img className="c-company__logo"
           src={logo.image}
           alt={logo.alt}
           title={logo.title}
      />
      <h3 className="c-company__title a-text-h4-alt a-color-dark">{title}</h3>
      <div className="c-company__info">
        {
          company.tags.length > 0 && company.tags.map((tag, index) => (
            <span className="c-company__badge" key={index}>{tag}</span>
          ))
        }
        <ExternalLink url={siteLink} title={siteLink} />
      </div>
      <div className="c-company__content">
        <div className="c-article-inline">
          <p className="a-text-paragraph a-color-dark-soft">{description}</p>
        </div>
        {
          (company.note && company.noteImage.image) && (
            <div className="c-association-member">
              <p className="a-text-caption a-color-dark-disabled">{company.note}</p>
              <img src={company.noteImage.image}
                   alt={company.noteImage.alt}
                   title={company.noteImage.title}
              />
            </div>
          )
        }
      </div>
    </div>
  )
};

const DirectionContent = ({title, content}) => {
  return (
    <div>
      <div className="m-direction__subtitle a-text-h4 a-color-dark">{title}</div>
      {
        (() => {

          if(content.type === 'flags') {
            return <FlagsList items={content.items} />;
          } else if(content.type === 'items') {
            return <ItemsList items={content.items} />;
          } else  {
            return <Accordion items={content.items} />;
          }

        })()

      }

    </div>
  )
};

@inject('configStore', 'structureStore')
@observer
class DirectionPageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("dark", "inside");
    this.store = this.props.structureStore;
  }

  componentDidMount() {
    this.store.fetch(() => {
      this.store.setActive(this.props.match.params.directionSlug);
      console.log("DATA", toJS(this.store.active));
    })
  }

  render() {
    const direction = this.store.active;
    const { nextSlug, prevSlug } = this.store;

    if(!direction) return null;

    return (
      <div className="m-direction">

        <div className="m-direction__back">
          <BackLink to="/structure" title="На главную"/>
        </div>

        <div className="m-direction__wrapper">
          <div className="m-direction__head">
            <div className="m-direction__title a-text-h2 a-color-light">
              <img className="m-direction__title-icon"
                   src={direction.icon.image}
                   alt={direction.icon.alt}
                   title={direction.icon.title} />
              {direction.title}
            </div>
          </div>

          <div className="m-direction__body">
            <div className="m-direction__main">
              <h2 className="m-direction__subtitle a-text-h4 a-color-dark">Этим направлением занимается:</h2>
              {
                direction.companies.length > 0 && direction.companies.map(company => (
                  <Company key={company.id} company={company}/>
                ))
              }
              {/*<DirectionContent title={direction.subtitle} content={direction.content}/>*/}
            </div>
            <div className="m-direction__aside">
              <h2 className="m-direction__subtitle a-text-h4 a-color-dark">Достижения</h2>

              {
                (() => {
                  return <StatsContainer
                    controlType="dropdown"
                    statsView="widget"
                    chartsData={this.store.active.chartsData}
                    years={this.store.active.achievements}
                  />
                })()
              }
            </div>
          </div>
          <div className="m-direction__footer">

            <LangLink to={`/direction/${prevSlug}`} role="button" className="m-direction__button"
                      onClick={() => this.setActive(prevSlug)}>
              <p className="a-text-lead a-color-dark">{this.store.prevTitle}</p>
              <div className="c-back c-back--disabled">
                <i className="a-icon-arrow-left" />
                <span className="c-back__label">Подробнее</span>
              </div>
            </LangLink>

            <LangLink to={`/direction/${nextSlug}`} role="button" className="m-direction__button"
                      onClick={() => this.setActive(nextSlug)}>
              <p className="a-text-lead a-color-dark">{this.store.nextTitle}</p>
              <div className="c-link c-link--disabled">
                <span className="c-link__label">Подробнее</span>
                <i className="a-icon-arrow-right" />
              </div>
            </LangLink>
          </div>
        </div>

      </div>
    )
  }

  setActive(id) {
    this.store.setActive(id);
    window.scrollTo(0,0); // TODO Smooth scroll?
  }

}

export default DirectionPageContainer;

