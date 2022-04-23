<?php 
  $errors = array();
  $email = '';
  $subscribe = '';
  $er1 = '';

  if (isset($_POST['submit3'])) {

    $email = $_POST['email'];

    // checking required fields
    $req_fields = array('email');

    foreach ($req_fields as $field) {
      if (empty(trim($_POST[$field]))) {
        $errors[] = $field . ' is required';
      }
    }

    // checking max length
    $max_len_fields = array('email' => 100);

    foreach ($max_len_fields as $field => $max_len) {
      if (strlen(trim($_POST[$field])) > $max_len) {
      	$er1 = '1';
        $errors[] = $field . ' must be less than ' . $max_len . ' characters';
      }
    }

    // checking email address
    if (!is_email($_POST['email'])) {
    	$er1 = '1';
      $errors[] = 'Email address is invalid.';
    }
    // checking if email address already exists
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $query = "SELECT * FROM subscribers WHERE email = '{$email}' LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
      if (mysqli_num_rows($result_set) == 1) {
      	$er1 = '1';
        $errors[] = 'You are already subscribed';
      }
    }
      if (empty($errors)) {
      // no errors found... adding new record
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      // email address is already sanitized

      $query = "INSERT INTO subscribers ( ";
      $query .= "email";
      $query .= ") VALUES (";
      $query .= "'{$email}'";
      $query .= ")";

      $result = mysqli_query($connection, $query);

      if ($result) {
        // query successful... redirecting to users page
        $subscribe = '1';
        $email = '';
      } else {
      	$er1 = '2';
        //$errors[] = 'Subscribe failed';
      }
    }
  }
 ?>