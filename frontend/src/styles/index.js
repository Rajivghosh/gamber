import { StyleSheet,Dimensions } from "react-native";

const {height,width} = Dimensions.get('window');

export const styles = StyleSheet.create({
    container:{
        width : width,
        height : height
    },
    splash: {
        flex : 1,
        justifyContent: "center",
        alignItems: "center",
        backgroundColor: "#000000",
    },
    intro: {
        flex: 1,
        alignItems: "center",
        paddingTop : 50,
        paddingHorizontal: 30,
        backgroundColor: "#090f1f",
    },
    btnApps:{
        borderWidth : 1,
        backgroundColor : '#01b7ff',
        borderRadius: 40,
        paddingVertical:12,
        width : width * .80
    },
    btnText:{
        textTransform:'uppercase',
        textAlign:'center',
        color:'#fff',
        fontSize: 16
    },

    inputButtonContainer: {
        flexDirection: 'row',
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#181e2e',
        borderRadius:40,
        borderWidth:0.5,
        borderColor:"#fff"
    },
    icon:{
        width : 17,
        height : 12,
        marginHorizontal:15
    },
    passwordIcon:{
        width : 12,
        height : 17,
        marginHorizontal:17
    },
    passwordShowIcon:{
        justifyContent : 'flex-end',
        width : 12,
        height : 17,
        marginRight:30
    },
    inputButton: {
        flex: 1,
        paddingTop: 10,
        paddingRight: 10,
        paddingBottom: 10,
        paddingLeft: 0,
        color: '#fff',
        width: width *.80,
        fontSize: 15,
        fontWeight:'100'
    },
    categories:{
        backgroundColor: '#181e2e',
        borderRadius:10,
        borderColor: '#292f41',
        borderWidth:1,
        paddingHorizontal:20,
        marginVertical:10,
        paddingVertical:10
    },
    categoryNumber: {
        backgroundColor :'#01b7ff',
        width : 35,
        height : 35,
        borderRadius : 35/2,
        borderWidth : 1,
        marginVertical : 25,
    }
});