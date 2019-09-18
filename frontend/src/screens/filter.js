import React, { Component } from 'react'
import { Text, View, StyleSheet, Image, Alert, ScrollView, AsyncStorage, Picker, TouchableOpacity, Dimensions } from 'react-native'
import { styles } from '../styles';
import RangeSlider from 'rn-range-slider';
import DatePicker from 'react-native-datepicker'

const { width, height } = Dimensions.get('window')

export default class Filter extends Component {
    constructor(props) {
        super(props);
        this.state = {
            result: "",
            startDate: "",
            endDate: "",
            eventId: "",
            entryFee: "",
            entryType: "",
            payoutLow: 2000,
            payoutHigh: 8000
        }
    }
    async componentDidMount() {
        let token = await AsyncStorage.getItem('token');

        let form = new FormData();
        form.append('token', "9c86f317eaa514a5c8b7b400a91a4600");
        form.append('screen_id', 14);
        fetch("https://nodejsdapldevelopments.com/gamebar/public/api/filter_fetch", {
            method: 'POST',
            headers: {
                'Content-Type': "multipart/form-data"
            },
            body: form
        })
            .then(res => res.json())
            .then(res => {
                console.log("result ", res)
                this.setState({
                    result: res.result
                })
            })
    }

    onApplyFilter = async () => {
        let form = new FormData();

        const { navigation } = this.props;

        const comp_level_id = navigation.getParam('comp_level_id');

        const screen_id = navigation.getParam('screen_id');

        const category_id = navigation.getParam('category_id');


        let token = await AsyncStorage.getItem('token');


        const { eventId, entryType, startDate, endDate, entryFee, payoutLow, payoutHigh } = this.state;

        if (eventId !== "") {
            form.append('venue', eventId);
        } 
        if (entryType !== "") {
            form.append('game_entry_type', entryType);
        } 
        if (startDate !== "") {
            form.append('start_date', startDate);
        }
        if (endDate !== "") {
            form.append('end_date', endDate);
        } 
        if (entryFee !== "") {
            form.append('entry_fees', entryFee);
        }   
            form.append('token', token);
            form.append('screen_id', screen_id);
            form.append('comp_level_id', comp_level_id);
            form.append('category_id', category_id);  
            form.append('payout', payoutLow - payoutHigh);

            // console.log(`token ${token} screen_id ${screen_id} comp_level_id ${comp_level_id} category_id ${category_id} start_date ${startDate} end_date ${endDate}
            // entryFees ${entryFee} payout ${payout} venue ${eventId} game_entry_type ${entryType} `)

            fetch("https://nodejsdapldevelopments.com/gamebar/public/api/filtered_event_list", {
                method: 'POST',
                headers: {
                    'Content-Type': "multipart/form-data"
                },
                body: form
                })
                .then(res => res.json())
                .then(res => {
                    console.log("resultttt ", res.result.list)
                        this.props.navigation.navigate('EventList', {
                            
                            list: res.result.list,
                          })
                    
                })
    }

    resetData = () => {
        Alert.alert("Reset data", "Do you want to reset data ?", [
            { text: "No", onPress: () => (No = "no") },
            { text: "Yes", onPress: () => this.clearState() }
        ]);
        return true;
    }
    clearState() {
        this.setState({
            startDate: "",
            endDate: "",
            eventId: "",
            entryFee: "",
            entryType: "",
        })
    }

    render() {
        console.log("start data", this.state.startDate)
        return (
            <ScrollView style={inlineStyle.container}>
                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                    <View>
                        <Text style={{ color: '#fff', marginVertical: 25, fontSize: 16 }}>Event Category</Text>
                    </View>
                    <View style={{ flexDirection: 'row' }}>
                        <Image style={{ width: 20, height: 20, marginRight: 10, marginVertical: 30 }} source={require('../assests/Common_icon/help_icon.png')} />
                        <Image style={{ width: 17, height: 17, marginVertical: 30 }} source={require('../assests/Common_icon/notification_icon.png')} />
                    </View>
                </View>
                {/*  */}
                <View style={styles.categories}>
                    <View><Text style={inlineStyle.itemHeaderText}>Short by</Text></View>
                    <View style={{ borderBottomWidth: 1, borderColor: '#707287', marginTop: 10 }}></View>
                    <View>
                        <View style={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 15 }}>
                            <Text style={inlineStyle.text}>Start Date : </Text>
                            <DatePicker
                                style={{ width: 150 }}
                                date={this.state.startDate}
                                mode="date"
                                placeholder="Start date"
                                format="YYYY-MM-DD"

                                confirmBtnText="Confirm"
                                cancelBtnText="Cancel"
                                customStyles={{
                                    dateIcon: {
                                        position: 'absolute',
                                        left: 0,
                                        top: 4,
                                        marginLeft: 0
                                    },
                                    dateInput: {
                                        marginLeft: 36
                                    }
                                }}
                                onDateChange={(date) => { this.setState({ startDate: date }) }}
                            />

                            {/* <View>
                                <Image style={{ width: 5, height: 6 }} source={require('../assests/Filter/up_arrow.png')} />
                            </View> */}
                            <View style={inlineStyle.radioButton}>
                                <View style={inlineStyle.radioButtonChild}></View>
                            </View>
                        </View>
                        <View style={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 15 }}>
                            <Text style={inlineStyle.text}>Stop Date : </Text>
                            <DatePicker
                                style={{ width: 150 }}
                                date={this.state.endDate}
                                mode="date"
                                placeholder="End date"
                                format="YYYY-MM-DD"

                                confirmBtnText="Confirm"
                                cancelBtnText="Cancel"
                                customStyles={{
                                    dateIcon: {
                                        position: 'absolute',
                                        left: 0,
                                        top: 4,
                                        marginLeft: 0,
                                    },
                                    dateInput: {
                                        marginLeft: 36,

                                    }

                                }}
                                onDateChange={(date) => { this.setState({ endDate: date }) }}
                            />

                            {/* <View>
                                <Image style={{ width: 5, height: 6 }} source={require('../assests/Filter/down_arrow.png')} />
                            </View> */}
                            <View style={inlineStyle.radioButton}>
                                <View style={inlineStyle.radioButtonChild}></View>
                            </View>
                        </View>
                    </View>
                </View>

                <View style={styles.categories}>
                    {this.state.result.hasOwnProperty("event_venue") || this.state.result.event_venue !== undefined ?
                        <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                            <Picker
                                style={{
                                    height: 30,
                                    width: "50%",
                                    color: '#ffffff',
                                    justifyContent: 'center',
                                }}
                                selectedValue={this.state.eventId}
                                onValueChange={(itemValue, itemPosition) =>
                                    this.setState({ eventId: itemValue })}
                            >
                                <Picker.Item label="Select..." color='white' />
                                {this.state.result.event_venue.map((event, index) => {
                                    return (
                                        <Picker.Item label={event.name} value={event.id} key={index} />
                                    )
                                })}
                            </Picker>
                            <View style={{ flexDirection: 'row' }}>
                                <Text style={inlineStyle.text}>PS4</Text>
                                <Image style={{ width: 10, height: 15, marginLeft: 10, marginTop: 5 }} source={require('../assests/Common_icon/next_icon.png')} />
                            </View>
                        </View>
                        : null}
                </View>
                {/*  */}
                <View style={styles.categories}>
                    <View style={{ flexDirection: "row" }}>
                        <Text style={inlineStyle.itemHeaderText}>Entry Fee </Text>
                        <Text style={{ color: "#ffffff" }}>{" "}{this.state.entryFee}</Text>
                    </View>
                    <View style={{ borderBottomWidth: 1, borderColor: '#707287', marginTop: 10 }}></View>
                    {this.state.result.hasOwnProperty("fees_interval") || this.state.result.fees_interval !== undefined ?
                        <View style={{
                            flexDirection: 'row',
                            justifyContent: 'space-between',
                            marginTop: 10,
                            flex: 1, flexWrap: 'wrap'
                        }}>
                            {this.state.result.fees_interval.map((fee, index) => {
                                return (
                                    <TouchableOpacity style={inlineStyle.entryFee} key={index}
                                        onPress={() => this.setState({ entryFee: fee })}
                                    >
                                        <Text style={inlineStyle.text}>{fee}</Text>
                                    </TouchableOpacity>
                                )
                            })}
                        </View>
                        : null}

                </View>
                {/* *******Slider****** */}
                <View style={styles.categories}>
                    <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                        <Text style={inlineStyle.itemHeaderText}>Payout</Text>
                        <Text style={inlineStyle.itemHeaderText}>Price Range</Text>
                    </View>
                    <View style={{ borderBottomWidth: 1, borderColor: '#707287', marginTop: 10 }}>
                        <Text style={{ color: "white" }}>
                            {this.state.payoutLow}-{this.state.payoutHigh}
                        </Text>
                    </View>
                    <RangeSlider
                        style={{ height: 80 }}
                        //gravity={'center'}
                        min={2000}
                        max={80000}
                        step={50}
                        selectionColor="#3df"
                        blankColor="#f618"
                        onValueChanged={(low, high, fromUser) => {
                            this.setState({ payoutLow: low, payoutHigh: high })
                        }} />

                </View>
                {/* SLider */}
                <View style={styles.categories}>
                    <View><Text style={inlineStyle.itemHeaderText}>Entries</Text></View>
                    <View style={{ borderBottomWidth: 1, borderColor: '#707287', marginTop: 10 }}></View>
                    <View style={{ flexDirection: 'row', marginTop: 20 }}>
                        <TouchableOpacity style={inlineStyle.entryFee}
                            onPress={() => this.setState({ entryType: 1 })}
                        >
                            <Text style={inlineStyle.text}>SINGLE</Text>
                        </TouchableOpacity>
                        <View style={{ marginHorizontal: 7 }}></View>
                        <TouchableOpacity style={inlineStyle.entryFee}
                            onPress={() => this.setState({ entryType: 2 })}
                        >
                            <Text style={inlineStyle.text}>MULTIPLE</Text>
                        </TouchableOpacity>
                    </View>
                </View>
                <View style={{ marginTop: 30, flexDirection: 'row', justifyContent: 'space-between' }}>
                    <View>
                        <TouchableOpacity style={inlineStyle.btnApps}
                            onPress={() => this.resetData()}
                        >
                            <Text style={styles.btnText}>Reset</Text>
                        </TouchableOpacity>
                    </View>
                    <View>
                        <TouchableOpacity style={inlineStyle.btnApps1}
                            onPress={() => this.onApplyFilter()}
                        >
                            <Text style={styles.btnText}>Apply</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </ScrollView>
        )
    }
}

const inlineStyle = StyleSheet.create({
    container: {
        flex: 1,
        // paddingTop:,
        paddingHorizontal: 30,
        backgroundColor: "#090f1f",
    },
    itemHeaderText: {
        color: '#707287',
        fontSize: 12
    },
    text: {
        color: '#fff',
        fontSize: 16,
    },
    radioButton: {
        height: 24,
        width: 24,
        borderRadius: 12,
        borderWidth: 2,
        backgroundColor: '#fff',
        alignItems: 'center',
        justifyContent: 'center',
    },
    radioButtonChild: {
        height: 12,
        width: 12,
        borderRadius: 6,
        backgroundColor: '#01b7ff',
    },
    entryFee: {
        // borderWidth:1,
        backgroundColor: '#2b2e41',
        paddingHorizontal: 20,
        margin: 2
    },
    btnApps: {
        borderWidth: 1,
        backgroundColor: '#fe6b85',
        borderRadius: 40,
        paddingVertical: 12,
        width: width * 0.4
        // width : width * .80
    },
    btnApps1: {
        borderWidth: 1,
        backgroundColor: '#01b7ff',
        borderRadius: 40,
        paddingVertical: 12,
        width: width * 0.4
        // width : width * .80
    }

});
