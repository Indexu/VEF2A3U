<?php

	require_once('totsekkidbcon/ekkidbcon.php');

	$submitted_username = '';
    $error = '';

	if(!empty($_POST['login'])){
		// Ná í upplýsingar
		$query = "
            SELECT
                userID,
                fullName,
                email,
                password,
                salt
            FROM users
            WHERE
                email = :email
        ";

        $query_params = array(
            ':email' => $_POST['loginEmail']
        );
        
        try
        {
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }

        $login_ok = false;

        $row = $stmt->fetch();

        if($row){
            // Password check
            $check_password = hash('sha256', $_POST['loginPass'] . $row['salt']);
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            }

            // Ef password er rétt
            if($check_password === $row['password']){
                $login_ok = true;
            }
        }

        if($login_ok){
            // Losna við salt og password
            unset($row['salt']);
            unset($row['password']);

            $_SESSION['user'] = $row;
            $_SESSION['timeout'] = time();

            header("Location: index.php");
            die("Redirecting to front page"); 
        }

        else{
            $error = "Login Failed.";
            $submitted_username = htmlentities($_POST['loginEmail'], ENT_QUOTES, 'UTF-8');
        }
	}