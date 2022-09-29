<?php

require_once '../../admin/dbconnect/dbconnection.php';
require_once '../../admin/models/User.php';

class UserController
{
    private $link;

    function __construct()
    {
        $dbconnect = new DBConnect();
        $this->link = $dbconnect->InitConnect();
    }

    // Get all users
    function GetAllUsers()
    {
        $userList = [];
        $sql = "SELECT * FROM Users";

        $rs = $this->link->query($sql);

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $user = new User();
                $user->setUserID($row["UserID"]);
                $user->setUserName($row["UserName"]);
                $user->setFullName($row["FullName"]);
                $user->setEmail($row["Email"]);
                $user->setPhoneNumber($row["PhoneNumber"]);
                $user->setRole($row["Role"]);

                array_push($userList, $user);
            }
        }

        return $userList;
    }

    // Check user
    function CheckUser(User $user)
    {
        $sql = "SELECT * FROM Users WHERE UserName = ?";

        if ($stmt = mysqli_prepare($this->link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $user->getUserName();

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $password, $fullname, $phonenumber, $email, $role);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($user->getPassword(), $password)) {
                            $userLogin = new User();
                            $userLogin->setUserID($id);
                            $userLogin->setFullName($fullname);
                            $userLogin->setUserName($username);
                            $userLogin->setRole($role);
                            // Close statement
                            mysqli_stmt_close($stmt);
                            return $userLogin;
                        }
                        mysqli_stmt_close($stmt);
                        return null;
                    }
                } else {
                    mysqli_stmt_close($stmt);
                    return null;
                }
            } else {
                mysqli_stmt_close($stmt);
                return null;
            }
        }
    }

    // Create new user
    function Register(User $user)
    {
        $sql = "INSERT INTO Users (UserName, Password, FullName, PhoneNumber, Email, Role) 
            VALUES ('{$user->getUserName()}', '{$user->getPassword()}', '{$user->getFullName()}', '{$user->getPhoneNumber()}', '{$user->getEmail()}', '{$user->getRole()}')";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Delete user
    function DeleteUser($userId)
    {
        $sql = "DELETE FROM Users WHERE UserID={$userId}";

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Get User
    function GetUserById($userId)
    {
        $sql = "SELECT * FROM Users WHERE UserID={$userId}";

        if ($stmt = mysqli_prepare($this->link, $sql)) {
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $password, $fullname, $phonenumber, $email, $role);
                    if (mysqli_stmt_fetch($stmt)) {
                        $user = new User();
                        $user->setUserID($id);
                        $user->setUserName($username);
                        $user->setPassword($password);
                        $user->setFullName($fullname);
                        $user->setPhoneNumber($phonenumber);
                        $user->setEmail($email);
                        $user->setRole($role);

                        mysqli_stmt_close($stmt);

                        return $user;
                    }
                } else {
                    mysqli_stmt_close($stmt);
                    return null;
                }
            } else {
                mysqli_stmt_close($stmt);
                return null;
            }
        }
    }

    // Get User
    function GetUserByUserName($username)
    {
        $sql = "SELECT * FROM Users WHERE UserName='{$username}'";

        if ($stmt = mysqli_prepare($this->link, $sql)) {
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    return 1;
                } else {
                    mysqli_stmt_close($stmt);
                    return 0;
                }
            } else {
                mysqli_stmt_close($stmt);
                return 0;
            }
        }

        return 0;
    }

    // Update user
    function UpdateUser(User $user)
    {
        if ($user->getPassword() == "") {
            $sql = "UPDATE Users SET UserName='{$user->getUserName()}', FullName='{$user->getFullName()}', Email='{$user->getEmail()}', PhoneNumber='{$user->getPhoneNumber()}', Role='{$user->getRole()}' WHERE UserID={$user->getUserID()}";
        } else {
            $sql = "UPDATE Users SET UserName='{$user->getUserName()}', Password='{$user->getPassword()}', FullName='{$user->getFullName()}', Email='{$user->getEmail()}', PhoneNumber='{$user->getPhoneNumber()}', Role='{$user->getRole()}' WHERE UserID={$user->getUserID()}";
        }

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Change profile
    function ChangeProfile($userid, $password, $email, $phonenumber)
    {
        if ($password == "") {
            $sql = "UPDATE Users SET Email='{$email}', PhoneNumber='{$phonenumber}' WHERE UserID={$userid}";
        } else {
            $sql = "UPDATE Users SET Password='{$password}', Email='{$email}', PhoneNumber='{$phonenumber}' WHERE UserID={$userid}";
        }

        if ($this->link->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
