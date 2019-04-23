import React from 'react';

import PropTypes from 'prop-types';


const Text = (props) => {
    return (
        <span className={props.className}>
            {props.children}
        </span>
    );
};

Text.propTypes = {
    onClick: PropTypes.func
};


export default Text;