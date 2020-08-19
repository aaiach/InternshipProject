const initialState = { }

function authUser(state = initialState, action) {
  let nextState
  switch (action.type) {
    case 'LOGINUSER':{
        nextState = {...state, jwt: action.value.jwt}
      }
      return nextState || state
    case 'LOGOUTUSER':{
        nextState = {...state, jwt: false}
      }
      return nextState || state
  default:
    return state
  }
}

export default authUser
