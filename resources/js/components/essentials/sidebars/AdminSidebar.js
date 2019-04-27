import React from 'react';
import { Link } from "react-router-dom";

const AdminSidebar = () => {

    return (
        <div className="bg-light border-right" id="sidebar-wrapper" style={{height: "100vh"}}>
            <div className="list-group list-group-flush">
                <Link to="/" className="list-group-item list-group-item-action bg-light">Dashboard</Link>
                <Link to="/users" className="list-group-item list-group-item-action bg-light">Users</Link>
                <Link to="/oauth" className="list-group-item list-group-item-action bg-light">Oauth Clients</Link>
            </div>
        </div>
    );
};


export default AdminSidebar;