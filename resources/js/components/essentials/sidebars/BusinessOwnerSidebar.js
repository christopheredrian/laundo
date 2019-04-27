import React from 'react';
import { Link } from "react-router-dom";

const Sidebar = () => {

    return (
        <div className="bg-light border-right" id="sidebar-wrapper" style={{height: "100vh"}}>
            <div className="list-group list-group-flush">
                <Link to="/" className="list-group-item list-group-item-action bg-light">Dashboard</Link>
                <Link to="/sales" className="list-group-item list-group-item-action bg-light">Sales</Link>
                <Link to="/settings" className="list-group-item list-group-item-action bg-light">Settings</Link>
                <Link to="/users" className="list-group-item list-group-item-action bg-light">Users</Link>
            </div>
        </div>
    );
};


export default Sidebar;