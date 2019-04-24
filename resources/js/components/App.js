import React, {Component} from 'react';
import ReactDOM from 'react-dom';

import Button from "./essentials/Button";
import Text from "./essentials/Text";
import Container from "./essentials/Container";
import Row from "./essentials/Row";
import Card from "./essentials/Card";

/**
 *
 */
export default class App extends Component {
    render() {
        return (
            <Container>
                <Row className="justify-content-center">
                    <div className="col-md-8">
                        <Card className="card">
                            <div className="card-header">Example Component</div>

                            <div className="card-body">
                                I'm an example component!
                            </div>
                            <Button>
                                <Text>Sample Button</Text>
                            </Button>

                        </Card>
                    </div>
                </Row>
            </Container>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App/>, document.getElementById('app'));
}
