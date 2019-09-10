import React, { Component } from 'react';
import { View,Image,Text,StyleSheet,TextInput,Dimensions,TouchableOpacity,ScrollView,Picker } from 'react-native';
import { styles } from '../styles';

const {width,height} = Dimensions.get('screen')

class SignUp2 extends Component {
  constructor(props) {
    super(props);
    this.state = {
        
    };
  }
  

  render() {
    return (
    <ScrollView>
      <View style={styles.intro}>
        <Image style={{width: 200, height: 80}} source={require('../assests/Sign_in/game_bar_logo.png')} />
        <Text style={stylesImg.textStyle}>sign up</Text>
        <View style={{width:width * 0.80,marginTop:50,marginBottom:50}}> 
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="First Name"/>
            </View>
            <View style={{marginVertical:15}}></View>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Last Name"/>
            </View>
            <View style={{marginVertical:15}}></View>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Birthday"/>
            </View>
            <View style={{marginVertical:15}}></View>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Phone Number"/>
            </View>
            <View style={{marginVertical:15}}></View>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_in/password_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Address"/>
            </View>
            <View style={{marginVertical:15}}></View>
            <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                <View style={styles.inputButtonContainer}>
                    <Picker
                        placeholder="country"
                        selectedValue=""
                        style={stylesImg.selectedBox}>
                        <Picker.Item label="india" value="ind" />
                        <Picker.Item label="australia" value="aus" />
                    </Picker>
                </View>
                <View style={styles.inputButtonContainer}>
                    <Picker 
                        selectedValue="state"
                        style={stylesImg.selectedBox}>
                        <Picker.Item label="state" value="state" />
                        <Picker.Item label="" value="" />
                    </Picker>
                </View>
            </View>
            <View style={{marginVertical:10}}></View>
            <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                <View style={styles.inputButtonContainer}>
                    <Picker
                        // placeholder="country"
                        selectedValue="City"
                        style={stylesImg.selectedBox}>
                        <Picker.Item label="" value="" />
                        <Picker.Item label="" value="" />
                    </Picker>
                </View>
               
                <View style={styles.inputButtonContainer}>
                    <Picker 
                        selectedValue="Zip"
                        style={stylesImg.selectedBox}>
                        <Picker.Item label="" value="" />
                        <Picker.Item label="" value="" />
                    </Picker>
                </View>
            </View>
        </View>
        <View style={{marginTop:30}}>
            <TouchableOpacity style={styles.btnApps}>
                <Text style={styles.btnText}>sign up</Text>
            </TouchableOpacity>
        </View>
        <View style={{flexDirection:'row',marginTop:30,marginBottom:20}}>
            <Text style={{color:'#fff',textAlign:'center'}}>Already have any account.?</Text>
            <TouchableOpacity onPress={() => this.props.navigation.replace('SignIn')}>
                <Text style={{color:'#fff',textAlign:'right'}}>Sign In</Text>
            </TouchableOpacity>
        </View>
      </View>
    </ScrollView>
    );
  }
}

export default SignUp2;

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
    },
    selectedBox:{
        justifyContent : 'flex-start',
        marginLeft:15,
        color : 'white',
        height : 50,
        width: 140
    }
});
