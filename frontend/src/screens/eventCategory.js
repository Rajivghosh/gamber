import React, { Component } from 'react';
import { View, Text, ScrollView,Image,StyleSheet,AsyncStorage, TouchableOpacity } from 'react-native';
import { styles } from '../styles';

export default class EventCategory extends Component {
  constructor(props) {
    super(props);
    this.state = {

      category : [],

      compLevelId : '',
      screenId: ''


    };
  }

  componentDidMount = async() => {

    let token = await AsyncStorage.getItem('token');

    console.log(`token ${token}`);

    // let screen_id = await AsyncStorage.getItem('screen_id');

    // console.log(`screen_id ${screen_id}`)

    const { navigation } = this.props;
    
    const comp_level_id = navigation.getParam('comp_level_id');
    this.setState({compLevelId : comp_level_id})

    const screen_id = navigation.getParam('screen_id');
    this.setState({screenId : screen_id})

    console.log(`comp_level_id ${comp_level_id}`);
    console.log(`screen id ${screen_id}`);

    let form = new FormData();

    form.append('token',token);
    form.append('screen_id',screen_id);
    form.append('comp_level_id',comp_level_id);

    fetch('https://nodejsdapldevelopments.com/gamebar/public/api/event_category',{
      method : 'POST',
      headers:{
        'Content-Type': "multipart/form-data"
      },
      body: form
    })
    .then(res => res.json())
    .then(res => {
      console.log(res);

      this.setState({category : res.result.category})

      console.log(this.state.category)

    })

  }

  render() {
    return (
          <ScrollView style={inlineStyle.container}>
              <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <View>
                        <Text style={{color:'#fff',marginVertical:30,fontSize:16}}>Event Category</Text>
                    </View>
                    <View style={{flexDirection:'row'}}>
                        <Image  style={{width:30,height:30,marginRight:10,marginVertical:30}} source={require('../assests/Common_icon/help_icon.png')}/>
                        <Image  style={{width:27,height:27,marginVertical:30}} source={require('../assests/Common_icon/notification_icon.png')}/>
                    </View>
              </View>
              {
                this.state.category.map(data => {
                  return(
                    <TouchableOpacity
                      onPress={() => this.props.navigation.navigate('EventList',{comp_level_id:this.state.compLevelId,screen_id:this.state.screenId,category_id:data.id})} 
                      style={styles.categories} key={data.id}>
                      <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                        <Text style={inlineStyle.textStyle}>{data.name}</Text>
                        <View>
                         <View style={styles.categoryNumber}>
                             <View> 
                                <Text style={inlineStyle.pointsStyle}>{data.count}</Text>
                             </View>
                         </View>
                        </View>
                      </View>
                    </TouchableOpacity>
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