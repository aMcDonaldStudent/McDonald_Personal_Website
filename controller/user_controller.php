<?php //Should  be good now
require_once(__DIR__.'\..\model\user_db.php');
require_once(__DIR__.'\user.php');
//doesn't need update I think
class UserController {
    //helper function to convert a db row into a
    //User object
    private static function rowToUser($row) {
        $user = new User($row['UserId'], //skips Password
            $row['FirstName'],
            $row['LastName'],
            $row['EMail'],
            $row['Password'], //weird  8 args putting in pass
            $row['HireDate'], //this is shuffled in case  it errors
            $row['Extension'],
            $row['UserLevelNo']);
        $user->setUserNo($row['UserNo']);
        return $user; //Not  sure what order this needs to be  in or if it  controls how  it  views
    }

    //function to get all people in the database

    //function to get all people in the database
    public static function getAllUsers() {
        $queryRes = UsersDB::getUsers();

        if ($queryRes) {
            //process the results into an array with
            //the RoleNo and the RoleName - allows the
            //UI to not care about the DB structure
            $users = array();

            foreach ($queryRes as $row) {
                //process each row into an array of
                //Person objects (i.e. "people")
                $users[] = self::rowToUser($row);
            }
            return $users;
        } else {
            return false;
        }
    }

    //function to get people in a specific role
    //Might not be necessary but will remove later if unnecessary
    //function to get a specific person by their PersonNo
    public static function getUserByNo($userNo) {
        $queryRes = UsersDB::getUser($userNo);

        if ($queryRes) {
            //this query only returns a single row, so
            //just process it
            return self::rowToUser($queryRes);
        } else {
            return false;
        }
    }

    //function to delete a person by their PersonNo
    public static function deleteUser($userNo) {
        //no special processing needed - just use the 
        //DB function
        return UsersDB::deleteUser($userNo); 
    }

    //function to add a person to the DB
    public static function addUser($user) {
        return UsersDB::addUser(
            $user->getUserId(),
            $user->getPassword(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getHireDate(),
            $user->getEMail(),
            $user->getExtension(),
            $user->getUserLevelNo());
            //$product->getCategory()->getProductNo());
    }
    //function to update a person's information
    public static function updateUser($user) {
        return UsersDB::updateUser(
            $user->getUserNo(),
            $user->getUserId(),
            $user->getPassword(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getHireDate(),
            $user->getEMail(),
            $user->getExtension(),
            $user->getUserLevelNo());
    }





    //THIS LINE SEPARATES THE LOGIN SPECIFIC CODE FROM  THE  REST
    //function to check login credentials - return the
    //user's level if valid, false otherwise
    public static function validUser($email, $password) {
        $queryRes = UsersDB::getUserByEMail($email);
        if ($queryRes) {
            //process the user row
            $user = self::rowToUser($queryRes);
            if ($user->getPassword() === $password) {
                return $user->getUserLevelNo();
            } else {
                return false;
                echo "FAILS CHECK!";
            }
        } else {
            //either no such user or db connect failed - 
            //either way, can't validate the user
            return false;
            echo "NO  CHECK!";
        }
    }
} 