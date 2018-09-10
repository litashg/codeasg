import React, {Component} from "react";
import StatsValueList from "./StatsValueList";
import StatsCompareList from "./StatsCompareList";
import TabsContainer from "../ControlsContainer/TabsContainer";

class StatsContainer extends Component {
  constructor(props) {
    super(props);

    this.controlType = this.props.controlType || "inline";

    this.state = {
      activeId: null,
      isComparing: false,
      hasError: false
    };
  }

  componentDidMount() {
      if(this.props.years.length > 0) {
        this.setState({
          activeId: this.props.years[0].id
        });
      }
  }

  componentDidCatch(error, info) {
    this.setState({
      hasError: true
    })
  }

  render() {

    if(this.state.hasError === true || this.props.years.length === 0) {
      return null;
    }
    const { isComparing, activeId } = this.state;
    const activeItem = activeId ? this.getByStatsId(activeId) || this.getByStatsId(this.props.years[0].id) : this.getByStatsId(this.props.years[0].id);

    return (
      <div className="m-stats">
        <div className="m-stats__head">
          <TabsContainer compareHandler={() => this.showCompare()}
                         changeActive={(id) => this.changeActive(id)}
                         isComparing={isComparing}
                         activeId={this.state.activeId || this.props.years[0].id}
                         years={this.props.years}
                         type={this.props.controlType}/>
        </div>

        <div className="m-stats__body">
          {
            isComparing === true
              ? <StatsCompareList type={this.props.statsView} data={this.props.chartsData} />
              : <StatsValueList type={this.props.statsView} years={activeItem}/>
          }
        </div>
      </div>
    )
  }

  changeActive(id) {
    this.setState({
      activeId: id,
      isComparing: false
    })
  }

  showCompare() {
    if(this.state.isComparing) { return false; }
    this.setState({
      isComparing: true,
    })
  }

  getByStatsId(id) {
    return this.props.years.filter(item => item.id === id)[0];
  }

}


export default StatsContainer;
