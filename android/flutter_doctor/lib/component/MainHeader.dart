import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/api_endpoints.dart';
import 'package:flutter_doctor/utils/base_main_repo.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:flutter_doctor/utils/network_utils.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:flutter_switch/flutter_switch.dart';
class MainHeader extends StatefulWidget {
  String label;
  GlobalKey<ScaffoldState> scaffoldKey;
  MainHeader(this.label, this.scaffoldKey);
  @override
  MainHeaderState createState() => MainHeaderState();
}

class MainHeaderState extends State<MainHeader> {

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }
  @override
  Widget build(BuildContext context) {
    Configs.headstate = this;
    bool status = (Configs.umodel.active_state ==  1)? true : false;
    return Container(
      width: double.infinity,
      height: Configs.calcheight(120),
      color: backColor,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Container(
            decoration: BoxDecoration(
                borderRadius: BorderRadius.all(Radius.circular(20)),
                color: Colors.green,
                border: Border.all(color: Colors.green, width: 1)
            ),
              margin: EdgeInsets.only(left: Configs.calcwidth(31)),
            width: Configs.calcwidth(156),
            height: Configs.calcheight(56),
              child: FlutterSwitch(
                activeText: 'ﺍﻭﻧﻼﻳﻦ',
                inactiveText: 'ﺍﻭﻓﻼﻳﻦ',
                value: status,
                valueFontSize: Configs.calcheight(25),
                width: Configs.calcwidth(156),
                height: Configs.calcheight(56),
                borderRadius: 30.0,
                showOnOff: true,
                toggleColor: status?  Colors.green: Colors.grey,
                activeColor: backColor,
                inactiveColor: backColor,
                activeTextColor: Colors.green,
                inactiveTextColor: Colors.grey,
                onToggle: (val) async {
                  BuildContext dialogContext;
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
                  bool result = await setonline();
                  if(result){
                    setState(() {
                      status = val;
                    });
                  }
                  Navigator.of(context).pop();
                },
              ),
          ),
          Container(
            child: Row(
              children: [
                Text(
                  widget.label,
                  style: TextStyle(
                    fontSize: Configs.calcheight(30),
                    color: Gray06
                  ),
                ),
                SizedBox(
                  width: 10,
                ),
                Container(
                  width: Configs.calcheight(83),
                  height: Configs.calcheight(69),
                  margin: EdgeInsets.only(right: 10),
                  decoration: BoxDecoration(
                    image: DecorationImage(
                        image: AssetImage('assets/images/ic_menu.png',),
                      fit: BoxFit.fill
                    )
                  ),
                  child: FlatButton(
                    onPressed: (){
                      widget.scaffoldKey.currentState.openEndDrawer();
                    },
                  ),
                ),
              ],
            ),
          )
        ],
      ),
    );
  }

  Future<bool> setonline() async {
    if(Configs.umodel.active_state == 1){
      Map<String, Object> values = {
        'id': Configs.umodel.id,
      };
      String response = await NetworkHelper.makePostRequest(APIEndPoints.offlineurl, values);
      var result = jsonDecode(response);
      if(result['status'] == 'success'){
        Configs.umodel.active_state = 0;
        return true;
      } else {
        return false;
      }
    } else {
      Map<String, Object> values = {
        'id': Configs.umodel.id,
      };
      String response = await NetworkHelper.makePostRequest(APIEndPoints.onlineurl, values);
      var result = jsonDecode(response);
      if(result['status'] == 'success'){
        Configs.umodel.active_state = 1;
        return true;
      } else {
        return false;
      }
    }
  }
}


