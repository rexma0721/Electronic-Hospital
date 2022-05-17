import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/controllers/logincontroller.dart';
import 'package:flutter_doctor/screen/Consultant.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:mvc_pattern/mvc_pattern.dart';
import 'package:url_launcher/url_launcher.dart';

class SignIn extends StatefulWidget {
  @override
  _SignInState createState() => _SignInState();
}

class _SignInState extends StateMVC<SignIn> {

  logincontroller _con;

  _SignInState(): super(logincontroller()){
    _con = controller;
  }

  bool error = false;
  bool passsecure = true;
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    MediaQueryData mediaQueryData = MediaQuery.of(context);
    return Stack(
      children: [
        Container(
          width: double.infinity,
          height: double.infinity,
          color: primaryColor,
        ),
        Positioned(
          top: -Configs.calcheight(300),
          child: Image.asset(
            "assets/images/bg_logo.png",
            height: MediaQuery.of(context).size.height,
            width: MediaQuery.of(context).size.width,
            fit: BoxFit.cover,
          ),
        ),
        Scaffold(
          backgroundColor: Colors.transparent,
          body: Container(
            width: double.infinity,
            height: double.infinity,
            color: Colors.transparent,
            child: SingleChildScrollView(
              child: Column(
                children: [
                  SizedBox(
                    height: Configs.calcheight(390) + mediaQueryData.padding.top,
                  ),
                  Container(
                    width: mediaQueryData.size.width,
                    alignment: Alignment.center,
                    child: Container(
                      height: Configs.calcheight(700),
                      width: Configs.calcwidth(547),
                      decoration: BoxDecoration(
                          borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(55))),
                          color: backColor
                      ),
                      child: Column(
                        children: [
                          !error? Container(
                            width: double.infinity,
                            padding: EdgeInsets.only(top: Configs.calcheight(46)),
                            child: Text(
                              'ﺗﺴﺠﻴﻞ ﺍﻟﺪﺧﻮﻝ ﺍﻟﺨﺎﺹ ﺑﺎﻷﻃﺒﺎﺀ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(40),
                                color: Colors.black,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ):
                          Container(
                            padding: EdgeInsets.only(top: Configs.calcheight(46)),
                            width: double.infinity,
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Row(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    Text(
                                      'ﺍﻷﻳﻤﻴﻞ ﺍﻭ ﺍﻟﺮﻣﺰ ﻏﻴﺮ ﺻﺤﻴﺢ',
                                      style: TextStyle(
                                          color: Colors.red,
                                          fontSize: Configs.calcheight(30)
                                      ),
                                    ),
                                    SizedBox(
                                      width: 10,
                                    ),
                                    Image.asset('assets/images/ic_warn.png',
                                      width: Configs.calcheight(50),
                                      height: Configs.calcheight(50),)
                                  ],
                                ),
                                Text(
                                  'ﻳﺮﺟﻰ ﺍﻟﻤﺤﺎﻭﻟﺔ ﻣﺮﺓ ﺃﺧﺮﻯ',
                                  style: TextStyle(
                                      color: Colors.red,
                                      fontSize: Configs.calcheight(30)
                                  ),
                                )
                              ],
                            ),
                          ),
                          Container(
                            margin: EdgeInsets.only(top: 5, bottom: 5, left: 20, right: 20),
                            decoration: new BoxDecoration(
                              shape: BoxShape.rectangle,
                              color: Colors.white,
                              border: new Border.all(
                                color: Colors.white,
                                width: 1.0,
                              ),
                            ),
                            child: TextField(
                              controller: _emailController,
                              keyboardType: TextInputType.emailAddress,
                              decoration: InputDecoration(
                                  fillColor: Colors.white,
                                  prefixIcon: Padding(
                                    padding: EdgeInsets.all(1),
                                    child: Image.asset('assets/images/ic_email.png',
                                      width: Configs.calcheight(50),
                                      height: Configs.calcheight(50),),
                                  ),
                                  hintText: 'Email',
                                  border: InputBorder.none
                              ),
                            ),
                          ),
                          Container(
                            margin: EdgeInsets.only(top: 10, bottom: 5, left: 20, right: 20),
                            decoration: new BoxDecoration(
                              shape: BoxShape.rectangle,
                              color: Colors.white,
                              border: new Border.all(
                                color: Colors.white,
                                width: 1.0,
                              ),
                            ),
                            child: TextField(
                              controller: _passwordController,
                              keyboardType: TextInputType.visiblePassword,
                              decoration: InputDecoration(
                                  fillColor: Colors.white,
                                  prefixIcon: Padding(
                                    padding: EdgeInsets.all(1),
                                    child: Image.asset('assets/images/ic_lock.png',
                                      width: Configs.calcheight(50),
                                      height: Configs.calcheight(50),),
                                  ),
                                  suffixIcon: IconButton(
                                    onPressed: (){
                                      this.setState(() {
                                        passsecure = !passsecure;
                                      });
                                    },
                                    icon: Icon(passsecure ? Icons.visibility: Icons.visibility_off,
                                      color: Colors.grey,),
                                  ),
                                  hintText: 'Password',
                                  border: InputBorder.none
                              ),
                              obscureText: passsecure,
                            ),
                          ),
                          Container(
                            margin: EdgeInsets.only(top: Configs.calcheight(58)),
                            padding: EdgeInsets.only(left: 20, right: 20),
                            width: double.infinity,
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
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
                                  width: Configs.calcwidth(248),
                                  height: Configs.calcheight(71),
                                  child: FlatButton(
                                    color: thirdColor,
                                    textColor: Colors.white,
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(99.0),
                                    ),
                                    padding: EdgeInsets.all(0),
                                    onPressed: () async {
                                      String t_email = _emailController.text.trim();
                                      String t_pass = _passwordController.text.trim();
                                      BuildContext dialogContext;
                                      if(t_email.length != 0 && t_pass.length != 0 && Configs.validateEmail(t_email)){
                                        showDialog(
                                            barrierDismissible: false,
                                            context: context,
                                            builder: (context) {
                                              dialogContext = context;
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
                                        String result = await _con.login(t_email, t_pass);
                                        Navigator.pop(dialogContext);
                                        if(result == 'success'){
                                          _con.saveParam(t_email, t_pass);
                                          Navigator.pushNamed(context, '/consultant');
                                        } else {
                                          this.setState(() {
                                            error = true;
                                          });
                                        }

                                      } else {
                                        this.setState(() {
                                          error = true;
                                        });
                                      }
                                    },
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
                          ),
                          Container(
                            margin: EdgeInsets.only(top: Configs.calcheight(100)),
                            child: FlatButton(
                              onPressed: (){

                              },
                              child: Text(
                                'ﻫﻞ ﻧﺴﻴﺖ ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ؟',
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: Configs.calcheight(27)
                                ),
                              ),
                            ),
                          )
                        ],
                      ),
                    ),
                  )
                ],
              ),
            ),
          ),
        )
      ],
    );
  }
  openSignupURL() async{
    const url = 'https://ehospital.online/create';
    if (await canLaunch(url)) {
      await launch(url);
    } else {
      throw 'Could not launch $url';
    }
  }
}
