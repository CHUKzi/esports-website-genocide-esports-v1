<?php
  $errors4 = array();

  $name = '';
  $email = '';
  $subject = '';
  $message = '';
  $err4 = '';
  $suces = '';
  
  if (isset($_POST['submit4'])) {  
    $result_tap = '1';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    //$message2 = nl2br(strip_tags($message));
    $message2 = $message;

    // Use JSON encoded string and converts 
    // it into a PHP variable 
    $ipdat = @json_decode(file_get_contents( 
        "http://www.geoplugin.net/json.gp?ip=" . $ip)); 
       
    $country = $ipdat->geoplugin_countryName; 
    $city = $ipdat->geoplugin_city;

    // checking required fields
    $req_fields = array('name', 'email', 'subject', 'message');
    foreach ($req_fields as $field) {
      if (empty(trim($_POST[$field]))) {
        $err4 = '1';
        $errors4[] = $field . ' is required';
      }
    }
    // checking max length
    $max_len_fields = array('name' => 50, 'email' =>50, 'subject' => 75, 'message' => 1000);

    foreach ($max_len_fields as $field => $max_len) {
      if (strlen(trim($_POST[$field])) > $max_len) {
        $err4 = '1';
        $errors4[] = $field . ' must be less than ' . $max_len . ' characters';
      }
    }
    // checking email address
    if (!is_email($_POST['email'])) {
      $err4 = '1';
      $errors4[] = 'Email address is invalid.';
    }
      if (empty($errors4)) {
      // no errors found... adding new record
      $name = mysqli_real_escape_string($connection, $_POST['name']);
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $subject = mysqli_real_escape_string($connection, $_POST['subject']);
      $message = mysqli_real_escape_string($connection, $_POST['message']);
      $is_reply = '0';
      $is_delete = '0';

      $query = "INSERT INTO contact ( ";
      $query .= "name, email, subject, message, is_reply, is_delete";
      $query .= ") VALUES (";
      $query .= "'{$name}', '{$email}', '{$subject}', '{$message2}', '{$is_reply}', '{$is_delete}'";
      $query .= ")";

      $result = mysqli_query($connection, $query);

      if ($result) {
            $suces = '1';
            $msg = 'Your Message is Sent Successfully..., We will contact you within 24 hours ';
            $name = '';
            $email = '';
            $subject = '';
            $message = '';


        $sql = "UPDATE notification SET emails = emails+1 WHERE id = '1'";
        $connection->query($sql);

            } else {
                $err4 = '2';
                $errors4[] = 'Failed to add the new record.';
            }
      } 
    }

?>