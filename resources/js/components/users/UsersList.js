import React from 'react';
import axios from 'axios';

class UsersList extends React.PureComponent {

    constructor(props) {
        super(props);

        this.state = {
            users: []
        };

        this.fetchUsers = this.fetchUsers.bind(this);
    }

    componentDidMount() {
        this.fetchUsers();
    }

    fetchUsers() {
        axios.get('/api/users')
            .then((response) => {

                if (response.data && response.data.data) {
                    this.setState({
                        users: response.data.data
                    });
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }

    render() {

        return (
            <div>
                <h2>Users</h2>
                <ul>
                    {
                        this.state.users &&
                        (this.state.users.length > 0) &&
                        this.state.users.map((data, index) => {
                            return <li key={index}>{JSON.stringify(data)}</li>;
                        })
                    }
                </ul>
            </div>
        );
    }
}


export default UsersList;


