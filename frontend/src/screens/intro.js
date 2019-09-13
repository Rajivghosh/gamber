import React, { Component } from 'react'
import { Text, View,Image,StyleSheet,TouchableOpacity } from 'react-native'
import { styles } from '../styles';

export class Intro extends Component {
    render() {
        return (
            <View style={styles.intro}>
                <Image style={stylesImg.imageStyle} source={require('../assests/Intro_sc/intro_graphics.png')}/>
                <Text style={stylesImg.textStyle}>
                    Lorem ipsum dolor sit amet, 
                    consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in 
                    voluptate velit esse cillum dolore eu fugiat 
                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                </Text>
                <View>
                    <TouchableOpacity style={styles.btnApps} onPress={() => this.props.navigation.replace('SignIn')}>
                        <Text style={styles.btnText}>get started</Text>
                    </TouchableOpacity>
                </View>
            </View>
        )
    }
}

const stylesImg = StyleSheet.create({
    imageStyle: {
        // alignItems: "center",
        width: 165,
        height: 175,
        marginBottom: 30,
        padding:10
    },
    textStyle:{
        textAlign:'center',
        color:"#fff",
        marginVertical:30,
        lineHeight : 25
    }
});


export default  Intro
