<?php


use ZxcvbnPhp\Zxcvbn;


/**
 * Auth class
 * Required PHP 5.6 and above.
 */

class Auth
{
    protected $dbh;
    public $lang =array('user_blocked' => "Vous &ecirc;tes actuellement bloqu&eacute;s du syst&egrave;me.",
        'user_verify_failed' => "Code captcha invalide.",

        'email_password_invalid' => "Adresse email / mot de passe invalide.",
        'email_password_incorrect' => "Adresse email / mot de passe incorrect.",
        'remember_me_invalid' => "Le champ se souvenir de moi est invalide.",

        'password_short' => "Le mot de passe est trop court.",
        'password_weak' => "Le mot de passe est trop faible.",
        'password_nomatch' => "Les mots de passe ne sont pas identiques.",
        'password_changed' => "Le mot de passe a bien &eacute;t&eacute; chang&eacute;.",
        'password_incorrect' => "Le mot de passe actuel est incorrect.",
        'password_notvalid' => "Le mot de passe est invalide.",

        'newpassword_short' => "Le nouveau mot de passe est trop court.",
        'newpassword_long' => "Le nouveau mot de passe est trop long.",
        'newpassword_invalid' => "Le nouveau mot de passe doit contenir au moins un caractère en miniscule et en majuscule, et au moins un chiffre.",
        'newpassword_nomatch' => "Les nouveaux mots de passe ne sont pas identiques.",
        'newpassword_match' => "Le nouveau mot de passe est le m&ecirc;me que l'ancien.",

        'email_short' => "L'adresse email est trop courte.",
        'email_long' => "L'adresse email est trop longue.",
        'email_invalid' => "L'adresse email est invalide.",
        'email_incorrect' => "L'adresse email est incorrecte.",
        'email_banned' => "Cette adresse email est interdite.",
        'email_changed' => "L'adresse email a bien &eacute;t&eacute; chang&eacute;e.",

        'newemail_match' => "La nouvelle adresse email est identique à l'adresse email actuelle.",

        'account_inactive' => "Le compte n'a pas encore &eacute;t&eacute; activ&eacute;.",
        'account_activated' => "Le compte est desormais activ&eacute;.",

        'logged_in' => "Vous &ecirc;tes maintenant connect&eacute;s.",
        'logged_out' => "Vous avez &eacute;t&eacute; deconnect&eacute;s.",

        'system_error' => "Une erreur syst&egrave;me a &eacute;t&eacute; rencontr&eacute;e. Veuillez r&eacute;essayer.",

        'register_success' => "Le compte a bien &eacute;t&eacute; cr&eacute;e. L'email d'activation vous a &eacute;t&eacute; envoy&eacute;.",
        'register_success_emailmessage_suppressed' => "Le compte a bien &eacute;t&eacute; cr&eacute;e.",
        'email_taken' => "L'adresse email est d&eacute;j&agrave; utilis&eacute;e.",

        'resetkey_invalid' => "La cl&eacute; de r&eacute;initialisation est invalide.",
        'resetkey_incorrect' => "La cl&eacute; de r&eacute;initialisation est incorrecte.",
        'resetkey_expired' => "La cl&eacute; de r&eacute;initialisation est expir&eacute;e.",
        'password_reset' => "Le mot de passe a bien &eacute;t&eacute; r&eacute;initialis&eacute;.",

        'activationkey_invalid' => "La cl&eacute; d'activation est invalide.",
        'activationkey_incorrect' => "La cl&eacute; d'activation est incorrecte.",
        'activationkey_expired' => "La cl&eacute; d'activation est expir&eacute;e.",

        'reset_requested' => "Une demande de r&eacute;initialisation de votre mot de passe a &eacute;t&eacute; envoy&eacute;.",
        'reset_requested_emailmessage_suppressed' => "Une demande de r&eacute;initialisation de votre mot de passe a &eacutet&eacute cr&eacute&eacute.",
        'reset_exists' => "Une demande de r&eacute;initialisation de votre mot de passe existe d&eacute;j&agrave;.",

        'already_activated' => "Le compte est d&eacute;j&agrave; activ&eacute;.",
        'activation_sent' => "L'email d'activation a bien &eacute;t&eacute; envoy&eacute;.",
        'activation_exists' => "L'email d'activation a d&eacute;j&agrave; &eacute;t&eacute; envoy&eacute;.",


        'account_deleted' => "Compte supprimé.",
        'function_disabled' => "Cette fonction a &eacute;t&eacute; desactiv&eacute;.");
    protected $islogged = NULL;
    protected $currentuser = NULL;
    private $cookie_name = 'authID';
    private $table_users = 'users';
    private $table_sessions = 'sessions';
    private $key = 'fghuior.)/!/jdUkd8s2!7HVHG7777ghg';
    private $password_min_score = 2;

    /**
     * Initiates database connection
     */
    public function __construct(\PDO $dbh)
    {


        $this->dbh = $dbh;

        if (version_compare(phpversion(), '5.6.0', '<')) {
            die('PHP 5.6.0 required for PHPAuth engine!');
        }

        // Load language


        date_default_timezone_set('Europe/Paris');
    }

    /**
     * Logs a user in
     * @param string $email
     * @param string $password
     * @param int $remember
     * @return array $return
     */
    public function login($email, $password, $remember = 0)
    {
        $return['error'] = true;
        $validateEmail = $this->validateEmail($email);
        $validatePassword = $this->validatePassword($password);

        if ($validateEmail['error'] == 1) {
            $return['message'] = $this->lang["email_password_invalid"];

            return $return;
        } elseif ($validatePassword['error'] == 1) {
            $return['message'] = $this->lang["email_password_invalid"];

            return $return;
        } elseif ($remember != 0 && $remember != 1) {
            $return['message'] = $this->lang["remember_me_invalid"];

            return $return;
        }

        $uid = $this->getUID(strtolower($email));

        if (!$uid) {
            $return['message'] = $this->lang["email_password_incorrect"];

            return $return;
        }

        $user = $this->getBaseUser($uid);

        if (!$this->password_verify_with_rehash($password, $user['password'], $uid)) {
            $return['message'] = $this->lang["email_password_incorrect"];

            return $return;
        }

        if ($user['isactive'] != 1) {
            $return['message'] = $this->lang["account_inactive"];

            return $return;
        }

        $sessiondata = $this->addSession($user['uid'], $remember);

        if ($sessiondata == false) {
            $return['message'] = $this->lang["system_error"] . " #01";

            return $return;
        }

        $return['error'] = false;
        $return['message'] = $this->lang["logged_in"];

        $return['hash'] = $sessiondata['hash'];
        $return['expire'] = $sessiondata['expire'];

        $return['cookie_name'] = $this->cookie_name;

        return $return;
    }
    /**
     * Check if users password needs to be rehashed
     * @param string $password
     * @param string $hash
     * @param int $uid
     * @return bool
     */
    public function password_verify_with_rehash($password, $hash, $uid)
    {
        if (!password_verify($password, $hash)) {
            return false;
        }

        if (password_needs_rehash($hash, PASSWORD_DEFAULT, array('cost' => 10))) {
            $hash = $this->getHash($password);

            $query = $this->dbh->prepare("UPDATE {$this->table_users} SET password = ? WHERE id = ?");
            $query->execute(array($hash, $uid));
        }

        return true;
    }
    /**
     * Creates a new user, adds them to database
     * @param string $email
     * @param string $password
     * @param string $repeatpassword
     * @param array  $params
     * @return array $return
     */

    public function register( $params = Array())
    {
        $return['error'] = true;
        $password =$params['password'];
        $repeatpassword =$params['repeatPassword'];
        $email =$params['email'];
        if ($password !== $repeatpassword) {
            $return['message'] = $this->lang["password_nomatch"];

            return $return;
        }

        // Validate email
        $validateEmail = $this->validateEmail($email);

        if ($validateEmail['error'] == 1) {
            $return['message'] = $validateEmail['message'];

            return $return;
        }

        // Validate password
        $validatePassword = $this->validatePassword($password);

        if ($validatePassword['error'] == 1) {
            $return['message'] = $validatePassword['message'];

            return $return;
        }

        $zxcvbn = new Zxcvbn();
        if ($zxcvbn->passwordStrength($password)['score'] < intval($this->password_min_score)) {
            $return['message'] = $this->lang['password_weak'];

            return $return;
        }
        if ($this->isEmailTaken($email)) {
            $return['message'] = $this->lang["email_taken"];

            return $return;
        }
        $addUser = $this->addUser( $params);
        if ($addUser['error'] != 0) {
            $return['message'] = $addUser['message'];

            return $return;
        }
        $return['error'] = false;
        $return['message'] = ( $this->lang['register_success_emailmessage_suppressed'] );

        return $return;
    }




    /**
     * Logs out the session, identified by hash
     * @param string $hash
     * @return boolean
     */

    public function logout($hash)
    {
        if (strlen($hash) != 40) {
            return false;
        }

        return $this->deleteSession($hash);
    }

    /**
     * Hashes provided password with Bcrypt
     * @param string $password
     * @param string $password
     * @return string
     */

    public function getHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
    }

    /**
     * Gets UID for a given email address and returns an array
     * @param string $email
     * @return array|bool
     */


    public function getUID($email)
    {
        $query = $this->dbh->prepare("SELECT id FROM {$this->table_users} WHERE email = ?");
        $query->execute(array($email));

        if(!$row = $query->fetch(\PDO::FETCH_ASSOC)) {
            return false;
        }

        return $row['id'];
    }

    /**
     * Creates a session for a specified user id
     * @param int $uid
     * @param boolean $remember
     * @return array|bool
     */

    protected function addSession($uid, $remember)
    {
        $ip = $this->getIp();
        $user = $this->getBaseUser($uid);

        if (!$user) {
            return false;
        }

        $data['hash'] = sha1($this->key . microtime());
        $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

        $this->deleteExistingSessions($uid);

        if ($remember == true) {
            $data['expire'] = strtotime('+1 month');
        } else {
            $data['expire'] = strtotime('+30 minutes');
        }

        $data['cookie_crc'] = sha1($data['hash'] . $this->key);

        $query = $this->dbh->prepare("INSERT INTO {$this->table_sessions} (uid, hash, expiredate, ip, agent, cookie_crc) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$query->execute(array($uid, $data['hash'], date("Y-m-d H:i:s", $data['expire']), $ip, $agent, $data['cookie_crc']))) {
            return false;
        }

        setcookie($this->cookie_name, $data['hash'], $data['expire'], "/", NULL, 0, 0);
        $_COOKIE[$this->cookie_name] = $data['hash'];

        return $data;
    }

    /**
     * Removes all existing sessions for a given UID
     * @param int $uid
     * @return boolean
     */

    protected function deleteExistingSessions($uid)
    {
        $query = $this->dbh->prepare("DELETE FROM {$this->table_sessions} WHERE uid = ?");
        $query->execute(array($uid));

        return $query->rowCount() == 1;
    }

    /**
     * Removes a session based on hash
     * @param string $hash
     * @return boolean
     */

    protected function deleteSession($hash)
    {
        $query = $this->dbh->prepare("DELETE FROM {$this->table_sessions} WHERE hash = ?");
        $query->execute(array($hash));

        return $query->rowCount() == 1;
    }

    /**
     * Function to check if a session is valid
     * @param string $hash
     * @return boolean
     */

    public function checkSession($hash)
    {
        $ip = $this->getIp();



        if (strlen($hash) != 40) {
            return false;
        }

        $query = $this->dbh->prepare("SELECT id, uid, expiredate, ip, agent, cookie_crc FROM {$this->table_sessions} WHERE hash = ?");
        $query->execute(array($hash));

        if (!$row = $query->fetch(\PDO::FETCH_ASSOC)) {
            return false;
        }

        $uid = $row['uid'];
        $expiredate = strtotime($row['expiredate']);
        $currentdate = strtotime(date("Y-m-d H:i:s"));
        $db_ip = $row['ip'];
        $db_cookie = $row['cookie_crc'];

        if ($currentdate > $expiredate) {
            $this->deleteExistingSessions($uid);

            return false;
        }

        if ($ip != $db_ip) {
            return false;
        }

        if ($db_cookie == sha1($hash . $this->key)) {
            return true;
        }

        return false;
    }

    /**
     * Retrieves the UID associated with a given session hash
     * @param string $hash
     * @return int $uid
     */

    public function getSessionUID($hash)
    {
        $query = $this->dbh->prepare("SELECT uid FROM {$this->table_sessions} WHERE hash = ?");
        $query->execute(array($hash));

        if (!$row = $query->fetch(\PDO::FETCH_ASSOC)) {
            return false;
        }

        return $row['uid'];
    }

    /**
     * Checks if an email is already in use
     * @param string $email
     * @return boolean
     */

    public function isEmailTaken($email)
    {
        $query = $this->dbh->prepare("SELECT count(*) FROM {$this->table_users} WHERE email = ?");
        $query->execute(array($email));

        if ($query->fetchColumn() == 0) {
            return false;
        }

        return true;
    }

    /**
     * Adds a new user to database
     * @param string $email      -- email
     * @param string $password   -- password
     * @param array $params      -- additional params
     * @return int $uid
     */

    protected function addUser($params = array())
    {
        $return['error'] = true;

        $query = $this->dbh->prepare("INSERT INTO {$this->table_users} (isactive) VALUES (1)");

        if (!$query->execute()) {
            $return['message'] = $this->lang["system_error"] . " #03";
            return $return;
        }

        $uid = $this->dbh->lastInsertId("{$this->table_users}_id_seq");
        $email = htmlentities(strtolower($params['email']));


            $isactive = 1;


        $password = $this->getHash($params['password']);
        unset($params['password']);
        unset($params['repeatPassword']);
        unset($params['email']);
        if (is_array($params)&& count($params) > 0) {
            $customParamsQueryArray = Array();

            foreach($params as $paramKey => $paramValue) {
                $customParamsQueryArray[] = array('value' => $paramKey . ' = ?');
            }

            $setParams = ', ' . implode(', ', array_map(function ($entry) {
                    return $entry['value'];
                }, $customParamsQueryArray));
        } else { $setParams = ''; }

        $query = $this->dbh->prepare("UPDATE {$this->table_users} SET email = ?, password = ?, isactive = ? {$setParams} WHERE id = ?");

        $bindParams = array_values(array_merge(array($email, $password, $isactive), $params, array($uid)));

        if (!$query->execute($bindParams)) {
            $query = $this->dbh->prepare("DELETE FROM {$this->table_users} WHERE id = ?");
            $query->execute(array($uid));
            $return['message'] = $this->lang["system_error"] . " #04";

            return $return;
        }

        $return['error'] = false;
        return $return;
    }

    /**
     * Gets basic user data for a given UID and returns an array
     * @param int $uid
     * @return array|bool
     */

    protected function getBaseUser($uid)
    {
        $query = $this->dbh->prepare("SELECT email, password, isactive FROM {$this->table_users} WHERE id = ?");
        $query->execute(array($uid));

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        $data['uid'] = $uid;

        return $data;
    }

    /**
     * Gets public user data for a given UID and returns an array, password is not returned
     * @param int $uid
     * @return array|bool
     */

    public function getUser($uid)
    {
        $query = $this->dbh->prepare("SELECT * FROM {$this->table_users} WHERE id = ?");
        $query->execute(array($uid));

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        $data['uid'] = $uid;
        unset($data['password']);

        return $data;
    }


    /**
     * Allows a user to delete their account
     * @param int $uid
     * @param string $password
     * @return array $return
     */

    public function deleteUser($uid, $password)
    {
        $return['error'] = true;


        $validatePassword = $this->validatePassword($password);

        if ($validatePassword['error'] == 1) {
            $return['message'] = $validatePassword['message'];

            return $return;
        }

        $user = $this->getBaseUser($uid);

        if (!password_verify($password, $user['password'])) {
            $return['message'] = $this->lang["password_incorrect"];

            return $return;
        }

        $query = $this->dbh->prepare("DELETE FROM {$this->table_users} WHERE id = ?");

        if (!$query->execute(array($uid))) {
            $return['message'] = $this->lang["system_error"] . " #05";

            return $return;
        }

        $query = $this->dbh->prepare("DELETE FROM {$this->table_sessions} WHERE uid = ?");

        if (!$query->execute(array($uid))) {
            $return['message'] = $this->lang["system_error"] . " #06";

            return $return;
        }


        $return['error'] = false;
        $return['message'] = $this->lang["account_deleted"];

        return $return;
    }


    /**
     * Update an user
     * @param int $uid
     * @param string $password
     * @return array $return
     */

    public function updateUser($uid, $password,$fieldsToUpdate=array())
    {
        $return['error'] = true;

        $validatePassword = $this->validatePassword($password);

        if ($validatePassword['error'] == 1) {
            $return['message'] = $validatePassword['message'];

            return $return;
        }

        $user = $this->getBaseUser($uid);

        if (!password_verify($password, $user['password'])) {
            $return['message'] = $this->lang["password_incorrect"];

            return $return;
        }

        $user = $this->getUser($uid);
        $this->deleteUser($uid,$password);
        foreach ($fieldsToUpdate as $item=>$value){
            $user[$item]=$value;
        }

        $this->register($user);
        return $return;
    }



    /**
     * Verifies that a password is valid and respects security requirements
     * @param string $password
     * @return array $return
     */

    protected function validatePassword($password) {
        $return['error'] = true;
        if (strlen($password) < 3 ) {
            $return['message'] = $this->lang['password_short'];

            return $return;
        }

        $return['error'] = false;

        return $return;
    }

    /**
     * Verifies that an email is valid
     * @param string $email
     * @return array $return
     */

    public function validateEmail($email) {
        $return['error'] = true;

        if (strlen($email) < 5) {
            $return['message'] = $this->lang["email_short"];

            return $return;
        } elseif (strlen($email) > 100) {
            $return['message'] = $this->lang["email_long"];

            return $return;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $return['message'] = $this->lang["email_invalid"];

            return $return;
        }

            $bannedEmails = json_decode(file_get_contents(__DIR__. "/domains.json"));

            if (in_array(strtolower(explode('@', $email)[1]), $bannedEmails)) {
                $return['message'] = $this->lang["email_banned"];

                return $return;
            }


        $return['error'] = false;

        return $return;
    }




    /**
     * Returns a random string of a specified length
     * @param int $length
     * @return string $key
     */
    public function getRandomKey($length = 20)
    {
        $chars = "A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0U1V2W3X4Y5Z6a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6";
        $key = "";

        for ($i = 0; $i < $length; $i++) {
            $key .= $chars{mt_rand(0, strlen($chars) - 1)};
        }

        return $key;
    }

    /**
     * Returns IP address
     * @return string $ip
     */
    protected function getIp()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * Returns current session hash
     * @return string
     * @return boolean false if no cookie
     */
    public function getSessionHash(){
        return isset($_COOKIE[$this->cookie_name]) ? $_COOKIE[$this->cookie_name] : false;
    }

    /**
     * Returns is user logged in
     * @return boolean
     */
    public function isLogged() {
        if ($this->islogged === NULL) {
            $this->islogged = $this->checkSession($this->getSessionHash());
        }
        return $this->islogged;
    }

    /**
     * Gets user data for current user (from cookie) and returns an array, password is not returned
     * @return array|bool
     * @return boolean false if no current user
     */

    public function getCurrentUser()
    {
        if ($this->currentuser === NULL) {
            $hash = $this->getSessionHash();
            if ($hash === false) {
                return false;
            }

            $uid = $this->getSessionUID($hash);
            if ($uid === false) {
                return false;
            }

            $this->currentuser = $this->getUser($uid);
        }
        return $this->currentuser;
    }

    /**
     * Compare user's password with given password
     * @param int $userid
     * @param string $password_for_check
     * @return bool
     */
    public function comparePasswords($userid, $password_for_check)
    {
        $query = $this->dbh->prepare("SELECT password FROM {$this->table_users} WHERE id = ?");
        $query->execute(array($userid));

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        return password_verify($password_for_check, $data['password']);
    }


}
