import React, { Component } from 'react';
import { View, Text, ScrollView, Image, StyleSheet, TouchableOpacity,AsyncStorage, ToastAndroid } from 'react-native';
import { styles } from '../styles';
import Header from '../Components/header'


//Start component
export default class EventDetails extends Component {
    constructor(props) {
        super(props);
        this.state = {
            game : [],
            detials: "",
            extractedDate : "",
            extractedTime : "",
            days:""
        };
    }
    componentDidMount = async() => {
        let token = await AsyncStorage.getItem('token');

        const { navigation } = this.props;
    
        const comp_level_id = navigation.getParam('comp_level_id');
    
        const screen_id = navigation.getParam('screen_id');
    
        const category_id = navigation.getParam('category_id');

        const event_id = navigation.getParam('event_id')
        
        console.log(event_id);

        let form = new FormData();
        form.append('token', token);
        form.append('screen_id', screen_id);
        form.append('comp_level_id', comp_level_id);
        form.append('category_id', category_id);
        form.append('event_id', event_id);

        fetch('https://nodejsdapldevelopments.com/gamebar/public/api/event_details ', {
            method: 'POST',
            headers: {
                'Content-Type': "multipart/form-data"
            },
            body: form
        })
        .then(res => res.json())
        .then(res => {
            console.log("EVENT DETAILS", res)
            this.setState({game : res.result.game})
            this.setState({detials : res.result.details})
           
            const date = this.state.detials.event_start_date;

            const endDate = this.state.detials.event_end_date;

            const date1 = date.substr(0,date.indexOf(' '));

            console.log(date1);

            this.setState({extractedDate : date1});

            const time1 = date.substr(date.indexOf(' ')+1);

            console.log(time1);

            this.setState({extractedTime : time1});

            const endDate1 = endDate.substr(0,endDate.indexOf(' '));

            console.log(endDate1-date1);

            var calDate1 = new Date(date1);
            var calDate2 = new Date(endDate1);
            var subDate = calDate2 - calDate1;
            var days = (((subDate/1000)/60)/(60*24));
            this.setState({days : days})



        })
    }

    onJoin = async() =>{

        let token = await AsyncStorage.getItem('token');

        const { navigation } = this.props;

        const comp_level_id = navigation.getParam('comp_level_id');
    
        const screen_id = navigation.getParam('screen_id');
    
        const category_id = navigation.getParam('category_id');

        const event_id = navigation.getParam('event_id')
        
        let form = new FormData();
        form.append('token', token);
        form.append('screen_id', screen_id);
        form.append('comp_level_id', comp_level_id);
        form.append('category_id', category_id);
        form.append('event_id', event_id);

        fetch('https://nodejsdapldevelopments.com/gamebar/public/api/event_joining', {
            method: 'POST',
            headers: {
                'Content-Type': "multipart/form-data"
            },
            body: form
        })
        .then(res => res.json())
        .then(res => {
           console.log("join datya", res)
           if(res.status===100 || res.status===300){
            ToastAndroid.show(res.message, ToastAndroid.SHORT, ToastAndroid.CENTER,);
           }
           
        })

    }

    render() {

        

        return (
            <ScrollView style={inlineStyle.container}>
                <Header title="Event Details" navigation={this.props.navigation} />
                <View>
                    <View style={{ backgroundColor: "white",height:200}}>
                        <Image source={{uri:this.state.detials.banner}} style={{height:'100%'}}/>
                    </View>
                    <Text style={{ color: "white", marginLeft: 10 }}>{this.state.detials.gen_title}</Text>
                </View>
                <View style={{ flexDirection: "row", justifyContent: "space-around", marginTop: 20 }}>
                    <View>
                        <Text style={{ color: "white", marginLeft: 10 }}>Event Date</Text>
                        <Text style={{ color: "white", marginLeft: 10 }}>{this.state.extractedDate}</Text>
                    </View>
                    <View>
                        <Text style={{ color: "white", marginLeft: 10 }}>Start Time</Text>
                        <Text style={{ color: "white", marginLeft: 10 }}>{this.state.extractedTime}</Text>
                    </View>
                    <View>
                        <Text style={{ color: "white", marginLeft: 10 }}>Event Duration</Text>
                        <Text style={{ color: "white", marginLeft: 10 }}>{this.state.days} days</Text>
                    </View>
                </View>

                <View
                    style={{
                        marginTop: 20,
                        borderBottomColor: 'white',
                        marginLeft: 28,
                        marginRight: 20,
                        borderBottomWidth: 1,
                    }}
                />
                <View style={{ flexDirection: "row", justifyContent: "space-around", marginTop: 15 }}>
                    <View style={{flexDirection:"row"}}>
                        <Text style={{ color: "white"}}>Game Type :</Text>
                        <Text style={{color:'green'}}>{this.state.detials.game_type}</Text>
                    </View>

                    <Text style={{ color: "white"}}>Match Length : {this.state.detials.match_length} mins</Text>
                </View>
                <View
                    style={{
                        marginTop: 20,
                        borderBottomColor: 'white',
                        marginLeft: 28,
                        marginRight: 20,
                        borderBottomWidth: 1,
                    }}
                />
                <View style={{ flexDirection: "row", justifyContent: "space-around", marginTop: 15 }}>
                    <View>
                        <Text style={{ color: "white", marginLeft: 10 }}>Prize Pool</Text>
                        <Text style={{ color: "green", marginLeft: 10 }}>${this.state.detials.win_prize}</Text>
                    </View>
                    <View>
                        <Text style={{ color: "white", marginLeft: 10 }}>Total Enteries</Text>
                        <Text style={{ color: "white", marginLeft: 10 }}>{this.state.detials.total_entries}</Text>
                    </View>
                    <View>
                        <Text style={{ color: "white", marginLeft: 10 }}>Entry Fee</Text>
                        <Text style={{ color: "white", marginLeft: 10 }}>${this.state.detials.entry_fees}</Text>
                    </View>
                </View>
                <View
                    style={{
                        marginTop: 20,
                        borderBottomColor: 'white',
                        marginLeft: 28,
                        marginRight: 20,
                        borderBottomWidth: 1,
                    }}
                />
                <View style={{ flexDirection: "row", justifyContent: "space-around", marginTop: 20 }}>

                    <Text style={{ color: "white", paddingLeft: 15 }}>Dropdown(Winner) Not found</Text>

                    <View style={{ flexDirection: "row", justifyContent: "space-between" }}>
                        <View style={{ flexDirection: "row", marginRight: 8 }} >
                            <View style={{ marginRight:5, borderRadius: 10, width: 17, backgroundColor: "#01b7ff", justifyContent: "center", alignItems: "center" }}>
                                <Text style={{color:"#fff"}}>C</Text>
                            </View>
                            <Text style={{ color: "white" }}>Confirmed</Text>
                        </View>
                        <View style={{ flexDirection: "row", }} >
                            <View style={{ marginRight:5,color: "green", borderRadius: 10, width: 17, backgroundColor: "pink", justifyContent: "center", alignItems: "center" }}>
                                <Text style={{color:"#ffffff"}}>M</Text>
                            </View>
                            <Text style={{ color: "white" }}>Multi Entry</Text>
                        </View>
                    </View>
                </View>
                <View style={{ flexDirection: "row", justifyContent: "space-between",marginVertical:10}}>
                    <Text style={{color:"#fff",marginLeft:20}}>Venue :{this.state.detials.venue}</Text>
                    <Text style={{color:"#fff",marginRight:20}}>Controls Types: {this.state.detials.control_type}</Text>
                </View>

                <Text style={{ color: "white", marginLeft: 20 }}>
                    Additional Rules & Information
                    </Text>
                <View>
                    <Text style={{ color: "white", marginLeft: 20 }}>
                        After 1 minute of gameplay any complaints on log.
                    </Text>
                </View>
                <View style={inlineStyle.buttonView}>
                    <TouchableOpacity style={inlineStyle.buttonStyle}>
                        <View style={inlineStyle.btnNestedView}>
                            <Text style={{color:"#fff"}}>Game Statistics</Text>
                            <Text style={inlineStyle.btnRightText}>></Text>
                        </View>

                    </TouchableOpacity>
                    <TouchableOpacity style={inlineStyle.buttonStyle}>
                        <View style={inlineStyle.btnNestedView}>
                            <Text style={{color:"#fff"}}>Game Results Form</Text>
                            <Text style={inlineStyle.btnRightText}>></Text>
                        </View>
                    </TouchableOpacity>
                    <TouchableOpacity style={inlineStyle.buttonStyle}>
                        <View style={inlineStyle.btnNestedView}>
                            <Text style={{color:"#fff"}}>Player Credibility</Text>
                            <Text style={inlineStyle.btnRightText}>></Text>
                        </View>
                    </TouchableOpacity>
                    <TouchableOpacity style={inlineStyle.buttonStyle}>
                        <View style={inlineStyle.btnNestedView}>
                            <Text style={{color:"#fff"}}>Rewards & Payouts</Text>
                            <Text style={inlineStyle.btnRightText}>></Text>
                        </View>
                    </TouchableOpacity>
                    <TouchableOpacity style={inlineStyle.buttonStyle}>
                        <View style={inlineStyle.btnNestedView}>
                            <Text style={{color:"#fff"}}>Price Distribution</Text>
                            <Text style={inlineStyle.btnRightText}>></Text>
                        </View>
                    </TouchableOpacity>
                </View>

                <View style={{ marginBottom: 20, alignItems: "center", justifyContent: "center" }}>
                    {this.state.detials.event_status === 1 ?
                    <TouchableOpacity 
                    onPress={()=>{this.onJoin()}}
                    style={{
                        backgroundColor: "#01b7ff",
                        paddingRight: 50, paddingLeft: 50, paddingTop: 10, paddingBottom: 10, borderRadius: 50
                    }}>
                        <Text style={{ fontSize: 20, color: "#ffffff" }}>
                            JOIN
                        </Text>
                    </TouchableOpacity>:
                    <TouchableOpacity disabled={true} style={{
                        backgroundColor: "#01b7ff",
                        paddingRight: 50, paddingLeft: 50, paddingTop: 10, paddingBottom: 10, borderRadius: 50
                    }}>
                        <Text style={{ fontSize: 20, color: "#ffffff" }}>
                            UPCOMING
                        </Text>
                    </TouchableOpacity>
                    }
                    
                </View>

            </ScrollView>

        );
    }
}

const inlineStyle = StyleSheet.create({
    headerBox: {

    },
    container: {
        flex: 1,
        paddingTop: 10,
        backgroundColor: "#090f1f",
    },
    textStyle: {
        color: "#fff",
        textAlign: 'center',
        alignSelf: 'center',
        fontSize: 16,
        textTransform: 'capitalize'
    },
    pointsStyle: {
        // display:'flex',
        color: "#fff",
        textAlign: 'center',
        // alignSelf:'center',
        marginVertical: 7,
        fontSize: 16
    },
    buttonView: {
        marginTop: 20, padding: 15
    },
    buttonStyle: {
        // color:"#fff",
        backgroundColor: "#181e2e",
        padding: 10,
        borderRadius: 10,
        marginBottom: 15,
    },
    btnNestedView: {
        flexDirection: "row",
        justifyContent: "space-between",
        alignItems: "center"
    },
    btnRightText: { fontSize: 20 }
});