import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader1.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/component/Profilecomponent.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/base_main_repo.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';

class Withdraw extends StatefulWidget {
  @override
  _WithdrawState createState() => _WithdrawState();
}

class _WithdrawState extends State<Withdraw> {
  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();

  TextEditingController ibancontroller = TextEditingController();
  TextEditingController biccontroller = TextEditingController();
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
                            'ﺣﺴﺎﺑﻲ ﺍﻟﺒﻨﻜﻲ',
                            style: TextStyle(
                                fontSize: Configs.calcheight(30),
                                color: Colors.white),
                          ),
                          SizedBox(
                            width: 20,
                          ),
                          Image.asset(
                            'assets/images/ic_loan.png',
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
                    child: Text('ﻳﺮﺟﻰ ﺍﺩﺧﺎﻝ ﺑﻴﺎﻧﺎﺕ ﺍﻟﺤﺴﺎﺏ ﺍﻟﺒﻨﻜﻲ:',
                      style: TextStyle(
                        color: Black0,
                        fontSize: Configs.calcheight(30),
                      ),
                      textDirection: TextDirection.rtl,
                      textAlign: TextAlign.right,),
                  ),
                  Container(
                    width: double.infinity,
                    height: Configs.calcheight(100),
                    margin: EdgeInsets.only(left: 5, right: 5, top: 10),
                    padding: EdgeInsets.only(right: 5, left: 5),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(
                          Radius.circular(Configs.calcheight(8))),
                      color: Gray02,
                    ),
                    child: TextField(
                      controller: ibancontroller,
                      keyboardType: TextInputType.visiblePassword,
                      style: TextStyle(
                          fontSize: Configs.calcheight(30)
                      ),
                      decoration: InputDecoration(
                        hintText: 'Account Number or IBAN',
                        border: InputBorder.none,

                      ),
                    ),
                  ),
                  Container(
                    width: double.infinity,
                    height: Configs.calcheight(100),
                    margin: EdgeInsets.only(left: 5, right: 5, top: 10),
                    padding: EdgeInsets.only(right: 5, left: 5),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(
                          Radius.circular(Configs.calcheight(8))),
                      color: Gray02,
                    ),
                    child: TextField(
                      controller: biccontroller,
                      keyboardType: TextInputType.visiblePassword,
                      style: TextStyle(
                          fontSize: Configs.calcheight(30)
                      ),
                      decoration: InputDecoration(
                        hintText: 'BIC/SWIFT',
                        border: InputBorder.none,

                      ),
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
                      onPressed: () async {
                        if(ibancontroller.text.trim().length != 0 && biccontroller.text.trim().length != 0){
                          String response = await _baseMainRepository.addbank(ibancontroller.text.trim(), biccontroller.text.trim());
                          var result = jsonDecode(response);
                          if(result['status'] == 'success'){
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
                  Container(
                    width: double.infinity,
                    margin: EdgeInsets.only(left: 10, right: 10, top: 20),
                    padding: EdgeInsets.all(5),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(
                          Radius.circular(Configs.calcheight(8))),
                      color: Gray02,
                    ),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.end,
                      children: [
                       Column(
                         crossAxisAlignment: CrossAxisAlignment.end,
                         children: [
                           SizedBox(
                             height: 5,
                           ),
                           Text(
                             'ﻣﻼﺣﻈﺔ: ﺍﻟﺒﻴﺎﻧﺎﺕ ﺍﻋﻼﻩ ﻣﻤﻜﻦ ﺍﺳﺘﺤﺼﺎﻟﻬﺎ ﻣﻦ ﺍﻟﺒﻨﻚ ﺍﻟﻤﺼﺪﺭ ﻟﺒﻄﺎﻗﺔ',
                             style: TextStyle(
                                 fontSize: Configs.calcheight(20),
                                 color: Black05),
                             textAlign: TextAlign.right,
                           ),
                           Text(
                             'ﺍﻟﻔﻴﺰﺍ ﺍﻭ ﺍﻟﻤﺎﺳﺘﺮ ﻛﺎﺭﺩ',
                             style: TextStyle(
                                 fontSize: Configs.calcheight(20),
                                 color: Black05),
                             textAlign: TextAlign.right,
                           ),
                           SizedBox(
                             height: 5,
                           ),
                         ],
                       ),
                        SizedBox(
                          width: 5,
                        ),
                        Image.asset(
                          'assets/images/ic_info.png',
                          width: Configs.calcheight(45),
                          height: Configs.calcheight(45),
                        )
                      ],
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
                    Text('ﺗﻢ ﺗﺤﺪﻳﺚ ﺑﻴﺎﻧﺎﺗﻚ ﺑﻨﺠﺎﺡ',
                      style: TextStyle(
                        color: Colors.black,
                        fontSize: Configs.calcheight(25),
                      ),),
                  ],
                )
            ),
          );
        }).then((value) {
          ibancontroller.text = '';
          biccontroller.text = '';
    });
  }
}
