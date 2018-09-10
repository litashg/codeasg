import React, {Component} from "react";
import classNames from "classnames";
import FlagList from "../FlagsList"
import ItemsList from "../ItemsList"
import { observer } from "mobx-react";

const Partners = ({data}) => {
  console.log(data);
  return (
    <div className="c-accordion__block">
      <span className="c-accordion__label">{data.title}</span>

      <div className="c-partners">
        {
          data.list.map(item => {
            return (
              <a href={item.url} key={item.id} className="c-partners__item" target="_blank">
                <img className="c-partners__logo" src={item.logo} alt=""/>
              </a>
            )
          })
        }
      </div>
    </div>
  )
};
const Text = ({data}) => {
  return (
    <div className="c-accordion__block">
      <span className="c-accordion__label">{data.title}</span>
      <div className="c-text">
        {
          data.list.map(text => {
            return (
              <p key={text.id} className="c-text__item a-text-paragraph a-color-dark">{text.value}</p>
            )
          })
        }
      </div>
    </div>
  )
};
const Badges = ({data}) => {
  return (
    <div className="c-accordion__block">
      <span className="c-accordion__label">{data.title}</span>
      <div className="c-badges">
        {
          data.list.map(badge => <span key={badge.id} className="c-badges__item">{badge.title}</span>)
        }
      </div>
    </div>
  )
};
const Flags = ({data}) => {
  console.log("FLAGS", data);
  return (
    <div className="c-accordion__block">
      <span className="c-accordion__label">{data.title}</span>
      <FlagList items={data.list} />
    </div>
  )
};

const Items = ({data}) => {
  console.log("FLAGS", data);
  return (
    <div className="c-accordion__block">
      <span className="c-accordion__label">{data.title}</span>
      <ItemsList items={data.list} />
    </div>
  )
};

const Blocks = {
  "partners": ({item}) => <Partners data={item}/>,
  "text": ({item}) => <Text data={item}/>,
  "badges": ({item}) => <Badges data={item}/>,
  "flags": ({item}) => <Flags data={item}/>,
  "items": ({item}) => <Items data={item}/>,
};

const AccordionItem = ({item, ...props}) => {

  const content = item.content;

  if(!content) return null;

  return (
    <div className={classNames({
      "c-accordion__item": true,
      "is-active": props.isActive
    })}>
      <div className="c-accordion__head" onClick={props.onClick} role="button">
        <h3 className="c-accordion__title">{item.title}</h3>
      </div>
      <div className="c-accordion__body">
        {
          content.map(block => {
            const Block = Blocks[block.type];
            return (
              <Block key={block.id} item={block}/>
            )
          })
        }
      </div>
    </div>

  )
};

@observer
class Accordion extends Component {
  constructor(props) {
    super(props);

    this.state = {
      activeId: null,
      items: this.props.items
    };
  }

  render() {

    return (
      <div className="c-accordion">
        {
          this.state.items.map(item => {
            return (
              <AccordionItem
                isActive={this.state.activeId === item.id}
                onClick={() => this.setActive(item.id)}
                key={item.id}
                item={item} />
            )
          })
        }
      </div>
    );
  }

  setActive(id) {
    this.setState({
      activeId: id === this.state.activeId ? null : id
    })
  }
}


export default Accordion;
