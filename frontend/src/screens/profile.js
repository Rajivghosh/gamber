import React, { Component } from 'react';
import { View, Text } from 'react-native';

export default class profile extends Component {
  constructor(props) {
    super(props);
    this.state = {
    };
  }

  render() {
    return (
      <View style={{justifyContent:'center',alignItems:'center',flex:1,backgroundColor:'#090f1f'}}>
        <Text style={{color:'#fff',fontSize:30}}> Upcoming </Text>
      </View>
    );
  }
}
