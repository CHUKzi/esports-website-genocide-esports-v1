<?php
//blogs_page_head table 

$query = "SELECT * FROM blogs WHERE id='$blog'";
$blogs = mysqli_query($connection, $query);
$blogs_info = mysqli_fetch_assoc($blogs);

$get_id=$blog;
$member='guest';
$avatar='guest.jpg';
$delete='0';
$result_tap = '0';
$err3 = '0';
$suces = '0';

  $errorss = array();

  $name = '';
  $email = '';
  $comment = '';
  $msg = '';
  
  if (isset($_POST['submit2'])) {
    $result_tap = '1';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    // checking required fields
    $req_fields = array('name', 'email', 'comment');
    foreach ($req_fields as $field) {
      if (empty(trim($_POST[$field]))) {
        $err3 = '1';
        $errorss[] = $field . ' is required';
      }
    }
    // checking max length
    $max_len_fields = array('name' => 70, 'email' => 60, 'comment' => 5000);

    foreach ($max_len_fields as $field => $max_len) {
      if (strlen(trim($_POST[$field])) > $max_len) {
        $err3 = '1';
        $errorss[] = $field . ' must be less than ' . $max_len . ' characters';
      }
    }
    // checking email address
    if (!is_email($_POST['email'])) {
      $err3 = '1';
      $errorss[] = 'Email address is invalid.';
    }
      if (empty($errorss)) {
      // no errors found... adding new record
      $post_id=$get_id;
      $member_type=$member;
      $img=$avatar;
      $name = mysqli_real_escape_string($connection, $_POST['name']);
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $comment = mysqli_real_escape_string($connection, $_POST['comment']);
      $is_delete=$delete;

      $query = "INSERT INTO comments ( ";
      $query .= "post_id , member_type , img, name, email , comment , is_delete";
      $query .= ") VALUES (";
      $query .= "'{$post_id}', '{$member_type}', '{$img}', '{$name}', '{$email}', '{$comment}', '{$is_delete}'";
      $query .= ")";

      $result = mysqli_query($connection, $query);

      if ($result) {
        // query successful... redirecting to users page
        // header('Location: index.php?User_registered=true');
        $suces = '1';
        $msg = 'Your comment has been successfully posted';
        $name = '';
        $email = '';
        $comment = '';

        $sql = "UPDATE notification SET comments = comments+1 WHERE id = '1'";
        $connection->query($sql);

      } else {
        $err3 = '2';
        $errorss[] = 'Failed to add the new record.';

        echo "<script>alert('Invalid Details');</script>";
      }
    }
  }
?>