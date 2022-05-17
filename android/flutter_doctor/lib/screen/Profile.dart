import 'package:flutter/material.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader1.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/component/Profilecomponent.dart';
import 'package:flutter_doctor/screen/Changepassword.dart';
import 'package:flutter_doctor/screen/Confirm.dart';
import 'package:flutter_doctor/screen/Withdraw.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/api_endpoints.dart';
import 'package:flutter_doctor/utils/colors.dart';

class Profile extends StatefulWidget {
  @override
  _ProfileState createState() => _ProfileState();
}

class _ProfileState extends State<Profile> {
  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
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
            MainHeader1('ﺍﻟﺮﺟﻮﻉ', scaffoldKey),
            Expanded(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.start,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  Profilecomponent(),
                  Container(
                    child: Container(
                      width: double.infinity,
                      height: Configs.calcheight(100),
                      margin: EdgeInsets.only(left: 5, right: 5,top: 10),
                      child: FlatButton(
                        color: Gray02,
                        textColor: Colors.white,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                        ),
                        onPressed: (){
                          Navigator.popUntil(context, ModalRoute.withName('/consultant'));
                          Navigator.push(context, MaterialPageRoute(
                              builder: (context) => Changepassword()
                          ));
                        },
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            Text(
                              'ﺗﻐﻴﻴﺮ ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ',
                              style: TextStyle(
                                  fontSize: 20,
                                  color: Colors.black
                              ),
                            ),
                            SizedBox(
                              width: 20,
                            ),
                            Image.asset('assets/images/ic_password.png',
                              width: Configs.calcheight(45),
                              height: Configs.calcheight(45),)
                          ],
                        ),
                      ),
                    ),
                  ),
                  Container(
                    child: Container(
                      width: double.infinity,
                      height: Configs.calcheight(100),
                      margin: EdgeInsets.only(left: 5, right: 5,top: 10),
                      child: FlatButton(
                        color: Gray02,
                        textColor: Colors.white,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                        ),
                        onPressed: (){
                          Navigator.popUntil(context, ModalRoute.withName('/consultant'));
                          Navigator.push(context, MaterialPageRoute(
                              builder: (context) => Withdraw()
                          ));
                        },
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                            Text(
                              'ﺣﺴﺎﺑﻲ ﺍﻟﺒﻨﻜﻲ',
                              style: TextStyle(
                                  fontSize: 20,
                                  color: Colors.black
                              ),
                            ),
                            SizedBox(
                              width: 20,
                            ),
                            Image.asset('assets/images/ic_loan.png',
                              width: Configs.calcheight(45),
                              height: Configs.calcheight(45),)
                          ],
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
            Bottombar()
          ],
        ),
      ),
    );
  }
}
