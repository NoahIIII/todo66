<?php


function ValidateName($name,&$errors)
{
    if(empty($name))
    {
        $errors[]='name is requierd';
        return false;

    }
    else if (strlen($name)<=2)
    {
         $errors[]='name must be greater than 2 chars';
         return false;

    }
    else if(strlen($name)>20)
    {
      $errors[]='name must be smaller than 20 chars';
      return false;

    }
    else{
        return true;
    }
}
function ValidateEmail($email,&$errors)
{
 if(empty($email))
 {
     $errors[]='email is requierd';
     return false;

 }
 else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
 {
     $errors[]='Invalid email';
     return false;

 }
 else  
 {
    return true;
 }
}
function ValidatePassword($password,&$errors)
{
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{8,16}$/';
    if (preg_match($pattern, $password))
    {
        return true;
    }
    else if(strlen($password) < 8)
    {
         $errors[]='Password should be at least 8 chars';
         return false;

    }
    else if (strlen($password) > 16)
    {
         $errors[]='Password must be less than 16 chars';
         return false;

    }
    else if(!preg_match('/[A-Z]/', $password))
    {
         $errors[]='Password should contain at least one capital char';
         return false;

    }
    else if(!preg_match('/[a-z]/', $password))
    {
         $errors[]='Password should contain at least one small char';
         return false;

    }
    else if(!preg_match('/[^\w\s]/', $password))
    {
         $errors[]='Password should contain at least one special char';
         return false;
    }
    
}

function ConfirmPssword($con,$password_user,$id)
{
    $sql= $con->query("SELECT password from users where id = $id;");
    $db_password= $sql->fetchColumn(PDO::FETCH_DEFAULT);
    if(password_verify($password_user,$db_password))
    {
        return true;
    }
    else
    {
        return false;
    }

}
function EmailExist($con,$new_email,$errors)
{
    $sql= $con->query("SELECT email from users;");
    $emails = $sql->fetchall(PDO::FETCH_ASSOC);
    foreach($emails as $email)
    {
        if($email==$new_email)
        {
            $errors[]='Email already exists';
            return false;
        }
    }
    return true;

}
function TaskLength($input,$errors)
{
    if(strlen($input)>250)
    {
        $errors[]='task can not be more than 250 chars';
        return false;
    }
    else if(empty($input))
    {
        $errors[]='the new task can not be empty';
        return false;
    }
    else
    {
        return true;
    }
}
function EmailNotExist($con,$new_email,$errors)
{
    $sql= $con->query("SELECT email from users;");
    $emails = $sql->fetchall(PDO::FETCH_ASSOC);
    foreach($emails as $email)
    {
        if($email==$new_email)
        {
            return true;
        }
    }
    $errors[]='email does not exist';
    return false;


}