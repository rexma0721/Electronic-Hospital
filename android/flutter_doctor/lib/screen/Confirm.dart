import 'package:flutter/material.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader1.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/component/Profilecomponent.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/colors.dart';

class Confirm extends StatefulWidget {
  @override
  _ConfirmState createState() => _ConfirmState();
}

class _ConfirmState extends State<Confirm> {
  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();

  TextEditingController emailcontroller = TextEditingController();
  TextEditingController amountcontroller = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: scaffoldKey,
      endDrawer: NavDrawer(scaffoldKey),
      resizeToAvoidBottomPadding: false,
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
                      margin: EdgeInsets.only(left: 5, right: 5, top: 10),
                      padding: EdgeInsets.only(right: Configs.calcheight(28)),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.all(
                            Radius.circular(Configs.calcheight(8))),
                        color: Green0,
                      ),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.end,
                        children: [
                          Text(
                            'ﺳﺤﺐ ﺍﻟﺮﺻﻴﺪ',
                            style: TextStyle(
                                fontSize: Configs.calcheight(30),
                                color: Colors.white),
                          ),
                          SizedBox(
                            width: 20,
                          ),
                          Image.asset(
                            'assets/images/ic_payment.png',
                            width: Configs.calcheight(45),
                            height: Configs.calcheight(45),
                          )
                        ],
                      ),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(
                        top: Configs.calcheight(15), left: 5, right: 5),
                    height: Configs.calcheight(335),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(
                          Radius.circular(Configs.calcheight(28))),
                      color: Gray02,
                    ),
                    width: double.infinity,
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.start,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Container(
                          margin: EdgeInsets.only(
                            top: Configs.calcheight(25),
                          ),
                          width: Configs.calcwidth(350),
                          decoration: new BoxDecoration(
                            shape: BoxShape.rectangle,
                            color: Colors.white,
                            border: new Border.all(
                              color: Colors.white,
                              width: 1.0,
                            ),
                          ),
                          child: TextField(
                            controller: emailcontroller,
                            keyboardType: TextInputType.emailAddress,
                            style: TextStyle(fontSize: Configs.calcheight(30)),
                            decoration: InputDecoration(
                              fillColor: Colors.white,
                              hintText: 'Email To Send',
                              border: InputBorder.none,
                              isDense: true,
                              // Added this
                              contentPadding: EdgeInsets.all(3),
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                        Container(
                          margin: EdgeInsets.only(
                            top: Configs.calcheight(25),
                          ),
                          width: Configs.calcwidth(350),
                          decoration: new BoxDecoration(
                            shape: BoxShape.rectangle,
                            color: Colors.white,
                            border: new Border.all(
                              color: Colors.white,
                              width: 1.0,
                            ),
                          ),
                          child: TextField(
                            controller: amountcontroller,
                            keyboardType: TextInputType.number,
                            style: TextStyle(fontSize: Configs.calcheight(30)),
                            decoration: InputDecoration(
                              fillColor: Colors.white,
                              hintText: 'Full Amount',
                              border: InputBorder.none,
                              isDense: true,
                              // Added this
                              contentPadding: EdgeInsets.all(3),
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                        Container(
                          width: Configs.calcwidth(318),
                          height: Configs.calcheight(83),
                          margin: EdgeInsets.only(top: Configs.calcheight(25)),
                          child: FlatButton(
                            color: Blue06,
                            textColor: Colors.white,
                            padding: EdgeInsets.all(0),
                            shape: RoundedRectangleBorder(
                              borderRadius:
                                  BorderRadius.circular(Configs.calcheight(8)),
                            ),
                            onPressed: () {
                              sendwithdraw();
                            },
                            child: Text(
                              ' ﺗﺄﻛﻴﺪ ﺍﻟﺴﺤﺐ',
                              style: TextStyle(
                                  fontSize: Configs.calcheight(30),
                                  color: Colors.white),
                              textAlign: TextAlign.center,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(
                        top: Configs.calcheight(15), left: 5, right: 5),
                    height: Configs.calcheight(86),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(
                          Radius.circular(Configs.calcheight(8))),
                      color: Gray02,
                    ),
                    width: double.infinity,
                    alignment: Alignment.center,
                    child: Text(
                      'سيتم ايداع الرصيد في حسابك خلال 5 ايام عمل',
                      style: TextStyle(
                          fontSize: Configs.calcheight(30), color: Colors.pink),
                      textAlign: TextAlign.center,
                    ),
                  )
                ],
              ),
            ),
            Bottombar()
          ],
        ),
      ),
    );
  }

  sendwithdraw() async {
    if (emailcontroller.text.trim().length == 0 ||
        amountcontroller.text.trim().length == 0) {
      showDialog(
          context: context,
          builder: (BuildContext context) {
            // return object of type Dialog
            return AlertDialog(
              title: new Text("Error"),
              content: new Text("Please Input All!"),
              actions: <Widget>[
                // usually buttons at the bottom of the dialog
                new FlatButton(
                  child: new Text("Ok"),
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                ),
              ],
            );
          });
    }
  }
}
