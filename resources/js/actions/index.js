import {LOGIN_SUCCESS, INITIALIZE_USER} from '../constants/action-types';

export function loginSuccess(payload) {
    console.log('@action loginSuccess');

    return {
        type: LOGIN_SUCCESS,
        payload
    }
};

export function initializeUser(payload) {
    return {
        type: INITIALIZE_USER,
        payload
    }
}