import React, { Component } from 'react'
import { Text, View,StyleSheet,Image,Slider,ScrollView,TouchableOpacity,Dimensions } from 'react-native'
import { styles } from '../styles';
const{width,height} = Dimensions.get('window')
export default class Filter extends Component {
    render() {
        return (
            <ScrollView style={inlineStyle.container}>
                <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <View>
                        <Text style={{color:'#fff',marginVertical:25,fontSize:16}}>Event Category</Text>
                    </View>
                    <View style={{flexDirection:'row'}}>
                        <Image  style={{width:20,height:20,marginRight:10,marginVertical:30}} source={require('../assests/Common_icon/help_icon.png')}/>
                        <Image  style={{width:17,height:17,marginVertical:30}} source={require('../assests/Common_icon/notification_icon.png')}/>
                    </View>
              </View>
              {/*  */}
              <View  style={styles.categories}>
                <View><Text style={inlineStyle.itemHeaderText}>Short by</Text></View>
                <View style={{borderBottomWidth:1,borderColor:'#707287',marginTop:10}}></View>
                <View>
                    <View style={{flexDirection:'row',justifyContent:'space-between',marginTop:15}}>
                        <Text style={inlineStyle.text}>Start Date</Text>
                        <View>
                            <Image  style={{width:5,height:6}} source={require('../assests/Filter/up_arrow.png')} />
                        </View>
                        <View style={inlineStyle.radioButton}>
                            <View style={inlineStyle.radioButtonChild}></View>
                        </View>
                    </View>
                    <View style={{flexDirection:'row',justifyContent:'space-between',marginTop:15}}>
                        <Text style={inlineStyle.text}>Stop Date</Text>
                        <View>
                            <Image  style={{width:5,height:6}} source={require('../assests/Filter/down_arrow.png')} />
                        </View>
                        <View style={inlineStyle.radioButton}>
                            <View style={inlineStyle.radioButtonChild}></View>
                        </View>
                    </View>
                </View>
              </View>
              {/*  */}
              <View style={styles.categories}>
                <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <Text style={inlineStyle.itemHeaderText}>Console</Text>
                    <View style={{flexDirection:'row'}}>    
                        <Text style={inlineStyle.text}>PS4</Text>
                        <Image style={{width:10,height:15,marginLeft:10,marginTop:5}} source={require('../assests/Common_icon/next_icon.png')} />
                    </View>
                </View>
              </View>
              {/*  */}
              <View style={styles.categories}>
                 <View><Text style={inlineStyle.itemHeaderText}>Entry Fee</Text></View>
                 <View style={{borderBottomWidth:1,borderColor:'#707287',marginTop:10}}></View>
                 <View>
                    <View style={{flexDirection:'row',justifyContent:'space-between',marginTop:10}}>
                        <View style={inlineStyle.entryFee}>
                            <Text style={inlineStyle.text}>$1 - 10</Text>
                        </View>
                        <View style={inlineStyle.entryFee}>
                            <Text style={inlineStyle.text}>$10 - 25</Text>
                        </View>
                        <View style={inlineStyle.entryFee}>
                            <Text style={inlineStyle.text}>$30 - 50</Text>
                        </View>
                    </View>
                    <View style={{flexDirection:'row',marginTop:20}}>
                        <View style={inlineStyle.entryFee}>
                            <Text style={inlineStyle.text}>$50 - 60</Text>
                        </View>
                        <View style={{marginHorizontal:7}}></View>
                        <View style={inlineStyle.entryFee}>
                            <Text style={inlineStyle.text}>$70 - 90</Text>
                        </View>
                    </View>
                 </View>
              </View>
              {/* *******Slider****** */}
              <View style={styles.categories}>
                <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                    <Text style={inlineStyle.itemHeaderText}>Payout</Text>
                    <Text style={inlineStyle.itemHeaderText}>Price Range</Text>
                </View>
                <View style={{borderBottomWidth:1,borderColor:'#707287',marginTop:10}}></View>
                <Slider
                    style={{ marginTop:40,alignSelf: 'stretch' }}
                    step={1}
                    minimumValue={18}
                    maximumValue={71}
                    maximumTrackTintColor="#000"
                    // onValueChange = {}
                />
              </View>
              {/* SLider */}
              <View style={styles.categories}>
                <View><Text style={inlineStyle.itemHeaderText}>Entries</Text></View>
                <View style={{borderBottomWidth:1,borderColor:'#707287',marginTop:10}}></View>
                <View style={{flexDirection:'row',marginTop:20}}>
                        <View style={inlineStyle.entryFee}>
                            <Text style={inlineStyle.text}>SINGLE</Text>
                        </View>
                        <View style={{marginHorizontal:7}}></View>
                        <View style={inlineStyle.entryFee}>
                            <Text style={inlineStyle.text}>MULTIPLE</Text>
                        </View>
                </View>
              </View>
              <View style={{marginTop:30,flexDirection:'row',justifyContent:'space-between'}}>
                  <View>
                    <TouchableOpacity style={inlineStyle.btnApps}>
                        <Text style={styles.btnText}>Reset</Text>
                    </TouchableOpacity>
                  </View>
                  <View>
                    <TouchableOpacity style={inlineStyle.btnApps1}>
                        <Text style={styles.btnText}>Apply</Text>
                    </TouchableOpacity>
                  </View>
            </View>
            </ScrollView>
        )
    }
}

const inlineStyle = StyleSheet.create({
    container:{
        flex: 1,
        // paddingTop:,
        paddingHorizontal: 30,
        backgroundColor: "#090f1f",
    },
    itemHeaderText:{
        color:'#707287',
        fontSize:12
    },
    text:{
        color:'#fff',
        fontSize:16
    },
    radioButton:{
        height:24,
        width:24,
        borderRadius: 12,
        borderWidth: 2,
        backgroundColor: '#fff',
        alignItems: 'center',
        justifyContent: 'center',
    },
    radioButtonChild:{
        height: 12,
        width: 12,
        borderRadius: 6,
        backgroundColor: '#01b7ff',
    },
    entryFee:{
        // borderWidth:1,
        backgroundColor: '#2b2e41',
        paddingHorizontal:20
    },
    btnApps:{
        borderWidth : 1,
        backgroundColor : '#fe6b85',
        borderRadius: 40,
        paddingVertical:12,
        width: width*0.4
        // width : width * .80
    },
    btnApps1:{
        borderWidth : 1,
        backgroundColor : '#01b7ff',
        borderRadius: 40,
        paddingVertical:12,
        width: width*0.4
        // width : width * .80
    }

});
