import React, {Component} from "react";
import { toJS } from 'mobx';
import Button from "../../components/shared/Button";
import classNames from "classnames";

class TabsContainer extends Component {
  constructor(props) {
    super(props);

    this.state = {
      type: this.props.type || "inline",
      isShown: false
    };

    this.closeDropdownHandler = this.closeDropdownHandler.bind(this);
  }

  componentDidMount() {
    window.addEventListener('click', this.closeDropdownHandler, false);
  }

  componentWillUnmount() {
    window.removeEventListener('click', this.closeDropdownHandler);
  }

  render() {

    if(!this.props.activeId) {
      return null;
    }

    const { isComparing,  activeId} = this.props;

    const activeYear = this.props.years.filter(item => item.id === activeId)[0] || this.props.years[0];

    return (
      <div className="m-tabs">

        <div className="m-tabs__items" onClick={(e) => this.preventHandler(e)}>

          {
            this.state.type === "dropdown" && (
              <div className={classNames("m-tabs__button", {
                "is-active": isComparing === false,
                "is-shown": this.state.isShown
              })}>
                <Button onClick={() => this.dropdownHandler()}
                        isActive={false}>
                  { activeYear.title }
                  <span className="a-triangle" />
                </Button>
              </div>
            )
          }
          <div className={classNames("m-tabs__list", {
            "m-tabs__list--dropdown": this.state.type === "dropdown",
            "is-active": this.state.isShown
          })}>
          {
            this.props.years.map(item => {

              if(activeId === item.id && this.state.type === "dropdown") { return null; }

              return (
                <Button key={item.id}
                        onClick={() => {
                          this.props.changeActive(item.id);
                          this.dropdownHandler();
                        }}
                        isActive={item.id === activeId && isComparing === false}>
                  { item.title }
                </Button>
              )
            })
          }
          </div>
        </div>
        <Button onClick={() => this.props.compareHandler()}
                isActive={isComparing === true}>
          Сравнить по годам
        </Button>
      </div>
    )
  }

  dropdownHandler() {
    this.setState({
      isShown: !this.state.isShown
    })
  }
  closeDropdownHandler() {
    if(this.state.isShown) {
      this.setState({
        isShown: false
      })
    }
  }
  preventHandler(e) {
    e.stopPropagation();
  }
}

export default TabsContainer;
