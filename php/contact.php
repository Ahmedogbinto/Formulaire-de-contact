<?php 

$array = array("firstname" => "", "name" => "", "email" => "", "phone" => "", "message" => "", "firstnameError" => "", "nameError" =>"", "phoneError" =>"", "messageError" => "","isSuccess" => false);                       // 1ère fois j'aimerais que les champs soient vident. 

$emailTo = "johnt613@johntaeib.com";




if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $array["firstname"] = test_input($_POST["firstname"]);                                                                                                                    // pour la deuxième fois j'aimerais sauvegarder les valeurs des champs.
    $array["name"] = test_input($_POST["name"]); 
    $array["email"] = test_input($_POST["email"]);
    $array["phone"] = test_input($_POST["phone"]);
    $array["message"] = test_input($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText="";

    if(empty($array["firstname"]))
    {
        $array["firstnameError"] = "Je veux connaitre ton prénom !";
        $array["isSuccess"] = false;
    }
    else
    {
        $emailText .= "Firstname: {$array['firstname']}\n";
    }

    if(empty($array["name"]))
    {
        $array["nameError"] = "Et oui je veux tout savoir, même ton nom !";
        $array["isSuccess"]  = false;
    }
    else
    {
        $emailText .= "Name: {$array["name"]}\n";
    }

    if(empty($array["message"]))
    {
        $array["messageError"] = "Qu'es ce tu veux me dire ?";
        $array["isSuccess"]  = false;
    }
    else
    {
        $emailText .= "Message: {$array['message']}\n";
    }

    if(!isEmail($array["email"]))
    {
        $array["emailError"] = "Tu essaies de me roubler? c'est pas un email ça ! :)";
        $array["isSuccess"]  = false;
    }
    else
    {
        $emailText .= "Email: {$array['email']}\n";
    }

    if(!isPhone($array["phone"]))
    {
        $array["phoneError"] = "Que des chiffres et des espaces stp...";
        $array["isSuccess"]  = false;
    }
    else
    {
        $emailText .= "Phone: {$array['phone']}\n";
    }

    if($array["isSuccess"])
    {
        $headers= "From: {$array['firstname']} {$array['name']} <{$array['email']}>\r\nReply-to: {$array['email']}";
        mail($emailTo, "le sujet de l'email", $emailText, $headers);                                                       // la fonction mail permet l'envoie d'email
    }

    echo json_encode($array);                                                                                              // Renvoyer le travail de cette partie Php en json vers le fichier
}

function isPhone($phone)
{
    return preg_match("/^[0-9 ]+$/", $phone);
}


function isEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function test_input($data)
{
    $data = trim($data);                                                           // Permet d eviter des injections de scripts, a partir de l URL pour la securite 
    $data = stripslashes($data);                                                  // supprimer les caracteres anti slashes
    $data = htmlspecialchars($data);                                               // supprimer les caracteres speciaux 

    return $data;
}

?>