import React from 'react';


import PropTypes from 'prop-types';


const Button = (props) => {
    return (
        <button
            onClick={props.onClick}
            style={props.style}
            className={'btn btn-primary'}
        >
            {props.children}
        </button>
    );
};

Button.propTypes = {
    onClick: PropTypes.func
};


export default Button;