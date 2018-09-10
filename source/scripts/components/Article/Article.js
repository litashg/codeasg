import React, { Fragment } from "react";
import * as CONTENT from "../../constants/content";

const blocks = {
  [CONTENT.TYPE_PARAGRAPH]: ({children}) => <p className="a-text-paragraph a-color-dark-soft">{children}</p>
};

const Article = ({data}) => {
  return (
    <div className="c-article-inline">
      {
        data.map(item => {
          const Block = blocks[item.type];

          return (
            <Block key={item.id}>
              { item.value }
            </Block>
          )
        })
      }
    </div>
  )
};

export default Article;
