import { createStore } from 'redux';
import toggleFavorite from './Reducers/authReducer'

export default createStore(toggleFavorite)
