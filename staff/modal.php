<?php

class DB_Modal
{
    public static function is_password_strong($password)
    {

        $isLength = strlen($password) >= 8;
        $isUpperCase = preg_match("@[A-Z]@", $password);
        $isLowerCase = preg_match("@[a-z]@", $password);
        $isDigitOrSymbol = preg_match("@[\d\W]@", $password);


        if ($isLength && $isUpperCase && $isLowerCase && $isDigitOrSymbol) {
            return true;
        } else {
            return false;
        }
    }

    public static function forget($first_name, $email)
    {

        require("db.php");

        $person = mysqli_real_escape_string($connect, $first_name);
        $to = mysqli_real_escape_string($connect, $email);

        $forget_query = "SELECT name AS USER, password AS PASS FROM user Where first_name='$first_name' AND email='$email' ";

        $result = mysqli_query($connect, $forget_query);

        if (mysqli_num_rows($result) > 0) {

            $output = mysqli_fetch_assoc($result);

            // Set headers
            $headers = "Content-Type: text/html; charset=UTF-8\r\n";
            $message = "Dear " . $first_name . ", \n Your ( USER= " . $output['USER'] . " AND PASS= " . $output['PASS'] . " ) \n Please don't share with any one.";
            $subject = "Forget Detail";

            // Send the email
            if (mail($to, $subject, $message, $headers)) {

                return true;

            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public static function login($username, $password)
    {

        include("db.php");

        $user = mysqli_real_escape_string($connect, $username);
        $pass = mysqli_real_escape_string($connect, $password);

        $login_query = "SELECT id AS user_id, name AS username, role AS user_role, isActive FROM user WHERE name='$user' AND password='$pass' ";

        $result = mysqli_query($connect, $login_query);

        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            return "Invalid username or password.";
        } else if (!$row['isActive']) {
            return "Permission Denied!";
        } else {
            return $row;
        }
    }

    public static function register($first_name, $last_name, $email, $contact, $role, $username, $password)
    {

        include("db.php");

        $activate = $role ? 0 : 1;

        /* escape input values */
        $first_name = mysqli_real_escape_string($connect, $first_name);
        $email = mysqli_real_escape_string($connect, $email);
        $contact = mysqli_real_escape_string($connect, $contact);
        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password); // recommended: use password_hash
        $role = (int) $role;

        /* handle optional last name */
        $last_name_sql = ($last_name !== null && $last_name !== '')
            ? "'" . mysqli_real_escape_string($connect, $last_name) . "'"
            : "NULL";

        /* insert query */
        $insert_query = "INSERT INTO user (
                first_name,
                last_name,
                name,
                email,
                contact_number,
                password,
                role,
                isActive
            ) VALUES (
                '$first_name',
                $last_name_sql,
                '$username',
                '$email',
                '$contact',
                '$password',
                $role,
                $activate
            )";

        $result = mysqli_query($connect, $insert_query);

        mysqli_close($connect);

        if (!$result) {
            return "Error: " . mysqli_error($connect);
        }
        return "Account created successfully.";
    }

    public static function get_users($OFFSET, $LIMIT)
    {

        require("db.php");

        $get_users_query = "SELECT * FROM user LIMIT $OFFSET, $LIMIT";

        $result = mysqli_query($connect, $get_users_query);

        if (!$result) {
            return mysqli_error($connect);
        } else if (mysqli_affected_rows($connect) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 'Categories table is empty!';
        }
    }

    public static function get_categories()
    {

        require("db.php");

        $get_users_query = "SELECT * FROM categories";

        $result = mysqli_query($connect, $get_users_query);

        if (!$result) {

            return mysqli_error($connect);
        } else if (mysqli_affected_rows($connect) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 'Categories table is empty!';
        }
    }

    public static function set_post($title, $description, $image, $author_id, $categorie_id) {
        
        require('db.php');

        $post_title = mysqli_real_escape_string($connect,$title);
        $post_description = mysqli_real_escape_string($connect, $description);
        $post_image = mysqli_real_escape_string($connect, $image);


        $userid = intval($author_id);
        $categorie_id = intval($categorie_id);

        if (($userid == 0) || ($categorie_id == 0)) {
            return 'INVALID ID FOUNDED';
        }

        $set_post_query = "INSERT INTO post( title, description, image, author_id, category_id ) values ('$post_title','$post_description','$post_image',$userid,$categorie_id) ";

        $result = mysqli_query($connect, $set_post_query);

        if (!$result) {
            return mysqli_error($connect);
        }  else {
            return 'Successfully Posted!';
        }
    }

    public static function get_posts($OFFSET, $LIMIT)
    {

        require("db.php");

        $get_users_query = "SELECT * FROM post LIMIT $OFFSET, $LIMIT";

        $result = mysqli_query($connect, $get_users_query);

        if (!$result) {
            return mysqli_error($connect);
        } else if (mysqli_affected_rows($connect) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 'Post table is empty!';
        }
    }

    public static function set_categorie($type) {

        include('db.php');

        $new_type = mysqli_real_escape_string($connect, $type);

        $new_categroies_query = "INSERT into categories(name) value('$new_type')";

        $result = mysqli_query($connect, $new_categroies_query);

        if (!$result) {
            return mysqli_error($connect);  
        }

        if (mysqli_affected_rows($connect) > 0) {
            return true;
        }
    }

    public static function countThe($request)
    {
        require("db.php");

        $count_request = mysqli_real_escape_string($connect, $request);

        if ($count_request === 'USERS') {

            $query = "SELECT count(id) AS TOTAL_USERS FROM user";

        } else if ($count_request === 'CATEGORIES') {

            $query = "SELECT count(id) AS TOTAL_CATEORIES FROM categories";

        } else if ($count_request === 'POSTS') {

            $query = "SELECT count(id) AS TOTAL_POSTS FROM post";

        } else {

            return "request denied!";
        }

        $result = mysqli_query($connect, $query);

        if (!$result) {
            return mysqli_error($connect);
        }

        return mysqli_fetch_assoc($result);
    }
    public static function grant($USER, $ACTION)
    {
        require("db.php");

        $userid = intval($USER);
        $action = intval($ACTION);

        if ($action !== 0 || $action !== 1) {
            return 0;
        }
        if ($action === 0) {
            $action = 1;
        } else {
            $action = 0;
        }

        $query = "UPDATE user SET isActive = $action WHERE id = $userid";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            return 0;
        }

        return mysqli_affected_rows($connect);
    }
}

/* Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil */
?>