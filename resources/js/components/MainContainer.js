import React, {Component} from 'react';
import axios from 'axios';

import {BrowserRouter as Router} from 'react-router-dom';
import BusinessOwnerContainer from './containers/BusinessOwnerContainer'
import AdminContainer from "./containers/AdminContainer";
import Login from "./login/Login";


const USER_ROLE_BUSINESS_OWNER = 'business_owner';
const USER_ROLE_ADMIN = 'admin';

import {connect} from 'react-redux';
import {initializeUser} from "../actions";


/**
 *
 */
class MainContainer extends Component {

    constructor(props) {
        super(props);

        this.getLoggedInUser = this.getLoggedInUser.bind(this);
    }


    componentDidMount() {

    }

    shouldComponentUpdate(nextProps, nextState) {


        if (nextProps.auth !== this.props.auth) {
            this.getLoggedInUser(nextProps.auth);
            return true;
        }

        if (JSON.stringify(nextProps) !== JSON.stringify(this.props)) {
            return true;
        }
    }

    getLoggedInUser(auth) {

        if (auth && auth.data && auth.data.access_token) {

            const config = {
                headers: {'Authorization': "Bearer " + auth.data.access_token}
            };

            axios.get('/api/get_logged_in_user', config)
                .then((response) => {

                    this.props.initializeUser(response.data.data);
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    render() {
        /**
         * Temporary user role for testing
         * Uncomment one of these for testing
         */
        // const testRole = null; // production
        const testRole = USER_ROLE_BUSINESS_OWNER;
        // const testRole = USER_ROLE_ADMIN;

        // Get user
        const panels = {
            // <<role>> : <<panel component>>
            [USER_ROLE_ADMIN]: <AdminContainer/>,
            [USER_ROLE_BUSINESS_OWNER]: <BusinessOwnerContainer/>
        };

        let panel = null;

        if (testRole) {
            /**
             *
             *
             * Testing a specific role
             *
             */
            if (panels[testRole]) {
                panel = panels[testRole];
            }

        } else {
            /**
             *
             *
             * Production setup
             *
             */
            if (!this.props.auth) {
                /**
                 * Not Authenticated
                 */
                panel = <Login/>;
            } else if (this.props.user && this.props.user.role) {
                /**
                 * Authenticated
                 */
                if (panels[this.props.user.role]) {
                    panel = panels[this.props.user.role];
                }

            } else {
                // TODO:  Loading screen
            }

        }


        return (

            <Router>
                {panel || null}
            </Router>
        );

    }
}


const mapPropsToState = (state) => {
    return {
        auth: state.auth,
        user: state.user
    };
};


function mapDispatchToProps(dispatch) {
    return ({
        initializeUser: (userData) => {
            dispatch(initializeUser(userData))
        }
    })
}


/**
 * Inject redux store to app
 */
export default connect(mapPropsToState, mapDispatchToProps)(MainContainer);
