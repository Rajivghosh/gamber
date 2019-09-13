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
    Picker,
    AsyncStorage,
    DatePickerAndroid
} from 'react-native';
import { styles } from '../styles';

const {width,height} = Dimensions.get('screen')

class SignUp2 extends Component {
  constructor(props) {
    super(props);
    this.state = {
        email : '',
        password : '',

        country : [],
        selectedCountryId : '',

        statee : [],
        selectedStateId : '',

        city: [],
        selectedCityId : '',

        firstName : '',
        lastName : '',
        birthday : '',
        phoneNumber : '',
        address : '',
        showDate : false,
        zipCode : '',

        errFirstName : '',
        errLastName : '',
        errBirthday : '',
        errPhoneNumber : '',
        errAddress : '',
        


    };
  }

  componentDidMount(){

    //fetching all countries.


    fetch('https://nodejsdapldevelopments.com/gamebar/public/api/country',{
        method : 'GET',

        headers:{
          'Content-Type': "multipart/form-data"
        }

    })
    .then(res => res.json())
    .then(res => {

        console.log(res);

        this.setState({country : res.result});

    })

  }


  allInputField = (text,field) => {
    if(field == 'firstName'){
        this.setState({firstName : text})
    }
    if(field == 'lastName'){
        this.setState({lastName : text})
    }

    if(field == 'phoneNumber'){
        this.setState({phoneNumber : text})
    }

    if(field == 'address'){
        this.setState({address : text})
    }

    if(field == 'zipcode'){
        this.setState({zipCode : text})
    }
  }



  setDate =async() => {
    try {
      const {action, year, month, day} = await DatePickerAndroid.open({
        
        date: new Date(),

      });
      if (action !== DatePickerAndroid.dismissedAction) {

        let Date1 = `${year}/${month}/${day}`

        this.setState({birthday : Date1})

        this.setState({showDate : true});

        console.log(this.state.birthday);

      }
    } catch ({code, message}) {
      console.warn('Cannot open date picker', message);
    }
  }


  selectState = (itemValue) => {

    console.log(`item value ${itemValue}`);

    fetch(`https://nodejsdapldevelopments.com/gamebar/public/api/state/${itemValue}`,{
        method : 'GET',
        headers:{
          'Content-Type': "multipart/form-data"
        }
        
    })
    .then(res => res.json())
    .then(res => {
        console.log(res);
        this.setState({statee : res.result})
        console.log(this.state.statee)
    })

  }

  selectCity = (itemValue) => {

      console.log(itemValue);

      fetch(`https://nodejsdapldevelopments.com/gamebar/public/api/city/${itemValue}`,{
        method : 'GET',
        headers:{
          'Content-Type': "multipart/form-data"
        }
      })
      .then(res => res.json())
      .then(res => {
          console.log(res);
          this.setState({city:res.result});
          console.log(this.state.city);
      })
  }
 

  signUp = async() => {
        const {firstName,lastName,birthday,phoneNumber,address,selectedCountryId,selectedStateId,selectedCityId,zipCode} = this.state

        console.log(firstName,lastName,birthday,phoneNumber,address,selectedCountryId,selectedStateId,selectedCityId,zipCode);

        firstName == "" ? this.setState({errFirstName : `Please enter first name`}) : this.setState({errFirstName : ''});
        lastName == "" ? this.setState({errLastName : `Please enter last name`}) : this.setState({errLastName : ''});
        birthday == "" ? this.setState({errBirthday : `Please enter birthday`}) : this.setState({errBirthday : ''})
        phoneNumber == "" ? this.setState({errPhoneNumber : `Please enter phone number`}) : this.setState({errPhoneNumber : ''});
        address == "" ? this.setState({errAddress : `Please enter address`}) : this.setState({errAddress : ''});
        zipCode == "" ? alert(`Please enter zipcode`) : null;

        let verficationCode ; 

        try {
            verficationCode = await AsyncStorage.getItem('verificationCode');
            if (value !== null) {

              console.log(value);
            }
          } catch (error) {

            alert('Error! verification code not found');

        }
        console.log(verficationCode);

        if(firstName !== "" && lastName !== "" && birthday !== "" && phoneNumber !== "" && address !== "" && selectedCountryId !== "" && selectedStateId !== "" && zipCode !== ""){
            
            let form = new FormData();

            form.append('verify_code',verficationCode);
            form.append('first_name',firstName);
            form.append('last_name',lastName);
            form.append('contact_no',phoneNumber);
            form.append('address',address);
            form.append('country',selectedCountryId);
            form.append('state',selectedStateId);
            form.append('city',this.selectedCityId);
            form.append('zip_code',this.state.zipCode);


            
            fetch('https://nodejsdapldevelopments.com/gamebar/public/api/register',{
                method : 'POST',
                headers:{
                    'Content-Type': "multipart/form-data"
                },
                body : form
            })
            .then(res => res.json())
            .then(res => {
                console.log(res);
                if(res.message == "Resgistered Succesfully"){
                    this.props.navigation.navigate('Login')
                }

            })
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
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="First Name"
                    onChangeText={(text) => this.allInputField(text,'firstName')}/>
            </View>
            <Text style={{color:'#fff'}}>{this.state.errFirstName}</Text>

            <View style={{marginVertical:15}}></View>

            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Last Name"
                    onChangeText={(text) => this.allInputField(text,'lastName')}/>
            </View>
            <Text style={{color:'#fff'}}>{this.state.errLastName}</Text>

            <View style={{marginVertical:15}}></View>

            <View style={styles.inputButtonContainer}>
                <TouchableOpacity onPress={() => this.setDate()} style={{flexDirection:'row'}}>

                    <Image  style={{width:12,height:17,marginHorizontal:17,marginVertical:12}} source={require('../assests/Sign_up/user_icon.png')} />
                    <TextInput
                        value={this.state.birthday}
                        style={styles.inputButton}
                        placeholderTextColor="#fff"
                        placeholder="Birthday"/>

                </TouchableOpacity>
               
            </View>
            <Text style={{color:'#fff'}}>{this.state.errBirthday}</Text>


            <View style={{marginVertical:15}}></View>
            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Phone Number"
                    onChangeText={(text) => this.allInputField(text,'phoneNumber')}/>
            </View>
            <Text style={{color:'#fff'}}>{this.state.errPhoneNumber}</Text>

            <View style={{marginVertical:15}}></View>

            <View style={styles.inputButtonContainer}>
                <Image  style={styles.passwordIcon} source={require('../assests/Sign_in/password_icon.png')} />
                <TextInput
                    style={styles.inputButton}
                    placeholderTextColor="#fff"
                    placeholder="Address"
                    onChangeText={(text) => this.allInputField(text,'address')}/>
            </View>
            <Text style={{color:'#fff'}}>{this.state.errAddress}</Text>


            <View style={{marginVertical:15}}></View>

            <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                <View style={styles.inputButtonContainer}>

                    <Picker
                        selectedValue={this.state.selectedCountryId}
                        style={stylesImg.selectedBox}
                        onValueChange={(itemValue,itemIndex) => {
                            
                            this.setState({selectedCountryId : itemValue})

                            this.selectState(itemValue);

                        }}>
                        {
                            this.state.country.map((index,key) => {
                                return(
                                    <Picker.Item
                                        key={index.id} 
                                        label={index.country_name} 
                                        value={index.id} 
                                    />
                                )
                            })
                        }
                    </Picker>
                </View>

                <View style={styles.inputButtonContainer}>

                    <Picker 
                        selectedValue={this.state.selectedStateId}
                        style={stylesImg.selectedBox}
                        onValueChange = {(itemValue) => {
                            this.setState({selectedStateId : itemValue});

                            this.selectCity(itemValue);

                        }}>
                        {
                            this.state.statee.map((index,key) => {
                                return(
                                    <Picker.Item
                                        key={index.id} 
                                        label={index.state_name} 
                                        value={index.id} 
                                    />
                                )
                            })
                        }
                    </Picker>
                    
                </View>

            </View>
            <View style={{marginVertical:10}}></View>
            <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                <View style={styles.inputButtonContainer}>


                    <Picker 
                            selectedValue={this.state.selectedCity}
                            style={stylesImg.selectedBox}
                            onValueChange = {(itemValue) => this.setState({selectedCityId : itemValue})}>
                            {
                                this.state.city.map((index,key) => {
                                    return(
                                        <Picker.Item
                                            key={index.id} 
                                            label={index.city_name} 
                                            value={index.id} 
                                        />
                                    )
                                })
                            }
                    </Picker>


                </View>
               
                <View style={stylesImg.inputButtonContainer}>
                    <Image  style={styles.passwordIcon} source={require('../assests/Sign_in/password_icon.png')} />
                    <TextInput
                        style={styles.inputButton}
                        placeholderTextColor="#fff"
                        placeholder="zipcode"
                        onChangeText={(text) => this.allInputField(text,'zipcode')}/>
                </View>

            </View>
        </View>
        <View style={{marginTop:30}}>
            <TouchableOpacity style={styles.btnApps} onPress={() => this.signUp()}>
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
    },
    inputButtonContainer:{
        marginLeft:15,
        flexDirection: 'row',
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#181e2e',
        borderRadius:40,
        borderWidth:0.5,
        borderColor:"#fff",
        width : 155
    }

});
