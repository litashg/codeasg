import React, { Component } from "react";
import Snap from "snapsvg";
import classNames from "classnames";
import { observer } from "mobx-react";
import {
  addPoint,
  addPlanPoint,
  addLine,
  setPlan,
  setActive,
  getBase,
  getCountriesSVG,
  addLabel,
  addBasePoint } from "./helpers";

const BASE_BOX = {cx: 1568.313234787018, cy: 465.2631591656574};

@observer
class SnapMap extends Component {
  constructor(props) {
    super(props);
    this.countries = this.props.countries;
    this.svgRef = React.createRef();
  }

  componentDidMount() {
    const map = this.svgRef.current;
    const snap = Snap(map);
    const [
      shapesGroup,
      pointsGroup,
      linesGroup,
      labelsGroup
    ] = [
      snap.select("#snap-map-items"),
      snap.g(),
      snap.g(),
      snap.g(),
    ];

     let pattern = snap.path("M10-5-10,15M15,0,0,15M0-5-20,15").attr({
      fill: "none",
      stroke: "#EEE3D0",
      strokeWidth: 3
    });
    pattern = pattern.pattern(0, 0, 10, 10);

    getCountriesSVG()
      .then(fragment => {

        const baseBox = BASE_BOX || getBase(fragment);

        this.countries.map(country => {
          const item = fragment.select(`#${country.key}`);

          if(item) {
            const itemBox = item.getBBox();
            const {x , y} = country.coordinates;

            let coordinates = null;

            if(x !== 0 && y !== 0) {
              coordinates = { cx: x, cy: y};
            } else {
              coordinates = {cx: itemBox.cx, cy: itemBox.cy};
            }

            if(country.status === "active") {
              setActive(fragment, item);
              addPoint(pointsGroup, coordinates);
              addLine(linesGroup, coordinates, baseBox);
              addLabel(labelsGroup, country.title, coordinates, baseBox.cx, country.labelPosition);
            }

            if(country.status === "plan") {
              setPlan(fragment, item, pattern);
              addPlanPoint(pointsGroup, coordinates);
            }
          } else {
            console.error("Cant find shape", country.key);
          }

        });

        addBasePoint(linesGroup, baseBox);

        shapesGroup.append(fragment);
      })
      .catch(err => console.log(err));
  }

  render() {
    if(this.countries.length === 0) {
      return null;
    }

    return (
      <svg ref={this.svgRef} className={classNames({
        "is-plan-shown": this.props.isShowPlans === true
      })} width="2820" height="1382" x="0" y="744" viewBox="0 0 2820 1382">
        <rect width="2820" height="1382" x="0" y="0" fill="none" />
        <g id="snap-map-items">
          {/*will be generate by snap*/}
        </g>
      </svg>
    )
  }


}

export default SnapMap;
