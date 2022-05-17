class APIEndPoints{

  // static final String kApiBase = 'http://10.10.10.192/api/';
  static final String kApiBase = 'http://104.248.81.101/api/';
  static final String mediaurl = 'http://104.248.81.101/upload/photo/';
  static final String chat_image_url = 'http://104.248.81.101/upload/chat/';

  static final String loginurl = kApiBase + 'doctor_login';
  static final String consultanturl = kApiBase + 'doctor_consultation';
  static final String offlineurl = kApiBase + 'doctor_offline';
  static final String onlineurl = kApiBase + 'doctor_online';
  static final String changepasswordurl = kApiBase + 'doctor_password';
  static final String doctor_sendNotification = kApiBase + 'doctor_sendNotification';
  static final String patient_givefeedback = kApiBase + 'patient_givefeedbacks';
  static final String contactus = kApiBase + 'contactus';
  static final String addbank = kApiBase + 'addbank';
  static final String changeprice = kApiBase + 'changeprice';
}