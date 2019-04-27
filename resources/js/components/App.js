import React from 'react';
import ReactDOM from 'react-dom';
import {Provider} from 'react-redux';

import MainContainer from "./MainContainer";
import store from '../store'



if (document.getElementById('app')) {
    ReactDOM.render((
        <Provider store={store}>
            <MainContainer/>
        </Provider>
    ), document.getElementById('app'));
}
