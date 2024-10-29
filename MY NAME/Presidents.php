<?php
    session_start(); 
    ob_start();
    $connection = new mysqli('localhost', 'root', '', 'syad_project_db');

    if(!$connection){
        // echo "Failed to connect to database:".$connection->connect_error;
    }
    else{

        if(isset($_POST['candidate-name']) && isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $inputValue = $_POST['candidate-name'];
            $id = $_SESSION['national_id'];
            
            $sql_update_value = "UPDATE candidate_votes SET president = '$inputValue' where national_id = '$id'";
            // $sql_update_mp = "UPDATE candidate_votes SET member_of_p = '$inputValue' where id = '$id'";
            // $sql_update_councillor = "UPDATE candidate_votes SET councillor = '$inputValue' where id = '$id'";
            
            if(mysqli_query($connection, $sql_update_value)){
                header("Location: MPs.php");
                exit();
            }else {
                echo "Error updating record: " . mysqli_error($connection);
            }

           
        }
         
            
        
    }
//    $connection->close();
    //   ob_end_flush(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Election System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <script defer src="func.js"></script>

    <style>
        :root{
            --gray-: gray;
            --darkgray-: rgb(80, 80, 80);
            --lightgray-: lightgray;
            --palegray-: rgba(211, 211, 211, 0.351);
            --white-: white;
        }
        /*------This part Defines the 'Poppins' google font-------*/
        /*NORMAL*/
        @font-face{
            font-family: 'Poppins';
            src: url('fonts/Poppins-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        /*------------------------------------------*/
        /*BOLD*/
        @font-face{
            font-family: 'Poppins';
            src: url('fonts/Poppins-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        /*-------------------------------------------------*/
        *{
            font-family: 'Poppins';
        }

        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .app-name {
            display: grid;
            grid-template-columns: 2fr .5fr;
            margin-top: 5%;
            align-items: center;            
            text-align: center;
        }

        .app-name h1 {
            height: auto;
            font-size: 3rem;
            color: var(--darkgray-);            
        }

        .app-name img {
            border-radius: 50%;
            object-fit: cover;
            width: 35%;
        }

        .app-name div {
            text-align: right;            
        }

        header,
        main {
            width: 87%;
            min-width: 1000px;
            max-width: 1300px;
            margin: auto;
        }

        main {
            padding-bottom: 5%;
        }

        main h2 {
            font-size: 2.5rem;
            margin: 0 0 5% 0;
            color: var(--darkgray-);
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        .voting-guide{             
            padding: 5%;
            margin-top: 5%;
            margin-bottom: 5%;            
            line-height: 2;
        }

        .voting-guide, .guide-navigation {
            border-radius: 10px;
            background-color: var(--lightgray-);
        }

        .voting-guide p {
            font-size: 18px;
            color: var(--darkgray-);
        }

        .voting-guide h3 {
            color: var(--darkgray-);
            font-size: 1.4rem;
        }

        .guide-navigation {
            margin-top: 8%;            
            padding: 2%;
            display: flex;
            justify-content: end;
        }

        button {
            padding: 1% 2%;
            border: none;
            background-color: var(--gray-);
            color: var(--white-);
            border-radius: 5px;
            cursor: pointer;
            margin-right: 1%;
        }

        button:hover{
            background-color: var(--darkgray-);
        }

        button:active{
            background-color: var(--glightray-);   
            border: 1pt solid var(--gray-);
            font-weight: 400;
            color: var(--darkgray-);
        }

        .candidate-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2%;            
        }

        .candidate-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: var(--lightgray-);            
            padding: 8% 2%;
            border-radius: 10px;
            box-shadow: 0 2px 4px var(--gray-);
            height: 100%;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;            
        }

        .candidate-card.selected {
            /* background-color: var(--darkgray-);  */
            border: 3pt solid var(--darkgray-);            
        }

        .candidate-card:hover {
            transform: translateY(-5px);
        }

        .candidate-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .candidate-picture img {
            width: 100%;
        }

        .candidate-info {
            text-align: center;
            margin-top: 5%;
        }

        .candidate-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin: 1% ;
        }

        .candidate-name, .party-name {
            color: var(--darkgray-);
        }                       

        .party-name {
            font-size: 1.1rem;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .candidate-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .candidate-grid {
                grid-template-columns: 1fr;
            }
        }

        .warning {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: var(--palegray-);
        }

        .warning-container {
            text-align: center;
            align-items: center;
            background-color: var(--darkgray-);
            margin: 15% auto;            
            box-shadow: 0px 0px 8px var(--darkgray-);            
            padding: 3%;
            height: 40%;
            border-radius: 5px;
            max-width: 25%;
        }       

        .warning-container p {
            font-size: 1.1rem;
            color: var(--lightgray-);
            font-weight: bold;
        }


        .close {
            color: var(--darkgray-);
            float: right;
            font-size: 15px;
            font-weight: lighter;
            width: 20%;            
            background-color: var(--white-);
            padding: 2%;
            border-radius: 4px;
        }

        .close:hover,
        .close:focus {
            color: var(--white-);
            text-decoration: none;
            background-color: var(--gray-);
            cursor: pointer;
        }

        .pop {
            border-radius: 100%;
            border: 1pt solid var(--darkgray-);
        }

        .go-up {
            position: fixed;
            bottom: 30px;
            right: 10px;
            width: 50px;
            float: right;
            margin-right: 100px;
            display: none;
        }
    </style>
</head>

<body>
    <header>
        <div class="app-name">
            <h1>MALAWI NATIONAL ELECTION SYSTEM </h1>
            <div>
                <img src="img/images.png" alt="">
            </div>
        </div>        
    </header>
    

    <main>
        <div class="voting-guide">
            <h3>HOW TO VOTE</h3>
            <p>Please follow the guidelines to help you through the voting process.</p>
            <h3>PART 1:</h3>
            <p>- Click on a Presidential Candidate of your choice below. <br>
                - Then click the <strong>Next</strong> button to confirm.
            </p>            
        </div>

        <h2>PRESIDENTIAL CANDIDATES</h2>

        <div class="out-candidate-grid">
            <div class="candidate-grid">
                <div onclick="divListener(1)" class="candidate-card">
                    <img src="img/kude.jpg" alt="Candidate Picture" class="candidate-picture">
                    <div class="candidate-info">
                        <div class="candidate-name">Mr. Alexander Kude</div>
                        <div class="party-name">Alexander Kude's Party (AKP)</div>
                    </div>
                    <div class="radio-circle"><img src="social_15707749.png" alt=""></div>
                </div>
                <div onclick="divListener(2)" class="candidate-card">
                    <img src="img/jackson.jpg" alt="Candidate Picture" class="candidate-picture" width="200px"
                        height="250px">
                    <div class="candidate-info">
                        <div class="candidate-name">Miss Chisomo Jackson</div>
                        <div class="party-name">The Jacksons (TJs)</div>
                    </div>
                    <div class="radio-circle"><img src="social_15707749.png" alt=""></div>
                </div>
                <div onclick="divListener(3)" class="candidate-card">
                    <img src="img/ireen.jpg" alt="Candidate Picture" class="candidate-picture">
                    <div class="candidate-info">
                        <div class="candidate-name">Miss Ireen Munthali</div>
                        <div class="party-name">The Famous Ireen (TFI)</div>
                    </div>
                    <div class="radio-circle"><img src="social_15707749.png" alt=""></div>
                </div>
            </div>
            <div class="guide-navigation">
                <button class="prev" id="prev">Home</button>
                <button class="next" id="next" >Next</button>
            </div>
        </div>

        <button class="go-up" id="g-up">GO UP</button>
    </main>
    <div class="warning" id="warning">
        <div class="warning-container">
            <img class="pop" src="img/images.png" alt="" width="100px">
            <br><br>
            <p>Click a Candidate to Continue</p>
            <br>
            <span class="close">OK</span>
        </div>
    </div>

    <form action="Presidents.php" method="post"  id="form" >
        <input type="hidden" id="candidate-name" name="candidate-name" value="">
        <input type="hidden" id="id" name="id" value="">
    </form>

  
    

    <script>
      
        function warn() {
            const warning = document.getElementById('warning');
            const close = document.getElementsByClassName('close')[0];

            warning.style.display = "block";

            close.onclick = function () {
                warning.style.display = "none";
            }

            window.onclick = function (event) {
                if (event.target == warning) {
                    warning.style.display = "none";
                }
            }
        }



        document.getElementById('next').addEventListener('click', function () {
            const selectedCard = document.querySelector('.candidate-card.selected');
            if (!selectedCard) {
                warn();
            } else {
                window.location.assign('MPs.php');
            }
        });

        document.getElementById('prev').addEventListener('click', function () {
            window.location.href = "landing.html";
        });

        const cards = document.querySelectorAll('.candidate-card');
        cards.forEach(card => {
            card.addEventListener('click', function () {
                cards.forEach(c => {
                    c.classList.remove('selected');
                    c.querySelector('.radio-circle').classList.remove('active');
                });
                card.classList.add('selected');
                card.querySelector('.radio-circle').classList.add('active');
            });
        });
        const form = document.getElementById('form');        
        let setCandidateName ="";
        let setId ="";
        function divListener(divID){            
            if(divID == 1){             
                setCandidateName = "President1";
                setId = "1";
            }
            if(divID == 2){
                setCandidateName = "President2";
                setId = "2";               
            }
            if(divID == 3){
                setCandidateName = "President3";
                setId = "3";                
            }
           
            document.getElementById('candidate-name').setAttribute("value", setCandidateName);
           document.getElementById('id').setAttribute("value", setId);
        }



        function formSubmit(){
            const form = document.getElementById('form');
            form.submit();
        }

            document.getElementById('next').addEventListener('click', function () {

        if (setCandidateName && setId) {
            formSubmit();
        } else {
            warn();
        }
        });

        

       
        


        // this is my thing

    </script>
  
</body>
</html>








