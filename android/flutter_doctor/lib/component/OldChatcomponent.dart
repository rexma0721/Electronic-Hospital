import 'dart:convert';
import 'dart:io';

import 'package:cached_network_image/cached_network_image.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:firebase_storage/firebase_storage.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/screen/largeImage.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/base_main_repo.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:image_picker/image_picker.dart';
import 'package:intl/intl.dart' as intl;

class OldChatcomponent extends StatefulWidget {
  @override
  _OldChatcomponentState createState() => _OldChatcomponentState();
}

class _OldChatcomponentState extends State<OldChatcomponent> {

  TextEditingController messagecontroller = TextEditingController();
  final db = Firestore.instance;
  CollectionReference chatReference;

  BaseMainRepository _baseMainRepository;
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
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
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
              Expanded(
                child: Container(
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
                ),
              )
            ],
          ),
        ],
      ),
    );
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
              child: documentSnapshot.data['type'] == 'Welcome'? Container() :documentSnapshot.data['image_url'] != ''
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
                            ? dateformat.format(documentSnapshot.data["time"].toDate())
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
}
