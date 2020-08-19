// Components/Test.js

import React, { Component } from "react";
import { View, Text} from "react-native";
import * as Font from 'expo-font';
import { Button, ThemeProvider } from 'react-native-elements';
import { connect } from 'react-redux';

class Temp extends React.Component {

 async componentDidMount() {
    await Font.loadAsync({
      "roboto-regular":require("../assets/fonts/roboto-regular.ttf")
    });
  }

  _logout = () => {
    const action = { type: "LOGOUTUSER" }
    this.props.dispatch(action)
  }

  render() {
    return (
      <View>
        <Button title="Logout" onPress={() => this._logout()}/>
      </View>
    )
  }
}

const mapStateToProps = state => {
  return {
    jwt: state.jwt
  }
}

export default connect(mapStateToProps)(Temp)
