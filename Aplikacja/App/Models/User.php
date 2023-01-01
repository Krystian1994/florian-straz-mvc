<?php

namespace App\Models;

use PDO;
use \App\Token;
use \App\Mail;
use \Core\View;


class User extends \Core\Model{
    public $errors = [];

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }


    public function save(){
        $this->validate();
        $this->recaptchaCheck();
        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'UPDATE users SET rank = :rank, position = :position, password = :password_hash, email = :email WHERE username = :username AND surname = :surname AND division = :division';

            $db = static::getDB();
            $stmt = $db->prepare($sql);
            
            $stmt->bindValue(':rank', $this->rank, PDO::PARAM_STR);
            $stmt->bindValue(':position', $this->position, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
            $stmt->bindValue(':division', $this->division, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        }

        return false;
    }

    private function recaptchaCheck(){
         //sprawdzamy recaptche
         $secret = '6LcA9_khAAAAAExJH8XKebdCC0-SwL6ZZh87eSZB';
         //łączymy się z serwerem googla w celu weryfikacji recaptchy
         $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
         //dekodujemy odpowiedź z formatu JSON
         $answer = json_decode($check);
         //sprawdzamy atrybut obiektu answer
         if($answer->success==false){
             $this->errors[] = 'Potwierdź, że nie jesteś botem.';
         }
    }

    public function validate(){
        // Name
        if ($this->username == '') {
            $this->errors[] = 'Imię jest wymagane';
        }

        // Surname
        if ($this->surname == '') {
            $this->errors[] = 'Nazwisko jest wymagane';
        }

        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Błędny email';
        }
        if (static::emailExists($this->email, $this->id ?? null)) {
            $this->errors[] = 'Podany email został użyty';
        }

        // Password
        if (isset($this->password)) {
            if (strlen($this->password) < 6) {
                $this->errors[] = 'Hasło musi zawierać minimum 6 znaków';
            }
    
            if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
                $this->errors[] = 'Hasło musi zawierać minimum jedną literę';
            }
    
            if (preg_match('/.*\d+.*/i', $this->password) == 0) {
                $this->errors[] = 'Hasło musi zawierać minimum jedną liczbę';
            }
        }

        // user exist?
        if($this->userExist()){
            $this->errors[] = 'Funkcjoraiusz o podanym Imieniu i Nazwisku dokonał rejestracji';
        }

        // is user from the unit?
        if($this->userFromUnit()){
            $this->errors[] = 'Funkcjonariusz nie jest przypisany do danej JRG';
        }
    }

    public function userFromUnit(){
        $sql = 'SELECT division FROM users WHERE username = :username AND surname = :surname';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
        $stmt->execute();

        $savePerson = $stmt->fetch();
        if(isset($savePerson['division'])){
            if($savePerson['division'] == $this->division){
                return false;
            }
        }
        return true;
    }

    public function userExist(){
        $sql = 'SELECT rank FROM users WHERE username = :username AND surname = :surname';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $this->surname, PDO::PARAM_STR);
        if($stmt->execute()){
            $person = $stmt->fetch();
            if(isset($person['rank'])){
                if($person['rank'] != ''){
                    return true;
                }
            }
        }
        return false;
    }

    public static function emailExists($email, $ignore_id = null){
        $user = static::findByEmail($email);

        if ($user) {
            if ($user->id != $ignore_id) {
                return true;
            }
        }

        return false;
    }

    public static function findByEmail($email){
        $sql = 'SELECT * FROM users WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function authenticate($email, $password){
        $user = static::findByEmail($email);
        
        if($user){
            if (password_verify($password, $user->password)) {
                return $user;
            }
            return false;
        }
        return false;
    
    }

    public static function findByID($id){
        $sql = 'SELECT * FROM users WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public function rememberLogin(){
        $token = new Token();
        $hashed_token = $token->getHash();
        $this->remember_token = $token->getValue();

        $this->expiry_timestamp = time() + 60 * 60 * 24 * 30;  // 30 days from now

        $sql = 'INSERT INTO remembered_logins (token_hash, user_id, expires_at)
                VALUES (:token_hash, :user_id, :expires_at)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $this->expiry_timestamp), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public static function sendPasswordReset($email){
        $user = static::findByEmail($email);

        if ($user) {

            if ($user->startPasswordReset()) {

                $user->sendPasswordResetEmail();

            }
        }
    }

    protected function startPasswordReset(){
        $token = new Token();
        $hashed_token = $token->getHash();
        $this->password_reset_token = $token->getValue();

        $expiry_timestamp = time() + 60 * 60 * 2;  // 2 hours from now

        $sql = 'UPDATE users
                SET password_reset_hash = :token_hash,
                    password_reset_expires_at = :expires_at
                WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', $expiry_timestamp), PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    protected function sendPasswordResetEmail(){
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/password/reset/' . $this->password_reset_token;

        $text = View::getTemplate('Password/reset_email.txt', ['url' => $url]);
        $html = View::getTemplate('Password/reset_email.html', ['url' => $url]);

        Mail::send($this->email, 'Password reset', $text, $html);
    }

    public static function findByPasswordReset($token){
        $token = new Token($token);
        $hashed_token = $token->getHash();

        $sql = 'SELECT * FROM users
                WHERE password_reset_hash = :token_hash';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {
            
            // Check password reset token hasn't expired
            if (strtotime($user->password_reset_expires_at) > time()) {

                return $user;
            }
        }
    }

    public function resetPassword($password){
        $this->password = $password;

        $this->validateReset();

        //return empty($this->errors);
        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'UPDATE users
                    SET password = :password_hash,
                        password_reset_hash = NULL,
                        password_reset_expires_at = NULL
                    WHERE id = :id';

            $db = static::getDB();
            $stmt = $db->prepare($sql);
                                                  
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
                                          
            return $stmt->execute();
        }

        return false;
    }

    public function updateProfile($data){
        if(isset($data['rank'])){
            $this->rank = $data['rank'];
        }
        
        if(isset($data['position'])){
            $this->position = $data['position'];
        }
        if(isset($data['division'])){
            $this->division = $data['division'];
        }
        
        $this->email = $data['email'];

        // Only validate and update the password if a value provided
        if ($data['password'] != '') {
            $this->password = $data['password'];
        }

        $this->validateEdit();

        if (empty($this->errors)) {

            $sql = 'UPDATE users SET email = :email';

            // Add password if it's set
            if (isset($this->password)) {
                $sql .= ', password = :password_hash';
            }

            if (isset($this->rank)) {
                $sql .= ', rank = :rank';
            }

            if (isset($this->position)) {
                $sql .= ', position = :position';
            }

            if (isset($this->division)) {
                $sql .= ', division = :division';
            }

            $sql .= "\nWHERE id = :id";


            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            // Add password if it's set
            if (isset($this->password)) {

                $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            }

            if (isset($this->rank)) {
                $stmt->bindValue(':rank', $this->rank, PDO::PARAM_STR);
            }

            if (isset($this->position)) {
                $stmt->bindValue(':position', $this->position, PDO::PARAM_STR);
            }

            if (isset($this->division)) {
                $stmt->bindValue(':division', $this->division, PDO::PARAM_STR);
            }

            return $stmt->execute();
        }

        return false;
    }

    public function validateEdit(){
        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Błędny email';
        }
        if (static::emailExists($this->email, $this->id ?? null)) {
            $this->errors[] = 'Podany email został użyty';
        }

        // Password
        if (isset($this->password)) {
            if (strlen($this->password) < 6) {
                $this->errors[] = 'Hasło musi zawierać minimum 6 znaków';
            }
    
            if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
                $this->errors[] = 'Hasło musi zawierać minimum jedną literę';
            }
    
            if (preg_match('/.*\d+.*/i', $this->password) == 0) {
                $this->errors[] = 'Hasło musi zawierać minimum jedną liczbę';
            }
        }
    }

    public function validateReset(){
        // Password
        if (isset($this->password)) {
            if (strlen($this->password) < 6) {
                $this->errors[] = 'Hasło musi zawierać minimum 6 znaków';
            }
    
            if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
                $this->errors[] = 'Hasło musi zawierać minimum jedną literę';
            }
    
            if (preg_match('/.*\d+.*/i', $this->password) == 0) {
                $this->errors[] = 'Hasło musi zawierać minimum jedną liczbę';
            }
        }
    }
}

