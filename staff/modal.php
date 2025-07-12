<?php

# Class: DB_Modal - Handles all database operations related to user, posts, and categories

class DB_Modal
{
    # Check password strength
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

    # Handle forgotten password by sending email with credentials
    public static function forget($first_name, $email)
    {
        require("db.php");

        $person = mysqli_real_escape_string($connect, $first_name);
        $to = mysqli_real_escape_string($connect, $email);

        $query = "SELECT name AS USER, password AS PASS FROM user Where first_name='$person' AND email='$email' ";

        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) > 0) {
            $output = mysqli_fetch_assoc($result);
            $headers = "Content-Type: text/html; charset=UTF-8\r\n";
            $message = "Dear " . $person . ", \n Your ( USER= " . $output['USER'] . " AND PASS= " . $output['PASS'] . " ) \n Please don't share with any one.";
            $subject = "Forget Detail";

            if (mail($to, $subject, $message, $headers)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    # login verfication if valid return cradintional ---
    public static function login($username, $password)
    {
        include("db.php");

        $user = mysqli_real_escape_string($connect, $username);
        $pass = mysqli_real_escape_string($connect, $password);

        $query = "SELECT 
                    user.id AS user_id, 
                    user.name AS username, 
                    user.role AS user_role, 
                    user.isActive AS isSafe 
                FROM 
                    user 
                WHERE 
                    user.name='$user' AND user.password='$pass' ";

        $output = mysqli_query($connect, $query);

        if (!$output) {
            return mysqli_error($connect);
        }

        $col = mysqli_fetch_assoc($output);

        if (!$col) {
            return 'Login username and password is Unvalid!';
        } else if ($col['isSafe']) {
            return $col;
        } else {
            return 'Permission Denied!';
        }
    }

    # register a new user
    public static function register($first_name, $last_name, $email, $contact, $role, $username, $password)
    {
        include("db.php");

        $activate = $role ? 0 : 1;

        $first_name = mysqli_real_escape_string($connect, $first_name);
        $email = mysqli_real_escape_string($connect, $email);
        $contact = mysqli_real_escape_string($connect, $contact);
        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password);
        $role = (int) $role;

        $last_name_sql = ($last_name !== null && $last_name !== '')
            ? "'" . mysqli_real_escape_string($connect, $last_name) . "'"
            : "NULL";

        $query = "INSERT 
                    INTO 
                        user (
                            first_name,
                            last_name,
                            name,
                            email,
                            contact_number,
                            password,
                            role,
                            isActive
                        ) 
                    VALUES (
                        '$first_name',
                        $last_name_sql,
                        '$username',
                        '$email',
                        '$contact',
                        '$password',
                        $role,
                        $activate
                    )";

        $result = mysqli_query($connect, $query);

        mysqli_close($connect);

        if (!$result) {
            return "Error: " . mysqli_error($connect);
        }
        return "Account created successfully.";
    }

    # Get users with pagination
    public static function get_users($OFFSET, $LIMIT)
    {
        require("db.php");

        $query = "SELECT
                    user.id AS user_id,
                    user.name AS user_name,
                    user.first_name AS user_fname,
                    user.last_name AS user_lname,
                    user.email AS user_mail,
                    user.contact_number AS user_number,
                    user.created_at AS user_stamp,
                    user.role AS user_role,
                    user.isActive AS isOK
                FROM 
                    user 
                LIMIT $OFFSET, $LIMIT";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            return mysqli_error($connect);
        } else if (mysqli_affected_rows($connect) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 'Categories table is empty!';
        }
    }

    # Insert a new post
    public static function set_post($title, $description, $image, $author_id, $categorie_id)
    {
        require('db.php');

        $post_title = mysqli_real_escape_string($connect, $title);
        $post_description = mysqli_real_escape_string($connect, $description);
        $post_image = mysqli_real_escape_string($connect, $image);

        $userid = intval($author_id);
        $categorie_id = intval($categorie_id);

        if (($userid == 0) || ($categorie_id == 0)) {
            return 'INVALID ID FOUNDED';
        }

        $query = "INSERT 
            INTO 
                post( title, description, image, author_id, category_id ) 
            VALUES (
                '$post_title', 
                '$post_description', 
                '$post_image', 
                $userid, 
                $categorie_id
            )";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            return mysqli_error($connect);
        } else {
            return 'Successfully Posted!';
        }
    }

    # get all post of database
    public static function get_all_posts($filter_type = null, $filter_value = null) {

        require('db.php');

        $WHERE = "";
        
        if ($filter_value !== null && $filter_type !== null) {

            $filter_value = mysqli_real_escape_string($connect, $filter_value);
            
            if ($filter_type = 'category') {
                $WHERE = "WHERE categories.id = '$filter_value'";
            } else if ($filter_type = 'user') {
                $WHERE = "WHERE user.id = '$filter_value'";
            } else if ($filter_type = 'post') {
                $WHERE = "WHERE post.id = '$filter_value'";
            } else if ($filter_type = 'stamp') {
                $WHERE = "WHERE post.created_at = '$filter_value'";
            } else {
                return 'invalid filter';
            }
        }

        $query = "SELECT
                post.id AS post_id,
                post.title AS post_title,
                post.description AS post_description,
                post.image AS post_image,
                post.created_at AS post_stamp,
                user.id AS user_id,
                user.name AS author_name,
                categories.id AS categories_id,
                categories.name AS post_category
            FROM
                post
            JOIN
                user ON post.author_id = user.id
            JOIN
                categories ON post.category_id = categories.id
            $WHERE";

        $output = mysqli_query($connect, $query);

        if (!$output) {

            return mysqli_error($connect);
        } else if (mysqli_affected_rows($connect) > 0) {

            return mysqli_fetch_all($output, MYSQLI_ASSOC);
        } else {

            return 'Post table is empty!';
        }
    }
    
    # Get posts with pagination
    public static function get_posts($OFFSET, $LIMIT, $USERID, $ROLE)
    {
        require("db.php");

        $OFFSET = (int)$OFFSET;
        $LIMIT = (int)$LIMIT;
        $USERID = (int)$USERID;

        $query = "SELECT 
                post.id AS post_id,
                post.title AS post_title,
                post.description AS post_description,
                post.created_at AS post_stamp,
                user.name AS author_name,
                categories.name AS post_category
            FROM 
                post
            JOIN 
                user ON post.author_id = user.id
            JOIN 
                categories ON post.category_id = categories.id";

        if ($ROLE !== 1) {
            $query .= " WHERE post.author_id = $USERID";
        }

        $query .= " LIMIT $OFFSET, $LIMIT";

        $output = mysqli_query($connect, $query);

        if (!$output) {
            return mysqli_error($connect);
        }

        if (mysqli_num_rows($output) > 0) {
            return mysqli_fetch_all($output, MYSQLI_ASSOC);
        } else {
            return 'No Post Found?';
        }
    }

    # Add new category
    public static function set_categorie($type)
    {
        include('db.php');

        $new_type = mysqli_real_escape_string($connect, $type);

        $query = "INSERT 
                INTO 
                    categories (name) 
                VALUE 
                    ('$new_type')";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            return mysqli_error($connect);
        }

        if (mysqli_affected_rows($connect) > 0) {
            return true;
        }
    }

    # Get all categories
    public static function get_categories()
    {
        require("db.php");

        $query = "SELECT 
                categories.id AS category_id,
                categories.name AS category_type,
                COUNT(post.id) AS category_count
            FROM 
                categories
            LEFT JOIN 
                post ON post.category_id = categories.id
            GROUP BY 
                categories.id, categories.name
            ORDER BY 
                category_count DESC";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            return mysqli_error($connect);
        } else if (mysqli_affected_rows($connect) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 'Categories table is empty!';
        }
    }

    # Count records for USERS, CATEGORIES, or POSTS
    public static function countThe($request, $id = null)
    {
        require("db.php");

        $count_request = mysqli_real_escape_string($connect, $request);

        if ($count_request === 'USERS') {
            $query = "SELECT count(id) AS TOTAL_USERS FROM user";
        } else if ($count_request === 'CATEGORIES') {
            $query = "SELECT count(id) AS TOTAL_CATEORIES FROM categories";
        } else if ($count_request === 'POSTS') {
            $query = "SELECT count(id) AS TOTAL_POSTS FROM post";
        } else if ($count_request === 'USER_POSTS') {
            $query = "SELECT count(id) AS TOTAL_USER_POSTS FROM post WHERE author_id = $id";
        }else {
            return "request denied!";
        }
        $result = mysqli_query($connect, $query);

        if (!$result) {

            return mysqli_error($connect);
        } else {

            return mysqli_fetch_assoc($result);
        }
    }

    # Toggle user activation (grant or deny)
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

        $query = "UPDATE 
                user 
            SET 
                isActive = $action 
            WHERE 
                id = $userid";

        $result = mysqli_query($connect, $query);

        if (!$result) {
            return 0;
        }

        return mysqli_affected_rows($connect);
    }
}

/* Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil */
