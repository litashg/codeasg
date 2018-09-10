import React, {Component, Fragment} from 'react';
import {inject, observer} from "mobx-react";
import { Helmet } from "react-helmet";
import classNames from "classnames";
import Tooltip from "./Tooltip";
import Point from "./Points";
import SnapMap from "./SnapMap";
import getPageTitle from "../../lib/getPageTitle";

@inject('configStore', 'mapStore')
@observer
class MapPageContainer extends Component{
  constructor(props) {
    super(props);
    this.props.configStore.setPageConfig("light", "slide");
    this.store = this.props.mapStore;

    this.state = {
      mapId: null,
      isShowPlans: false,
      activeId: null,
      isTooltip: false,
      tooltipContent: null,
      tooltipPosition: {
        x: 0,
        y: 0
      }
    };

    this.hideTooltips = this.hideTooltips.bind(this);
    this.preventTooltipClose = this.preventTooltipClose.bind(this);
  }

  componentDidMount() {
    this.store.fetch(() => {

      this.setState({
        mapId: this.store.data.controls[0].map,
        activeId: this.store.data.controls[0].key
      })
    });

    window.addEventListener('click', this.hideTooltips);
  }

  componentWillUnmount() {
    window.removeEventListener('click', this.hideTooltips);
  }

  render() {

    if(!this.state.activeId && !this.state.mapId) {
      return null;
    }

    const { points, countries, controls } = this.store;

    const currentSet = points.filter(item => item.type === this.state.activeId);
    const plansItems = currentSet.filter(item => item.status === "plan");
    const activeItems = currentSet.filter(item => item.status === "active");


    return (
      <div className="m-geography">
        <Helmet>
          <title>{ getPageTitle(this.store.data.title) }</title>
        </Helmet>

        <h1 className="m-geography__title a-text-h3 a-color-brand-second">{this.store.data.title}</h1>
        <div className="m-geography__map">
          <div className="m-geography__map-box">
            <svg className="c-map" width="2820" height="2870" viewBox="0 0 2820 2870">

              {
                this.state.mapId !== "global" && (
                  <Fragment>
                    <g className={classNames("c-map__image",{
                      "is-zoom": this.state.mapId === "default-zoomed"
                    })}>
                      <image width="2820" height="2870" x="0" y="0" xlinkHref="/media/maps/ukraine.svg" />
                    </g>

                    {
                      this.generatePoints(this.store.isPlansShown, activeItems, plansItems)
                    }
                  </Fragment>
                )
              }
              {
                this.state.mapId === "global" && (
                  <g className={classNames("c-map__image c-map__image--global",{
                    "off-zoom": this.store.isPlansShown === true
                  })}>
                    <SnapMap countries={countries} isShowPlans={this.store.isShowPlans}/>
                  </g>
                )
              }

            </svg>
          </div>
        </div>
        <div className="m-geography__controls">

          <div className={classNames({
            "c-switch": true,
            "is-active": this.store.isPlansShown
          })} onClick={() => this.switchPlans()}>
            <div className="c-switch__button" />
            <span className="c-switch__label a-text-paragraph">
              { this.store.isPlansShown ? "Планы показаны" : "Планы скрыты" }
            </span>
          </div>


          <div className="c-controls">

            {
              controls.map(control => {
                return (
                  <div className={classNames({
                    "c-controls__item": true,
                    "is-active": control.key === this.state.activeId
                  })} onClick={() => {
                    this.setActive(control.key, control.map)
                  }} key={control.id}>
                    <i className={`c-controls__icon c-controls__icon--${control.icon}`} />
                    <div className="c-controls__content">
                      <h2 className="a-text-h4">{control.title}</h2>
                      <p className="a-text-paragraph a-color-dark-disabled">
                        {control.description}{" "}{this.store.isPlansShown ? `(${control.plans})` : ""}
                      </p>
                    </div>
                  </div>
                )
              })
            }
          </div>
        </div>

        {
          this.state.isTooltip && (
            <Tooltip>

              <div className="c-tooltip"
                   style={{
                    left: this.state.tooltipPosition.x,
                    top: this.state.tooltipPosition.y,
                  }}
                   onClick={this.preventTooltipClose}>
                <h3 className="c-tooltip__title a-color-light">
                  {this.state.tooltipContent.title}
                </h3>
                <p className="c-tooltip__subtitle a-text-paragraph a-color-light-disabled">
                  {this.state.tooltipContent.address}
                </p>
                <p className="c-tooltip__note a-text-caption a-color-dark-disabled">
                  {this.state.tooltipContent.description}
                </p>

              </div>
            </Tooltip>
          )
        }
      </div>
    )
  }

  switchPlans() {
    this.store.togglePlans();
  }

  setActive(id, mapId) {
    this.setState({
      activeId: id,
      mapId: mapId
    })
  }

  pointHandler(e, item) {
    const { top, left } = e.target.getBoundingClientRect();
    this.setState({
      isTooltip: true,
      tooltipContent: item,
      tooltipPosition: {
        x: left,
        y: top
      }
    })
  }

  preventTooltipClose(e) {
    e.stopPropagation();
  }

  hideTooltips(e) {
    if(e.target.classList.contains('c-point') || e.target.classList.contains('c-tooltip')) {
      e.stopPropagation();
    } else {
      this.setState({
        isTooltip: false,
        tooltipContent: null,
      })
    }
  }

  generatePoints(isPlansShow, activeItems, plansItems) {
    return (
      <g>
        {
          activeItems && activeItems.map(item => {
            return <Point onClick={(e) => this.pointHandler(e, item)}
                          type={this.state.activeId} key={item.id} item={item}/>
          })
        }
        {
          (isPlansShow && plansItems) && plansItems.map(item => {
            return <Point onClick={(e) => this.pointHandler(e, item)}
                          type={this.state.activeId} key={item.id} item={item}/>
          })
        }
      </g>
    )
  }

}

export default MapPageContainer;

