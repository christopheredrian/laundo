import React from 'react';
import axios from 'axios';
import {Container} from 'react-bootstrap';
import ReactTable from 'react-table';
import 'react-table/react-table.css'

class OauthClientList extends React.PureComponent {

    constructor(props) {
        super(props);

        this.state = {
            clients: []
        };

        this.fetchOauthClients = this.fetchOauthClients.bind(this);
    }

    componentDidMount() {
        this.fetchOauthClients();
    }

    fetchOauthClients() {
        axios.get('/api/oauth')
            .then((response) => {

                console.log(response);
                if (response.data && response.data.data) {
                    this.setState({
                        clients: response.data.data
                    });
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }

    render() {

        const columns = [
            {
                Header: 'Id',
                accessor: 'id' // String-based value accessors!
            },
            {
                Header: 'Name',
                accessor: 'name'
            },
            {
                Header: 'Secret',
                accessor: 'secret'
            },
            {
                Header: 'Redirect',
                accessor: 'redirect'
            },
            {
                Header: 'Is Personal Client',
                accessor: 'personal_access_client'
            },
            {
                Header: 'Is Password Client',
                accessor: 'personal_access_client'
            },
            {
                Header: 'Is Revoked',
                accessor: 'revoked'
            },
            {
                Header: 'created_at',
                accessor: 'created_at',
            },
            {
                Header: 'Updated At',
                accessor: 'updated_at',
            }

        ];


        return (
            <Container>


                <h2>Oauth Clients</h2>

                <hr/>

                <ReactTable
                    columns={columns}
                    data={this.state.clients}
                    defaultPageSize={5}
                />


            </Container>
        );
    }
}


export default OauthClientList;


