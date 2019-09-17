import React from 'react'
import { View, Text, Image,TouchableOpacity} from 'react-native';
import Back from 'react-native-vector-icons/Ionicons'
import {withNavigation} from 'react-navigation'

function Header(props){
    return(
        <View style={{flexDirection:'row',justifyContent:'space-between'}}>
                <View style={{flexDirection:'row'}}>
                    <View style={{flexDirection:'row'}}>
                        <TouchableOpacity onPress={() => props.navigation.goBack()}><Back style={{fontSize:32,marginTop:25,marginHorizontal:8}} color="#fff" name="ios-arrow-round-back"/></TouchableOpacity>
                        <Text style={{color:'#fff',marginVertical:30,fontSize:16,marginLeft:5}}>{props.title}</Text>
                    </View>
                </View>
                <View style={{flexDirection:'row'}}>
                    <Image  style={{width:30,height:30,marginRight:10,marginVertical:30}} source={require('../assests/Common_icon/help_icon.png')}/>
                    <Image  style={{width:27,height:27,marginVertical:30}} source={require('../assests/Common_icon/notification_icon.png')}/>
                </View>
        </View>
    )
}

export default withNavigation(Header);