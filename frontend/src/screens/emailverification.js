import React, { Component } from 'react';
import { View,Image,Text,StyleSheet,TextInput,Dimensions,TouchableOpacity,Alert,AsyncStorage } from 'react-native';
import {styles} from '../styles/index'

const{width,height} = Dimensions.get('screen')
export default class EmailVerification extends Component {
  constructor(props) {
    super(props);
    this.state = {
      code : '',
      errCode : '',

    };
  }

  submitHandler = async () => {

      if(this.state.code !== ""){
      
        let code = new FormData();
      
        code.append('code',this.state.code)
      
        fetch('https://nodejsdapldevelopments.com/gamebar/public/api/emailverify',{
          method : 'POST',
          headers:{
            'Content-Type': "multipart/form-data"
          },
          body: code
        })
        .then(res => res.json())
        .then(res => {
          console.log(res);
        
          if(res.message == "Email verification code not valid"){
          
            alert(`Email verification code not valid`)
          
          }else{
          
              Alert.alert(
                'Success',
                res.message,
                [
                
                  {text: 'Yes', onPress: () => this.props.navigation.navigate('SignUp2') },
                ],
                { cancelable: false }
              )
              
              try {
              
                 AsyncStorage.setItem('verificationCode',this.state.code);
              
              }catch (error) {
              
                alert('Error saving data');
                
              }
          
          }
        
        })
      
    }
    else{

      this.setState({errCode : `Please enter code`});

    }

   
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
                    placeholder="Enter code"
                    onChangeText={(text) => this.setState({code : text})}/>
            </View>

            <Text style={{color:'#fff'}}>{this.state.errCode}</Text>

            <View style={{marginTop:30}}>
              <TouchableOpacity style={styles.btnApps} onPress={() => this.submitHandler()}>
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

