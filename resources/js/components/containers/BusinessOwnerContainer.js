import React from 'react';
import {Col, Row} from "react-bootstrap";

import Header from "../essentials/Header";
import BusinessOwnerSidebar from "../essentials/sidebars/BusinessOwnerSidebar";
import SalesList from "../sales/SalesList";
import Settings from "../settings/Settings";
import UsersList from "../users/UsersList";

import {Route, withRouter} from 'react-router-dom';


class BusinessOwnerContainer
    extends React.Component {

    render() {
        return (
            <div style={{margin: 0}}>
                <Header/>
                <Row>
                    <Col md={3}>
                        <BusinessOwnerSidebar/>
                    </Col>
                    <Col md={9}>
                        <Route exact path={`/sales`} component={SalesList}/>
                        <Route exact path={`/users`} component={UsersList}/>
                        <Route exact path={`/settings`} component={Settings}/>
                    </Col>

                </Row>
            </div>

        )
    }
}
;


export default withRouter(BusinessOwnerContainer);