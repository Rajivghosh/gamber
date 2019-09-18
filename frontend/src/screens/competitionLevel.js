import React, { Component }  from 'react';
import { View, Text, ScrollView,Image,StyleSheet,AsyncStorage,TouchableOpacity } from 'react-native';
import Header from '../Components/header';

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
      <>
      { this.state.screenId == 14 ? 
        <ScrollView style={inlineStyle.container}>
        
              <Header title="Competition Level" navigation={this.props.navigation}/>
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
          </ScrollView> : <View style={{justifyContent:'center',alignItems:'center',backgroundColor:'#090f1f',flex:1}}><Text style={{color:'#fff',fontSize:30}}>Upcoming..</Text></View>
      } 
      </>
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
