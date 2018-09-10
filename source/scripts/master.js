import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from "react-router-dom";
import { Provider } from 'mobx-react';
import Layout from "./components/Layout";
import Main from "./components/Layout/Main";

// stores
import configStore from "./stores/configStore";
import mainStore from "./stores/mainStore";
import aboutStore from "./stores/aboutStore";
import historyStore from "./stores/historyStore";
import structureStore from "./stores/structureStore";
import contactsStore from "./stores/contactsStore";
import auditStore from "./stores/auditStore";
import mapStore from "./stores/mapStore";

const rootElement = document.querySelector('#root');
const outPage = document.querySelector('#out-page');

const Root = () => {
  return (
    <BrowserRouter>
      <Provider configStore={configStore}
                mainStore={mainStore}
                aboutStore={aboutStore}
                historyStore={historyStore}
                structureStore={structureStore}
                auditStore={auditStore}
                mapStore={mapStore}
                contactsStore={contactsStore}>
          <Layout>
            <Main/>
          </Layout>
      </Provider>
    </BrowserRouter>
  )
};

if(rootElement && !outPage) {
  ReactDOM.render(<Root/>, rootElement);
}

