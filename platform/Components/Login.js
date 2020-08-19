import React, { Component } from "react";
import { StyleSheet, View, ActivityIndicator, Text} from "react-native";
import * as Font from 'expo-font';
import {getAuth} from "../API/auth.js"
import { Button, ThemeProvider, Input } from 'react-native-elements';
import Icon from 'react-native-vector-icons/FontAwesome';
import { connect } from 'react-redux';

class Login extends React.Component {
  async componentDidMount() {
      await Font.loadAsync({
        'bellota': require('../assets/fonts/bellota.ttf'),
      });
    }
  constructor(props) {
    super(props)
    this.email = ""
    this.password = ""
    this.state = {
      isLoading: false,
      error: ""
    }
  }

  _auth = () => {
    this.setState({ isLoading: true })
    getAuth(this.email, this.password).then(data => {
        if(data.status == "success"){
          const action = { type: "LOGINUSER", value: data}
          this.props.dispatch(action)
        }else{
          this.setState({error: data.message})
        }
        this.setState({ isLoading: false })
    })
  }

  _displayLoading() {
    if (this.state.isLoading) {
      return (
        <View style={styles.loading_container}>
          <ActivityIndicator size='large' />
        </View>
      )
    }
  }

  _displayError() {
      return (
        <View style>
          <Text style={styles.errorStyle}>{this.state.error}</Text>
        </View>
      )
  }

  render() {
    return (
      <View style={styles.container}>
        {this._displayError()}
        <Input
          containerStyle={styles.textInput}
          inputStyle={{marginTop: '80%'}}
          placeholder="E-mail"
          onChangeText={(text) => this.email = text}
        />
        <Input
          containerStyle={styles.textInput}
          inputStyle={{marginTop: '10%'}}
          placeholder="Mot de passe"
          secureTextEntry = {true}
          onChangeText={(text) => this.password = text}
        />
        <ThemeProvider>
          <Button containerStyle={styles.Button_1} title="Login" onPress={() => this._auth()}/>
        </ThemeProvider>
        {this._displayLoading()}
      </View>
    )
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1
  },
  textInput:{
    width: '70%',
    alignSelf: "center"
  },
  Button_1: {
    width: 139,
    height: '100%',
    marginTop: '60%',
    alignSelf: "center"
  },
  loading_container: {
    position: 'absolute',
    left: 0,
    right: 0,
    top: 201,
    bottom: 0,
    alignItems: 'center',
    justifyContent: 'center'
  },
  errorStyle: {
    fontFamily: "bellota",
    fontSize: 18,
    color: 'darkred',
    textAlign: 'center',
    top: "100%"
  }
});

const mapStateToProps = state => {
  return {
    jwt: state.jwt
  }
}
export default connect(mapStateToProps)(Login)
