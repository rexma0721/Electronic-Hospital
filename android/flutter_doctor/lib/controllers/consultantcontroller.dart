import 'dart:convert';

import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter_doctor/models/consultant_model.dart';
import 'package:flutter_doctor/models/usermodel.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/base_main_repo.dart';
import 'package:mvc_pattern/mvc_pattern.dart';
import 'package:shared_preferences/shared_preferences.dart';

class consultantcontroller extends ControllerMVC {
  BaseMainRepository _baseMainRepository;

  List<consultant_model> res_consultArr;
  List<consultant_model> old_consultArr;
  List<consultant_model> consultArr;
  List<int> unread_num;

  final db = Firestore.instance;
  CollectionReference chatReference;

  consultantcontroller() {

    _baseMainRepository = BaseMainRepository();
    getconsultant();
  }
  Future<void> getconsultant() async{
    res_consultArr = List();
    consultArr = List();
    old_consultArr = List();
    unread_num = List();
    Configs.numofChat = 0;
    Configs.numofVideo = 0;
    Configs.numofVoice = 0;
    String response = await _baseMainRepository.getconsultant();
    var result = jsonDecode(response);
    if(result['status'] == 'success'){
      Map<String, dynamic> decodedJSON = {};
      decodedJSON = jsonDecode(response) as Map<String, dynamic>;
      Configs.umodel.consultant = decodedJSON['consultant'] != null ? List.from(decodedJSON['consultant']).map((e) => consultant_model.fromJSON(e)).toList() : [];
      consultArr = Configs.umodel.consultant;
      for(int i = 0; i < consultArr.length; i++){
        if(consultArr[i].status != 'now'){
          old_consultArr.add(consultArr[i]);
        }
      }
      setState((){});
      List temp_arr = List();
      for(int x = 0; x < consultArr.length; x++){
        if(consultArr[x].status == 'now'){
          temp_arr.add(consultArr[x]);
        }
      }
      if(temp_arr.length > 0){
        List<consultant_model> temps_arr = List();
        List<int> temps_unread = List();
        temps_arr.add(temp_arr[0]);
        temps_unread.add(0);
        for(int x = 1; x < temp_arr.length; x++){
          consultant_model temp = temp_arr[x];
          bool t_flag = false;
          for(int xx = 0; xx < temps_arr.length; xx++){
            if(temp.patient_id == temps_arr[xx].patient_id){
              t_flag = true;
            }
          }
          if(t_flag == false){
            temps_arr.add(temp_arr[x]);
            temps_unread.add(0);
          }
        }
        res_consultArr = temps_arr;
        unread_num = temps_unread;
        setState((){});
        for(int i = 0; i < res_consultArr.length; i++){
          switch(res_consultArr[i].type){
            case 'typing':
              Configs.numofChat++;
              break;
            case 'voice':
              Configs.numofVoice++;
              break;
            case 'video':
              Configs.numofVideo++;
              break;
          }
        }
        for(int i = 0; i < res_consultArr.length; i++){
          chatReference =
              db.collection("chats")
                  .document(res_consultArr[i].id.toString())
                  .collection('messages');
          chatReference.snapshots().listen((querySnapshot) {
            int count = 0;
            querySnapshot.documents.forEach((element) {
              if(element['receiver_id'] == res_consultArr[i].doctor_id.toString() && !element['isRead']) {
                count++;
              }
            });
            unread_num[i] = count;
            setState((){});
          });
        }
      }

    }
  }

  // void setflag() {
  //
  // }
}