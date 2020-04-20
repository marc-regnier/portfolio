<?php 

    $tab = array("firstname"=> "", "name"=> "", "email"=> "", "phone"=> "", "message"=> "", 
    "firstnameError"=> "", "nameError"=> "", "emailError"=> "", "phoneError"=> "", "messageError"=> "", "isSuccess"=> false);

    $emailTo = "marc.reg083@gmail.com";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $tab['firstname'] = verifyInput($_POST["firstname"]);
        $tab['name'] =  verifyInput($_POST["name"]);
        $tab['email'] =  verifyInput($_POST["email"]);
        $tab['phone'] =  verifyInput($_POST["phone"]);
        $tab['message'] =  verifyInput($_POST["message"]);
        $tab['isSuccess'] = true;
        $emailText = "";

    if(empty($tab['firstname']))
    {
        $tab['firstnameError'] = "Comment tu t'appelle ?";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailText .= "Firstname: {$tab['firstname']}\n";
    }

    if(empty($tab['name']))
    {
        $tab['nameError'] = "Je veux juste savoir ton prénom";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailText .= "Name: {$tab['name']}\n";
    }

    if(!isEmail($tab['email']))
    {
        $emailError = "Je veux juste savoir ton email";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailText .= "Email: {$tab['email']}\n";
    }

    if(!isPhone($tab['phone']))
    {
        $tab['phoneError'] = "Je veux juste savoir ton phone";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailText .= "Téléphone: {$tab['phone']}\n";
    }

    if(empty($tab['message']))
    {
        $tab['messageError'] = "Ecris-moi un petit mot";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailText .= "Message: {$tab['message']}\n";
    }

    if($isSuccess){
        $headers = "FROM: {$tab['firstname']} {$tab['name']} <{$tab['email']}>\r\nReply-To: {$tab['email']}";
        mail($emailTo, "Un message de votre site", $emailText, $headers);
    }
    echo json_encode($tab);
}
    function isPhone($phone)
    {
    return preg_match("/^[0-9]*$/", $phone);
    }


    function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

?>
