import React, { Component } from 'react'
import { Text, View, StyleSheet, Image, Slider, ScrollView, AsyncStorage, Picker, TouchableOpacity, Dimensions } from 'react-native'
import { styles } from '../styles';
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
            payout: ""
        }
    }
    async componentDidMount() {
        let token = await AsyncStorage.getItem('token');

        let form = new FormData();
        form.append('token', "bfae7f26b2ab50bdbf3c19d58fec63d6");
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

    onApplyFilter = () => {
        const { eventId, entryType, startDate, endDate, entryFee, payout } = this.state;
        if (eventId === "") {
            alert("Select an event")
        } else if (entryType === "") {
            alert("Select entries")
        } else if (startDate === "") {
            alert("Select start date")
        } else if (endDate === "") {
            alert("Select end date")
        } else if (entryFee === "") {
            alert("Select entry fees")
        } else if (payout === "") {
            alert("Select payou")
        } else {
            let form = new FormData();
            form.append('token', "bfae7f26b2ab50bdbf3c19d58fec63d6");
            form.append('screen_id', 14);
            form.append('copm_level_id', 13);
            form.append('category_id', 35);
            form.append('start_date', startDate);
            form.append('end_date', endDate);
            form.append('entry_fees', entryFee);
            form.append('payout', payout);
            form.append('venue', event);
            form.append('game_entry_type', entryType);

            fetch("https://nodejsdapldevelopments.com/gamebar/public/api/filtered_event_list", {
                method: 'POST',
                headers: {
                    'Content-Type': "multipart/form-data"
                },
                body: form
            })
                .then(res => res.json())
                .then(res => {
                    console.log("result ", res)

                })
        }
    }

    render() {
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
                            <Text style={inlineStyle.text}>Start Date</Text>
                            <View>
                                <Image style={{ width: 5, height: 6 }} source={require('../assests/Filter/up_arrow.png')} />
                            </View>
                            <View style={inlineStyle.radioButton}>
                                <View style={inlineStyle.radioButtonChild}></View>
                            </View>
                        </View>
                        <View style={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 15 }}>
                            <Text style={inlineStyle.text}>Stop Date</Text>
                            <View>
                                <Image style={{ width: 5, height: 6 }} source={require('../assests/Filter/down_arrow.png')} />
                            </View>
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
                                <Picker.Item label="Select..." />
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
                    <View><Text style={inlineStyle.itemHeaderText}>Entry Fee</Text></View>
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
                        <Text style={{ color: "white" }}>{this.state.payout}</Text></View>
                    <Slider
                        style={{ marginTop: 40, alignSelf: 'stretch' }}
                        step={1}
                        minimumValue={18}
                        maximumValue={71}
                        maximumTrackTintColor="#000"
                        onValueChange={(value) => this.setState({ payout: value })}
                    />
                </View>
                {/* SLider */}
                <View style={styles.categories}>
                    <View><Text style={inlineStyle.itemHeaderText}>Entries</Text></View>
                    <View style={{ borderBottomWidth: 1, borderColor: '#707287', marginTop: 10 }}></View>
                    <View style={{ flexDirection: 'row', marginTop: 20 }}>
                        <TouchableOpacity style={inlineStyle.entryFee}
                            onPress={() => this.setState({ entry: 1 })}
                        >
                            <Text style={inlineStyle.text}>SINGLE</Text>
                        </TouchableOpacity>
                        <View style={{ marginHorizontal: 7 }}></View>
                        <TouchableOpacity style={inlineStyle.entryFee}
                            onPress={() => this.setState({ entry: 2 })}
                        >
                            <Text style={inlineStyle.text}>MULTIPLE</Text>
                        </TouchableOpacity>
                    </View>
                </View>
                <View style={{ marginTop: 30, flexDirection: 'row', justifyContent: 'space-between' }}>
                    <View>
                        <TouchableOpacity style={inlineStyle.btnApps}>
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
