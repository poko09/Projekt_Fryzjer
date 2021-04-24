<?php

    session_start();
    
    $conn = new mysqli('localhost', 'root', '', 'projekt_fryzjer');
    

    if($conn->connect_errno!=0)
    {
        echo "Error: ".$conn->connect_errno;
    }

    else 
    {       
        if(isset($_POST['email']))
        {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $wszystko_ok = true;

            if(strlen($firstName)<3 || strlen($firstName)>25){
                $wszystko_ok=false;
                $_SESSION['e_name']="Imie musi miec od 3 do 25 znakow!";
            }
            if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
                $wszystko_ok=false;
                $_SESSION['e_name']="Niepoprawny format imienia";
              }
    
            if (empty($firstName)) {
                 $wszystko_ok=false;
                 $_SESSION['e_name']="Uzupełnij pole!";
            }

            if((strlen($lastName)<3) || (strlen($lastName)>20)) {
                $wszystko_ok = false;
                $_SESSION['e_lastName']="Nazwisko musi miec od 3 do 25 znakow!";
            }
            if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
                $wszystko_ok=false;
                $_SESSION['e_lastName']="Niepoprawny format nazwiska!";
              }
            if (empty($lastName)) {
                $wszystko_ok=false;
                $_SESSION['e_lastName']="Uzupełnij pole!";
               }
    
            $emailB=filter_var($email, FILTER_SANITIZE_EMAIL);
    
            if(filter_var($emailB, FILTER_VALIDATE_EMAIL)==false ||($emailB!= $email)) {
                $wszystko_ok=false;
                $_SESSION['e_email']="Niepoprawny format emailu!";
            }
            if (empty($email)) {
                $wszystko_ok=false;
                $_SESSION['e_email']="Uzupełnij pole!";
            }   
            
            if (empty($number)) {
            $wszystko_ok=false;
            $_SESSION['e_number']="Uzupełnij pole!";
            }
            if (empty($date)) {
            $wszystko_ok=false;
            $_SESSION['e_date']="Uzupełnij pole!";
            }
            if (empty($time)) {
                $wszystko_ok=false;
                $_SESSION['e_time']="Uzupełnij pole!";
            }
            
            if(isset($_POST['option1'])){
                $option1 = $_POST['option1']; 
           }
           else {
               $wszystko_ok=false;
               $_SESSION['e_option1']="Uzupełnij pole!";
           }
    
           if ($wszystko_ok == true) {
                if($conn->query("INSERT INTO oferta VALUES ('$firstName', '$lastName', '$email', '$number', '$date', '$time', '$option1' )"))
                {
                    $_SESSION['udane']==true;
                    header('Location: formularz.php');
                }
                else 
                {
                    throw new Exception($conn->error);
                }
           }
        
            $conn->close();

    }
}
?>

<!DOCTPYE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta name = "descrtiption" content = "Najlepszy salon fryzjerski" > 
        
        <title>
            Twój Fryzjer
        </title>
    </head>
    <body>
        
       
    </body>

   <style>
  
        /* kolor t≥a */ 
        body {
            margin-left: auto;
            margin-right: auto;

            background-image: url("tlo_formularz.jpg");
            height: auto;
            font-family: Verdana;
            text-align: center;
        }
  
        /* cechy samego kwestionariusza */
        form {
            background-color: rgb(81, 70, 238);
            background: url('https://haircutbyhugo.com/wp-content/uploads/2019/01/hairdresser.jpg');
           
          
            border: 2px solid rgb(247, 249, 250);
            opacity:1;
            max-width: 500px;
            border-radius: 10px;
            margin: 50px auto;
            padding: 20px 15px;
            box-shadow: 2px 5px 10px rgba(221, 221, 233, 0.884);
        }
  
        /* napis w kwestionariuszu */
        .form-control {
            text-align: left;
            margin-bottom: 25px;
        }
  
        /* miejsce do wpisywania danych */ 
        .form-control label {
            display: inline-box;
            margin-bottom: 5px;
        }
  
        /* ramki boxow do wpisywania danych */
        .form-control input,
        .form-control select,
        .form-control textarea {
            border: 2px solid rgb(252, 254, 255);
            
            border-radius: 10px;
            font-family: inherit;
            padding: 10px;
            display: block;
            width: 75%;
        }
  
        /* button zatwierdzajĻcy */
        .form-control input[type="radio"],
        .form-control input[type="checkbox"] {
            display: inline-block;
            
            width: auto;
        }
  
        /* przycisk zatwierdzajĻcy */
        button {
            background-color: #fcf5f5;
            border: 1px solid rgb(12, 0, 0);
            border-radius: 10px;
            font-family: inherit;
            font-size: 25px;
            display: block;
            width: 100%;
            margin-top: 50px;
            margin-bottom: 20px;
        }
        .error
        {
            color:red;
        font-size: small;
        }
            
        
    </style>
    <body>
        <h1><p style="color: white;">Zapisz się na wizytę!</p></h1>
      
        <!-- Create Form -->
        <form  method="post">
            
            <!-- szczegóły -->
            <div class="form-control">
                <label for="name" id="label-name">
                <b>
                    <p style="color: white;">Imię</p></b>
                </label>
      
                <!-- typ pola -->
                <input type="text"
                       id="name"
                       placeholder="Wpisz swoje imię"
                       name="firstName"/>
                       <?php
                    if(isset($_SESSION['e_name']))
                    {
                        echo '<div class="error">'.$_SESSION['e_name'].'</div>';
                        unset($_SESSION['e_name']);
                    }
                ?>
            </div>
            <div class="form-control">
                <label for="surname" id="label-name">
                    <b>
                        <p style="color: white;">Nazwisko</p></b>
                </label>
      
                <!-- typ pola -->
                <input type="text"
                       id="surname"
                       placeholder="Wpisz swoje nazwisko"
                       name="lastName" />
                       <?php
                    if(isset($_SESSION['e_lastName']))
                    {
                        echo '<div class="error">'.$_SESSION['e_lastName'].'</div>';
                        unset($_SESSION['e_lastNname']);
                    }
                ?>
            </div>
       
            <div class="form-control">
                <label for="email" id="label-email">
                    <b>
                        <p style="color: white;">Email</p></b>
                </label>
      
                <!-- typ pola Email-->
                <input type="email"
                       id="email"
                       placeholder="Wpisz swój email"
                       name="email" />
                       <?php
                    if(isset($_SESSION['e_email']))
                    {
                        echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                        unset($_SESSION['e_email']);
                    }
                ?>
            </div>
            <div class="form-control">
                <label for="phone" id="label-phone">
                    <b>
                        <p style="color: white;">Telefon</p></b>
                </label>
      
                <!-- typ pola Text -->
                <input type="text"
                       id="phone"
                       placeholder="Podaj swoj numer telefonu np. 000-000-000"
                       pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}"
                       name="number" />
                       <?php
                    if(isset($_SESSION['e_number']))
                    {
                        echo '<div class="error">'.$_SESSION['e_number'].'</div>';
                        unset($_SESSION['e_number']);
                    }
                ?>
            </div>
            <div class="form-control">
                <label for="date" id="label-date">
                    <b>
                        <p style="color: white;">Data wizyty</p></b>
                </label>
      
                <!-- typ pola Text -->
                <input type="date"
                       id="date"
                       placeholder="Podaj datÍ wizyty" 
                       min="2021-04-21"
                       max="2022-06-31"
                       name="date"/>
                       <?php
                    if(isset($_SESSION['e_date']))
                    {
                        echo '<div class="error">'.$_SESSION['e_date'].'</div>';
                        unset($_SESSION['e_date']);
                    }
                ?>
            </div>
            <div class="form-control">
                <label for="time" id="label-time">
                    <b>
                        <p style="color: white;">Godzina wizyty</p></b>
                </label>
      
                <!-- typ pola Text -->
                <input type="time"
                       id="time"
                       placeholder="Podaj godzinę wizyty" 
                       min="08:00"
                       max="20:00"
                       name="time"/>
                       <?php
                    if(isset($_SESSION['e_time']))
                    {
                        echo '<div class="error">'.$_SESSION['e_time'].'</div>';
                        unset($_SESSION['e_time']);
                    }
                ?>
            </div>
            
            <!-- ZERKNAC TUTAJ KONIECZNIE!
            <div class="form-control">
                <label for="role" id="label-role">
                    <b>
                        <p style="color: white;">Wybierz cel wizyty</p></b>
                </label>
            -->  
                <!-- lista -->
       
            <div class="form-control" style="color: white;">
                <label for="option1">Sposób strzyżenia</label>
                <div>
                    <label for="broda" class="radio-inline"
                    ><input
                        type="radio"
                        name="option1"
                        value="brodaryzura"
                        id="broda"
                    />Broda (50 zł)</label
                    
                    >
                    
                    <br>
                    <label for="fryzura" class="radio-inline"><input
                        type="radio"
                        name="option1"
                        value="f"
                        id="fryzura"
                    />Fryzura (50 zł)</label>
                    <br>
                    <label for="inne" class="radio-inline"><input
                        type="radio"
                        name="option1"
                        value="inne"
                        id="inne"
                    />Broda + Fryzura (100 zł)</label>
                    <?php
                    if(isset($_SESSION['e_option1']))
                    {
                        echo '<div class="error">'.$_SESSION['e_option1'].'</div>';
                        unset($_SESSION['e_option1']);
                    }
                ?>
                </div>
            </div>
            </div>
            <div class="form-control">
                <label for="comment">
                    <b>
                        <p style="color: white;">Komentarze do rezerwacji</p></b>
                </label>
      
                <!-- dodatkowe pole -->
                <textarea name="comment" id="comment"
                    placeholder="Dodatkowe zyczenia lub prośby">
                </textarea>
            </div>
       
            <!-- dodatkowe pole -->
            <button type="submit" value="submit">
                Zapisz się!
            </button>
        </form>
    </body>


    
</html>