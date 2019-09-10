import React, { Component } from 'react';
import { View,Image,Text,StyleSheet,TextInput,Dimensions,TouchableOpacity } from 'react-native';
import { styles } from '../styles';

const {width,height} = Dimensions.get('screen')

class SignIn extends Component {
  constructor(props) {
    super(props);
    this.state = {
        
    };
  }

  render() {
    return (
      <View style={styles.intro}>
        <Image style={{width: 200, height: 80}} source={require('../assests/Sign_in/game_bar_logo.png')} />
        <Text style={stylesImg.textStyle}>sign in</Text>
        <View style={{width:width * 0.80,marginTop:50,marginBottom:50}}> 
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.icon} source={require('../assests/Sign_in/email_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Enter email ID"/>
            </View>
            <View style={{marginVertical:15}}></View>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_in/password_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Password"/>
                <Image  style={styles.passwordShowIcon} source={require('../assests/Sign_in/password_icon.png')} />
            </View>
            <TouchableOpacity style={{marginTop:15}}>
                <Text style={{color:'#fff',textAlign:'right'}}>Forgot Password</Text>
            </TouchableOpacity>
        </View>
        <View style={{marginTop:30}}>
            <TouchableOpacity style={styles.btnApps}>
                <Text style={styles.btnText}>get started</Text>
            </TouchableOpacity>
        </View>
        <View style={{flexDirection:'row',marginTop:30}}>
            <Text style={{color:'#fff',textAlign:'center'}}>Dont have any account</Text>
            <TouchableOpacity onPress={() => this.props.navigation.replace('SignUp')}>
                <Text style={{color:'#fff',textAlign:'right'}}>Sign Up</Text>
            </TouchableOpacity>
        </View>
       
      </View>
    );
  }
}

export default SignIn;

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
