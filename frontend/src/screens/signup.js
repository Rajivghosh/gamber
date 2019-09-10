import React, { Component } from 'react';
import { View,Image,Text,StyleSheet,TextInput,Dimensions,TouchableOpacity,CheckBox,ScrollView,DatePickerAndroid,Alert } from 'react-native';

import { styles } from '../styles';

const {width,height} = Dimensions.get('screen')

export default class SignUp extends Component {
  constructor(props) {
    super(props);
    this.state = {
      checkedAge : true,
      age : '',
      checkedPrivacy : true,
      privacy : '',
      email:'',
      userName : '',
      password:'',
      errEmail:'',
      errUserName: '',
      errPassword: '',
      dob : '',
      errDob : '',
      showDate : false
    };
  }
  allInputFields = (text,field) =>{
    if(field == 'email'){
      this.setState({email : text})
    }
    if(field == 'username'){
      this.setState({userName:text})
    }
    if(field == 'password'){
      this.setState({password: text})
    }
  }

  validity = () => {
  

    this.state.email == "" ? this.setState({errEmail : 'Please enter email'}) : this.setState({errEmail : ''});
    this.state.userName == "" ? this.setState({errUserName : 'Please enter username'}) : this.setState({errUserName:''});
    this.state.password == "" ? this.setState({errPassword : 'Please enter password'}) : this.setState({errPassword:''});
    this.state.dob == "" ? this.setState({errDob : 'Please enter date of birth'}) : this.setState({errDob : ''});
    this.state.checkedAge == true ? this.setState({age : 1}) : this.setState({age : 0});

    this.state.checkedPrivacy == true ? this.setState({privacy : 1}) : this.setState({privacy : 0});


    if(this.state.email !== "" && this.state.password !== "" && this.state.userName !== "" && this.state.dob !== ""){

      this.onPressSignUp();

    }

  }

  onPressSignUp = () => {



    var form = new FormData();

    form.append('email',this.state.email);
    form.append('password',this.state.password);
    form.append('username',this.state.userName);
    form.append('dob',this.state.dob);
    form.append('check_age',this.state.age);
    form.append('check_privacy',this.state.privacy);

    console.log(form)

    fetch('https://nodejsdapldevelopments.com/gamebar/public/api/signup',{
      method : 'POST',
      headers:{
        'Content-Type': "multipart/form-data"
      },
      body: form
    })
    .then(res => res.json())
    .then(res => {
        if(res.message == "Please fill all the required fields"){
          alert(res.message)
        }
        else if(res.message == "Sorry, Username/Email already exist"){
          alert(res.message)
        } 
        else{
          Alert.alert(
            'Success',
            res.message,
            [
              // {text: 'No', onPress: () => alert(this.constructor.name), style: 'cancel'},
              {text: 'Yes', onPress: () => this.props.navigation.navigate('signup2') },
            ],
            { cancelable: false }
        );
        }
    })
  }


  setDate =async() => {
    try {
      const {action, year, month, day} = await DatePickerAndroid.open({
        
        date: new Date(),

      });
      if (action !== DatePickerAndroid.dismissedAction) {

        let Date1 = `${year}/${month}/${day}`

        this.setState({dob : Date1})

        this.setState({showDate : true});

        console.log(this.state.dob);

      }
    } catch ({code, message}) {
      console.warn('Cannot open date picker', message);
    }
  }

  render() {
    return (
    <ScrollView>
      <View style={styles.intro}>
        <Image style={{width: 200, height: 80}} source={require('../assests/Sign_in/game_bar_logo.png')} />
        <Text style={stylesImg.textStyle}>sign up</Text>
        <View style={{width:width * 0.80,marginTop:50,marginBottom:50}}>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.icon} source={require('../assests/Sign_in/email_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    onChangeText={(text)=>this.allInputFields(text,'email')}
                    placeholder="Enter email ID"/>
            </View>
            <Text style={{color:'#fff'}}>{this.state.errEmail}</Text>
            <View style={{marginVertical:15}}></View>

              <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    onChangeText={(text) => this.allInputFields(text,'username')}
                    placeholder="User Name"/>
              </View>
              <Text style={{color:'#fff'}}>{this.state.errUserName}</Text>

            <View style={{marginVertical:15}}></View>

            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_in/password_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    onChangeText={(text) => this.allInputFields(text,'password')}
                    placeholder="Password"/>
                {/* <Image  style={styles.passwordShowIcon} source={require('../assests/Sign_in/password_icon.png')} /> */}
            </View>
            <Text style={{color:'#fff'}}>{this.state.errPassword}</Text>


            <View style={{marginVertical:10}}>
              <TouchableOpacity style={styles.btnApps} onPress={() => this.setDate()}><Text style={styles.btnText}>{this.state.showDate ? this.state.dob : `Enter DOB` }</Text></TouchableOpacity> 
              <Text style={{color:'#fff'}}>{this.state.errDob}</Text>
            </View>


            <View style={{flexDirection:'row',marginTop:20,marginBottom:10}}>
               <CheckBox 
                  style={{color:'#fff',marginRight:10}}
                  value={this.state.checkedAge}
                  onValueChange={() => {this.setState({checkedAge : !(this.state.checkedAge)})}} />
                <Text style={{color:'#fff',fontSize:16,marginVertical:5}}>Age 18 years or older</Text>
            </View>

            <View style={{flexDirection:'row'}}>
               <CheckBox
                  style={{color:'#fff',marginRight:10}}
                  value={this.state.checkedPrivacy}
                  onValueChange={() => this.setState({checkedPrivacy : !(this.state.checkedPrivacy)})} /> 

                <Text style={{color:'#fff',fontSize:16,marginVertical:5}}>Privacy Policy and Terms of Use</Text>
            </View>

            <View style={{marginTop:30}}>
              <TouchableOpacity style={styles.btnApps} onPress={() => this.validity()}>
                  <Text style={styles.btnText}>sign up</Text>
              </TouchableOpacity>
            </View>
        </View>
      </View>
    </ScrollView>
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