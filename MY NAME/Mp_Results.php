<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results Dashboard</title>
    <style>
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
            font-family: 'POPPINS','FIGTREE','LEXEND DECA','MONTSERRAT',sans-serif;
        }
        body {
            scale: 0.9;
            background-color: #f4f4f4;
            margin: 0;
            padding-top: 1%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
    
        }
        h1{
            font-size: 2.5rem;
        }

        .dashboard {
            background-color: #ddd;
            padding: 60px;
            border-radius: 10px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto;
            gap: 20px;
            width: 800px;
            max-width: 100%;
        }

        .candidate-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .candidate-info {
            display: flex;
            align-items: center;
        }

        .candidate-info img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .candidate-info .name {
            font-size: 18px;
            font-weight: bold;
        }

        .candidate-info .party {
            font-size: 14px;
            color: #888;
        }

        .vote-percentage {
            margin: 15px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .vote-bar {
            height: 10px;
            width: 100%;
            background-color: #ddd;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
        }

        .navBtns{
            display: flex;
            flex-direction: row;
            width: 100%;
            grid-column-start: 1;
            grid-column-end: 4;
            gap: 5%;
        }
        .navBtns button{
            width: 90%;
            padding: 1%;
            border-radius: 10px;
        }
        .navBtns button a{
            text-decoration: none;
            color: black;
            font-size: 1rem;
        }

        .bar {
            height: 100%;
            transition: width 0.5s ease;
        }

        .bar.blue {
            background-color: blue;
        }

        .bar.red {
            background-color: red;
        }

        .bar.green {
            background-color: green;
        }

        /* Chart container */
        .graph-container {
            grid-column: span 3;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        canvas {
            width: 100% !important;
            height: 300px !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
   <h1>MEMBERS OF PARLIAMENT RESULTS</h1>
    <div class="dashboard">
        <!-- Candidate 1 -->
        <div class="candidate-card">
            <div class="candidate-info">
                <img src="img/chipo.jpg" alt="mp1">
                <div>
                    <div class="name">Miss Chiposa Chiomba</div>
                    <div class="party">TJ's</div>
                </div>
            </div>
            <div class="vote-percentage" id="mp1-percentage">30%</div>
            <div class="vote-bar">
                <div class="bar blue" id="mp1-bar" style="width: 30%;"></div>
            </div>
            <div id="mp1-votes">Total Votes: 650,000</div>
        </div>

        <!-- Candidate 2 -->
        <div class="candidate-card">
            <div class="candidate-info">
                <img src="img/major.jpg" alt="Pr. mp2 Spade">
                <div>
                    <div class="name">Major Nthala</div>
                    <div class="party">TFI</div>
                </div>
            </div>
            <div class="vote-percentage" id="mp2-percentage">25%</div>
            <div class="vote-bar">
                <div class="bar red" id="mp2-bar" style="width: 25%;"></div>
            </div>
            <div id="mp2-votes">Total Votes: 600,000</div>
        </div>

        <!-- Candidate 3 -->
        <div class="candidate-card">
            <div class="candidate-info">
                <img src="img/thumbiko.jpg" alt="mp3">
                <div>
                    <div class="name">Thumbiko Banda</div>
                    <div class="party">AKP</div>
                </div>
            </div>
            <div class="vote-percentage" id="mp3-percentage">17%</div>
            <div class="vote-bar">
                <div class="bar green" id="mp3-bar" style="width: 17%;"></div>
            </div>
            <div id="mp3-votes">Total Votes: 40,000</div>
        </div>

        <!-- Bar Graph (Chart.js) -->
        <div class="graph-container">
            <canvas id="electionChart"></canvas>
        </div>
        <div class="navBtns">
            <button><a href="login.php">Go to Login</a></button>
            <button><a href="President_results.php">Check Presidential Results</a></button>
            <button><a href="Councillor_Results.php">Check Councillors Results</a></button>
        </div>
    </div>
    <?php
        $connection = new mysqli('localhost', 'root', '', 'syad_project_db');

        if(!$connection){
            echo "Failed to connect to database:".$connection->connect_error;
        }        
        else{     

            $sql_count_mp2_votes = "SELECT COUNT(*) FROM candidate_votes WHERE member_of_p = 'Mp2'";            
            $mp2_votes = mysqli_query($connection, $sql_count_mp2_votes);
            $mp2_results = mysqli_fetch_array($mp2_votes)[0]; // Access directly by index

            $sql_count_mp3_votes = "SELECT COUNT(*) FROM candidate_votes WHERE member_of_p = 'Mp3'";            
            $mp3_votes = mysqli_query($connection, $sql_count_mp3_votes);
            $mp3_results = mysqli_fetch_array($mp3_votes)[0]; // Access directly by index

            $sql_count_mp1_votes = "SELECT COUNT(*) FROM candidate_votes WHERE member_of_p = 'Mp1'";            
            $mp1_votes = mysqli_query($connection, $sql_count_mp1_votes);
            $mp1_results = mysqli_fetch_array($mp1_votes)[0]; // Access directly by index
            
            // Count all rows
            $sql_count_all_votes = "SELECT COUNT(*) FROM candidate_votes";
            $all_votes = mysqli_query($connection, $sql_count_all_votes);
            $all_results = mysqli_fetch_array($all_votes)[0];
           
        }
    ?>

    <script>
        const ctx = document.getElementById('electionChart').getContext('2d');
        const electionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ms Chiposa Chiomba (TJs)', 'Mr Major Nthala (TFI)', 'Mr Thumbiko Banda (AKP)'],
                datasets: [{
                    label: 'Vote Percentage',
                    data: [0, 0, 0],  // Initial percentages
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)', // Blue for PDP
                        'rgba(255, 99, 132, 0.8)',  // Red for Mbakuwaku Party
                        'rgba(75, 192, 192, 0.8)'   // Green for UDG
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 2.
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Vote Percentage'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

    
        function fetchVotes() {
            const allVotes = <?php echo $all_results ?>;
            const mp2Votes = <?php echo $mp2_results ?>;  
            const mp1Votes = <?php echo $mp1_results ?>;  
            const mp3Votes = <?php echo $mp3_results ?>;  
            
            const voteData = {
                mp1: {
                    votes: mp1Votes,
                    percentage:( (mp1Votes/allVotes)*100).toFixed(2)  
                },
                mp2: {
                    votes: mp2Votes,
                    percentage: ((mp2Votes/allVotes)*100).toFixed(2)   
                },
                mp3: {
                    votes: mp3Votes,
                    percentage: ((mp3Votes/allVotes)*100).toFixed(2)   
                }
            };

            // Update mp1's data
            document.getElementById('mp1-percentage').textContent = voteData.mp1.percentage + '%';
            document.getElementById('mp1-bar').style.width = voteData.mp1.percentage + '%';
            document.getElementById('mp1-votes').textContent = 'Total Votes: ' + voteData.mp1.votes.toLocaleString();

            // Update Pr. mp2 Spade's data
            document.getElementById('mp2-percentage').textContent = voteData.mp2.percentage + '%';
            document.getElementById('mp2-bar').style.width = voteData.mp2.percentage + '%';
            document.getElementById('mp2-votes').textContent = 'Total Votes: ' + voteData.mp2.votes.toLocaleString();

            // Update mp3's data
            document.getElementById('mp3-percentage').textContent = voteData.mp3.percentage + '%';
            document.getElementById('mp3-bar').style.width = voteData.mp3.percentage + '%';
            document.getElementById('mp3-votes').textContent = 'Total Votes: ' + voteData.mp3.votes.toLocaleString();

            // Update the Chart.js bar chart
            electionChart.data.datasets[0].data = [
                voteData.mp1.percentage,
                voteData.mp2.percentage,
                voteData.mp3.percentage
            ];
            electionChart.update();
        }        
        setInterval(fetchVotes, 100);
    </script>
</body>
</html>
