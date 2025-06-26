<?php

    class DB_Modal {

        public static function is_password_strong ($password) {
        
            $isLength = strlen($password) >= 8;
            $isUpperCase = preg_match("@[A-Z]@", $password);
            $isLowerCase = preg_match("@[a-z]@", $password);
            $isDigitOrSymbol = preg_match("@[\d\W]@", $password);


            if ($isLength && $isUpperCase && $isLowerCase && $isDigitOrSymbol) 
            {    
                return true;        
            } 
            else 
            {
                return false;
            }
        }

        public static function forget($first_name, $email) {

            require ("db.php");

            $person = mysqli_real_escape_string($connect, $first_name);
            $to = mysqli_real_escape_string($connect, $email);

            $forget_query = "SELECT name AS USER, password AS PASS FROM user Where first_name='$first_name' AND email='$email' ";

            $result = mysqli_query($connect, $forget_query);

            if (mysqli_num_rows($result) > 0) {

                $output = mysqli_fetch_assoc($result);
            
                // Set headers
                $headers = "Content-Type: text/html; charset=UTF-8\r\n";
                $message = "Dear " . $first_name . ", \n Your ( USER= ". $output['USER'] . " AND PASS= " . $output['PASS'] . " ) \n Please don't share with any one.";
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

        public static function login($username, $password) {

            include("db.php");
            
            $user = mysqli_real_escape_string($connect, $username);
            $pass = mysqli_real_escape_string($connect, $password);

            $login_query = "SELECT id AS user_id, name AS username, role AS user_role FROM user WHERE name='$user' AND password='$pass' ";

            $result = mysqli_query($connect, $login_query);

            if (!$result)
            {
                return mysqli_error($connect);
            }
            return mysqli_fetch_assoc($result);
        }

        public static function register($first_name, $last_name, $email, $contact, $role, $username, $password) {
         
            include("db.php");

            $activate = $role ? 0 : 1;

            /* escape input values */
            $first_name = mysqli_real_escape_string($connect, $first_name);
            $email = mysqli_real_escape_string($connect, $email);
            $contact = mysqli_real_escape_string($connect, $contact);
            $username = mysqli_real_escape_string($connect, $username);
            $password = mysqli_real_escape_string($connect, $password); // recommended: use password_hash
            $role = (int)$role;

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

            if (!$result) 
            {
                return "Error: " . mysqli_error($connect);
            }
            return "Account created successfully.";
        }
    }

?>
