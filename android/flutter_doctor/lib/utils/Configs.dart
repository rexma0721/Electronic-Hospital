import 'package:flutter/material.dart';
import 'package:flutter_doctor/component/MainHeader.dart';
import 'package:flutter_doctor/controllers/consultantcontroller.dart';
import 'package:flutter_doctor/models/usermodel.dart';
import 'package:flutter_doctor/models/consultant_model.dart';

class Configs {

  static final String APP_ID = 'b71d83143daf4cd0b8900de43aede7e0';

  static double calheight = 0;
  static double calwidth = 0;
  static int numofChat = 0;
  static int numofVoice = 0;
  static int numofVideo = 0;
  static double calcheight(data){
    return calheight * data;
  }
  static double calcwidth(data){
    return calwidth * data;
  }
  static bool validateEmail(String value) {
    Pattern pattern =
        r'^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$';
    RegExp regex = new RegExp(pattern);
    return (!regex.hasMatch(value)) ? false : true;
  }
  static usermodel umodel;
  static consultant_model conmodel;
  static consultantcontroller con;
  static MainHeaderState headstate;
  static BuildContext con_context;
}