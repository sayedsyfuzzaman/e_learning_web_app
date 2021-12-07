<?php

class authentication
{
    function authenticateUser($data)
    {
        require_once "Admin/model/model.php";
        $model = new model();
        $user = $model->getUserInfo($data);

        if (!empty($user)) {
            $userInfo = array();
            foreach ($user as $rows) {
                $userInfo = array(
                    'id' => $rows["id"],
                    'password' => $rows["password"],
                    'usertype' => $rows["usertype"],
                    'name' => $rows["name"],
                    'email' => $rows["email"],
                    'phone' => $rows["phone"],
                    'nationality' => $rows["nationality"],
                    'nid' => $rows["nid"],
                    'dob' => $rows["dob"],
                    'gender' => $rows["gender"],
                    'address' => $rows["address"],
                    'image' => $rows["image"]
                );
                break;
            }

            if ($userInfo['usertype'] == "Admin") {
                $_SESSION['id'] = $userInfo["id"];
                $_SESSION['password'] = $userInfo["password"];
                $_SESSION['usertype'] = $userInfo["usertype"];
                $_SESSION['name'] = $userInfo["name"];
                $_SESSION['email'] = $userInfo["email"];
                $_SESSION['phone'] = $userInfo["phone"];
                $_SESSION['nationality'] = $userInfo["nationality"];
                $_SESSION['nid'] = $userInfo["nid"];
                $_SESSION['dob'] = $userInfo["dob"];
                $_SESSION['gender'] = $userInfo["gender"];
                $_SESSION['address'] = $userInfo["address"];
                $_SESSION['image'] = $userInfo["image"];
                header("location: Admin/dashboard.php");
            } elseif ($userInfo['usertype'] == "Manager") {
                echo "Signing in..";
                return true;
            }
        }
        return false;
    }
}
