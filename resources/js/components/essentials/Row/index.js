import React, {Component} from 'react';
import ReactDOM from 'react-dom';


const Row = (props) => {
    return (
        <div className={'row'} style={...props.style}>
            {props.children}
        </div>
    );
};

export default Row;