import 'dart:convert';
import 'dart:io';

import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/api_endpoints.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:image_picker/image_picker.dart';

class Profilecomponent extends StatefulWidget {
  @override
  _ProfilecomponentState createState() => _ProfilecomponentState();
}

class _ProfilecomponentState extends State<Profilecomponent> {
  @override
  Widget build(BuildContext context) {
    return Container(
      height: Configs.calcheight(235),
      width: Configs.calcwidth(573),
      margin: EdgeInsets.only(top: Configs.calcheight(13),),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(20))),
        color: Gray02,
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Column(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                width: Configs.calcwidth(220),
                height: Configs.calcheight(65),
                child: Stack(
                  children: [
                    Container(
                      padding: EdgeInsets.only(left: Configs.calcheight(14), right: Configs.calcheight(14)),
                      margin: EdgeInsets.only(top: Configs.calcheight(14), left: Configs.calcwidth(12)),
                      width: Configs.calcwidth(209),
                      height: Configs.calcheight(59),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(20))),
                        color: Colors.white,
                      ),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Image.asset(
                            'assets/images/ic_video.png',
                            width: Configs.calcheight(39),
                            height: Configs.calcheight(39),
                          ),
                          Image.asset(
                            'assets/images/ic_voice.png',
                            width: Configs.calcheight(39),
                            height: Configs.calcheight(39),
                          ),
                          Image.asset(
                            'assets/images/ic_chat_black.png',
                            width: Configs.calcheight(39),
                            height: Configs.calcheight(39),
                          ),
                        ],
                      ),
                    ),
                    Positioned(
                      top: 0,
                      right: 0,
                      child: Container(
                        width:Configs.calcwidth(200),
                        padding: EdgeInsets.only(left: Configs.calcheight(14), right: Configs.calcheight(4)),
                        child:  Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Container(
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(33/2))),
                                color: Colors.white,
                              ),
                              width: Configs.calcheight(33),
                              height: Configs.calcheight(33),
                              child: Text(
                                Configs.numofVideo.toString(),
                                style: TextStyle(
                                    fontSize: Configs.calcheight(22),
                                    color: Black05
                                ),
                                textAlign: TextAlign.center,
                              ),
                            ),
                            Container(
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(33/2))),
                                color: Colors.white,
                              ),
                              width: Configs.calcheight(33),
                              height: Configs.calcheight(33),
                              child: Text(
                                Configs.numofVoice.toString(),
                                style: TextStyle(
                                    fontSize: Configs.calcheight(22),
                                    color: Black05
                                ),
                                textAlign: TextAlign.center,
                              ),
                            ),
                            Container(
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(33/2))),
                                color: Colors.white,
                              ),
                              width: Configs.calcheight(33),
                              height: Configs.calcheight(33),
                              child: Text(
                                Configs.numofChat.toString(),
                                style: TextStyle(
                                    fontSize: Configs.calcheight(22),
                                    color: Black05
                                ),
                                textAlign: TextAlign.center,
                              ),
                            )
                          ],
                        ),
                      ),
                    )
                  ],
                ),
              ),
              Container(
                padding: EdgeInsets.all( Configs.calcheight(7)),
                margin: EdgeInsets.all( Configs.calcheight(12)),
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(20))),
                  color: Colors.white,
                ),
                child: Text(
                  ' الرصيد ' + Configs.umodel.money.toString() + '\$',
                  textDirection: TextDirection.rtl,
                  style: TextStyle(
                      fontSize: Configs.calcheight(30)
                  ),
                ),
              )
            ],
          ),
          Container(
            padding: EdgeInsets.only(right: Configs.calcheight(47), bottom: Configs.calcheight(10)),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.start,
              children: [
                Container(
                  decoration: BoxDecoration(
                      borderRadius: BorderRadius.all(
                          Radius.circular(Configs.calcheight(75))),
                      color: Gray02,
                      border: Border.all(
                          color: Colors.white, width: Configs.calcheight(7))),
                  margin: EdgeInsets.only(top: Configs.calcheight(20)),
                  height: Configs.calcheight(150),
                  width: Configs.calcheight(150),
                  alignment: Alignment.center,
                  child: Container(
                      width: Configs.calcheight(118),
                      height: Configs.calcheight(118),
                      decoration: new BoxDecoration(
                          shape: BoxShape.circle,
                          image: new DecorationImage(
                              fit: BoxFit.fill,
                              image: new NetworkImage(APIEndPoints.mediaurl + Configs.umodel.photo)))),
                ),
                Container(
                  child: Container(
                    width: Configs.calcwidth(145),
                    height: Configs.calcheight(44),
                    child: FlatButton(
                      color: Gray06,
                      textColor: Colors.white,
                      padding: EdgeInsets.all(0),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(Configs.calcheight(20)),
                      ),
                      onPressed: (){
                        File image;
                        showDialog(context: context,
                            builder: (BuildContext context){
                              return AlertDialog(
                                title: new Text('Upload a clear picture'),
                                content: Container(
                                  height: 100,
                                  child:  Column(
                                    children: [
                                      new FlatButton(
                                        child: new Text('Take Photo...'),
                                        onPressed: () async {
                                          File image = await ImagePicker.pickImage(
                                              source: ImageSource.camera
                                          );
                                          if(image != null) ChangeImage(image);
                                          Navigator.of(context).pop();
                                        },
                                      ),
                                      new FlatButton(
                                          child: new Text('Choose from Library'),
                                          onPressed: () async {
                                            File image = await  ImagePicker.pickImage(
                                                source: ImageSource.gallery
                                            );
                                            if(image != null) ChangeImage(image);
                                            Navigator.of(context).pop();
                                          }),


                                    ],
                                  ),
                                ),
                                actions: <Widget>[
                                  new FlatButton(
                                    child: new Text("CANCEL"),
                                    onPressed: (){
                                      Navigator.of(context).pop();
                                    }, )
                                ],
                              );
                            }
                        );
                      },
                      child: Text(
                        'ﺗﺤﺪﻳﺚ ﺍﻟﺼﻮﺭﺓ',
                        style: TextStyle(
                          fontSize: Configs.calcheight(25),
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }
  Future<void> ChangeImage(File file) async{
    String fileName = file.path.split('/').last;

    FormData data = FormData.fromMap({
      "doctor_id": Configs.umodel.id,
      "file": await MultipartFile.fromFile(
        file.path,
        filename: fileName,
      ),
    });

    Dio dio = new Dio();

    dio.post(APIEndPoints.kApiBase + 'doctor_photo_update', data: data)
        .then((response) {
      var result = jsonDecode(response.toString());
      if(result['status'] == 'success') {
        Configs.umodel.photo = result['doctor']['photo'];
        setState(() {
        });
      }
    })
        .catchError((error) => print(error));
  }
}
