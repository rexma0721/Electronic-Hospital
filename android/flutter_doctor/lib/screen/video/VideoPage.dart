import 'package:agora_rtc_engine/agora_rtc_engine.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'package:flutter/painting.dart';
import 'package:flutter_doctor/component/Bottombar.dart';
import 'package:flutter_doctor/component/MainHeader.dart';
import 'package:flutter_doctor/component/NavDrawer.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:wakelock/wakelock.dart';

class VideoPage extends StatefulWidget {
  /// non-modifiable channel name of the page
  final String channelName;

  /// non-modifiable client role of the page
  final ClientRole role;
  final String callType;
  final String currentstate;
  const VideoPage({Key key, this.channelName, this.role, this.callType, this.currentstate})
      : super(key: key);
  @override
  _VideoPageState createState() => _VideoPageState();
}

class _VideoPageState extends State<VideoPage> {

  static final _users = <int>[];
  final _infoStrings = <String>[];
  bool muted = false;
  bool disable = true;
  bool loud_flag = true;
  bool call_end_flag = false;

  @override
  void dispose() {
    // clear users
    print('destory');
    _users.clear();
    // destroy sdk
    AgoraRtcEngine.leaveChannel();
    AgoraRtcEngine.destroy();
    Wakelock.disable();
    super.dispose();
  }
  @override
  void initState() {
    super.initState();


    Wakelock.enable();
    // initialize agora sdk
    initialize().then((value) {
    });
  }
  Future<void> initialize() async {
    if (Configs.APP_ID.isEmpty) {
      setState(() {
        _infoStrings.add(
          'APP_ID missing, please provide your APP_ID in settings.dart',
        );
        _infoStrings.add('Agora Engine is not starting');
      });
      return;
    }

    await _initAgoraRtcEngine();
    _addAgoraEventHandlers();

    await AgoraRtcEngine.enableWebSdkInteroperability(true);
    await AgoraRtcEngine.setParameters(
        '''{\'che.video.lowBitRateStreamParameter\':{\'width\':320,\'height\':180,\'frameRate\':15,\'bitRate\':140}}''');
    await AgoraRtcEngine.joinChannel(null, widget.channelName, null, 0);
  }
  Future<void> _initAgoraRtcEngine() async {
    await AgoraRtcEngine.create(Configs.APP_ID);
    widget.callType == "VideoCall"
        ? await AgoraRtcEngine.enableVideo()
        : await AgoraRtcEngine.enableAudio();
    await AgoraRtcEngine.setChannelProfile(ChannelProfile.Communication);
    await AgoraRtcEngine.setClientRole(widget.role);
    await AgoraRtcEngine.setEnableSpeakerphone(true);

  }

  /// Add agora event handlers
  void _addAgoraEventHandlers() {
    AgoraRtcEngine.onError = (dynamic code) {
      setState(() {
        final info = 'onError: $code';
        _infoStrings.add(info);
      });
    };

    AgoraRtcEngine.onJoinChannelSuccess = (
        String channel,
        int uid,
        int elapsed,
        ) {
      print('onJoinChannel');
      setState(() {
        final info = 'onJoinChannel: $channel, uid: $uid';
        _infoStrings.add(info);
      });
    };

    AgoraRtcEngine.onLeaveChannel = () {
      setState(() {
        _infoStrings.add('onLeaveChannel');
        _users.clear();
      });
    };

    AgoraRtcEngine.onUserJoined = (int uid, int elapsed) {
      print('userJoined');
      setState(() {
        final info = 'userJoined: $uid';
        _infoStrings.add(info);
        _users.add(uid);
      });
    };

    AgoraRtcEngine.onUserOffline = (int uid, int reason) {
      setState(() {
        final info = 'userOffline: $uid';
        _infoStrings.add(info);
        _users.remove(uid);
      });
      Navigator.pop(context);
    };

    AgoraRtcEngine.onFirstRemoteVideoFrame = (
        int uid,
        int width,
        int height,
        int elapsed,
        ) {
      setState(() {
        final info = 'firstRemoteVideo: $uid ${width}x $height';
        _infoStrings.add(info);
      });
    };
  }


  /// Helper function to get list of native views
  List<Widget> _getRenderViews() {
    final List<AgoraRenderWidget> list = [];
    if (widget.role == ClientRole.Broadcaster) {
      list.add(AgoraRenderWidget(0, local: true, preview: true));
    }
    _users.forEach((int uid) => list.add(AgoraRenderWidget(uid)));
    return list;
  }

  /// Video view wrapper
  Widget _videoView(view) {
    return Expanded(child: Container(child: view));
  }

  /// Video view row wrapper
  Widget _expandedVideoRow(List<Widget> views) {
    final wrappedViews = views.map<Widget>(_videoView).toList();
    return Positioned(
        top: Configs.calcheight(10),
        right: Configs.calcheight(10),
        child: Container(
          width: Configs.calcwidth(150),
          height: Configs.calcwidth(200),
          child: Row(
            children: wrappedViews,
          ),
        )
    );
  }
  /// Video layout wrapper
  Widget _viewRows() {
    final views = _getRenderViews();
    switch (views.length) {
      case 1:
        return Container(
            child: Column(
              children: <Widget>[_videoView(views[0])],
            ));
      case 2:
        return Container(
            child: Stack(
              children: <Widget>[
                Container(
                    child: Column(
                      children: <Widget>[_videoView(views[1])],
                    )),
                _expandedVideoRow([views[0]])
              ],
            ));
      case 3:
        return Container(
            child: Column(
              children: <Widget>[
                _expandedVideoRow(views.sublist(0, 2)),
                _expandedVideoRow(views.sublist(2, 3))
              ],
            ));
      case 4:
        return Container(
            child: Column(
              children: <Widget>[
                _expandedVideoRow(views.sublist(0, 2)),
                _expandedVideoRow(views.sublist(2, 4))
              ],
            ));
      default:
    }
    return Container();
  }

  /// Toolbar layout
  Widget _videoToolbar() {
    if (widget.role == ClientRole.Audience) return Container();
    return Container(
      alignment: Alignment.bottomCenter,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Container(
            width: 50,
            child: RawMaterialButton(
              onPressed: _onToggleLoud,
              child: Icon(
                loud_flag ? Icons.volume_off : Icons.volume_up,
                color: loud_flag ? Colors.white : Theme.of(context).primaryColor,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor: loud_flag ? Theme.of(context).primaryColor : Colors.white,
              padding: const EdgeInsets.all(5.0),
            ),
          ),
          Container(
            width: 50,
            child: RawMaterialButton(
              onPressed: _onToggleMute,
              child: Icon(
                muted ? Icons.mic_off : Icons.mic,
                color: muted ? Colors.white : Theme.of(context).primaryColor,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor: muted ? Theme.of(context).primaryColor : Colors.white,
              padding: const EdgeInsets.all(5.0),
            ),
          ),
          Container(
            width: 50,
            child: RawMaterialButton(
              onPressed: () => _onCallEnd(context),
              child: Icon(
                Icons.call_end,
                color: Colors.white,
                size: 35.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor: Colors.redAccent,
              padding: const EdgeInsets.all(5.0),
            ),
          ),
          Container(
            width: 50,
            child: RawMaterialButton(
              onPressed: _onSwitchCamera,
              child: Icon(
                Icons.switch_camera,
                color: Theme.of(context).primaryColor,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor: Colors.white,
              padding: const EdgeInsets.all(5.0),
            ),
          ),
          Container(
            width: 50,
            child: RawMaterialButton(
              onPressed: _disVideo,
              child: Icon(
                disable ? Icons.videocam : Icons.videocam_off,
                color: disable ? Theme.of(context).primaryColor : Colors.white,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor: !disable ? Theme.of(context).primaryColor : Colors.white,
              padding: const EdgeInsets.all(5.0),
            ),
          )
        ],
      ),
    );
  }

  Widget _audioToolbar() {
    if (widget.role == ClientRole.Audience) return Container();
    return Container(
      alignment: Alignment.bottomCenter,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Container(
            child: RawMaterialButton(
              onPressed: _onToggleLoud,
              child: Icon(
                loud_flag ? Icons.volume_off : Icons.volume_up,
                color: loud_flag ? Colors.white : Theme.of(context).primaryColor,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor: loud_flag ? Theme.of(context).primaryColor : Colors.white,
              padding: const EdgeInsets.all(5.0),
            ),
            width: 50,
          ),
          Container(
            child: RawMaterialButton(
              onPressed: _onToggleMute,
              child: Icon(
                muted ? Icons.mic_off : Icons.mic,
                color: muted ? Colors.white : Theme.of(context).primaryColor,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor: muted ? Theme.of(context).primaryColor : Colors.white,
              padding: const EdgeInsets.all(5.0),
            ),
            width: 50,
          ),
         Container(
           child:  RawMaterialButton(
             onPressed: () => _onCallEnd(context),
             child: Icon(
               Icons.call_end,
               color: Colors.white,
               size: 35.0,
             ),
             shape: CircleBorder(),
             elevation: 2.0,
             fillColor: Colors.redAccent,
             padding: const EdgeInsets.all(5.0),
           ),
           width: 50,
         )
        ],
      ),
    );
  }
  void _onCallEnd(BuildContext context) {
    CollectionReference callRef = Firestore.instance.collection("calls");
    callRef.where("channel_id", isEqualTo: "${Configs.conmodel.id.toString()}").getDocuments().then((value) async {
      if(value.documents[0]['response'] == 'Awaiting'){
        await callRef
            .document(Configs.conmodel.id.toString())
            .setData({'response': "Call_Cancelled"},
            merge: true);
        call_end_flag = true;
        setState(() {

        });
        // Future.delayed(Duration(milliseconds: 2000), () {
        //   print('12345');
        //   Navigator.pop(context);
        // });
      }
      else{
        print('123456');
        Navigator.pop(context);
      }
    });

  }
  Future<void> _onToggleLoud() async {
    setState(() {
      loud_flag = !loud_flag;
    });
   await AgoraRtcEngine.setEnableSpeakerphone(loud_flag);
  }

  Future<void> _onToggleMute() async {
    setState(() {
      muted = !muted;
    });
    AgoraRtcEngine.muteLocalAudioStream(muted);
    if(muted){
      setState(() {
        loud_flag = false;
      });
      await AgoraRtcEngine.setEnableSpeakerphone(loud_flag);
    }
  }

  void _onSwitchCamera() {
    AgoraRtcEngine.switchCamera();
  }

  _disVideo() {
    setState(() {
      disable = !disable;
    });
    AgoraRtcEngine.enableLocalVideo(disable);
  }
  @override
  void didChangeDependencies() {
    // TODO: implement didChangeDependencies
    super.didChangeDependencies();
  }
  @override
  Widget build(BuildContext context) {
    print('hellos');
    print(widget.currentstate);
    if(widget.currentstate == 'Decline'){
      return Column(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: <Widget>[
                Text("${Configs.conmodel.name} is Busy",
                    style: TextStyle(
                        fontSize: 25,
                        fontWeight: FontWeight.bold)),
                RaisedButton.icon(
                    color: Theme.of(context).backgroundColor,
                    icon: Icon(
                      Icons.arrow_back,
                      color: Colors.white,
                    ),
                    label: Text(
                      "Back",
                      style: TextStyle(color: Colors.white),
                    ),
                    onPressed: () async {
                      Navigator.pop(context);
                    })
              ],
            );
    }
    if(call_end_flag){
      Future.delayed(Duration(milliseconds: 2000), () {
        Navigator.pop(context);
      });
      return Container(
        alignment: Alignment.center,
        child: Text("Call Ended..."),
      );
    }
    return Scaffold(
      body: Container(
        color: Gray01,
        child: Stack(
          children: <Widget>[
            widget.callType == "VideoCall"
                ? _viewRows()
                : Container(
              alignment: Alignment.center,
              child: Icon(
                Icons.person,
                size: 60,
                color: Theme.of(context).backgroundColor,
              ),
            ),
            // _panel(),
            widget.callType == "VideoCall" ? _videoToolbar() : _audioToolbar()
          ],
        ),
      ),
    );
  }
}
