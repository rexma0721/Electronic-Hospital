
class consultant_model {
  int id;
  int doctor_id;
  int patient_id;
  String type;
  String status;
  int rate;
  String facebook;
  String source;
  String created_at;
  String updated_at;
  String unread_num;
  String name;
  int call_id;
  String call_password;
  String call_login;

  consultant_model();
  consultant_model.fromJSON(Map<String, dynamic> jsonMap) {
    try {
      id = jsonMap['id'];
      doctor_id = jsonMap['doctor_id'];
      patient_id = jsonMap['patient_id'];
      type = jsonMap['type'];
      status = jsonMap['status'];
      rate = jsonMap['rate'];
      facebook = jsonMap['facebook'];
      source = jsonMap['source'];
      created_at = jsonMap['created_at'];
      updated_at = jsonMap['updated_at'];
      unread_num = jsonMap['unread_num'];
      name = jsonMap['name'];
      call_id = jsonMap['call_id'];
      call_password = jsonMap['call_password'];
      call_login = jsonMap['call_login'];
    } catch (e) {
      print(e);
    }
  }
}