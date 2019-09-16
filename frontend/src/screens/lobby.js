import React, { Component } from 'react';
import { View, Text, ScrollView,Image,StyleSheet,AsyncStorage,TouchableOpacity } from 'react-native';
import { styles } from '../styles';
export default class Lobby extends Component {
  constructor(props) {
    super(props);
    this.state = {

      datas : [],
      id : '',

    };
  }

  componentDidMount = async() => {
    let form = new FormData();

    let token = await AsyncStorage.getItem('token');

    console.log(token);

    form.append('token',token)

    fetch('https://nodejsdapldevelopments.com/gamebar/public/api/game_list',{
      method : 'POST',
      headers:{
        'Content-Type': "multipart/form-data"
      },
      body: form
    })
    .then(res => res.json())
    .then(res => {

      console.log(res);

      this.setState({datas : res.result});

      console.log(this.state.datas);

    })

    

  }

  render() {
    return (
          <ScrollView style={inlineStyle.container}>
              <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <View>
                        <Text style={{color:'#fff',marginVertical:30,fontSize:16}}>Lobby</Text>
                    </View>
                    <View style={{flexDirection:'row'}}>
                        <Image  style={{width:30,height:30,marginRight:10,marginVertical:30}} source={require('../assests/Common_icon/help_icon.png')}/>
                        <Image  style={{width:27,height:27,marginVertical:30}} source={require('../assests/Common_icon/notification_icon.png')}/>
                    </View>
              </View>
              {
                this.state.datas.map(data => {
                 
                  return(
                    <View key={data.id}>
                      <View style={{flex:1 , marginVertical:10}}>
                        <TouchableOpacity onPress={() => this.props.navigation.navigate('CompetitionLevel',{screen_id : data.id})}>
                          <Image source={{uri : data.logo}} style={{height:150,width:'100%'}} />
                        </TouchableOpacity>
                      </View>
                    </View>

                  )
                })
              }
          </ScrollView>
   
    );
  }
}

const inlineStyle = StyleSheet.create({
    headerBox: {

    },
    container:{
        flex: 1,
        paddingTop:10,
        paddingHorizontal: 30,
        backgroundColor: "#090f1f",
    },
    textStyle:{
        color:"#fff",
        textAlign : 'center',
        alignSelf: 'center',
        fontSize:16,
        textTransform: 'capitalize'
    },
    pointsStyle:{
      // display:'flex',
      color:"#fff",
      textAlign : 'center',
      // alignSelf:'center',
      marginVertical:7,
      fontSize:16
    }
});