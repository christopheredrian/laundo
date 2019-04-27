import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from 'react-router-dom';

import BusinessOwnerContainer from './containers/BusinessOwnerContainer'
import AdminContainer from "./containers/AdminContainer";


const USER_ROLE_BUSINESS_OWNER = 'business_owner';
const USER_ROLE_ADMIN = 'admin';

/**
 *
 */
class App extends Component {

    constructor(props) {
        super(props);
    }


    componentDidMount() {

    }

    render() {

        /**
         * Temporary user role for testing
         */
        const
            // role = USER_ROLE_BUSINESS_OWNER,
            role = USER_ROLE_ADMIN;


        const panels = {
            // <<role>> : <<panel component>>
            [USER_ROLE_ADMIN]: <AdminContainer/>,
            [USER_ROLE_BUSINESS_OWNER]: <BusinessOwnerContainer/>
        };


        return (
            <Router>
                {panels[role] || null}
            </Router>
        );

    }
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App/>, document.getElementById('app'));
}
