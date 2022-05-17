import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader1.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/component/Profilecomponent.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/base_main_repo.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';

class ChangePrice extends StatefulWidget {
  @override
  _ChangePriceState createState() => _ChangePriceState();
}

class _ChangePriceState extends State<ChangePrice> {
  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();

  TextEditingController chatcontroller = TextEditingController();
  TextEditingController voicecontroller = TextEditingController();
  TextEditingController videocontroller = TextEditingController();
  BaseMainRepository _baseMainRepository;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _baseMainRepository = BaseMainRepository();
  }
  @override
  Widget build(BuildContext context) {
    chatcontroller.text = Configs.umodel.remain_chat.toString();
    voicecontroller.text = Configs.umodel.remain_call.toString();
    videocontroller.text = Configs.umodel.remain_video.toString();
    return Scaffold(
      key: scaffoldKey,
      endDrawer: NavDrawer(scaffoldKey),
      body: Container(
        width: double.infinity,
        height: double.infinity,
        color: Colors.white,
        child: SingleChildScrollView(
          child: Column(
            children: [
              MainHeader1('ﺍﻟﺮﺟﻮﻉ', scaffoldKey),
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
                        'ﺗﺤﺪﻳﺪ ﺍﻟﺘﻜﻠﻔﺔ',
                        style: TextStyle(
                          fontSize: Configs.calcheight(30),
                          color: Colors.white,
                        ),
                      ),
                      SizedBox(
                        width: 20,
                      ),
                      Image.asset(
                        'assets/images/ic_wallet_white.png',
                        width: Configs.calcheight(45),
                        height: Configs.calcheight(45),
                      )
                    ],
                  ),
                ),
              ),
              Container(
                padding: EdgeInsets.only(right: 10),
                width: double.infinity,
                child: Text('ﺗﺤﺪﻳﺚ ﺗﻜﻠﻔﺔ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                  style: TextStyle(
                    color: Color(0xff777777),
                    fontSize: Configs.calcheight(30),
                  ),
                  textAlign: TextAlign.right,),
              ),
              Container(
                  width: double.infinity,
                  margin: EdgeInsets.only(left: 30, right: 30, top: 20),
                  child: Column(
                    children: [
                      Row(
                        children: [
                          Expanded(
                            child: Text('التكلفة',
                              style: TextStyle(
                                color: Color(0xff777777),
                                fontSize: Configs.calcheight(30),
                              ),
                              textAlign: TextAlign.right,),
                          ),
                          Expanded(
                            child: Text('ﻃﺮﻳﻘﺔ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                              style: TextStyle(
                                color: Color(0xff777777),
                                fontSize: Configs.calcheight(30),
                              ),
                              textAlign: TextAlign.right,),
                          ),
                        ],
                      ),
                      Container(
                        width: double.infinity,
                        margin: EdgeInsets.only(top: 5, bottom: 5),
                        child:  Row(
                          children: [
                            Expanded(
                              child: Container(
                                width: double.infinity,
                                alignment: Alignment.centerRight,
                                child: Container(
                                  width: Configs.calcheight(150),
                                  height: Configs.calcheight(80),
                                  decoration:BoxDecoration(
                                      borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(8))),
                                      color: Colors.white,
                                      border: Border.all(color: Color(0xff777777), width: 1)),
                                  padding: EdgeInsets.only(left: 10, right: 10),
                                  child: TextField(
                                    enableInteractiveSelection: false,
                                    controller: chatcontroller,
                                    keyboardType: TextInputType.number,
                                    inputFormatters: <TextInputFormatter>[
                                      FilteringTextInputFormatter.digitsOnly
                                    ],
                                    decoration: InputDecoration(
                                        fillColor: Colors.white,
                                        border: InputBorder.none,
                                        prefixStyle: TextStyle(
                                            color:  Colors.black,
                                            fontSize: Configs.calcheight(30)
                                        ),
                                        prefixText: '\$',
                                        contentPadding:
                                        EdgeInsets.all(0)),
                                    onChanged: (text) {
                                    },
                                    style: TextStyle(
                                        fontSize: Configs.calcheight(30),
                                        color:  Colors.black),
                                  ),
                                ),
                              ),
                            ),
                            Expanded(
                              child: Text('ﺍﻟﻨﺼﻴﺔ',
                                style: TextStyle(
                                  color: Color(0xff777777),
                                  fontSize: Configs.calcheight(30),
                                ),
                                textAlign: TextAlign.right,),
                            ),
                          ],
                        ),
                      ),
                      Container(
                        width: double.infinity,
                        margin: EdgeInsets.only(top: 5, bottom: 5),
                        child:  Row(
                          children: [
                            Expanded(
                              child: Container(
                                width: double.infinity,
                                alignment: Alignment.centerRight,
                                child: Container(
                                  width: Configs.calcheight(150),
                                  height: Configs.calcheight(80),
                                  decoration:BoxDecoration(
                                      borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(8))),
                                      color: Colors.white,
                                      border: Border.all(color: Color(0xff777777), width: 1)),
                                  padding: EdgeInsets.only(left: 10, right: 10),
                                  child: TextField(
                                    enableInteractiveSelection: false,
                                    controller: voicecontroller,
                                    keyboardType: TextInputType.number,
                                    inputFormatters: <TextInputFormatter>[
                                      FilteringTextInputFormatter.digitsOnly
                                    ],
                                    decoration: InputDecoration(
                                        fillColor: Colors.white,
                                        border: InputBorder.none,
                                        prefixStyle: TextStyle(
                                            color:  Colors.black,
                                            fontSize: Configs.calcheight(30)
                                        ),
                                        prefixText: '\$',
                                        contentPadding:
                                        EdgeInsets.all(0)),
                                    onChanged: (text) {
                                    },
                                    style: TextStyle(
                                        fontSize: Configs.calcheight(30),
                                        color:  Colors.black),
                                  ),
                                ),
                              ),
                            ),
                            Expanded(
                              child: Text('اتصال صوتي',
                                style: TextStyle(
                                  color: Color(0xff777777),
                                  fontSize: Configs.calcheight(30),
                                ),
                                textAlign: TextAlign.right,),
                            ),
                          ],
                        ),
                      ),
                      Container(
                        width: double.infinity,
                        margin: EdgeInsets.only(top: 5, bottom: 5),
                        child:  Row(
                          children: [
                            Expanded(
                              child: Container(
                                width: double.infinity,
                                alignment: Alignment.centerRight,
                                child: Container(
                                  width: Configs.calcheight(150),
                                  height: Configs.calcheight(80),
                                  decoration:BoxDecoration(
                                      borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(8))),
                                      color: Colors.white,
                                      border: Border.all(color: Color(0xff777777), width: 1)),
                                  padding: EdgeInsets.only(left: 10, right: 10),
                                  child: TextField(
                                    enableInteractiveSelection: false,
                                    controller: videocontroller,
                                    keyboardType: TextInputType.number,
                                    inputFormatters: <TextInputFormatter>[
                                      FilteringTextInputFormatter.digitsOnly
                                    ],
                                    decoration: InputDecoration(
                                        fillColor: Colors.white,
                                        border: InputBorder.none,
                                        prefixStyle: TextStyle(
                                            color:  Colors.black,
                                            fontSize: Configs.calcheight(30)
                                        ),
                                        prefixText: '\$',
                                        contentPadding:
                                        EdgeInsets.all(0)),
                                    onChanged: (text) {
                                    },
                                    style: TextStyle(
                                        fontSize: Configs.calcheight(30),
                                        color:  Colors.black),
                                  ),
                                ),
                              ),
                            ),
                            Expanded(
                              child: Text('اتصال فيديو',
                                style: TextStyle(
                                  color: Color(0xff777777),
                                  fontSize: Configs.calcheight(30),
                                ),
                                textAlign: TextAlign.right,),
                            ),
                          ],
                        ),
                      )
                    ],
                  )
              ),
              Container(
                width: double.infinity,
                height: Configs.calcheight(83),
                margin: EdgeInsets.only(top: Configs.calcheight(25), left: 5, right: 5),
                child: FlatButton(
                  color: Color(0xff4124F0),
                  textColor: Colors.white,
                  padding: EdgeInsets.all(0),
                  shape: RoundedRectangleBorder(
                    borderRadius:
                    BorderRadius.circular(Configs.calcheight(8)),
                  ),
                  onPressed: () async {
                    if(chatcontroller.text.trim().length != 0 && voicecontroller.text.trim().length != 0 && videocontroller.text.trim().length != 0){
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
                      String response =
                      await _baseMainRepository.changeprice(chatcontroller.text.trim(), voicecontroller.text.trim(), videocontroller.text.trim());
                      var result = jsonDecode(response);
                      Navigator.of(context).pop();
                      if (result['status'] == 'success') {
                        showsuccessmodal();
                      }
                    }
                  },
                  child: Text(
                    'ﺗﺤﺪﻳﺚ',
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
      ),
      bottomNavigationBar:  Bottombar(),
    );
  }

  void showsuccessmodal() {
    showDialog(
        barrierDismissible: true,
        context: context,
        builder: (context) {
          return Dialog(
            shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(38)))),
            child: Container(
                width: Configs.calcwidth(460),
                height: Configs.calcheight(392),
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.all(
                      Radius.circular(Configs.calcheight(38))),),
                padding: EdgeInsets.all(Configs.calcheight(25)),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Image.asset('assets/images/ic_success.png',
                      width: Configs.calcheight(171),
                      height: Configs.calcheight(171),),
                    SizedBox(
                      height: Configs.calcheight(20),
                    ),
                    Text('ﺗﻢ ﺗﺤﺪﻳﺚ ﺗﻜﻠﻔﺔ ﺧﺪﻣﺎﺕ ﺍﻻﺳﺘﺸﺎﺭﺍﺕ ﺑﻨﺠﺎﺡ',
                      style: TextStyle(
                        color: Colors.black,
                        fontSize: Configs.calcheight(25),
                      ),
                    textAlign: TextAlign.center,),
                  ],
                )
            ),
          );
        }).then((value) {
          Configs.umodel.remain_chat = int.parse(chatcontroller.text.trim());
          Configs.umodel.remain_call = int.parse(voicecontroller.text.trim());
          Configs.umodel.remain_video = int.parse(videocontroller.text.trim());
          setState(() {

          });

    });
  }
}
