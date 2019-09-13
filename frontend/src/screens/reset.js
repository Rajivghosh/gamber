import React, { Component } from 'react';
import { View, Text, Image,StyleSheet,Dimensions,TextInput,TouchableOpacity} from 'react-native';
import { styles } from '../styles';
// const {width,height} = Dimensions.get('window')
export default class Reset extends Component {
  constructor(props) {
    super(props);
    this.state = {
    };
  }

  render() {
    return (
      <View style={styles.container}>
          <View style={stylesImg.forgetPassword}>
            <TouchableOpacity style={{justifyContent:'row'}}>
                {/* implement back button */}
                <Text style={{color:'#fff',textAlign:'left'}}>Forgot Password</Text>
            </TouchableOpacity>
          </View>
          <View  style={styles.intro}>
            <Image style={{width:200,height:150}} source={require('../assests/Forgot_password/forgot_password_graphics.png')}></Image>
            <Text style={stylesImg.textStyle}>we will send you an email with reset instruction</Text>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.icon} source={require('../assests/Sign_in/email_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Enter email ID"/>
            </View>
            <View style={{marginTop:50}}>
                <TouchableOpacity style={styles.btnApps}>
                    <Text style={styles.btnText}>reset</Text>
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
        marginVertical:80,
        lineHeight : 25,
        fontSize:16,
        textTransform:'capitalize',
        fontWeight:'500',
        fontSize:20
    },
    forgetPassword:{
        justifyContent : 'flex-start',
        backgroundColor: "#090f1f",
    }
});
