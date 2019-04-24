import React from 'react';

const Row = (props) => {

    let classNames = "row";


    if (props.className) {
        classNames = `${classNames} ${props.className}`;
    }


    return (
        <div className={classNames} style={props.style}>
            {props.children}
        </div>
    );
};

export default Row;