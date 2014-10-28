<?php

	require_once('totsekkidbcon/ekkidbcon.php');
    require_once("solvemedialib.php");

    $registerName = '';
    $registerEmail = '';
    $registerError = '';

    $success = false;

    $optionsArray = [

        ["searchEngine", "Search Engine"],
        ["friend", "From a friend"],
        ["website", "Another website"],
        ["ads", "Advertisements"],
        ["other", "Other"]

    ];

    do{

        if(!empty($_POST['signupSend'])){

            // Ef notandinn hefur editað shit og submittað engu í dropdown box
            if(empty($_POST['dropDown'])){
                $registerError = "Please select where you heard about this site";
                
                if(!empty($_POST['signupName'])){
                    $registerName = $_POST['signupName'];
                }

                if(!empty($_POST['signupEmail'])){
                    $registerEmail = $_POST['signupEmail'];
                }

                break;
            }

            $heardAbout = $_POST['dropDown'];

            // Ef nafn er missing
            if(empty($_POST['signupName'])){
                $registerError = "Please enter your full name";

                if(!empty($_POST['signupEmail'])){
                    $registerEmail = $_POST['signupEmail'];
                }

                break;
            }


            // Ef email var ekki sláð inn
            if(empty($_POST['signupEmail'])){
                $registerError = "Please enter your email";

                if(!empty($_POST['signupName'])){
                    $registerName = $_POST['signupName'];
                }

                break;
            }

            // Ef password var ekki sláð inn
            if(empty($_POST['signupPass']))
            {
                $registerError = "Please enter your password";

                if(!empty($_POST['signupName'])){
                    $registerName = $_POST['signupName'];
                }

                if(!empty($_POST['signupEmail'])){
                    $registerEmail = $_POST['signupEmail'];
                }

                break;
            }

            // Ef password var ekki sláð inn
            if(empty($_POST['confirmPass']) || $_POST['signupPass'] != $_POST['confirmPass'])
            {
                $registerError = "Passwords do not match";

                if(!empty($_POST['signupName'])){
                    $registerName = $_POST['signupName'];
                }

                if(!empty($_POST['signupEmail'])){
                    $registerEmail = $_POST['signupEmail'];
                }

                break;
            }

            // Validate email
            if(!filter_var($_POST['signupEmail'], FILTER_VALIDATE_EMAIL))
            {
                $registerError = "Invalid email address";

                if(!empty($_POST['signupName'])){
                    $registerName = $_POST['signupName'];
                }

                break;
            }

            // --- Finna út hvort að emailið er in-use ---
            $query = "
                SELECT
                    1
                FROM users
                WHERE
                    email = :email
            ";

            $query_params = array(
                ':email' => $_POST['signupEmail']
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

            $row = $stmt->fetch();

            if($row){
                $registerError = "Email is already in use";

                if(!empty($_POST['signupName'])){
                    $registerName = $_POST['signupName'];
                }

                break;
            }
            // --- END ---

            // --- CAPTCHA ---
            $solvemedia_response = solvemedia_check_answer($privkey,
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["adcopy_challenge"],
                    $_POST["adcopy_response"],
                    $hashkey);
            if (!$solvemedia_response->is_valid) {
                $registerError = "CAPTCHA Incorrect";

                if(!empty($_POST['signupName'])){
                    $registerName = $_POST['signupName'];
                }

                if(!empty($_POST['signupEmail'])){
                    $registerEmail = $_POST['signupEmail'];
                }

                break;
            }

            // --- Register user ---
            $query = "
                INSERT INTO users (
                    fullName,
                    email,
                    heardAbout,
                    password,
                    salt
                ) VALUES (
                    :fullName,
                    :email,
                    :heardAbout,
                    :password,
                    :salt
                )
            ";

            // Generate-a 8-byte salt með hex
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 

            // Hasha passwordið með sha256 og saltinu
            $password = hash('sha256', $_POST['signupPass'] . $salt);

            // Hasha 65536 sinnum í viðbót því að afþvíbara
            for($i = 0; $i < 65536; $i++)
            {
                $password = hash('sha256', $password . $salt);
            }

            $query_params = array(
                ':fullName' => $_POST['signupName'],
                ':email' => $_POST['signupEmail'],
                ':heardAbout' => $heardAbout,
                ':password' => $password,
                ':salt' => $salt,
            );

            // Inserta
            try
            {
                $stmt = $pdo->prepare($query);
                $result = $stmt->execute($query_params);
            }
            catch(PDOException $ex)
            {
                die("Failed to run query: " . $ex->getMessage());
            }
            // --- END ---

            $success = true; 
        }

    }while(0);

    function createOptions($array){
        for ($i=0; $i < count($array); $i++) { 
            echo "<option value='" . $array[$i][0] . "'>" . $array[$i][1] . "</option>";
        }
    }