import React from 'react';
import {
    Navbar, Col, Row, Nav, Form,
    FormControl, Button
}
    from 'react-bootstrap';


const Header = () => {

    return (
        <Row style={{margin: 0, padding:0 }}>

            <Col style={{
                paddingRight: 0,
                paddingLeft: 0
            }}>

                <Navbar bg="dark" variant="dark">
                    <Navbar.Brand href="#home">
                        <img
                            alt=""
                            src="/wm.png"
                            width="30"
                            height="30"
                            className="d-inline-block align-top"
                        />
                        {' Laundo'}
                    </Navbar.Brand>
                </Navbar>

            </Col>


        </Row>
    );

};

export default Header;