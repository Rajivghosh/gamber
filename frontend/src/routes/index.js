import React from 'react'
import { createStackNavigator,createAppContainer,createBottomTabNavigator} from "react-navigation";
import {Image} from 'react-native';
import Splash from '../screens/splash'
import Intro from "../screens/intro";
import SignIn from "../screens/signin";
import Reset from "../screens/reset";
// import SignUp from "../screens/signup2";
import SignUp2 from "../screens/signup2"
import  EventCategory from "../screens/eventCategory";
import Filter from "../screens/filter";
// import signup2 from "../screens/signup";
import SignUp from "../screens/signup"
// import EmailVerification from "../screens/emailverification";
import EmailVerification from '../screens/emailverification'
import ForgotPassword from "../screens/forgotPassword";
import Lobby from "../screens/lobby";
import CompetitionLevel from "../screens/competitionLevel";
import EventList from "../screens/eventList";
import Header from "../Components/header";
import Stats from '../screens/stats'
import EventDetails from '../screens/eventDetails';



const TabNavigator = createBottomTabNavigator(
    {
        Lobby: {
            screen: Lobby,
            navigationOptions: {
                tabBarLabel: "Lobby",
                tabBarIcon: ({ tintColor }) => (<Image source={require('../assests/Common_icon/lobby_icon_select.png')} style={{width:30,height:30}}/>)
            },
        },
        Stats: {
            screen: Stats,
            navigationOptions: {
                tabBarLabel: "Stats",
                tabBarIcon: ({ tintColor }) => (<Image source={require('../assests/Common_icon/stats_icon_select.png')} style={{width:30,height:30}}/>)
            },
        },
    },
    {
        tabBarOptions:{
            activeBackgroundColor : '#000',
            inactiveBackgroundColor : '#000'
        }
    }

)

const MainAppNavigator = createStackNavigator(
    {
        Splash: Splash,
        Intro: Intro,
        SignIn: SignIn,
        Reset : Reset,
        SignUp : SignUp,
        SignUp2: SignUp2,
        Header: Header,
        Lobby : TabNavigator,
        EventCategory: EventCategory,
        Filter : Filter,
        EmailVerification : EmailVerification,
        ForgotPassword : ForgotPassword,
        CompetitionLevel : CompetitionLevel,
        EventList : EventList,
        EventDetails : EventDetails,
        Stats:Stats

    },
    {
        initialRouteName: "Lobby",
        headerMode: "none"
    }
);

export const AppContainer = createAppContainer(MainAppNavigator);