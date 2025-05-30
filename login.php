<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>inloggen</title>
 
   
   
   <?php
    session_start();
require 'modules/database.php';
require 'modules/functions.php';
$errors =[];
$input = [];
const EMAIL_REQUIRED = "email invullen";
const EMAIL_INVALID = "Geldig email adres invullen";
const PASSWORD_INVALID = "password invullen";
const CREDENTIALS_NOT_INVALID = "verkeerd email en/of password";
if (isset($_post['login'])){
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if($email===false){
        $errors['email'] = EMAIL_REQUIRED;

    } else {
        $inputs['email'] = $email;
    }
}

$password = filter_input(INPUT_POST,'password');

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
            case 'FAILURE':
                $errors['credentials'] = CREDENTIALS_NOT_INVALID;
                include_once "login.php";
                break;
    }
}


?>   
<div class="container-lg">
        <h4>Inloggen</h4>
        <?php
        if(!empty($error['credentials'])):?>
        <div class="alert alert-danger"><?$errors['credentials']??''?></div>
    </div>
    <?php endif; ?>
</head>

<body>
        <form type="post" action="">
            <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email address<label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $inputs['email']??''?>">
               
            </div>
              <div class="mb-3 mt-3">
                    <label for="password" class="form-label">password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    
                     <div class="form-text text-danger">
                    <?=$errors['password']??''?>
                </div>
               </div>
        <button type="submit" name="login" value="login" class="btn btn-primary mb-5">Login</button> 
    </form>
    
</body>

</html>