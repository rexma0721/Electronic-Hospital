import 'dart:convert';
import 'dart:io';
import 'package:dio/dio.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/screen/ChangePrice.dart';
import 'package:flutter_doctor/screen/Changepassword.dart';
import 'package:flutter_doctor/screen/Contact.dart';
import 'package:flutter_doctor/screen/LandingPage.dart';
import 'package:flutter_doctor/screen/Profile.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/api_endpoints.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:image_picker/image_picker.dart';
import 'package:share/share.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:url_launcher/url_launcher.dart';

class NavDrawer extends StatefulWidget {
  GlobalKey<ScaffoldState> scaffoldkey;

  NavDrawer(this.scaffoldkey);

  @override
  _NavDrawerState createState() => _NavDrawerState();
}

class _NavDrawerState extends State<NavDrawer> {
  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.start,
          children: <Widget>[
            Container(
              decoration: BoxDecoration(
                borderRadius:
                BorderRadius.all(Radius.circular(Configs.calcheight(20))),
                color: Gray02,
              ),
              height: Configs.calcheight(286),
              width: double.infinity,
              margin: EdgeInsets.all(5),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.start,
                children: [
                  Container(
                    decoration: BoxDecoration(
                        borderRadius: BorderRadius.all(
                            Radius.circular(Configs.calcheight(175 / 2))),
                        color: Gray02,
                        border: Border.all(
                            color: Colors.white, width: Configs.calcheight(7))),
                    margin: EdgeInsets.only(top: Configs.calcheight(20)),
                    height: Configs.calcheight(175),
                    width: Configs.calcheight(175),
                    alignment: Alignment.center,
                    child: Container(
                        width: Configs.calcheight(130),
                        height: Configs.calcheight(130),
                        decoration: new BoxDecoration(
                            shape: BoxShape.circle,
                            image: new DecorationImage(
                                fit: BoxFit.cover,
                                image: new NetworkImage(APIEndPoints.mediaurl +
                                    Configs.umodel.photo)))),
                  ),
                  Container(
                    child: Container(
                      width: Configs.calcwidth(145),
                      height: Configs.calcheight(44),
                      margin: EdgeInsets.only(top: Configs.calcheight(20)),
                      child: FlatButton(
                        color: Green0,
                        textColor: Colors.white,
                        padding: EdgeInsets.all(0),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(Configs
                              .calcheight(20)),
                        ),
                        onPressed: () {
                          File image;
                          showDialog(context: context,
                              builder: (BuildContext context) {
                                return AlertDialog(
                                  title: new Text('Upload a clear picture'),
                                  content: Container(
                                    height: 100,
                                    child: Column(
                                      children: [
                                        new FlatButton(
                                          child: new Text('Take Photo...'),
                                          onPressed: () async {
                                            File image = await ImagePicker
                                                .pickImage(
                                                source: ImageSource.camera
                                            );
                                            if (image != null) ChangeImage(
                                                image);
                                            Navigator.of(context).pop();
                                          },
                                        ),
                                        new FlatButton(
                                            child: new Text(
                                                'Choose from Library'),
                                            onPressed: () async {
                                              File image = await ImagePicker
                                                  .pickImage(
                                                  source: ImageSource.gallery
                                              );
                                              if (image != null) ChangeImage(
                                                  image);
                                              Navigator.of(context).pop();
                                            }),


                                      ],
                                    ),
                                  ),
                                  actions: <Widget>[
                                    new FlatButton(
                                      child: new Text("CANCEL"),
                                      onPressed: () {
                                        Navigator.of(context).pop();
                                      },)
                                  ],
                                );
                              }
                          );
                        },
                        child: Text(
                          'ﺗﺤﺪﻳﺚ ﺍﻟﺼﻮﺭﺓ',
                          style: TextStyle(
                            fontSize: Configs.calcheight(25),
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                  )
                ],
              ),
            ),
            Container(
              child: Container(
                width: double.infinity,
                height: Configs.calcheight(94),
                margin: EdgeInsets.only(left: 5, right: 5, bottom: 5),
                child: FlatButton(
                  color: Gray02,
                  textColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                  ),
                  onPressed: () {
                    Navigator.popUntil(
                        context, ModalRoute.withName('/consultant'));
                    Navigator.push(context, MaterialPageRoute(
                        builder: (context) => Profile()
                    ));
                  },
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      Text(
                        'ﺍﻟﻤﻠﻒ ﺍﻟﺸﺨﺼﻲ',
                        style: TextStyle(
                            fontSize: Configs.calcheight(30),
                            color: Colors.black
                        ),
                      ),
                      SizedBox(
                        width: 15,
                      ),
                      Image.asset('assets/images/ic_profile.png',
                        width: Configs.calcheight(40),
                        height: Configs.calcheight(40),)
                    ],
                  ),
                ),
              ),
            ),
            Container(
              child: Container(
                width: double.infinity,
                height: Configs.calcheight(94),
                margin: EdgeInsets.only(left: 5, right: 5, bottom: 5),
                child: FlatButton(
                  color: Gray02,
                  textColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                  ),
                  onPressed: () {
                    Navigator.popUntil(
                        context, ModalRoute.withName('/consultant'));
                    Navigator.push(context, MaterialPageRoute(
                        builder: (context) => Changepassword()
                    ));
                  },
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      Text(
                        'تغيير كلمة المرور',
                        style: TextStyle(
                            fontSize: Configs.calcheight(30),
                            color: Colors.black
                        ),
                      ),
                      Image.asset('assets/images/ic_security.png',
                        width: Configs.calcheight(40),
                        height: Configs.calcheight(40),)
                    ],
                  ),
                ),
              ),
            ),
            Container(
              child: Container(
                width: double.infinity,
                height: Configs.calcheight(94),
                margin: EdgeInsets.only(left: 5, right: 5, bottom: 5),
                child: FlatButton(
                  color: Gray02,
                  textColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                  ),
                  onPressed: () {
                    Navigator.popUntil(
                        context, ModalRoute.withName('/consultant'));
                    Navigator.push(context, MaterialPageRoute(
                        builder: (context) => ChangePrice()
                    ));
                  },
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      Text(
                        'ﺗﺤﺪﻳﺪ ﺍﻟﺘﻜﻠﻔﺔ',
                        style: TextStyle(
                            fontSize: Configs.calcheight(30),
                            color: Colors.black
                        ),
                      ),
                      SizedBox(
                        width: 15,
                      ),
                      Image.asset('assets/images/ic_wallet.png',
                        width: Configs.calcheight(40),
                        height: Configs.calcheight(40),)
                    ],
                  ),
                ),
              ),
            ),
            Container(
              child: Container(
                width: double.infinity,
                height: Configs.calcheight(94),
                margin: EdgeInsets.only(left: 5, right: 5, bottom: 5),
                child: FlatButton(
                  color: Gray02,
                  textColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                  ),
                  onPressed: () {
                    Share.share('https://www.alodoctor.online');
                  },
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      Text(
                        'ﻣﺸﺎﺭﻛﺔ',
                        style: TextStyle(
                            fontSize: Configs.calcheight(30),
                            color: Colors.black
                        ),
                      ),
                      SizedBox(
                        width: 20,
                      ),
                      Image.asset('assets/images/ic_share.png',
                        width: Configs.calcheight(40),
                        height: Configs.calcheight(40),)
                    ],
                  ),
                ),
              ),
            ),
            Container(
              child: Container(
                width: double.infinity,
                height: Configs.calcheight(94),
                margin: EdgeInsets.only(left: 5, right: 5, bottom: 5),
                child: FlatButton(
                  color: Gray02,
                  textColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                  ),
                  onPressed: () {
                    Navigator.popUntil(
                        context, ModalRoute.withName('/consultant'));
                    Navigator.push(context, MaterialPageRoute(
                        builder: (context) => Contact()
                    ));
                  },
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      Text(
                        'ﺍﺗﺼﻞ ﺑﻨﺎ',
                        style: TextStyle(
                            fontSize: Configs.calcheight(30),
                            color: Colors.black
                        ),
                      ),
                      SizedBox(
                        width: 20,
                      ),
                      Image.asset('assets/images/ic_contact.png',
                        width: Configs.calcheight(40),
                        height: Configs.calcheight(40),)
                    ],
                  ),
                ),
              ),
            ),
            Container(
              child: Container(
                width: double.infinity,
                height: Configs.calcheight(94),
                margin: EdgeInsets.only(left: 5, right: 5, bottom: 5),
                child: FlatButton(
                  color: Gray02,
                  textColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                  ),
                  onPressed: () async {
                    SharedPreferences prefs = await SharedPreferences.getInstance();
                    prefs.setString('rememberme', 'false');
                    prefs.setString('email', '');
                    prefs.setString('password', '');
                    FirebaseMessaging().deleteInstanceID();
                    Navigator.popUntil(context, ModalRoute.withName('/consultant'));
                    Navigator.of(context).pop();
                    Navigator.push(context, MaterialPageRoute(
                        builder: (context) => LandingPage()
                    ));
                  },
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      Text(
                        'ﺗﺴﺠﻴﻞ ﺍﻟﺨﺮﻭﺝ',
                        style: TextStyle(
                            fontSize: Configs.calcheight(30),
                            color: Colors.black
                        ),
                      ),
                      SizedBox(
                        width: 20,
                      ),
                      Image.asset('assets/images/ic_logout.png',
                        width: Configs.calcheight(40),
                        height: Configs.calcheight(40),)
                    ],
                  ),
                ),
              ),
            ),
            Container(
              margin: EdgeInsets.only(top: Configs.calcheight(235)),
              padding: EdgeInsets.only(left: 20, right: 20),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Container(
                    width: Configs.calcheight(80),
                    height: Configs.calcheight(80),
                    decoration: BoxDecoration(
                        image: DecorationImage(
                            image: AssetImage('assets/images/ic_youtube.png',),
                            fit: BoxFit.fill
                        )
                    ),
                    child: FlatButton(
                      onPressed: () async{
                        const url = 'https://www.youtube.com/channel/UC6Br0QvLy8D-w-I6JCDIakA/featured';
                        if (await canLaunch (url)
                        ) {
                        await launch(url);
                        } else {
                        throw 'Could not launch $url';
                        }

                      },
                    ),
                  ),
                  Container(
                    width: Configs.calcheight(80),
                    height: Configs.calcheight(80),
                    decoration: BoxDecoration(
                        image: DecorationImage(
                            image: AssetImage('assets/images/ic_facebook.png',),
                            fit: BoxFit.fill
                        )
                    ),
                    child: FlatButton(
                      onPressed: () async{
                        const url = 'https://www.facebook.com/alodoctor.online';
                        if (await canLaunch (url)
                        ) {
                          await launch(url);
                        } else {
                          throw 'Could not launch $url';
                        }

                      },
                    ),
                  ),
                  Container(
                    width: Configs.calcheight(80),
                    height: Configs.calcheight(80),
                    decoration: BoxDecoration(
                        image: DecorationImage(
                            image: AssetImage('assets/images/ic_twitter.png',),
                            fit: BoxFit.fill
                        )
                    ),
                    child: FlatButton(
                      onPressed: () async{
                        const url = 'https://www.twitter.com/alodoctor2';
                        if (await canLaunch (url)
                        ) {
                          await launch(url);
                        } else {
                          throw 'Could not launch $url';
                        }
                      },
                    ),
                  ),
                  Container(
                    width: Configs.calcheight(80),
                    height: Configs.calcheight(80),
                    decoration: BoxDecoration(
                        image: DecorationImage(
                            image: AssetImage(
                              'assets/images/ic_instagram.png',),
                            fit: BoxFit.fill
                        )
                    ),
                    child: FlatButton(
                      onPressed: () async{
                        const url = 'https://www.instagram.com/alodoctor.online';
                        if (await canLaunch (url)
                        ) {
                          await launch(url);
                        } else {
                          throw 'Could not launch $url';
                        }

                      },
                    ),
                  ),

                ],
              ),
            ),

          ],
        ),
      ),
    );
  }

  Future<void> ChangeImage(File file) async {
    String fileName = file.path
        .split('/')
        .last;

    FormData data = FormData.fromMap({
      "doctor_id": Configs.umodel.id,
      "file": await MultipartFile.fromFile(
        file.path,
        filename: fileName,
      ),
    });

    Dio dio = new Dio();

    dio.post(APIEndPoints.kApiBase + 'doctor_photo_update', data: data)
        .then((response) {
      var result = jsonDecode(response.toString());
      if (result['status'] == 'success') {
        Configs.umodel.photo = result['doctor']['photo'];
        setState(() {});
      }
    })
        .catchError((error) => print(error));
  }
}
