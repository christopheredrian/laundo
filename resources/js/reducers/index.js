import {LOGIN_SUCCESS, INITIALIZE_USER} from "../constants/action-types";

const initialState = {
    auth: null
};

function rootReducer(state = initialState, action) {

    switch (action.type) {

        case LOGIN_SUCCESS:
            return {
                ...state,
                auth: action.payload
            };
            break;

        case INITIALIZE_USER:
            return {
                ...state,
                user: action.payload
            };


        default:
            break;
    }

    return state;
};
export default rootReducer;