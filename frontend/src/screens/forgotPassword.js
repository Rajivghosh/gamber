import React, { Component } from 'react';
import { 
    View,
    Image,
    Text,
    StyleSheet,
    TextInput,
    Dimensions,
    TouchableOpacity,
    ScrollView,
    Alert,
    FlatList
} from 'react-native';

import { styles } from '../styles';

const {width,height} = Dimensions.get('screen')
export default class ForgotPassword extends Component {
  constructor(props) {
    super(props);
    this.state = {
        email : '',
        errEmail : ''
    };
  }

  forgetPassword = () => {
      this.state.email == "" ? this.setState({errEmail : `Please enter your email`}) : this.setState({errEmail:``});

      if(this.state.email !== ""){
            
            let form = new FormData();

            form.append('email',this.state.email)

            fetch(`https://nodejsdapldevelopments.com/gamebar/public/api/forget-password`,{
                method : 'POST',
                headers:{
                    'Content-Type': "multipart/form-data"
                },
                body: form
            })
            .then(res => res.json())
            .then(res => {
                console.log(res);

                if(res.message == "Your new password is sent to the email provided, please find and login using that."){
                    Alert.alert(
                        'Success',
                        res.message,
                        [
                        
                          {text: 'Ok', onPress: () => this.props.navigation.navigate('SignIn') },
                        ],
                        { cancelable: false }
                      )
                }else{
                    alert(res.message)
                }

            })
      }
  }

  render() {
    return (
    <View style={{flex:1}}>
    <ScrollView>
        <View style={styles.intro}>
          <View style={{width:width * 0.80,marginTop:50,marginBottom:30}}> 

            <View style={{justifyContent:'center',alignItems: 'center',marginBottom:80}}>
                <Image style={{width:130,height:100}} source={require('../assests/Forgot_password/forgot_password_graphics.png')} />
            </View>
             
              <View style={{marginTop:10,marginBottom:45}}>
                  <Text style={{color:'#fff',textAlign:'center',fontSize:18}}>We will send you an email with reset instruction</Text>
              </View>
              <View style={styles.inputButtonContainer}>
  
                  <Image  style={styles.icon} source={require('../assests/Sign_in/email_icon.png')} />
                  <TextInput
                      style={styles.inputButton}
                      placeholderTextColor="#fff"
                      placeholder="Enter Email ID"
                      onChangeText={(text) => this.setState({email:text})}/>
  
  
              </View>
              <Text style={{color:'#fff'}}>{this.state.errEmail}</Text>
  
          </View>
          <View style={{marginTop:30,paddingBottom:110}}>
              <TouchableOpacity style={styles.btnApps} onPress={() => this.forgetPassword()}>
                  <Text style={styles.btnText}>Reset</Text>
              </TouchableOpacity>
          </View>
        </View>
    </ScrollView>
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