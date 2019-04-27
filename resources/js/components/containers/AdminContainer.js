import React from 'react';
import {Col, Row, Container} from "react-bootstrap";

import Header from "../essentials/Header";
import SalesList from "../sales/SalesList";
import UsersList from "../users/UsersList";
import OauthClientList from '../oauth/OauthClientList';

import {Link, Route, withRouter} from 'react-router-dom';


class AdminContainer extends React.Component {

    render() {
        return (
            <div style={{margin: "0"}}>
                <Header/>
                <Row>
                    <Col md={3}>
                        <div className="bg-light border-right" id="sidebar-wrapper" style={{height: "100vh"}}>
                            <div className="list-group list-group-flush">
                                <Link to="/"
                                      className="list-group-item list-group-item-action bg-light">Dashboard</Link>
                                <Link to="/users"
                                      className="list-group-item list-group-item-action bg-light">Users</Link>
                                <Link to="/oauth" className="list-group-item list-group-item-action bg-light">Oauth
                                    Clients</Link>
                            </div>
                        </div>
                    </Col>
                    <Col md={9}>
                        <Container className={'mt-3'}>
                            <Route exact path={`/sales`} component={SalesList}/>
                            <Route exact path={`/users`} component={UsersList}/>
                            <Route exact path={`/oauth`} component={OauthClientList}/>
                        </Container>
                    </Col>

                </Row>
            </div>

        )
    }
}
;


export default withRouter(AdminContainer);