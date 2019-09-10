import React, { Component } from 'react';
import { View,Image,Text,StyleSheet,TextInput,Dimensions,TouchableOpacity } from 'react-native';
import {styles} from '../styles/index'

const{width,height} = Dimensions.get('screen')
export default class EmailVerification extends Component {
  constructor(props) {
    super(props);
    this.state = {
    };
  }

  render() {
    return (
      <View style={styles.intro}>
         <Image style={{width: 200, height: 80}} source={require('../assests/Sign_in/game_bar_logo.png')} />
         <Text style={stylesImg.textStyle}>Emial Verification</Text>
         <View style={{marginTop:50,marginBottom:50,width:width*0.80}}>
            <View style={styles.inputButtonContainer}>
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Enter code"/>
            </View>
            <View style={{marginTop:30}}>
              <TouchableOpacity style={styles.btnApps} onPress={() => this.props.navigation.replace('SignUp2')}>
                  <Text style={styles.btnText}>submit</Text>
              </TouchableOpacity>
            </View>
         </View>
      </View>
    );
  }
}

const stylesImg = StyleSheet.create({
    imageStyle: {
        // alignItems: "center",
        width: 150,
        height: 150,
        marginBottom: 30,
        padding:10,

    },
    textStyle:{
        textAlign:'center',
        color:"#fff",
        marginVertical:30,
        lineHeight : 25,
        fontSize:16,
        textTransform:'capitalize',
        fontWeight:'500'
    }
});

