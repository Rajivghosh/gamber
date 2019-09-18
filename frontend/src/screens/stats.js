import React, { Component } from 'react'
import { Text, View, StyleSheet, Image, Alert, ScrollView, AsyncStorage, TouchableOpacity, } from 'react-native'
import Header from "../Components/header"

export default class GameStatistics extends Component {
    constructor(props) {
        super(props);
        this.state = {
            selectedGameName: "Fortnight",
            selectedButton: "upcoming",
            gameResult: "",
            selectedDataView: []
        }
    }

    async componentDidMount() {
        let token = await AsyncStorage.getItem('token');
        let form = new FormData();
        form.append('token', "9c86f317eaa514a5c8b7b400a91a4600");
        form.append('screen_id', 14);
        fetch("https://nodejsdapldevelopments.com/gamebar/public/api/event_statistic_list", {
            method: 'POST',
            headers: {
                'Content-Type': "multipart/form-data"
            },
            body: form
        })
            .then(res => res.json())
            .then(res => {

                console.log(res);

                this.setState({
                    gameResult: res.result,
                    selectedDataView: res.result.upcoming
                })
            }).catch(err => {
                console.log("error", err.message)
          
            })
    }
    onSelectDataView = (type) => {
        console.log(this.state.gameResult)
        if (type === "upcoming") {
            this.setState({
                selectedButton: "upcoming",
                selectedDataView: this.state.gameResult.upcoming
            })
        }
        if (type === "live") {
            this.setState({
                selectedButton: "live",
                selectedDataView: this.state.gameResult.live
            })
        }
        if (type === "histroy") {
            this.setState({
                selectedButton: "histroy",
                selectedDataView: this.state.gameResult.histroy
            })
        }
    }

    render() {
        const { selectedGameName, selectedButton, gameResult, selectedDataView } = this.state;
        return (
            <View style={styles.container}>
                <View style={{ backgroundColor: "#1c1b1b", opacity: 0.9 }}>
                    {/* Import header */}
                    <Header title={"Game Statistics"} />
                    {/* Game name start */}
                    {gameResult.hasOwnProperty("games") || gameResult.games !== undefined ?
                        <ScrollView
                            horizontal={true}
                        >
                            {gameResult.games.map((game, index) => {
                                return (
                                    <View style={{ padding: 10 }} key={index}>
                                        <TouchableOpacity
                                            onPress={() => this.setState({ selectedGameName: game.game_screen_name })}
                                            style={selectedGameName == game.game_screen_name ? styles.selectedGameButton : styles.buttonPadding}
                                        >
                                            <Text style={selectedGameName === game.game_screen_name ?
                                                styles.defaultText : styles.unSelectedGame}>{game.game_screen_name}</Text>
                                        </TouchableOpacity>
                                    </View>
                                )
                            })}

                        </ScrollView> : null}
                    {/* Game name end */}
                </View>

                {/* Button View start */}
                <View style={{
                    flexDirection: "row",
                    alignItems: "center",
                    justifyContent: "center",
                    marginTop: 10
                }}>
                    <TouchableOpacity style={selectedButton === "upcoming" ?
                        [styles.upcomingButton, styles.selectedBtnBgColor] :
                        [styles.upcomingButton, styles.unselectedbtnBgColor]
                    }
                        onPress={() => this.onSelectDataView("upcoming")}
                    >
                        <Text style={styles.defaultText}>Upcoming</Text>
                    </TouchableOpacity>
                    <TouchableOpacity style={selectedButton === "live" ?
                        [styles.liveButton, styles.selectedBtnBgColor] :
                        [styles.liveButton, styles.unselectedbtnBgColor]
                    }
                        onPress={() => this.onSelectDataView("live")}
                    >
                        <Text style={styles.defaultText}>Live</Text>
                    </TouchableOpacity>
                    <TouchableOpacity
                        style={selectedButton === "histroy" ?
                            [styles.historyButton, styles.selectedBtnBgColor] :
                            [styles.historyButton, styles.unselectedbtnBgColor]
                        }
                        onPress={() => this.onSelectDataView("histroy")}
                    >
                        <Text style={styles.defaultText}>Histroy</Text>
                    </TouchableOpacity>
                </View>
                {/* Button View end */}
                {/* Game details start */}
                {selectedDataView !== undefined && selectedDataView.length > 0   ?
                    <ScrollView>
                        {selectedDataView.map((data, index) => {
                            return (
                                <View key={index}
                                    style={{ backgroundColor: "#1c1b1b", margin: 15, height: 150 }}>
                                    <View style={{ flexDirection: "row", alignItems: "flex-start", margin: 10 }}>
                                        <Image
                                            style={{ width: 40, height: 40, borderRadius: 30 }}
                                            source={{ uri: data.banner }}
                                        />
                                        <View style={{ marginLeft: 20 }}>
                                            <Text style={styles.defaultText}>{data.title}</Text>
                                            <Text style={styles.defaultText}>{data.event_start_date}</Text>
                                        </View>
                                    </View>
                                    <ScrollView style={{ margin: 10 }} nestedScrollEnabled={true}>
                                        <Text style={styles.defaultText}>
                                            {data.event_rule}
                                        </Text>

                                    </ScrollView>
                                </View>
                            )
                        })}

                    </ScrollView> : null}
                {/* Game details end */}
            </View >
        )
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: "#090f1f",
    },
    defaultText: {
        color: "#ffffff",
    },
    unSelectedGame: {
        color: "gray"
    },
    selectedGameButton: {
        paddingBottom: 10,
        borderBottomWidth: 2,
        borderBottomColor: 'skyblue',
    },
    buttonPadding: {
        paddingBottom: 10,
    },
    upcomingButton: {
        paddingLeft: 29, paddingRight: 29, paddingTop: 15, paddingBottom: 15, borderTopLeftRadius: 20,
        borderBottomLeftRadius: 20
    },
    liveButton: {
        paddingLeft: 40, paddingRight: 40, paddingTop: 15, paddingBottom: 15,
    },
    historyButton: {
        paddingLeft: 35, paddingRight: 35, paddingTop: 15, paddingBottom: 15, borderTopRightRadius: 20,
        borderBottomRightRadius: 20
    },
    selectedBtnBgColor: {
        backgroundColor: 'skyblue'
    },
    unselectedbtnBgColor: {
        backgroundColor: '#2b2e41',
    },

});
