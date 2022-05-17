import 'dart:convert';
import 'dart:io';

import 'package:cached_network_image/cached_network_image.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:firebase_storage/firebase_storage.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/screen/largeImage.dart';
import 'package:flutter_doctor/screen/video/DialVideo.dart';
import 'package:flutter_doctor/screen/voice/DialVoice.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/base_main_repo.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:image_picker/image_picker.dart';
import 'package:intl/intl.dart' as intl;
import 'package:permission_handler/permission_handler.dart';

class Chatcomponent extends StatefulWidget {
  @override
  _ChatcomponentState createState() => _ChatcomponentState();
}

class _ChatcomponentState extends State<Chatcomponent> {

  TextEditingController messagecontroller = TextEditingController();
  final db = Firestore.instance;
  CollectionReference chatReference;

  BaseMainRepository _baseMainRepository;

  bool voice_flag = false;
  bool video_flag = false;

  final dateformat = new intl.DateFormat('hh:mm   dd/MM/yyyy');

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _baseMainRepository = BaseMainRepository();
    print(Configs.conmodel.id);
    chatReference =
        db.collection("chats")
            .document(Configs.conmodel.id.toString())
            .collection('messages');

  }

  @override
  Widget build(BuildContext context) {
    voice_flag = false;
    video_flag = false;
    if(Configs.conmodel.type == 'typing'){
      voice_flag = false;
      video_flag = false;
    } else if (Configs.conmodel.type == 'voice') {
      voice_flag = true;
      video_flag = false;
    } else {
      voice_flag = false;
      video_flag = true;
    }
    return Container(
      width: double.infinity,
      height: double.infinity,
      child: Stack(
        children: [
          Column(
            children: [
              Container(
                height: Configs.calcheight(105),
                width: double.infinity,
                padding: EdgeInsets.only(left: Configs.calcheight(20), right: Configs.calcheight(20)),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Container(
                      width: Configs.calcwidth(206),
                      height: Configs.calcheight(55),
                      child: FlatButton(
                        color: Red0,
                        textColor: Colors.white,
                        padding: EdgeInsets.all(0),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(Configs.calcheight(7)),
                        ),
                        onPressed: (){
                          endchat();
                        },
                        child: Text(
                          'ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                          style: TextStyle(
                            fontSize: Configs.calcheight(27),
                            color: Colors.white
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                    Container(
                      width: Configs.calcwidth(322),
                      height: Configs.calcheight(55),
                      child: FlatButton(
                        color: Green0,
                        textColor: Colors.white,
                        padding: EdgeInsets.all(0),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(Configs.calcheight(7)),
                        ),
                        onPressed: (){
                        },
                        child: Text(
                          Configs.conmodel.name,
                          style: TextStyle(
                              fontSize: Configs.calcheight(27),
                              color: Colors.white
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              Container(
                height: MediaQuery
                    .of(context)
                    .size
                    .height - Configs.calcheight(600),
                width: double.infinity,
                color: Color(0xffe8eff5),
                child:  StreamBuilder<QuerySnapshot>(
                  stream: chatReference
                      .orderBy('time', descending: true)
                      .snapshots(),
                  builder: (BuildContext context,
                      AsyncSnapshot<QuerySnapshot> snapshot) {
                    if (!snapshot.hasData)
                      return Center(
                        child: Container(
                          height: 15,
                          width: 15,
                          child: CircularProgressIndicator(
                            valueColor: AlwaysStoppedAnimation(primaryColor),
                            strokeWidth: 2,
                          ),
                        ),
                      );
                    return ListView(
                      reverse: true,
                      children: generateMessages(snapshot),
                    );
                  },
                ),
              )
            ],
          ),
          Positioned(
            top: MediaQuery
                .of(context)
                .size
                .height - Configs.calcheight(490),
            child: Container(
              width: MediaQuery
                  .of(context)
                  .size
                  .width,
              height: Configs.calcheight(110),
              padding: EdgeInsets.only(left: Configs.calcheight(12),
                  right: Configs.calcheight(12)),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Container(
                    width: Configs.calcwidth(490),
                    height: Configs.calcheight(98),
                    padding: EdgeInsets.only(left: Configs.calcheight(12),
                        right: Configs.calcheight(12)),
                    decoration: BoxDecoration(
                        borderRadius: BorderRadius.all(
                            Radius.circular(Configs.calcheight(36))),
                        color: Colors.white,
                        border: Border.all(
                            color: Black04, width: Configs.calcheight(2))),
                    child: Row(
                      children: [
                        Container(
                          width: Configs.calcheight(72),
                          height: Configs.calcheight(72),
                          child: FlatButton(
                            color: Blue10,
                            padding: EdgeInsets.all(0),
                            shape: RoundedRectangleBorder(
                              borderRadius:
                              BorderRadius.circular(Configs.calcheight(36)),
                            ),
                            onPressed: () {
                              sendText();
                            },
                            child: Image.asset('assets/images/ic_send.png',
                              width: Configs.calcheight(42),
                              height: Configs.calcheight(42),
                            ),
                          ),
                        ),
                        Expanded(
                          child: Container(
                            width: double.infinity,
                            padding: EdgeInsets.only(left: 10),
                            child: TextField(
                              controller: messagecontroller,
                              keyboardType: TextInputType.multiline,
                              maxLines: null,
                              decoration: InputDecoration(
                                  fillColor: Colors.white,
                                  hintText: 'ﺍﻛﺘﺐ ﺍﺳﺘﺠﺎﺑﺘﻚ',
                                  border: InputBorder.none
                              ),
                              textAlign: TextAlign.right,
                            ),
                          ),
                        )
                      ],
                    ),
                  ),
                  Container(
                    width: Configs.calcheight(72),
                    height: Configs.calcheight(72),
                    child: FlatButton(
                      color: Blue10,
                      padding: EdgeInsets.all(0),
                      shape: RoundedRectangleBorder(
                        borderRadius:
                        BorderRadius.circular(Configs.calcheight(36)),
                      ),
                      onPressed: () async {
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
                                          if(image != null) _sendImage(image);
                                          Navigator.of(context).pop();
                                        },
                                      ),
                                      new FlatButton(
                                          child: new Text('Choose from Library'),
                                          onPressed: () async {
                                            File image = await  ImagePicker.pickImage(
                                                source: ImageSource.gallery
                                            );
                                            if(image != null) _sendImage(image);
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
                      child: Image.asset('assets/images/ic_camera.png',
                        width: Configs.calcheight(42),
                        height: Configs.calcheight(42),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
          Positioned(
            top: MediaQuery
                .of(context)
                .size
                .height - Configs.calcheight(580),
            right: 0,
            child: Container(
              width: MediaQuery
                  .of(context)
                  .size
                  .width,
              padding: EdgeInsets.only(left: Configs.calcheight(12),
                  right: Configs.calcheight(12)),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                 Visibility(
                   child:  Container(
                     width: Configs.calcheight(72),
                     height: Configs.calcheight(72),
                     child: FlatButton(
                       color: Green0,
                       padding: EdgeInsets.all(0),
                       shape: RoundedRectangleBorder(
                         borderRadius:
                         BorderRadius.circular(Configs.calcheight(36)),
                       ),
                       onPressed: () {
                         onJoinVideo("VideoCall");
                       },
                       child: Image.asset('assets/images/ic_video_white.png',
                         width: Configs.calcheight(42),
                         height: Configs.calcheight(42),
                       ),
                     ),
                   ),
                   visible: video_flag,
                 ),
                  Visibility(
                    child:  Container(
                      width: Configs.calcheight(72),
                      height: Configs.calcheight(72),
                      child: FlatButton(
                        color: Green0,
                        padding: EdgeInsets.all(0),
                        shape: RoundedRectangleBorder(
                          borderRadius:
                          BorderRadius.circular(Configs.calcheight(36)),
                        ),
                        onPressed: () {
                          onJoinaudio("VoiceCall");
                        },
                        child: Image.asset('assets/images/ic_voice_white.png',
                          width: Configs.calcheight(42),
                          height: Configs.calcheight(42),
                        ),
                      ),
                    ),
                    visible: voice_flag,
                  )
                ],
              ),
            ),
          )
        ],
      ),
    );
  }
  Future<void> onJoinaudio(String s) async {
    await handleCameraAndMic(s);
    String response = await _baseMainRepository.sendnotification('voice', '');
    var result = jsonDecode(response);
    if(result['status'] != 'failed'){
      // push video page with given channel name
      await Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => DialVoice(),
        ),
      );
    } else {
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
                      Text('ﺗﻢ ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: Configs.calcheight(25),
                        ),),
                    ],
                  )
              ),
            );
          }).then((value) async {
        Navigator.popUntil(context, ModalRoute.withName('/consultant'));
        Configs.con.getconsultant();
      });
    }
  }
  Future<void> onJoinVideo(callType) async {
    await handleCameraAndMic(callType);
    String response = await _baseMainRepository.sendnotification('video', '');
    var result = jsonDecode(response);
    if(result['status'] != 'failed'){
      // push video page with given channel name
      await Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => DialVideo(),
        ),
      );
    } else {
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
                      Text('ﺗﻢ ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: Configs.calcheight(25),
                        ),),
                    ],
                  )
              ),
            );
          }).then((value) async {
        Navigator.popUntil(context, ModalRoute.withName('/consultant'));
        Configs.con.getconsultant();
      });
    }
  }
  Future<void> sendText() async {
    if (messagecontroller.text.trim().length != 0) {
      String text = messagecontroller.text.trim();
      setState(() {
        messagecontroller.text = '';
      });
      String response = await _baseMainRepository.sendnotification('typing', text);
      var result = jsonDecode(response);
      if(result['status'] != 'failed'){
        chatReference.add({
          'type': 'Msg',
          'text': text,
          'sender_id': Configs.conmodel.doctor_id.toString(),
          'receiver_id': Configs.conmodel.patient_id.toString(),
          'isRead': false,
          'image_url': '',
          'time': FieldValue.serverTimestamp(),
        }).then((documentReference) {

        }).catchError((e) {});
      }
      else {
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
                        Text('ﺗﻢ ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: Configs.calcheight(25),
                          ),),
                      ],
                    )
                ),
              );
            }).then((value) async {
          Navigator.popUntil(context, ModalRoute.withName('/consultant'));
          Configs.con.getconsultant();
        });
      }

    }
  }

  Future<void> _sendImage(File image) async {
    String response = await _baseMainRepository.sendnotification('photo', 'Image');
    var result = jsonDecode(response);

    if(result['status'] != 'failed'){
      int timestamp = new DateTime.now().millisecondsSinceEpoch;
      StorageReference storageReference = FirebaseStorage
          .instance
          .ref()
          .child('chats/${Configs.conmodel.id}/img_' +
          timestamp.toString() +
          '.jpg');
      StorageUploadTask uploadTask =
      storageReference.putFile(image);
      await uploadTask.onComplete;
      String fileUrl = await storageReference.getDownloadURL();
      chatReference.add({
        'type': 'Image',
        'text': 'Photo',
        'sender_id': Configs.conmodel.doctor_id.toString(),
        'receiver_id': Configs.conmodel.patient_id.toString(),
        'isRead': false,
        'image_url': fileUrl,
        'time': FieldValue.serverTimestamp(),
      });
    } else{
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
                      Text('ﺗﻢ ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: Configs.calcheight(25),
                        ),),
                    ],
                  )
              ),
            );
          }).then((value) async {
        Navigator.popUntil(context, ModalRoute.withName('/consultant'));
        Configs.con.getconsultant();
      });
    }
  }
  generateMessages(AsyncSnapshot<QuerySnapshot> snapshot) {
    return snapshot.data.documents
        .map<Widget>((doc) => Container(
      margin: const EdgeInsets.symmetric(vertical: 10.0),
      child: new Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: doc.data['sender_id'] != Configs.conmodel.doctor_id.toString()
              ? generateReceiverLayout(
            doc,
          )
              : generateSenderLayout(doc)),
    ))
        .toList();
  }
  List<Widget> generateReceiverLayout(DocumentSnapshot documentSnapshot) {
    if (!documentSnapshot.data['isRead']) {
      chatReference.document(documentSnapshot.documentID).updateData({
        'isRead': true,
      });

      return _messagesIsRead(documentSnapshot);
    }
    return _messagesIsRead(documentSnapshot);

  }
  _messagesIsRead(documentSnapshot) {
    final ThemeData _theme = Theme.of(context);
    return <Widget>[
      Expanded(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Container(
              child:documentSnapshot.data['type'] == 'Welcome'? Container() : documentSnapshot.data['image_url'] != ''
                  ? InkWell(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: <Widget>[
                    new Container(
                      margin: EdgeInsets.only(left: 10),
                      child: CachedNetworkImage(
                        placeholder: (context, url) => Center(
                          child: CupertinoActivityIndicator(
                            radius: 10,
                          ),
                        ),
                        errorWidget: (context, url, error) =>
                            Icon(Icons.error),
                        height: MediaQuery.of(context).size.height * .65,
                        width: MediaQuery.of(context).size.width * .9,
                        imageUrl: documentSnapshot.data['image_url'],
                        fit: BoxFit.fitWidth,
                      ),
                      height: 150,
                      width: 150.0,
                      color: Colors.white,
                      padding: EdgeInsets.all(5),
                    ),
                    Padding(
                      padding: const EdgeInsets.only(right: 10),
                      child: Text(
                          documentSnapshot.data["time"] != null
                              ?  dateformat.format(documentSnapshot.data["time"].toDate())
                              : "",
                        style: TextStyle(
                          color: Black04,
                          fontSize: 13.0,
                        ),),
                    )
                  ],
                ),
                onTap: () {
                  Navigator.of(context).push(CupertinoPageRoute(
                    builder: (context) => LargeImage(
                      documentSnapshot.data['image_url'],
                    ),
                  ));
                },
              )
                  : Container(
                  padding: EdgeInsets.symmetric(
                      horizontal: 15.0, vertical: 10.0),
                  width: MediaQuery.of(context).size.width * 0.9,
                  margin: EdgeInsets.only( left: 10),
                  decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(5)),
                  child: Column(
                    children: <Widget>[
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.end,
                        children: <Widget>[
                          Container(
                            child: Text(
                              documentSnapshot.data['text'],
                              style: TextStyle(
                                color: Blue10,
                                fontSize: 20.0,
                              ),
                            ),
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.end,
                            children: <Widget>[
                              Text(
                                documentSnapshot.data["time"] != null
                                    ?  dateformat.format(documentSnapshot.data["time"].toDate())
                                    : "",
                                style: TextStyle(
                                  color: Black04,
                                  fontSize: 13.0,
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ],
                  )),
            ),
          ],
        ),
      ),
    ];
  }
  List<Widget> generateSenderLayout(DocumentSnapshot documentSnapshot) {
    final ThemeData _theme = Theme.of(context);
    return <Widget>[
      Expanded(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.end,
          children: <Widget>[
            Container(
              child: documentSnapshot.data['image_url'] != ''
                  ? InkWell(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: <Widget>[
                    new Container(
                      margin: EdgeInsets.only(right: 15),
                      child: Stack(
                        children: <Widget>[
                          CachedNetworkImage(
                            placeholder: (context, url) => Center(
                              child: CupertinoActivityIndicator(
                                radius: 10,
                              ),
                            ),
                            errorWidget: (context, url, error) =>
                                Icon(Icons.error),
                            height:
                            MediaQuery.of(context).size.height * .65,
                            width: MediaQuery.of(context).size.width * .9,
                            imageUrl: documentSnapshot.data['image_url'],
                            fit: BoxFit.fitWidth,
                          ),
                        ],
                      ),
                      height: 150,
                      width: 150.0,
                      color: Colors.white,
                      padding: EdgeInsets.all(5),
                    ),
                    Padding(
                      padding: const EdgeInsets.only(right: 10),
                      child: Text(
                        documentSnapshot.data["time"] != null
                            ?  dateformat.format(documentSnapshot.data["time"].toDate())
                            : "",
                        style: TextStyle(
                          color: Black04,
                          fontSize: 13.0,
                        ),),
                    )
                  ],
                ),
                onTap: () {
                  Navigator.of(context).push(
                    CupertinoPageRoute(
                      builder: (context) => LargeImage(
                        documentSnapshot.data['image_url'],
                      ),
                    ),
                  );
                },
              )
                  : Container(
                  padding: EdgeInsets.symmetric(
                      horizontal: 15.0, vertical: 10.0),
                  width: MediaQuery.of(context).size.width * 0.9,
                  margin: EdgeInsets.only( left: 20.0, right: 5),
                  decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(5)),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.end,
                    children: <Widget>[
                      Container(
                        child: Text(
                          documentSnapshot.data['text'],
                          style: TextStyle(
                            color: Green0,
                            fontSize: 20.0,
                          ),
                        ),
                      ),
                      Text(
                        documentSnapshot.data["time"] != null
                            ?  dateformat.format(documentSnapshot.data["time"].toDate())
                            : "",
                        style: TextStyle(
                          color: Black04,
                          fontSize: 13.0,
                        ),
                      ),
                    ],
                  )),
            ),
          ],
        ),
      ),
    ];
  }
  void endchat(){
    showDialog(
        barrierDismissible: true,
        context: context,
        builder: (context) {
          return Dialog(
            shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.all(Radius.circular(Configs.calcheight(30)))),
            child: Container(
                width: Configs.calcwidth(460),
                height: Configs.calcheight(251),
                padding: EdgeInsets.all(Configs.calcheight(10)),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text('ﻗﻢ ﺑﺘﺄﻛﻴﺪ ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                      style: TextStyle(
                        color: Black0,
                        fontSize: Configs.calcheight(30),
                      ),),
                    SizedBox(
                      height: Configs.calcheight(30),
                    ),
                    Row(
                      children: [
                        Container(
                        width: Configs.calcwidth(206),
                        height: Configs.calcheight(55),
                        margin: EdgeInsets.only(left: Configs.calcheight(7.5), right: Configs.calcheight(7.5)),
                        child: FlatButton(
                          color: Blue10,
                          textColor: Colors.white,
                          padding: EdgeInsets.all(0),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(Configs.calcheight(55/2)),
                          ),
                          onPressed: (){
                            Navigator.of(context).pop();
                          },
                          child: Text(
                            'ﺍﻟﻐﺎﺀ ﺍﻷﻣﺮ',
                            style: TextStyle(
                                fontSize: Configs.calcheight(27),
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                      ),Container(
                          width: Configs.calcwidth(206),
                          height: Configs.calcheight(55),
                          margin: EdgeInsets.only(left: Configs.calcheight(7.5), right: Configs.calcheight(7.5)),
                          child: FlatButton(
                            color: Red0,
                            textColor: Colors.white,
                            padding: EdgeInsets.all(0),
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(Configs.calcheight(55/2)),
                            ),
                            onPressed: (){
                              sendfeedback();
                            },
                            child: Text(
                              'ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ',
                              style: TextStyle(
                                fontSize: Configs.calcheight(27),
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ),
                        ),],
                    )
                  ],
                )
            ),
          );
        });
  }

  Future<void> sendfeedback() async {
    String response = await _baseMainRepository.givefeedback();
    var result = jsonDecode(response);
    if(result['status'] == 'success'){
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
                      Text('تم الاستلام بنجاح شكرا لتقييمك الاستشارة',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: Configs.calcheight(25),
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ],
                  )
              ),
            );
          }).then((value) async {
        Navigator.popUntil(context, ModalRoute.withName('/consultant'));
        Configs.con.getconsultant();
      });
    }
  }


}
Future<void> handleCameraAndMic(callType) async {
  await PermissionHandler().requestPermissions(callType == "VideoCall"
      ? [PermissionGroup.camera, PermissionGroup.microphone]
      : [PermissionGroup.microphone]);
}
