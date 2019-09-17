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
  AsyncStorage
} from 'react-native';
import { styles } from '../styles';

import MaterialCommunityIcons from 'react-native-vector-icons/MaterialCommunityIcons'

const { width, height } = Dimensions.get('screen')

class SignIn extends Component {
  constructor(props) {
    super(props);
    this.state = {
      email: '',
      password: '',
      errEmail: '',
      errPassword: '',
      iconName: 'eye',
      passwordVisible: false,

    };
  }

  allInputField = (text, field) => {
    if (field == "email") {
      this.setState({ email: text });
    }
    if (field == "password") {
      this.setState({ password: text });
    }
  }

  onPasswordVisiblityHandler = () => {
    let iconName = this.state.passwordVisible ? 'eye' : 'eye-off'
    this.setState(prevState => {
      return {
        passwordVisible: !(prevState.passwordVisible),
        iconName: iconName
      }
    })
  }

  signIn = () => {

    this.state.email == "" ? this.setState({ errEmail: `Please enter email` }) : this.setState({ errEmail: `` });
    this.state.password == "" ? this.setState({ errPassword: `Please enter password` }) : this.setState({ errPassword: `` });

    if (this.state.email !== "" && this.state.password !== "") {

      let form = new FormData();
      form.append('email', this.state.email);
      form.append('password', this.state.password);

      fetch('https://nodejsdapldevelopments.com/gamebar/public/api/signin', {
        method: 'POST',
        headers: {
          'Content-Type': "multipart/form-data"
        },
        body: form
      })
        .then(res => res.json())
        .then(res => {
          console.log(res);

          if (res.message == "Successful, Login") {

            // let token = res.result.filter(i =>  i == "login_token");

            // console.log(res.result[0].login_token);

            let token = res.result[0].login_token

            // console.log(token);

            AsyncStorage.setItem('token', res.result[0].login_token);


            Alert.alert(
              'Success',
              res.message,
              [

                { text: 'Ok', onPress: () => this.props.navigation.navigate('Lobby') },
              ],
              { cancelable: false }
            )
          }
          else {
            alert(res.message)
          }
        })
    }

  }


  render() {
    return (
      <ScrollView>
        <View style={styles.intro}>
          <Image style={{ width: 200, height: 80 }} source={require('../assests/Sign_in/game_bar_logo.png')} />
          <Text style={stylesImg.textStyle}>sign in</Text>
          <View style={{ width: width * 0.80, marginTop: 50, marginBottom: 50 }}>
            <View style={styles.inputButtonContainer}>

              <Image style={styles.icon} source={require('../assests/Sign_in/email_icon.png')} />
              <TextInput
                keyboardType="email-address"
                returnKeyType="next"
                style={styles.inputButton}
                placeholderTextColor="#fff"
                placeholder="Enter email ID"
                onSubmitEditing={() => this.password.focus()}
                onChangeText={(text) => this.allInputField(text, 'email')} />


            </View>
            <Text style={{ color: '#fff' }}>{this.state.errEmail}</Text>

            <View style={{ marginVertical: 15 }}></View>

            <View style={styles.inputButtonContainer}>

              <Image style={styles.passwordIcon} source={require('../assests/Sign_in/password_icon.png')} />
              <TextInput
                ref={(input) => this.password = input}
                secureTextEntry={!this.state.passwordVisible}
                style={styles.inputButton}
                returnKeyType="go"
                placeholderTextColor="#fff"
                placeholder="Password"
                onChangeText={(text) => this.allInputField(text, 'password')}
                onSubmitEditing={() => this.signIn()}
              />

              <TouchableOpacity
                style={{ marginRight: 10 }}
                onPress={() => this.onPasswordVisiblityHandler()}>
                <MaterialCommunityIcons name={this.state.iconName} size={20} color="#fff" />
              </TouchableOpacity>


            </View>
            <Text style={{ color: '#fff' }}>{this.state.errPassword}</Text>

            <TouchableOpacity style={{ marginTop: 15 }} onPress={() => this.props.navigation.navigate('ForgotPassword')}>
              <Text style={{ color: '#fff', textAlign: 'right' }}>Forgot Password</Text>
            </TouchableOpacity>
          </View>
          <View style={{ marginTop: 30 }}>
            <TouchableOpacity style={styles.btnApps} onPress={() => this.signIn()}>
              <Text style={styles.btnText}>get started</Text>
            </TouchableOpacity>
          </View>
          <View style={{ flexDirection: 'row', marginTop: 30 }}>
            <Text style={{ color: '#fff', textAlign: 'center' }}>Dont have any account</Text>
            <TouchableOpacity onPress={() => this.props.navigation.navigate('SignUp')}>
              <Text style={{ color: '#fff', textAlign: 'right' }}>Sign Up</Text>
            </TouchableOpacity>
          </View>

        </View>
      </ScrollView>
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
    padding: 10,

  },
  textStyle: {
    textAlign: 'center',
    color: "#fff",
    marginVertical: 30,
    lineHeight: 25,
    fontSize: 16,
    textTransform: 'capitalize',
    fontWeight: '500'
  }
});
