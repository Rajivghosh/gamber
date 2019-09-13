import React, { Component } from 'react';
import { View, Text, ScrollView,Image,StyleSheet } from 'react-native';
import { styles } from '../styles';
export default class EventCategory extends Component {
  constructor(props) {
    super(props);
    this.state = {



    };
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
              <View style={styles.categories}>
                  <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <Text style={inlineStyle.textStyle}>challenges</Text>
                    <View>
                     <View style={styles.categoryNumber}>
                         <View> 
                            <Text style={inlineStyle.pointsStyle}>5</Text>
                         </View>
                     </View>
                    </View>
                  </View>
              </View>
              <View style={styles.categories}>
                  <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <Text style={inlineStyle.textStyle}>head-to-head</Text>
                    <View>
                     <View style={styles.categoryNumber}>
                         <View style={{justifyContent:'center',alignContent:'center'}}> 
                            <Text style={inlineStyle.pointsStyle}>5</Text>
                         </View>
                     </View>
                    </View>
                  </View>
              </View>
              <View style={styles.categories}>
                  <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <Text style={inlineStyle.textStyle}>tournaments</Text>
                    <View>
                     <View style={styles.categoryNumber}>
                         <View style={{justifyContent:'center',alignContent:'center'}}> 
                            <Text style={inlineStyle.pointsStyle}>5</Text>
                         </View>
                     </View>
                    </View>
                  </View>
              </View>
              <View style={styles.categories}>
                  <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <Text style={inlineStyle.textStyle}>ladders</Text>
                    <View>
                     <View style={styles.categoryNumber}>
                         <View style={{justifyContent:'center',alignContent:'center'}}> 
                            <Text style={inlineStyle.pointsStyle}>5</Text>
                         </View>
                     </View>
                    </View>
                  </View>
              </View>
              <View style={styles.categories}>
                  <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <Text style={inlineStyle.textStyle}>leagues</Text>
                    <View>
                     <View style={styles.categoryNumber}>
                         <View style={{justifyContent:'center',alignContent:'center'}}> 
                            <Text style={inlineStyle.pointsStyle}>5</Text>
                         </View>
                     </View>
                    </View>
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