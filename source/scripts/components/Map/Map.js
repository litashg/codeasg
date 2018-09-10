import React, { Component } from "react";
import { observer } from "mobx-react";
import { initMap } from "./initMap";

@observer
class Map extends Component {
  constructor(props) {
    super(props);
    this.mapCanvas = React.createRef();
  }

  componentDidMount() {

    const lat = parseFloat(this.props.position.latitude) || 48.914681;
    const lng = parseFloat(this.props.position.longitude) || 48.914681;

    initMap(this.mapCanvas.current, {lat, lng});
  }

  render() {
    return (
      <div className="c-map" ref={this.mapCanvas} />
    )
  }
}

export default Map;
