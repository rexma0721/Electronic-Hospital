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

class Changepassword extends StatefulWidget {
  @override
  _ChangepasswordState createState() => _ChangepasswordState();
}

class _ChangepasswordState extends State<Changepassword> {
  final GlobalKey<ScaffoldState> scaffoldKey = GlobalKey<ScaffoldState>();

  TextEditingController oldcontroller = TextEditingController();
  TextEditingController newcontroller = TextEditingController();
  TextEditingController confirmcontroller = TextEditingController();

  bool old_flag = true;
  bool new_flag = true;
  bool con_flag = true;

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
                            'تغيير كلمة المرور',
                            style: TextStyle(
                                fontSize: Configs.calcheight(30),
                                color: Colors.white),
                          ),
                          Image.asset(
                            'assets/images/ic_password.png',
                            width: Configs.calcheight(45),
                            height: Configs.calcheight(45),
                          )
                        ],
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
                      controller: oldcontroller,
                      keyboardType: TextInputType.visiblePassword,
                      style: TextStyle(
                        fontSize: Configs.calcheight(30)
                      ),
                      decoration: InputDecoration(
                          suffixIcon: IconButton(
                            onPressed: (){
                              this.setState(() {
                                old_flag = !old_flag;
                              });
                            },
                            icon: Icon(old_flag ? Icons.visibility: Icons.visibility_off,
                              color: Colors.grey,),
                          ),
                          hintText: 'ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ ﺍﻟحالية',
                          border: InputBorder.none,

                      ),
                      obscureText: old_flag,
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
                      controller: newcontroller,
                      keyboardType: TextInputType.visiblePassword,
                      style: TextStyle(
                          fontSize: Configs.calcheight(30)
                      ),
                      decoration: InputDecoration(
                        suffixIcon: IconButton(
                          onPressed: (){
                            this.setState(() {
                              new_flag = !new_flag;
                            });
                          },
                          icon: Icon(old_flag ? Icons.visibility: Icons.visibility_off,
                            color: Colors.grey,),
                        ),
                        hintText: 'ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ ﺍﻟﺠﺪﻳﺪﺓ',
                        border: InputBorder.none,

                      ),
                      obscureText: new_flag,
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
                      controller: confirmcontroller,
                      keyboardType: TextInputType.visiblePassword,
                      style: TextStyle(
                          fontSize: Configs.calcheight(30)
                      ),
                      decoration: InputDecoration(
                        suffixIcon: IconButton(
                          onPressed: (){
                            this.setState(() {
                              con_flag = ! con_flag;
                            });
                          },
                          icon: Icon(old_flag ? Icons.visibility: Icons.visibility_off,
                            color: Colors.grey,),
                        ),
                        hintText: ' تأكيد ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ ﺍﻟﺠﺪﻳﺪﺓ',
                        border: InputBorder.none,

                      ),
                      obscureText: con_flag,
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
                        changePsw();
                      },
                      child: Text(
                        'ﺗﺄﻛﻴﺪ ﺗﻐﻴﻴﺮ ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ',
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
            Bottombar()
          ],
        ),
      ),
    );
  }
 void showmessage(txt){
   showDialog(
       context: context,
       builder: (BuildContext context) {
         // return object of type Dialog
         return AlertDialog(
           title: new Text("Alert"),
           content: new Text(txt),
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
  Future<void> changePsw() async {
    String t_old = oldcontroller.text.trim();
    String t_new = newcontroller.text.trim();
    String t_con = confirmcontroller.text.trim();
    if(t_old.length == 0){
      showmessage('يرجى ادخال كلمة المرور الحالية');
      return;
    } 
    if(t_new.length == 0){
      showmessage('يرجى تأكيد كلمة المرور الجديدة');
      return;
    }
    if(t_con.length == 0){
      showmessage('يرجى ادخال كلمة المرور الجديدة');
      return;
    }
    else if(t_new != t_con){
      showmessage('يرجى ادخال كلمة المرور الجديدة');
      return;
    }
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
    BaseMainRepository _baseMainRepository = BaseMainRepository();
    String response = await _baseMainRepository.changepssword(t_old, t_new);
    Navigator.pop(context);
    var result = jsonDecode(response);
    if(result['status'] == 'success'){
      showDialog(
          context: context,
          builder: (BuildContext context) {
            // return object of type Dialog
            return AlertDialog(
              title: new Text('تمت العملية بنجاح!'),
              content: new Text('تم تحديث كلمة المرور بنجاح'),
              actions: <Widget>[
                // usually buttons at the bottom of the dialog
                new FlatButton(
                  child: new Text('حسنا'),
                  onPressed: () {
                    Navigator.popUntil(context, ModalRoute.withName('/consultant'));
                  },
                ),
              ],
            );
          });
    } else{
      showmessage(result['status']);
    }
  }
}
