import React from 'react';
import {Row, Col, Form, Button, Card} from 'react-bootstrap';
import axios from 'axios';
import {connect} from 'react-redux';
import {loginSuccess} from '../../actions';

class Login extends React.PureComponent {

    constructor(props) {
        super(props);

        this.state = {
            email: '',
            password: ''
        };
        this.handleLogin = this.handleLogin.bind(this);
        this.onValueChange = this.onValueChange.bind(this);

    }

    /**
     * Set the input values
     */
    onValueChange(event) {

        this.setState({
            [event.target.name]: event.target.value
        });
    }

    handleLogin() {

        axios.post('/oauth/token', {
            username: this.state.email,
            password: this.state.password,
            grant_type: 'password', // todo: chris fetch this from the Database
            client_id: 4,
            client_secret: 'kJyewsP6Kbn7P7ur53PNVnUTl98ssfXzDGIArD75',
        })
            .then((response) => {

                console.log('Login .js after axios call');
                console.log(response);
                // Store token to redux store
                this.props.loginSuccess(response);
            })
            .catch((error) => {

            });


    }


    componentWillReceiveProps(nextProps, nextContext) {

    }

    render() {
        const formStyle = {
            margin: "10% 33%",
            padding: '60px 50px',
            border: "1px solid #8c7f7f4f"
        };


        return (
            <Row>
                <Col>
                    <Card style={formStyle}>
                        <Form>
                            <Form.Group controlId="formGroupEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control
                                    name="email"
                                    type="email"
                                    placeholder="Enter email"
                                    value={this.state.email}
                                    onChange={this.onValueChange}
                                />
                            </Form.Group>
                            <Form.Group controlId="formGroupPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control
                                    name="password"
                                    type="password"
                                    placeholder="Password"
                                    value={this.state.password}
                                    onChange={this.onValueChange}
                                />
                            </Form.Group>
                            <Button
                                className={'float-right'}
                                onClick={this.handleLogin}
                            >
                                Login
                            </Button>
                        </Form>
                    </Card>
                </Col>
            </Row>
        );
    }
}

//
// const mapDispatchToProps = {
//     loginSuccess: loginSuccess
// };

function mapDispatchToProps(dispatch) {
    return({
        loginSuccess: (oauthResponse) => {
            dispatch(loginSuccess(oauthResponse))
        }
    })
}


export default connect(null, mapDispatchToProps)(Login);