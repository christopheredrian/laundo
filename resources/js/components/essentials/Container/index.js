import React from 'react';


const Container = (props) => {
    return (
        <div className={'container'} style={props.style}>
            {props.children}
        </div>
    );
};

export default Container ;