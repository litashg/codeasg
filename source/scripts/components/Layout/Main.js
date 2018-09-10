import React from 'react';
import { Route } from 'react-router-dom';
import MainPageContainer from "../../containers/MainPageContainer/MainPageContainer";
import AboutPageContainer from "../../containers/AboutPageContainer/AboutPageContainer";
import AuditPageContainer from "../../containers/AuditPageContainer/AuditPageContainer";
import StructurePageContainer from "../../containers/StructurePageContainer/StructurePageContainer";
import ContactsPageContainer from "../../containers/ContactsPageContainer/ContactsPageContainer";
import NotFoundPageContainer from "../../containers/NotFoundPageContainer/NotFoundPageContainer";
import MapPageContainer from "../../containers/MapPageContainer/MapPageContainer";
import HistoryPageContainer from "../../containers/HistoryPageContainer";
import DirectionPageContainer from "../../containers/DirectionPageContainer";
import withLangRoute from "../../hocs/withLangRoute";

const LangRoute = withLangRoute(Route);

const Main = () => {
  return(
    <main className="m-main">
      <LangRoute exact path='/' component={MainPageContainer} />
      <LangRoute exact path='/about' component={AboutPageContainer} />
      <LangRoute exact path='/audit' component={AuditPageContainer} />
      <LangRoute exact path='/structure' component={StructurePageContainer} />
      <LangRoute exact path='/map' component={MapPageContainer} />
      <LangRoute exact path='/contacts' component={ContactsPageContainer} />
      <LangRoute exact path='/not-found' component={NotFoundPageContainer} />
      <LangRoute exact path='/direction/:directionSlug' component={DirectionPageContainer} />
      <LangRoute exact path='/history' component={HistoryPageContainer} />
    </main>
  )
};


export default Main;
