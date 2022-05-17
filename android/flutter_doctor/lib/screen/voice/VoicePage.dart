import 'dart:async';

import 'package:agora_rtc_engine/agora_rtc_engine.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'package:flutter_doctor/utils/Configs.dart';
import 'package:flutter_doctor/utils/colors.dart';
import 'package:wakelock/wakelock.dart';

class VoicePage extends StatefulWidget {
  /// non-modifiable channel name of the page
  final String channelName;

  /// non-modifiable client role of the page
  final ClientRole role;
  final String callType;
  final String response;

  const VoicePage({Key key, this.channelName, this.role, this.callType, this.response})
      : super(key: key);

  @override
  _VoicePageState createState() => _VoicePageState();
}

class _VoicePageState extends State<VoicePage> {
  static final _users = <int>[];
  final _infoStrings = <String>[];
  bool muted = false;
  bool disable = true;
  bool loud_flag = false;
  bool timer_flag = false;

  Timer _timer;
  int _start = 0;

  void startTimer() {
    const oneSec = const Duration(seconds: 1);
    _timer = new Timer.periodic(
      oneSec,
      (Timer timer) => setState(
        () {
          _start++;
        },
      ),
    );
  }

  @override
  void dispose() {
    // clear users
    if(_timer != null)_timer.cancel();
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
    initialize();
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
    VideoEncoderConfiguration configuration = VideoEncoderConfiguration();
    configuration.dimensions = Size(1920, 1080);
    await AgoraRtcEngine.setVideoEncoderConfiguration(configuration);
    await AgoraRtcEngine.joinChannel(null, widget.channelName, null, 0);
    Firestore.instance.collection("calls")
        .where("channel_id", isEqualTo: "${Configs.conmodel.id.toString()}").snapshots().listen((event) {
       if(event.documents[0]['response'] == 'Pickup' && !timer_flag){
         startTimer();
         timer_flag = true;
       }
    });
  }

  Future<void> _initAgoraRtcEngine() async {
    await AgoraRtcEngine.create(Configs.APP_ID);
    widget.callType == "VideoCall"
        ? await AgoraRtcEngine.enableVideo()
        : await AgoraRtcEngine.enableAudio();
    await AgoraRtcEngine.setChannelProfile(ChannelProfile.LiveBroadcasting);
    await AgoraRtcEngine.setClientRole(widget.role);
    await AgoraRtcEngine.setEnableSpeakerphone(false);
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
    return Expanded(
      child: Row(
        children: wrappedViews,
      ),
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
            child: Column(
          children: <Widget>[
            _expandedVideoRow([views[0]]),
            _expandedVideoRow([views[1]])
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
                color:
                    loud_flag ? Colors.white : Theme.of(context).primaryColor,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor:
                  loud_flag ? Theme.of(context).primaryColor : Colors.white,
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
              fillColor:
                  !disable ? Theme.of(context).primaryColor : Colors.white,
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
                color:
                    loud_flag ? Colors.white : Theme.of(context).primaryColor,
                size: 20.0,
              ),
              shape: CircleBorder(),
              elevation: 2.0,
              fillColor:
                  loud_flag ? Theme.of(context).primaryColor : Colors.white,
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
            width: 50,
          )
        ],
      ),
    );
  }

  void _onCallEnd(BuildContext context) {
    CollectionReference callRef = Firestore.instance.collection("calls");
    callRef
        .where("channel_id", isEqualTo: "${Configs.conmodel.id.toString()}")
        .getDocuments()
        .then((value) async {
      print(value.documents[0]['response']);
      if (value.documents[0]['response'] == 'Awaiting') {
        await callRef
            .document(Configs.conmodel.id.toString())
            .setData({'response': "Call_Cancelled"}, merge: true);
      }
      Navigator.pop(context);
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
    if (muted) {
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
  Widget build(BuildContext context) {

    String timetext = '00:00';
    String mintext = '';
    String sectext = '';
    int cal_min = (_start / 60).round();
    int cal_sec = _start % 60;
    if(cal_min == 0){
      mintext = '00';
    } else if(cal_min < 10){
      mintext = '0' + cal_min.toString();
    } else{
      mintext = cal_min.toString();
    }
    if(cal_sec == 0){
      sectext = '00';
    } else if(cal_sec < 10){
      sectext =  '0' + cal_sec.toString();
    } else {
      sectext = cal_sec.toString();
    }
    timetext = mintext + ':' + sectext;
    if(widget.response == 'Awaiting'){
      timetext = "الاتصال جاري";
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
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Icon(
                          Icons.person,
                          size: 60,
                          color: Theme.of(context).backgroundColor,
                        ),
                        SizedBox(
                          height: 5,
                        ),
                        Text(timetext,
                            textAlign: TextAlign.center,
                            style:
                                TextStyle(fontSize: 25, color: Colors.black)),
                      ],
                    )),
            // _panel(),
            widget.callType == "VideoCall" ? _videoToolbar() : _audioToolbar()
          ],
        ),
      ),
    );
  }
}
