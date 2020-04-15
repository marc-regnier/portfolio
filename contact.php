<?php 

    $tab = (["firstname"=> "", "name"=> "", "email"=> "", "phone"=> "", "message"=> "", 
    "firstnameError"=> "", "nameError"=> "", "emailError"=> "", "phoneError"=> "", "messageError"=> "", "isSucess"=> false]);

    $emailTo = "marc.reg083@gmail.com";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $tab['firstname'] = $_POST["firstname"];
        $tab['name'] = $_POST["name"];
        $tab['email'] = $_POST["email"];
        $tab['phone'] = $_POST["phone"];
        $tab['message'] = $_POST["message"];
        $tab['isSuccess'] = true;

    if(empty($tab['firstname']))
    {
        $tab['firstnameError'] = "Comment tu t'appelle ?";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailTo .= "Firstname: {$tab['firstname']}\n";
    }

    if(empty($tab['name']))
    {
        $tab['nameError'] = "Je veux juste savoir ton prénom";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailTo .= "Name: {$tab['name']}\n";
    }

    if(!isEmail($tab['email']))
    {
        $emailError = "Je veux juste savoir ton email";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailTo .= "Email: {$tab['email']}\n";
    }

    if(!isPhone($tab['phone']))
    {
        $tab['phoneError'] = "Je veux juste savoir ton phone";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailTo .= "Téléphone: {$tab['phone']}\n";
    }

    if(empty($tab['message']))
    {
        $tab['messageError'] = "Ecris-moi un petit mot";
        $tab['isSuccess'] = false;
    }
    else
    {
        $emailTo .= "Message: {$tab['message']}\n";
    }

    if($isSuccess){
        $headers = "FROM: {$tab['firstname']} {$tab['name']} <$email>\r\nReply-To: {$tab['email']}";
        mail($emailTo, "Un message de votre site", $emailTo, $headers);
    }
    echo json_encode($tab);
}
    function isPhone($var)
    {
    return preg_match("/^[0-9]*$/", $var);
    }


    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }


    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

?>
