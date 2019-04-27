import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router, Route} from 'react-router-dom';


import {Col, Row} from 'react-bootstrap';
import Sidebar from "./essentials/Sidebar";
import Header from "./essentials/Header";

import UsersList from "./users/UsersList";
import SalesList from "./sales/SalesList";
import Settings from "./settings/Settings";

/**
 *
 */
export default class App extends Component {

    constructor(props) {
        super(props);
    }


    componentDidMount() {

    }

    render() {

        return (
            <Router>
                <div style={{margin: 0}}>
                    <Header/>
                    <Row>
                        <Col md={3}>
                            <Sidebar/>
                        </Col>
                        <Col md={9}>
                            {/* Routes below we can create another component later instead */}
                            <Route exact path={`/sales`} component={SalesList}/>
                            <Route exact path={`/users`} component={UsersList}/>
                            <Route exact path={`/settings`} component={Settings}/>
                        </Col>

                    </Row>
                </div>


            </Router>
        );
    }
}


if (document.getElementById('app')) {
    ReactDOM.render(<App/>, document.getElementById('app'));
}
