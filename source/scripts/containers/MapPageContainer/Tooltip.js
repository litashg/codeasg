import React, { Component } from "react";
import ReactDOM from "react-dom";

const TOOLTIP_ROOT = document.getElementById('tooltip-root');

class Tooltip extends Component {
  constructor(props) {
    super(props);
    this.element = document.createElement('div');
    this.element.className = "m-tooltips__wrapper";
  }

  componentDidMount() {
    TOOLTIP_ROOT.appendChild(this.element);
  }
  componentWillUnmount() {
    TOOLTIP_ROOT.removeChild(this.element);
  }

  render() {
    return ReactDOM.createPortal(
      this.props.children,
      this.element
    )
  }
}

export default Tooltip;
