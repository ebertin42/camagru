<?php
  	require_once "assets/header.php";

	if(isset($_POST["go"])) {
    	if (isset($_POST["login"]) && isset($_POST["email"]) &&
			isset($_POST["pass"]) && isset($_POST["rpass"])) {
					echo "<pre>";
					print_r($_POST);
					echo "</pre>";
        	$login = htmlspecialchars(htmlentities($_POST["login"]));
			$email = htmlspecialchars(htmlentities($_POST["email"]));
			$pass = htmlspecialchars(htmlentities($_POST["pass"]));
			$rpass = htmlspecialchars(htmlentities($_POST["rpass"]));


			$verif = $dbh->prepare("SELECT * FROM `users` WHERE `name` = ? OR `email` = ?;");
			$verif->execute(array($login, $email));
			if (!($verif->rowCount())) {
				if(preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
					if (validate_pass($pass)) {
						if ($pass == $rpass) {
							$hash_pass = my_hash($pass);
							$rd_str = generate_random_string();
							$request = $dbh->prepare("INSERT INTO `users` (`name`, `pwd`, `email`, `token_mail`) VALUES (?, ?, ?, ?)");
							$request->execute(array($login, $hash_pass, $email, $rd_str));
                            sendConfirmMail($rd_str, $email, $login);
						}
						else
							$error = "The two Passwords need to be the same";
					}
					else
						$error = "Syntax error for Password. You need, at least 8-42 chars, one uppercase, one lowercase and one digit OKEY !? ";
				}
				else
					$error = "Syntax error for email";
			}
			else
				$error = "A user with this name or this email already exist !";
        }
        else
          $error = "You don't fill all field. PLS do it. Or die. Fckr.";
	}
?>
<?php if(isset($ok)){ ?>
    <div class="alert alert-success">
        <span class="alert-link">Year :) !</span> <?php echo (isset($ok)) ? $ok : ''; ?>
    </div>
<?php }
if (isset($error)){
    ?>
    <div class="alert alert-danger">
        <span class="alert-link">Oh No :( ! </span> Error : <?php echo (isset($error)) ? $error : ''; ?>
    </div>
<?php }?>
<form method="POST" action="#">
    <div class="field is-horizontal">
      <div class="field-label is-normal">
      </div>
      <div class="field-body">
        <div class="field">
          <p class="control is-expanded has-icons-left">
            <input class="input" type="text" name="login" placeholder="Login" required>
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control is-expanded has-icons-left has-icons-right">
            <input class="input" type="email" name="email" placeholder="Email" required>
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
          </p>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label is-normal">
      </div>
      <div class="field-body">
        <div class="field">
          <p class="control is-expanded has-icons-left">
            <input class="input" type="password" name="pass" placeholder="Password" required>
            <span class="icon is-small is-left">
              <i class="fas fa-lock-open"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <p class="control is-expanded has-icons-left has-icons-right">
            <input class="input" type="password" name="rpass" placeholder="Re-type Password" required>
            <span class="icon is-small is-left">
              <i class="fas fa-lock-open"></i>
            </span>
          </p>
        </div>
      </div>
    </div>

    <div class="field is-horizontal">
      <div class="field-label">
        <!-- Left empty for spacing -->
      </div>
      <div class="field">
          <input class="button is-primary" type="submit" name="go" value="Register">
      </div>
    </form>
<?php
  require_once "assets/footer.php";
?>
