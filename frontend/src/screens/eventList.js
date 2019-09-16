import React, { Component } from 'react';
import { View, Text, ScrollView,Image,StyleSheet,AsyncStorage, TouchableOpacity,TextInput } from 'react-native';
import { styles } from '../styles';

export default class EventList extends Component {
  constructor(props) {
    super(props);
    this.state = {
        game : [],
        list : [],
        level : [],
        newList : []
    };
  }

  componentDidMount =async() =>{ 

    let token = await AsyncStorage.getItem('token');

    const { navigation } = this.props;
    
    const comp_level_id = navigation.getParam('comp_level_id');
    // this.setState({compLevelId : comp_level_id})

    const screen_id = navigation.getParam('screen_id');
    // this.setState({screenId : this.state.screen_id});

    const category_id = navigation.getParam('category_id');

    console.log(`comp_level_id ${comp_level_id}`);
    console.log(`screen id ${screen_id}`);
    console.log(`category_id ${category_id}`);

    let form = new FormData();

    form.append('token',token);
    form.append('screen_id',screen_id);
    form.append('comp_level_id',comp_level_id);
    form.append('category_id',category_id);

    fetch('https://nodejsdapldevelopments.com/gamebar/public/api/event_list',{
        method : 'POST',
        headers:{
          'Content-Type': "multipart/form-data"
        },
        body: form
    })
    .then(res => res.json())
    .then(res => {
        console.log(res)

        this.setState({level : res.result.level});
        this.setState({list : res.result.list[0]});
        this.setState({game: res.result.game});

        const newList = this.state.list.map(index =>  index)
        this.setState({newList : newList});
    
        this.state.newList.map(index => console.log(index));
    })

   
  }

  render() {
    return (
        <ScrollView style={inlineStyle.container}>
              <View style={{flexDirection:'row',justifyContent:'space-between',marginHorizontal:10}}>
                    <View>
                        <Text style={{color:'#fff',marginVertical:30,fontSize:16}}>Event Category</Text>
                    </View>
                    <View style={{flexDirection:'row'}}>
                        <Image  style={{width:30,height:30,marginRight:10,marginVertical:30}} source={require('../assests/Common_icon/help_icon.png')}/>
                        <Image  style={{width:27,height:27,marginVertical:30}} source={require('../assests/Common_icon/notification_icon.png')}/>
                    </View>
              </View>

              <View>
                {
                    this.state.game.map(data => {
                        return(
                          <View style={{flex:1 , marginVertical:10}} key={data.id}>
                            <Image source={{uri : data.logo}} style={{height:170,width:'100%'}} />
                          </View>
                        )
                    })
                }
              </View>
              <View style={{marginHorizontal:10,marginTop:30}}>
                <View style={styles.inputButtonContainer}>
                    <Image  style={styles.passwordIcon} source={require('../assests/Sign_up/user_icon.png')} />
                    <TextInput
                        style={styles.inputButton}
                        placeholderTextColor="#fff"
                        placeholder="Search"
                        onChangeText={(text) => this.allInputField(text,'firstName')}/>
                </View>

                <View style={{marginTop:10}}>

                  <View style={{justifyContent:'center',marginBottom:8}}>
                    <Text style={{color:'#fff',textAlign:'center'}}>List of Events</Text>
                  </View>

                  <View>
                    <View style={{borderBottomWidth:1,borderColor:'#fff'}}></View>
                  </View>

                </View>

                <View>
                    {
                        this.state.list.map(data =>{
                            return(
                                <View style={styles.categories} key={data.id}> 
                                    <View style={{flexDirection:"row",marginVertical:10}}>
                                        <Text style={{color:'#fff'}}>{data.gen_title}</Text>
                                    </View>
                                    
                                    <View style={{borderBottomWidth:1,borderColor:'#fff'}}></View>

                                    <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                                        <Text></Text>

                                        <View style={{flexDirection:'row'}}>
                                          <Text style={{color:'#fff',}}>${data.entry_fees}</Text>
                                          <Text style={{color:'green',marginLeft:10}}>${data.win_prize}</Text>
                                        </View>

                                    </View>

                                    <View style={{flexDirection:'row',justifyContent:'space-between'}}>

                                        <Text style={{color:'#fff',textAlign:'left'}}>Entries</Text>

                                        <View style={{flexDirection:'row'}}>
                                          <Text style={{color:'#fff'}}>Entry</Text>
                                          <Text style={{color:'#fff',marginLeft:10}}>Prizes</Text>
                                        </View>
                                    </View>

                                </View>
                            )
                        })
                    }
                </View>
              </View>
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
        // paddingHorizontal: 30,
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