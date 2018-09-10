import React from "react";

const StructureItem = ({item}) => {
  const { logo, title, alt } = item;
  return (
    <picture className="c-structure__item">
      <img src={logo} alt={alt} title={title}/>
    </picture>
  )
};

const Structure = ({title, items}) => {
  return (
    <div className="c-structure">
      <h2 className="c-structure__title a-text-h4 a-color-dark">{title}</h2>
      <nav className="c-structure__list">
        {
          (items && items.length > 0) && items.map(item => <StructureItem key={item.id} item={item} />)
        }
      </nav>
      <p className="c-structure__caption a-text-paragraph a-color-dark-disabled">
        Структура БКВ Груп подтверждена международной аудиторской компанией
        <img src="/media/icons/deloitte.svg" alt="deloitte"/>
      </p>
    </div>
  )
};

export default Structure;