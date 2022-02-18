<?php 

$firstname = $name = $email = $message = "";                                         // 1ère fois j'aimerais que les champs soient vident. 
$firstnameError = $nameError = $emailError = $phoneError = $messageError = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstname = verifyInput($_POST["firstname"]);                                 // pour la deuxième fois j'aimerais sauvegarder les valeurs des champs.
    $name = verifyInput($_POST["name"]);
    $email = verifyInput($_POST["email"]);
    $phone = verifyInput($_POST["phone"]);
    $message = verifyInput($_POST["message"]);

    if(empty($firstname))
    {
        $firstnameError = "Je veux connaitre ton prénom !";
    }
    if(empty($name))
    {
        $nameError = "Et oui je veux tout savoir, même ton nom !";
    }
    if(empty($message))
    {
        $messageError = "Qu'es ce tu veux me dire ?";
    }
    if(!isEmail($email))
    {
        $emailError = "Tu essaies de me roubler? c'est pas un email ça ! :)";
    }
    if(!isPhone($phone))
    {
        $phoneError = "Que des chiffres et des espaces stp...";
    }
}

function isPhone($var)
{
    return preg_match("/^[0-9 ]+$/", $var);
}


function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function verifyInput($var)
{
    $var = trim($var);                                                           // Permet d eviter des injections de scripts, a partir de l URL pour la securite 
    $var = stripcslashes($var);                                                  // supprimer les caracteres anti slashes
    $var = htmlspecialchars($var);                                               // supprimer les caracteres speciaux 

    return $var;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contactez-moi !</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    
        <link href="https:fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>

            <div class="row">
                
                <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">                                         
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">Prénom<span class="blue"> *</span></label>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom" value ="<?php echo $firstname; ?>">
                           
                            <p class="comments"><?php echo $firstnameError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="name">Nom<span class="blue"> *</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value ="<?php echo $name; ?>">
                            <p class="comments"><?php echo $nameError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="email">Email<span class="blue"> *</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Votre email" value ="<?php echo $email; ?>">
                            <p class="comments"><?php echo $emailError; ?></p>
                        </div>

                        <div class="col-md-6">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre téléphone" value ="<?php echo $phone; ?>">
                            <p class="comments"><?php echo $phoneError; ?></p>
                        </div>

                        <div class="col-md-12">
                            <label for="message">Message<span class="blue"> *</span></label>
                            <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"><?php echo $message; ?></textarea>
                            <p class="comments"><?php echo $messageError; ?></p>
                        </div>

                        <div class="col-md-12">
                            <p class="blue"><strong>* C'est infomations sont requises</strong></p>
                        </div>

                        <div class="col-md-12">
                            <input type="submit" class="button1" value="Envoyer">
                        </div>

                    </div>

                    <p class ="thank-you"> Votre message a bien été envoyé. Merci de m'avoir contacter :) </p>
                </form>
            </div> 

        </div>

    </body>

</html>
