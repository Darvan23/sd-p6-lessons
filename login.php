<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    session_start();
require 'modules/database.php';
require 'modules/functions.php';
$errors =[];
$input = [];
const EMAIL_REQUIRED = "email invullen";
const EMAIL_INVALID = "Geldig email adres invullen";
const PASSWORD_INVALID = "password invullen";
const CREDENTIALS_NOT_INVALID = "Geldig email adres invullen";
if (isset($_post['login'])){
    $email = filter_input(type:INPUT_POST, var_name:'email', filter:FILTER_VALIDATE_EMAIL);

    if($email===false){
        $errors['email'] = EMAIL_REQUIRED;

    } else {
        $inputs['email'] = $email;
    }
}

$password = filter_input(type:INPUT_POST,var_name:'password');

if (empty($password)){
    $errors['password'] = PASSWORD_INVALID;
    
} else {
    $inputs['password'] = $password;
}

if (count($errors)=== 0){
    $result = checkLogin($inputs);
    switch ($result){
        case 'ADMIN':
            header(header:"Location:admin.php");
            break;
    }
}


?>
</head>

<body>
    <div>
        <form type="post" action="">
            <label>email<label>
                    <input type="email" class="form-control" name="email">
                    <label>password</label>
                    <input type="password" name="password" id="password">
                    <input type="submit" name="login" value="login">
        </form>
    </div>
</body>

</html>