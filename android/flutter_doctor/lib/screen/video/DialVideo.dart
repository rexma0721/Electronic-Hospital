import 'package:agora_rtc_engine/agora_rtc_engine.dart';
import 'package:assets_audio_player/assets_audio_player.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'package:flutter/painting.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/screen/video/VideoPage.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/colors.dart';

class DialVideo extends StatefulWidget {
  @override
  _DialVideoState createState() => _DialVideoState();
}

class _DialVideoState extends State<DialVideo> {

  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();
  bool ispickup = false;
  CollectionReference callRef = Firestore.instance.collection("calls");
  final assetsAudioPlayer = AssetsAudioPlayer();


  void initState() {
    _addCallingData();
    super.initState();
    assetsAudioPlayer.open(
      Audio("assets/audio.mp3"),
      loopMode: LoopMode.single
    );

  }
  @override
  void dispose() async {
    super.dispose();
    ispickup = true;
    assetsAudioPlayer.stop();
    await callRef
        .document(Configs.conmodel.id.toString())
        .setData({'calling': false}, merge: true);
  }

  _addCallingData() async {
    await callRef.document(Configs.conmodel.id.toString()).delete();
    await callRef.document(Configs.conmodel.id.toString()).setData({
      'callType': 'VideoCall',
      'calling': true,
      'response': "Awaiting",
      'channel_id': Configs.conmodel.id.toString(),
      'last_call': FieldValue.serverTimestamp()
    });
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: scaffoldKey,
      endDrawer: NavDrawer(scaffoldKey),
      body: Container(
          width: double.infinity,
          height: double.infinity,
          color: Colors.white,
          child: Column(
            children: [
              MainHeader('ﺍﺳﺘﺸﺎﺭﺍﺕ', scaffoldKey),
              Container(
                height: Configs.calcheight(105),
                width: double.infinity,
                padding: EdgeInsets.only(left: Configs.calcheight(20), right: Configs.calcheight(20)),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    Container(
                      width: Configs.calcwidth(322),
                      height: Configs.calcheight(55),
                      child: FlatButton(
                        color: Green0,
                        textColor: Colors.white,
                        padding: EdgeInsets.all(0),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(Configs.calcheight(7)),
                        ),
                        onPressed: (){
                        },
                        child: Text(
                          Configs.conmodel.name,
                          style: TextStyle(
                              fontSize: Configs.calcheight(27),
                              color: Colors.white
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              Expanded(
                child: Container(
                  color: Gray01,
                  width: double.infinity,
                  child: StreamBuilder<QuerySnapshot>(
                      stream: callRef
                          .where("channel_id", isEqualTo: "${Configs.conmodel.id.toString()}")
                          .snapshots(),
                      builder: (BuildContext context,
                          AsyncSnapshot<QuerySnapshot> snapshot) {
                        Future.delayed(Duration(seconds: 30), () async {
                          if (!ispickup) {
                            await callRef
                                .document(Configs.conmodel.id.toString())
                                .updateData({'response': 'Not-answer'});
                          }
                        });
                        if (!snapshot.hasData) {
                          return Container();
                        } else
                          try {
                            switch (snapshot.data.documents[0]['response']) {
                              case "Awaiting":
                              case "Pickup":
                              case "Call_Cancelled":
                              case "Decline":
                                {
                                  ispickup = true;
                                  if(snapshot.data.documents[0]['response'] != 'Awaiting'){
                                    assetsAudioPlayer.stop();
                                  }
                                  return VideoPage(
                                      channelName: Configs.conmodel.id.toString(),
                                      role: ClientRole.Broadcaster,
                                      callType: 'VideoCall',
                                      currentstate: snapshot.data.documents[0]['response'],
                                  );
                                }
                                break;
                              case "Not-answer":
                                {
                                  assetsAudioPlayer.stop();
                                  return Column(
                                    mainAxisAlignment: MainAxisAlignment.spaceAround,
                                    crossAxisAlignment: CrossAxisAlignment.center,
                                    children: <Widget>[
                                      Text("${Configs.conmodel.name} is Not-answering",
                                          style: TextStyle(
                                              fontSize: 25,
                                              fontWeight: FontWeight.bold)),
                                      RaisedButton.icon(
                                          color: Theme.of(context).backgroundColor,
                                          icon: Icon(
                                            Icons.arrow_back,
                                            color: Colors.white,
                                          ),
                                          label: Text(
                                            "Back",
                                            style: TextStyle(color: Colors.white),
                                          ),
                                          onPressed: () async {
                                            Navigator.pop(context);
                                          })
                                    ],
                                  );
                                }
                                break;
                            //call end
                              default:
                                {
                                  Future.delayed(Duration(milliseconds: 500), () {
                                    assetsAudioPlayer.stop();
                                    Navigator.pop(context);
                                  });
                                  return Container(
                                    alignment: Alignment.center,
                                    child: Text("Call Ended..."),
                                  );
                                }
                                break;
                            }
                          }
                          //  else if (!snapshot.data.documents[0]['calling']) {
                          //   Navigator.pop(context);
                          // }
                          catch (e) {
                            return Container();
                          }
                      }),
                ),
              ),
              Bottombar()
            ],
          ),
      ),
    );
  }
}
