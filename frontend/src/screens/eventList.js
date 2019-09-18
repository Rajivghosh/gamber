import React, { Component } from 'react';
import { View, Text, ScrollView, Image, StyleSheet, AsyncStorage, TouchableOpacity, TextInput } from 'react-native';
import { styles } from '../styles';
import Header from '../Components/header';
import Search from 'react-native-vector-icons/AntDesign'
import { thisExpression } from '@babel/types';

export default class EventList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      game: [],
      list: [],
      level: [],
      newList: [],
      searchList: [],
      searchText : "",
      // showSearch : false,
    };
  }

  componentDidMount = async () => {

    let token = await AsyncStorage.getItem('token');

    const { navigation } = this.props;

    const comp_level_id = navigation.getParam('comp_level_id');
    // this.setState({compLevelId : comp_level_id})

    const screen_id = navigation.getParam('screen_id');
    // this.setState({screenId : this.state.screen_id});

    const category_id = navigation.getParam('category_id');

    console.log(`comp_level_id ${comp_level_id}`);
    console.log(`screen id ${screen_id}`);
    console.log(`category_id ${category_id}`);

    let form = new FormData();

    form.append('token', token);
    form.append('screen_id', screen_id);
    form.append('comp_level_id', comp_level_id);
    form.append('category_id', category_id);

    fetch('https://nodejsdapldevelopments.com/gamebar/public/api/event_list', {
      method: 'POST',
      headers: {
        'Content-Type': "multipart/form-data"
      },
      body: form
    })
      .then(res => res.json())
      .then(res => {
        console.log(res)

        this.setState({ level: res.result.level });
        this.setState({ list: res.result.list});
        this.setState({ game: res.result.game });


        const newList = this.state.list.map(index => index)
        this.setState({ newList: newList });

        this.state.newList.map(index => console.log(index));
      })
  }

  // Search event
  searchEvent = async(data) => {
    let token = await AsyncStorage.getItem('token');


    const { navigation } = this.props;
    const comp_level_id = navigation.getParam('comp_level_id');
    const screen_id = navigation.getParam('screen_id');
    const category_id = navigation.getParam('category_id');
    // const event_id = navigation.getParam('event_id')


    let form = new FormData();
    form.append('token', token);
    form.append('screen_id', screen_id);
    form.append('comp_level_id', comp_level_id);
    form.append('category_id', category_id);
    form.append('search', data);

    this.setState({ searchText: data }, () => {
      fetch("https://nodejsdapldevelopments.com/gamebar/public/api/event_search", {
        method: 'POST',
        headers: {
          'Content-Type': "multipart/form-data"
        },
        body: form
      }).then(res => res.json()).then(res => {
        console.log("result", res)
          this.setState({searchList : res.result.search});

          if(this.state.searchList == ""){

          }
          console.log(this.state.searchList);

      }).catch(err => {
        console.log("error", err)
      })
    })

   
  }

  goToFilterPage = () => {

    const { navigation } = this.props;
    
    const comp_level_id = navigation.getParam('comp_level_id');

    const screen_id = navigation.getParam('screen_id');

    const category_id = navigation.getParam('category_id');


    this.props.navigation.navigate("Filter",{
      screen_id : screen_id,
      comp_level_id : comp_level_id,
      category_id : category_id
    })
  }

  render() {
    const { navigation } = this.props;

    const comp_level_id = navigation.getParam('comp_level_id');

    const screen_id = navigation.getParam('screen_id');

    const category_id = navigation.getParam('category_id');

    console.log(this.state.searchList);
  
 

    if(this.state.searchList != null){
      console.log(`search list is defined`)
      searchList = (
        this.state.searchList.map(data => {
          return(
            <TouchableOpacity
              onPress={() => this.props.navigation.navigate('EventDetails', {
                comp_level_id: comp_level_id,
                screen_id: screen_id,
                category_id: category_id,
                event_id: data.id


              })}
              style={styles.categories}
              key={data.id}>
              <View style={{ flexDirection: "row", marginVertical: 10 }}>
                <Text style={{ color: '#fff' }}>{data.event_status == 1 ? data.gen_title+"-LIVE" : data.gen_title}</Text>
              </View>

              <View style={{ borderBottomWidth: 1, borderColor: '#fff' }}></View>

              <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                <Text></Text>

                <View style={{ flexDirection: 'row' }}>
                  <Text style={{ color: '#fff', }}>${data.entry_fees}</Text>
                  <Text style={{ color: 'green', marginLeft: 10 }}>${data.win_prize}</Text>
                </View>

              </View>

              <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>

                <Text style={{ color: '#fff', textAlign: 'left' }}>Entries</Text>

                <View style={{ flexDirection: 'row' }}>
                  <Text style={{ color: '#fff' }}>Entry</Text>
                  <Text style={{ color: '#fff', marginLeft: 10 }}>Prizes</Text>
                </View>
              </View>
            </TouchableOpacity>
          )
      }) 
      )
    }

    if(this.state.searchList === undefined){
      console.log(`search list is not defined`)
      searchList = (
        <View>
          <Text style={{color:'#fff'}}>No data found</Text>
        </View>
      )
    }

    return (
      <ScrollView style={inlineStyle.container}>
        <Header title="Event List" navigation={this.props.navigation} />

        <View>
          {
            this.state.game.map(data => {
              return (
                <View style={{ flex: 1, marginVertical: 10 }} key={data.id}>
                  <Image source={{ uri: data.logo }} style={{ height: 170, width: '100%' }} />
                </View>
              )
            })
          }
        </View>

        <View style={{ marginHorizontal: 10, marginTop: 30 }}>
          <View style={styles.inputButtonContainer}>
            <Search
              name="search1"
              color="#fff"
              size={20}
            />
            <TextInput
              style={styles.inputButton}
              placeholderTextColor="#fff"
              placeholder="Search"
              onChangeText={(data) => this.searchEvent(data)} />
          </View>

          <View style={{ marginTop: 10 }}>
            <View style={{ justifyContent: 'center', marginBottom: 8 }}>
              <Text style={{ color: '#fff', textAlign: 'center' }}>List of Events</Text>
            </View>

            <View>
              <View style={{ borderBottomWidth: 1, borderColor: '#fff' }}></View>
            </View>
          </View>

          <View>
            { this.state.searchText.length === 0 ?  
              this.state.list.map(data => {
                return (
                  <TouchableOpacity
                    onPress={() => this.props.navigation.navigate('EventDetails', {
                      comp_level_id: comp_level_id,
                      screen_id: screen_id,
                      category_id: category_id,
                      event_id: data.id


                    })}
                    style={styles.categories}
                    key={data.id}>
                    <View style={{ flexDirection: "row", marginVertical: 10 }}>
                      <Text style={{ color: '#fff' }}>{data.event_status == 1 ? data.gen_title+"-LIVE" : data.gen_title}</Text>
                    </View>

                    <View style={{ borderBottomWidth: 1, borderColor: '#fff' }}></View>

                    <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                      <Text></Text>

                      <View style={{ flexDirection: 'row' }}>
                        <Text style={{ color: '#fff', }}>${data.entry_fees}</Text>
                        <Text style={{ color: 'green', marginLeft: 10 }}>${data.win_prize}</Text>
                      </View>

                    </View>

                    <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>

                      <Text style={{ color: '#fff', textAlign: 'left' }}>Entries</Text>

                      <View style={{ flexDirection: 'row' }}>
                        <Text style={{ color: '#fff' }}>Entry</Text>
                        <Text style={{ color: '#fff', marginLeft: 10 }}>Prizes</Text>
                      </View>
                    </View>
                  </TouchableOpacity>
                )
              }) :

              searchList

            }
          </View>
        </View>
        <TouchableOpacity style={{
          backgroundColor: "#ffffff",
          position: "absolute", top: 400, right: 30, borderRadius: 30,
          alignItems: "center", justifyContent: "center", padding: 10
        }}
          onPress={() => { this.goToFilterPage() }}
        >
          <Image
            style={{ width: 30, height: 30, borderRadius: 30 }}
            source={require('../assests/Filter/filter.png')}
          />
        </TouchableOpacity>
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
    // paddingHorizontal: 30,
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
  }
});