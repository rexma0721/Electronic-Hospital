import 'package:flutter_doctor/models/consultant_model.dart';

class usermodel {
  int id;
  int reader;
  int call_id;
  String call_password;
  String call_login;
  String fcmToken;
  int active_state;
  int money;
  String youtube_link;
  String facebook_link;
  String twitter_link;
  String instagram_link;
  String photo;
  String fname;
  String lname;
  String email;
  String phone;
  int remain_chat = 0;
  int remain_call = 0;
  int remain_video = 0;

  List<consultant_model> consultant;

  usermodel.fromJSON(Map<String, dynamic> jsonMap) {
    try {
      id = jsonMap['doctor']['id'];
      reader = jsonMap['doctor']['reader'];
      call_id = jsonMap['doctor']['call_id'];
      call_password = jsonMap['doctor']['call_password'];
      call_login = jsonMap['doctor']['call_login'];
      fcmToken = jsonMap['doctor']['fcmToken'];
      active_state = jsonMap['doctor']['active_state'];
      money = jsonMap['doctor']['money'];
      youtube_link = jsonMap['doctor']['youtube_link'];
      facebook_link = jsonMap['doctor']['facebook_link'];
      twitter_link = jsonMap['doctor']['twitter_link'];
      instagram_link = jsonMap['doctor']['instagram_link'];
      photo = jsonMap['doctor']['photo'];
      fname = jsonMap['doctor']['fname'];
      lname = jsonMap['doctor']['lname'];
      email = jsonMap['doctor']['email'];
      phone = jsonMap['doctor']['phone'];
      consultant = jsonMap['consultant'] != null ? List.from(jsonMap['consultant']).map((e) => consultant_model.fromJSON(e)).toList() : [];
      remain_chat = jsonMap['doctor']['remain_chat'];
      remain_call = jsonMap['doctor']['remain_call'];
      remain_video = jsonMap['doctor']['remain_video'];
    } catch (e) {
      print(e);
    }
  }
}
