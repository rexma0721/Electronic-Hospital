import 'dart:convert';
import 'dart:io';

import 'package:http/http.dart' as http;

class NetworkHelper {
  static Future<String> makePostRequest(
      var endPoint, dynamic postValues) async {

    try{
      final client = new http.Client();
      final response = await client.post(
        endPoint,
        headers: {HttpHeaders.contentTypeHeader: 'application/json',},
        body: json.encode(postValues),
      );
      if (response.statusCode == 200) {
        return response.body;
      } else {
        return null;
      }
    } catch(_){
      return null;
    }
  }
  static Future<String> makePutRequest(
      var endPoint, dynamic postValues) async {

    try{
      final client = new http.Client();
      final response = await client.put(
        endPoint,
        headers: {HttpHeaders.contentTypeHeader: 'application/json'},
        body: json.encode(postValues),
      );
      if (response.statusCode == 200) {
        return response.body;
      } else {
        return null;
      }
    } catch(_){
      return null;
    }
  }
  static Future<String> makeGetRequest(var endPoint) async {
    // set up Get request arguments
    try {
      final client = new http.Client();
      final response = await client.get(endPoint, headers: {HttpHeaders.contentTypeHeader: 'application/json'});
      int statusCode = response
          .statusCode; // this API passes back the id of the new item added to the body
      if (statusCode == 200) {
        return response.body;
      } else{
        return null;
      }
    } // request
    catch (e) {
      return null;
    }
// check the status code
  }
}
