import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/controllers/logincontroller.dart';
import 'package:flutter_doctor/screen/Signin.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:url_launcher/url_launcher.dart';

class LandingPage extends StatefulWidget {
  LandingPage({Key key, this.title}) : super(key: key);

  // This widget is the home page of your application. It is stateful, meaning
  // that it has a State object (defined below) that contains fields that affect
  // how it looks.

  // This class is the configuration for the state. It holds the values (in this
  // case the title) provided by the parent (in this case the App widget) and
  // used by the build method of the State. Fields in a Widget subclass are
  // always marked "final".

  final String title;

  @override
  _LandingPageState createState() => _LandingPageState();
}

class _LandingPageState extends State<LandingPage> {
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    checklogin(context);
  }
  @override
  Widget build(BuildContext context) {
    Configs.calheight = MediaQuery.of(context).size.height / 1238;
    Configs.calwidth = MediaQuery.of(context).size.width / 591;

    MediaQueryData mediaQueryData = MediaQuery.of(context);

    return Scaffold(
      body: Container(
        width: double.infinity,
        height: double.infinity,
        color: primaryColor,
        child: Stack(
          children: [
            Container(
              width: double.infinity,
              height: double.infinity,
              decoration: BoxDecoration(
                image: DecorationImage(
                  image: AssetImage("assets/images/bg_logo.png")
                )
              ),
            ),
            Positioned(
              top: Configs.calcheight(204),
              child: Container(
                width: mediaQueryData.size.width,
                child:  Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      'ﺍﻟﻤﺴﺘﺸﻔﻰ ﺍﻻﻟﻜﺘﺮﻭﻧﻲ',
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: Configs.calcheight(40)
                      ),
                    ),
                    Text(
                      'ﺧﺪﻣﺔ ﺍﻻﺳﺘﺸﺎﺭﺓ ﺍﻟﻄﺒﻴﺔ ﺍﻻﻟﻜﺘﺮﻭﻧﻴﺔ',
                      style: TextStyle(
                          color: Colors.white,
                          fontSize: Configs.calcheight(40)
                      ),
                    )
                  ],
                ),
              )
            ),
            Container(
              padding: EdgeInsets.only(top: Configs.calcheight(900)),
              child: Container(
                width: mediaQueryData.size.width,
                child: Row(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Container(
                      width: Configs.calcwidth(183),
                      height: Configs.calcheight(71),
                      margin: EdgeInsets.only(right: 20),
                      child: FlatButton(
                        color: secondryColor,
                        textColor: textColor,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(99.0),
                        ),
                        onPressed: (){
                          openSignupURL();
                        },
                        padding: EdgeInsets.all(0),
                        child: Text(
                          'ﺍﻧﺸﺎﺀ ﺣﺴﺎﺏ',
                          style: TextStyle(
                            fontSize: Configs.calcheight(25),
                          ),
                        ),
                      ),
                    ),
                    Container(
                      width: Configs.calcwidth(200),
                      height: Configs.calcheight(71),
                      margin: EdgeInsets.only(left: 20),
                      child: FlatButton(
                        color: thirdColor,
                        textColor: Colors.white,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(99.0),
                        ),
                        onPressed: (){
                          Navigator.push(context, MaterialPageRoute(
                            builder: (context) => SignIn()
                          ));
                        },
                        padding: EdgeInsets.all(0),
                        child: Text(
                          'ﺗﺴﺠﻴﻞ ﺍﻟﺪﺧﻮﻝ',
                          style: TextStyle(
                            fontSize: Configs.calcheight(25),
                          ),
                        ),
                      ),
                    )
                  ],
                ),
              )
            )
          ],
        ),
      )
    );
  }

  openSignupURL() async{
    const url = 'https://alodoctor.online/doctor-sign-up.html';
    if (await canLaunch(url)) {
    await launch(url);
    } else {
    throw 'Could not launch $url';
    }
  }

  Future<void> checklogin(BuildContext context) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    String t_remember = prefs.getString('rememberme');
    if(t_remember == 'true'){
      showDialog(
          barrierDismissible: false,
          context: context,
          builder: (context) {
            return Center(
                child: SpinKitCircle(
                  itemBuilder: (BuildContext context, int index) {
                    return DecoratedBox(
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.all(Radius.circular(20)),
                        color: Colors.white,
                      ),
                    );
                  },
                )
            );
          });
      logincontroller lcontroller = logincontroller();
      String result = await lcontroller.login(prefs.getString('email'), prefs.getString('password'));
      Navigator.of(context).pop();
      if(result == 'success'){
        Navigator.pushReplacementNamed(context, '/consultant');
      }
    }
  }
}