import 'package:badges/badges.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/colors.dart';

class Bottombar extends StatefulWidget {
  @override
  _BottombarState createState() => _BottombarState();
}

class _BottombarState extends State<Bottombar> {
  @override
  Widget build(BuildContext context) {
    int total = 0;
    for(int i = 0; i < Configs.con.unread_num.length; i++){
      total = total + Configs.con.unread_num[i];
    }
    return Container(
      height: Configs.calcheight(156),
      decoration: BoxDecoration(
        color: Colors.white,
        border: Border(
          top: BorderSide(width: 0.5, color: Colors.black),
        ),
      ),
      padding: EdgeInsets.only(
          left: Configs.calcwidth(23), right: Configs.calcwidth(23)),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Container(
            width: Configs.calcwidth(187),
            height: Configs.calcheight(112),
            margin: EdgeInsets.only(left: Configs.calcwidth(23)),
            child: FlatButton(
              color: Color.fromRGBO(243, 244, 248, 0.49),
              padding: EdgeInsets.all(0),
              shape: RoundedRectangleBorder(
                borderRadius:
                BorderRadius.circular(Configs.calcheight(112/2)),
              ),
              onPressed: () {
                Navigator.popUntil(context, ModalRoute.withName('/consultant'));
              },
              child: total == 0? Image.asset('assets/images/ic_notification_inactive.png',
                width: Configs.calcheight(70),
                height: Configs.calcheight(70),
              ) : Badge(
                shape: BadgeShape.circle,
                borderRadius: BorderRadius.circular(100),
                child:  Image.asset('assets/images/ic_notification_inactive.png',
                  width: Configs.calcheight(70),
                  height: Configs.calcheight(70),
                ),
                position: BadgePosition.topEnd(top: -10 ,end: -10),
                badgeContent: Text(
                  total.toString(),
                  style: TextStyle(
                      color: Colors.white,
                      fontSize: 13
                  ),
                  textAlign: TextAlign.center,
                ),
              ),
            ),
          ),
          Container(
            width: Configs.calcwidth(187),
            height: Configs.calcheight(112),
            margin: EdgeInsets.only(right: Configs.calcwidth(23)),
            child: FlatButton(
              color: Red01,
              padding: EdgeInsets.all(0),
              shape: RoundedRectangleBorder(
                borderRadius:
                BorderRadius.circular(Configs.calcheight(112/2)),
              ),
              onPressed: () {
                Navigator.popUntil(context, ModalRoute.withName('/consultant'));
              },
              child: Image.asset('assets/images/ic_home_active.png',
                width: Configs.calcheight(70),
                height: Configs.calcheight(70),
              ),
            ),
          )
        ],
      ),
    );
  }
}
