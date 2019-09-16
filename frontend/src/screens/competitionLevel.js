import React, { Component }  from 'react';
import { View, Text, ScrollView,Image,StyleSheet,AsyncStorage,TouchableOpacity } from 'react-native';

class competitionLevel extends Component {
  constructor(props) {
    super(props);
    this.state = {

      level : [],
      game : [],
      screenId : '',

    };
  }

  componentDidMount = async() => {

    let token = await AsyncStorage.getItem('token');

    // console.log(`token ${token}`);

    const { navigation } = this.props;

    const screenId = navigation.getParam('screen_id');
    
    // console.log(screenId);

    this.setState({screenId : screenId});

    // AsyncStorage.setItem('screen_id', this.state.screenId)

    

    console.log(screenId);

    let form = new FormData();

    form.append('token',token);
    form.append('screen_id',screenId);

    fetch('https://nodejsdapldevelopments.com/gamebar/public/api/comp_level',{
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
      this.setState({game : res.result.game});

    })
  }

  render() {
    return (
        <ScrollView style={inlineStyle.container}>
              <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <View>
                        <Text style={{color:'#fff',marginVertical:30,fontSize:16}}>Competition Level</Text>
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
                {
                  this.state.level.map(data => {
                    return(
                      <View key={data.id}>
                        <TouchableOpacity
                          onPress={() => this.props.navigation.navigate('EventCategory',{screen_id: this.state.screenId,comp_level_id:data.id})} 
                          style={{borderWidth:1 ,borderRadius:10,borderColor:'#fff',marginVertical:10,backgroundColor:data.name=='Compitative' ? '#9600aa':'#87CEFA',marginHorizontal:15}}>

                            <Text style={{color:'#fff',textAlign:'center',marginVertical:5,fontSize:20,textTransform:'uppercase'}}>{data.name}</Text>
                            <Text style={{color:'#fff',textAlign:'center',marginVertical:5,fontSize:16,textTransform:'capitalize'}}>{data.type}</Text>

                        </TouchableOpacity>
                      </View>
                    )
                  
                  })
                }
              </View>
          </ScrollView>
    );
  }
}

export default competitionLevel;

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
