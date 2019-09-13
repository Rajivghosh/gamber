import React, { Component } from 'react';
import { View,Image,StyleSheet,Dimensions } from 'react-native';
import { styles } from '../styles';
const win = Dimensions.get('window');
const ratio = win.width / 180;
class Splash extends Component {
  constructor(props) {
    super(props);
    this.state = {
    };
  }
  componentDidMount() { setTimeout(() => { this.props.navigation.replace("Intro"); }, 2500); }
  componentWillUnmount() { clearTimeout(); }
  render() {
    return (
      <View style={styles.splash}>
          <Image style={stylesImg.imageStyle} source={require('../assests/Splash/splash_screen.png')} />
      </View>
    );
  }
}

const stylesImg = StyleSheet.create({
    imageStyle: {
        width: win.width,
        height: 362 * ratio,
    }
});


export default Splash;
