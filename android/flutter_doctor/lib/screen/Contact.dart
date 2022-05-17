import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader1.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/component/Profilecomponent.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/base_main_repo.dart';
import 'package:flutter_doctor/utils/colors.dart';

class Contact extends StatefulWidget {
  @override
  _ContactState createState() => _ContactState();
}

class _ContactState extends State<Contact> {
  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();

  TextEditingController contactcontroller = TextEditingController();
  BaseMainRepository _baseMainRepository;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _baseMainRepository = BaseMainRepository();
  }

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
                            'ﺍﺗﺼﻞ ﺑﻨﺎ',
                            style: TextStyle(
                                fontSize: Configs.calcheight(30),
                                color: Colors.white),
                          ),
                          SizedBox(
                            width: 10,
                          ),
                          Image.asset(
                            'assets/images/ic_contact.png',
                            width: Configs.calcheight(45),
                            height: Configs.calcheight(45),
                            color: Colors.white,
                          )
                        ],
                      ),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(
                        top: Configs.calcheight(15), left: 5, right: 5),
                    height: Configs.calcheight(397),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(
                          Radius.circular(Configs.calcheight(8))),
                      color: Gray02,
                    ),
                    padding: EdgeInsets.all(Configs.calcheight(15)),
                    width: double.infinity,
                    child: TextField(
                      controller: contactcontroller,
                      keyboardType: TextInputType.visiblePassword,
                      style: TextStyle(
                          fontSize: Configs.calcheight(30),
                      ),
                      maxLines: null,
                      decoration: InputDecoration(
                        hintText: 'ﻧﺺ ﺍﻟﺮﺳﺎﻟﺔ',
                        border: InputBorder.none,
                      ),
                      textAlign: TextAlign.right,
                    ),
                  ),
                  Container(
                    width: Configs.calcwidth(569),
                    height: Configs.calcheight(83),
                    child: FlatButton(
                      color: Yellow0,
                      textColor: Colors.black,
                      padding: EdgeInsets.all(0),
                      shape: RoundedRectangleBorder(
                        borderRadius:
                        BorderRadius.circular(Configs.calcheight(3)),
                      ),
                      onPressed: () async {
                        if(contactcontroller.text.trim().length != 0){
                          String response = await _baseMainRepository.sendcontact(contactcontroller.text.trim());
                          var result = jsonDecode(response);
                          if(result['status'] == 'success'){
                            showsuccessmodal();
                          }

                        }
                      },
                      child: Text(
                        'ﺍﺭﺳﻞ',
                        style: TextStyle(
                            fontSize: Configs.calcheight(30),),
                        textAlign: TextAlign.center,
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
  void showsuccessmodal() {
    showDialog(
        barrierDismissible: true,
        context: context,
        builder: (context) {
          return Dialog(
            shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(18)))),
            child: Container(
                width: Configs.calcwidth(460),
                height: Configs.calcheight(384),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    SizedBox(
                      height: Configs.calcheight(49),
                    ),
                    Image.asset('assets/images/ic_success_modal.png',
                      width: Configs.calcheight(171),
                      height: Configs.calcheight(171),),
                    Container(
                        margin: EdgeInsets.only(top: Configs.calcheight(35)),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Text('ﺗﻢ ﺍﺳﺘﻼﻡ ﺍﻟﺮﺳﺎﻟﺔ ﺑﻨﺠﺎﺡ',
                              style: TextStyle(
                                color: Black0,
                                fontSize: Configs.calcheight(30),
                              ),
                              textAlign: TextAlign.center,),
                            Image.asset('assets/images/ic_mailsend.png',
                              width: Configs.calcheight(53),
                              height: Configs.calcheight(53),),
                          ],
                        )
                    )
                  ],
                )
            ),
          );
        }).then((value) {
      contactcontroller.text = '';
    });
  }
}
