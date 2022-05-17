import 'dart:convert';

import 'package:badges/badges.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/controllers/consultantcontroller.dart';
import 'package:flutter_doctor/models/consultant_model.dart';
import 'package:flutter_doctor/screen/ChatPage.dart';
import 'package:flutter_doctor/screen/OldChatPage.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:mvc_pattern/mvc_pattern.dart';
import 'dart:io';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';


class Consultant extends StatefulWidget {
  @override
  _ConsultantState createState() => _ConsultantState();
}

class _ConsultantState extends StateMVC<Consultant> {
  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();
  FirebaseMessaging _firebaseMessaging = FirebaseMessaging();
  static FlutterLocalNotificationsPlugin _flutterLocalNotificationsPlugin = FlutterLocalNotificationsPlugin();

  bool check_button = false;
  consultantcontroller _con;

  _ConsultantState() : super(consultantcontroller()) {
    _con = controller;
    Configs.con = _con;
  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _initLocalNotifications();
    configurePushNotification();
  }
  _initLocalNotifications() {
    var initializationSettingsAndroid = new AndroidInitializationSettings('@mipmap/launcher_icon');
    var initializationSettingsIOS = new IOSInitializationSettings();
    var initializationSettings = new InitializationSettings(android: initializationSettingsAndroid, iOS: initializationSettingsIOS);
    _flutterLocalNotificationsPlugin.initialize(initializationSettings, onSelectNotification: onSelectNotification);
  }

  @override
  Widget build(BuildContext context) {

    Configs.con_context = context;

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
              padding: EdgeInsets.only(top: 5),
              color: Colors.white,
              child: Container(
                decoration: BoxDecoration(
                  color: Colors.white,
                  border: Border(
                    bottom: BorderSide(
                        width: Configs.calcheight(7), color: bottomcolor),
                  ),
                ),
                padding: EdgeInsets.only(bottom: 5),
                child: Row(
                  children: [
                    Container(
                      width: Configs.calcwidth(265),
                      height: Configs.calcheight(72),
                      margin: EdgeInsets.only(left: Configs.calcheight(17 / 2)),
                      child: FlatButton(
                        color: (check_button
                            ? Color(0xFF00A68C)
                            : Color.fromRGBO(243, 244, 248, 0.49)),
                        textColor: (check_button
                            ? Color(0xFFFFFFFF)
                            : Color(0xFF6a6a6a)),
                        padding: EdgeInsets.all(0),
                        shape: RoundedRectangleBorder(
                          borderRadius:
                              BorderRadius.circular(Configs.calcheight(7)),
                        ),
                        onPressed: () {
                          setState(() {
                            check_button = !check_button;
                          });
                        },
                        child: Text(
                          'ﺍﺳﺘﺸﺎﺭﺍﺗﻲ ﺍﻟﺴﺎﺑﻘﺔ',
                          style: TextStyle(
                            fontSize: Configs.calcheight(25),
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                    Container(
                      width: Configs.calcwidth(300),
                      height: Configs.calcheight(72),
                      margin: EdgeInsets.only(left: Configs.calcheight(17 / 2)),
                      child: FlatButton(
                          color: (!check_button
                              ? Color(0xFF00A68C)
                              : Color.fromRGBO(243, 244, 248, 0.49)),
                          textColor: (!check_button
                              ? Color(0xFFFFFFFF)
                              : Color(0xFF6a6a6a)),
                          padding: EdgeInsets.all(0),
                          shape: RoundedRectangleBorder(
                            borderRadius:
                                BorderRadius.circular(Configs.calcheight(7)),
                          ),
                          onPressed: () {
                            setState(() {
                              check_button = !check_button;
                            });
                          },
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Container(
                                width: Configs.calcheight(42),
                                height: Configs.calcheight(42),
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.all(
                                      Radius.circular(Configs.calcheight(21))),
                                  color: Colors.white,
                                ),
                                alignment: Alignment.center,
                                margin: EdgeInsets.only(right: 5),
                                child: Text(
                                  _con.res_consultArr.length.toString(),
                                  style: TextStyle(
                                    color: Colors.black54,
                                  ),
                                  textAlign: TextAlign.center,
                                ),
                              ),
                              Text(
                                'استشاراتي الحالية',
                                style: TextStyle(
                                  fontSize: Configs.calcheight(25),
                                ),
                                textAlign: TextAlign.center,
                              ),
                            ],
                          )),
                    ),
                  ],
                ),
              ),
            ),
            Expanded(
              child:check_button?
              Container(
                child: Column(
                  children: [
                    Container(
                      padding: EdgeInsets.all(Configs.calcheight(28)),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Container(
                            decoration: BoxDecoration(
                                borderRadius: BorderRadius.all(
                                    Radius.circular(Configs.calcheight(7))),
                                color: Gray05,),
                            width: Configs.calcwidth(125),
                            height: Configs.calcheight(55),
                            padding: EdgeInsets.only(right: Configs.calcheight(15)),
                            alignment: Alignment.centerRight,
                            child: Text(
                              'ﺍﺳﺘﺠﺎﺑﺔ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(27),
                                color: Gray06,
                              ),
                              textAlign: TextAlign.right,
                            ),
                          ),
                          Container(
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.all(
                                  Radius.circular(Configs.calcheight(7))),
                              color: Gray05,),
                            width: Configs.calcwidth(149),
                            height: Configs.calcheight(55),
                            padding: EdgeInsets.only(right: Configs.calcheight(15)),
                            alignment: Alignment.centerRight,
                            child: Text(
                              'ﺍﻟﺘﺎﺭﻳﺦ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(27),
                                color: Gray06,
                              ),
                              textAlign: TextAlign.right,
                            ),
                          ),
                          Container(
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.all(
                                  Radius.circular(Configs.calcheight(7))),
                              color: Gray05,),
                            width: Configs.calcwidth(215),
                            height: Configs.calcheight(55),
                            padding: EdgeInsets.only(right: Configs.calcheight(15)),
                            alignment: Alignment.centerRight,
                            child: Text(
                              'ﺍﻷﺳﻢ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(27),
                                color: Gray06,
                              ),
                              textAlign: TextAlign.right,
                            ),
                          )
                        ],
                      ),
                    ),
                    Expanded(
                      child: ListView.builder(
                          shrinkWrap: true,
                          scrollDirection: Axis.vertical,
                          itemCount: _con.old_consultArr.length,
                          itemBuilder: (context, index) {
                            String img_icon;
                            switch(_con.old_consultArr[index].type){
                              case 'typing':
                                img_icon = 'assets/images/ic_chat_white.png';
                                break;
                              case 'voice':
                                img_icon = 'assets/images/ic_voice_white.png';
                                break;
                              case 'video':
                                img_icon = 'assets/images/ic_video_white.png';
                                break;
                            }
                            return Container(
                              decoration: BoxDecoration(
                                border: Border(
                                  bottom: BorderSide(
                                      width: Configs.calcheight(1), color: Colors.black),
                                ),
                              ),
                              padding: EdgeInsets.all(Configs.calcheight(16)),
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                children: [
                                  Row(
                                    children: [
                                      Container(
                                        width: Configs.calcwidth(125),
                                        height: Configs.calcheight(72),
                                        margin: EdgeInsets.only(left: Configs.calcwidth(12)
                                        ),
                                        child: FlatButton(
                                          color: Blue10,
                                          padding: EdgeInsets.all(0),
                                          shape: RoundedRectangleBorder(
                                            borderRadius:
                                            BorderRadius.circular(Configs.calcheight(7)),
                                          ),
                                          onPressed: () {
                                            Configs.conmodel = _con.old_consultArr[index];
                                            Navigator.popUntil(context, ModalRoute.withName('/consultant'));
                                            Navigator.push(context, MaterialPageRoute(
                                                builder: (context) => OldChatPage()
                                            ));
                                          },
                                          child: Image.asset(img_icon,
                                            width: Configs.calcheight(50),
                                            height: Configs.calcheight(50),
                                          ),
                                        ),
                                      ),
                                      Container(
                                        child: Text(
                                            _con.old_consultArr[index].created_at,
                                          style: TextStyle(
                                            fontSize: Configs.calcheight(27),
                                            color: Gray06
                                          ),
                                        ),
                                        margin: EdgeInsets.only(left: Configs.calcheight(12)),
                                      )
                                    ],
                                  ),
                                  Container(
                                    margin: EdgeInsets.only(left: Configs.calcheight(13)),
                                    child: Text(
                                      _con.old_consultArr[index].name.toString(),
                                      style: TextStyle(
                                        fontSize: Configs.calcheight(27),
                                        color: Gray06
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            );
                          }),
                    )
                  ],
                ),
              ) :
              Container(
                child: Column(
                  children: [
                    Container(
                      padding: EdgeInsets.all(Configs.calcheight(28)),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Container(
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.all(
                                  Radius.circular(Configs.calcheight(7))),
                              color: Gray05,),
                            width: Configs.calcwidth(125),
                            height: Configs.calcheight(55),
                            padding: EdgeInsets.only(right: Configs.calcheight(15)),
                            alignment: Alignment.centerRight,
                            child: Text(
                              'ﺍﺳﺘﺠﺎﺑﺔ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(27),
                                color: Gray06,
                              ),
                              textAlign: TextAlign.right,
                            ),
                          ),
                          Container(
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.all(
                                  Radius.circular(Configs.calcheight(7))),
                              color: Gray05,),
                            width: Configs.calcwidth(149),
                            height: Configs.calcheight(55),
                            padding: EdgeInsets.only(right: Configs.calcheight(15)),
                            alignment: Alignment.centerRight,
                            child: Text(
                              'ﺍﻟﺘﺎﺭﻳﺦ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(27),
                                color: Gray06,
                              ),
                              textAlign: TextAlign.right,
                            ),
                          ),
                          Container(
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.all(
                                  Radius.circular(Configs.calcheight(7))),
                              color: Gray05,),
                            width: Configs.calcwidth(215),
                            height: Configs.calcheight(55),
                            padding: EdgeInsets.only(right: Configs.calcheight(15)),
                            alignment: Alignment.centerRight,
                            child: Text(
                              'ﺍﻷﺳﻢ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(27),
                                color: Gray06,
                              ),
                              textAlign: TextAlign.right,
                            ),
                          )
                        ],
                      ),
                    ),
                    Expanded(
                      child: ListView.builder(
                          shrinkWrap: true,
                          scrollDirection: Axis.vertical,
                          itemCount: _con.res_consultArr.length,
                          itemBuilder: (context, index) {
                            String img_icon;
                            switch(_con.res_consultArr[index].type){
                              case 'typing':
                                img_icon = 'assets/images/ic_chat_white.png';
                                break;
                              case 'voice':
                                img_icon = 'assets/images/ic_voice_white.png';
                                break;
                              case 'video':
                                img_icon = 'assets/images/ic_video_white.png';
                                break;
                            }
                            return Container(
                              decoration: BoxDecoration(
                                border: Border(
                                  bottom: BorderSide(
                                      width: Configs.calcheight(1), color: Colors.black),
                                ),
                              ),
                              padding: EdgeInsets.all(Configs.calcheight(16)),
                              child: Row(
                                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                children: [
                                  Row(
                                    children: [
                                      Container(
                                        width: Configs.calcwidth(125),
                                        height: Configs.calcheight(72),
                                        margin: EdgeInsets.only(left: Configs.calcwidth(12)
                                        ),
                                        child: FlatButton(
                                          color: Green01,
                                          padding: EdgeInsets.all(0),
                                          shape: RoundedRectangleBorder(
                                            borderRadius:
                                            BorderRadius.circular(Configs.calcheight(7)),
                                          ),
                                          onPressed: () {
                                            Configs.conmodel = _con.res_consultArr[index];
                                            Navigator.popUntil(context, ModalRoute.withName('/consultant'));
                                            Navigator.push(context, MaterialPageRoute(
                                                builder: (context) => ChatPage()
                                            ));
                                          },
                                          child: _con.unread_num[index] != 0 ?
                                          Badge(
                                            shape: BadgeShape.circle,
                                            borderRadius: BorderRadius.circular(100),
                                            child:  Image.asset(img_icon,
                                              width: Configs.calcheight(50),
                                              height: Configs.calcheight(50),
                                            ),
                                            position: BadgePosition.topStart(top: -10 ,start: -10),
                                            badgeContent: Text(
                                              _con.unread_num[index].toString(),
                                              style: TextStyle(
                                                  color: Colors.white,
                                                  fontSize: 13
                                              ),
                                              textAlign: TextAlign.center,
                                            ),
                                          ):
                                          Image.asset(img_icon,
                                            width: Configs.calcheight(50),
                                            height: Configs.calcheight(50),
                                          ),
                                        ),
                                      ),
                                      Container(
                                        child: Text(
                                          _con.res_consultArr[index].created_at,
                                          style: TextStyle(
                                              fontSize: Configs.calcheight(27),
                                              color: Gray06
                                          ),
                                        ),
                                        margin: EdgeInsets.only(left: Configs.calcheight(12)),
                                      )
                                    ],
                                  ),
                                  Container(
                                    margin: EdgeInsets.only(left: Configs.calcheight(13)),
                                    child: Text(
                                      _con.res_consultArr[index].name,
                                      style: TextStyle(
                                          fontSize: Configs.calcheight(27),
                                          color: Gray06
                                      ),
                                    ),
                                  )
                                ],
                              ),
                            );
                          }),
                    )
                  ],
                ),
              )
            ),
            Bottombar()
          ],
        ),
      ),
    );
  }

  void configurePushNotification() {
    _firebaseMessaging.configure(
      onLaunch: (Map<String, dynamic> message) async {
        print('===============onLaunch$message');
      },
      onMessage: (Map<String, dynamic> message) async {
        _showNotification(message);
      },
      onBackgroundMessage: Platform.isIOS ? null:
      myBackgroundMessageHandler,
      onResume: (Map<String, dynamic> message) async {
        print('onResume$message');
      },
    );
  }
  static Future<dynamic> myBackgroundMessageHandler(Map<String, dynamic> message) {
    _showNotification(message);
    print('AppPushs myBackgroundMessageHandler : $message');
    return Future<void>.value();
  }
  static Future _showNotification(Map<String, dynamic> message) async {
    var pushTitle;
    var pushText;
    var action;

    if (Platform.isAndroid) {
      var nodeData = message['data'];
      pushTitle = nodeData['title'];
      pushText = nodeData['msgBody'];
      action = nodeData['action'];
    } else {
      pushTitle = message['title'];
      pushText = message['msgBody'];
      action = message['action'];
    }
    print("AppPushs params pushTitle : $pushTitle");
    print("AppPushs params pushText : $pushText");
    print("AppPushs params pushAction : $action");

    if(pushText == 'update'){
      // var result = jsonDecode(action);
      // consultant_model t_model = consultant_model.fromJSON(result);
      Configs.con.getconsultant();
        Navigator.popUntil(Configs.con_context, ModalRoute.withName('/consultant'));

    } else {
      var platformChannelSpecificsAndroid = new AndroidNotificationDetails(
          'Doctor',
          'Doctor channel',
          'Message from patient',
          playSound: true,
          enableVibration: true,
          importance: Importance.max,
          priority: Priority.high);
      // @formatter:on
      var platformChannelSpecificsIos = new IOSNotificationDetails(presentSound: false);
      var platformChannelSpecifics = new NotificationDetails(android: platformChannelSpecificsAndroid, iOS: platformChannelSpecificsIos);

      new Future.delayed(Duration.zero, () {
        _flutterLocalNotificationsPlugin.show(
          0,
          pushTitle,
          pushText,
          platformChannelSpecifics,
          payload: action,
        );
      });
    }

    // @formatter:off

  }
  Future onSelectNotification(String payload) {

    print('hellos');
    var result = jsonDecode(payload);
    Configs.conmodel = consultant_model.fromJSON(result);
    print(Configs.conmodel.id);
    Navigator.popUntil(context, ModalRoute.withName('/consultant'));
    Navigator.push(context, MaterialPageRoute(
        builder: (context) => ChatPage()
    ));
  }
}
