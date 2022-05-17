import 'dart:io';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/network_utils.dart';

import 'api_endpoints.dart';

class BaseMainRepository {
  Future<String> Login(String email, String password, String token) async {
    String platform = '';
    if (Platform.isAndroid) {
      platform = 'android';
    }
    if (Platform.isIOS) {
      platform = 'ios';
    }
    Map<String, Object> values = {
      'email': email,
      'password': password,
      'remember': 1,
      'fcmToken': token,
      'platform': platform
    };
    String result =
        await NetworkHelper.makePostRequest(APIEndPoints.loginurl, values);
    return result;
  }

  Future<String> getconsultant() async {
    Map<String, Object> values = {
      'doctor_id': Configs.umodel.id,
    };
    String result =
        await NetworkHelper.makePostRequest(APIEndPoints.consultanturl, values);
    return result;
  }

  Future<String> changepssword(String t_old, String t_new) async {
    Map<String, Object> values = {
      'current': t_old,
      'new': t_new,
      'doctor_id': Configs.umodel.id,
    };
    String result = await NetworkHelper.makePostRequest(
        APIEndPoints.changepasswordurl, values);
    return result;
  }

  Future<String> sendnotification(String s, String trim) async {
    print(Configs.conmodel.doctor_id);
    print(Configs.conmodel.patient_id);
    print(s);
    print(trim);

    Map<String, Object> values = {
      'noti_type': s,
      'sender_id': Configs.conmodel.doctor_id,
      'receiver_id': Configs.conmodel.patient_id,
      'value': trim
    };
    String result = await NetworkHelper.makePostRequest(
        APIEndPoints.doctor_sendNotification, values);
    return result;
  }

  Future<String> givefeedback() async {
    Map<String, Object> values = {
      'doctor_id': Configs.conmodel.doctor_id,
      'patient_id': Configs.conmodel.patient_id,
      'rate': 0,
      'feedback': '123',
      'type': Configs.conmodel.type,
    };
    String result = await NetworkHelper.makePostRequest(
        APIEndPoints.patient_givefeedback, values);
    return result;
  }

  Future<String> sendcontact(String trim) async {
    Map<String, Object> values = {
      'name': Configs.umodel.fname + ' ' + Configs.umodel.lname,
      'phone_number': Configs.umodel.phone.toString(),
      'email': Configs.umodel.email,
      'message': trim,
    };
    String result =
        await NetworkHelper.makePostRequest(APIEndPoints.contactus, values);
    return result;
  }

  Future<String> addbank(String trim, String trim2) async {
    Map<String, Object> values = {
      'number': trim,
      'type': trim2,
      'id': Configs.umodel.id
    };
    String result =
        await NetworkHelper.makePostRequest(APIEndPoints.addbank, values);
    return result;
  }

  Future<String> changeprice(String trim, String trim2, String trim3) async {
    Map<String, Object> values = {
      'doctor_id': Configs.umodel.id,
      'price_chat': trim,
      'price_voice': trim2,
      'price_video': trim3
    };
    String result =
        await NetworkHelper.makePostRequest(APIEndPoints.changeprice, values);
    return result;
  }
}
