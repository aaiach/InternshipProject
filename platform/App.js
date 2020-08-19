import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Store from './Store/configureStore'
import { Provider } from 'react-redux'

import Nav from "./Navigation/Navigation.js"

import 'react-native-gesture-handler';
import { NavigationContainer } from '@react-navigation/native';

export default function App() {
  return (
    <NavigationContainer>
      <Provider store={Store}>
        <Nav>
        </Nav>
      </Provider>
    </NavigationContainer>
  );
}
