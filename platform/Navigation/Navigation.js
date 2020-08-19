import React, { Component } from "react";
import { createStackNavigator } from '@react-navigation/stack';

import Login from '../Components/Login'
import Temp from '../Components/Temp'
import { connect } from 'react-redux';

const Stack = createStackNavigator();

class Nav extends Component {
  render() {
    console.log(this.props)
    if(!this.props.jwt){
      return (
          <Stack.Navigator>
            <Stack.Screen name="Login" component={Login} />
          </Stack.Navigator>
      );
    }else{
      return (
          <Stack.Navigator>
            <Stack.Screen name="Temp" component={Temp} />
          </Stack.Navigator>
      );
    }
  }
}

const mapStateToProps = state => {
  return {
    jwt: state.jwt
  }
}

export default connect(mapStateToProps)(Nav)
