<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rank</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: "Fjalla One", sans-serif;
            color: #fff;
            letter-spacing: 2px; 
            margin:0px;
        }
        body{
            background-image: url('Images/MainBackground.png');
            background-size:100%;
            /* background-attachment:fixed; */
            background-repeat: no-repeat;  
            
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
            font-family: Arial, sans-serif;
            font-size: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
            position: relative;
            font-weight:bold
        }

        th {
            background-color: #a29bfe;
            color: white;
        }



        .medal {
            top: 50%;
            width: 40px;
            height: auto;
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        tr.top-rank td {
            font-weight: bold;
            background-color: #0984e3;
        }
        tr td:nth-child(3){
            color:#f74b21
        }
        h2{
            text-align:center;
            font-size: 50px;
            text-shadow: 6px 6px 8px rgba(0, 0, 0, 0.5);
            color: #1e90ff;
            margin-top: 50px;
        }
        .back-button {
            display: block;
            width: 200px;
            padding: 10px;
            text-align: center;
            margin: 20px auto;
            background-color: #0681d0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 20px;
        }

        .back-button:hover {
            background-color: #1aa3c4;
            cursor: pointer;
        }
    </style>
</head>
<body>


<h2>LEADERBOARD</h2>

<table>
    <tr>
        <th>Rank</th>
        <th>Name</th>
        <th>Score</th>
    </tr>
    <?php

$filename = 'user_scores.txt';
$file_content = file($filename, FILE_IGNORE_NEW_LINES);

if ($file_content !== false) {
    $data = [];
    foreach ($file_content as $line) {
        $fields = explode(',', $line);
        $data[] = [
            'username' => trim($fields[0]),
            'score' => intval(trim($fields[1])),
        ];
    }


    // Sort by score descending
    usort($data, function ($a, $b) {
        return $b['score'] - $a['score'];
    });

    foreach ($data as $index => $item) {
        $rank = $index + 1;
        $username = $item['username'];
        $score = $item['score'];


        $tr_class = $rank <= 3 ? "top-rank" : "";


      $medalImg = "";
        if ($rank == 1) {
            $medalImg = "<img src='Images/1.png' class='medal' >";
        } elseif ($rank == 2) {
            $medalImg = "<img src='Images/2.png' class='medal' >";
        } elseif ($rank == 3) {
            $medalImg = "<img src='Images/3.png' class='medal' >";
        }

        echo "<tr class=\"$tr_class\">
                    <td>$medalImg $rank</td>
                    <td>$username</td>
                    <td>$score</td>
                  </tr>";
    }
} else {
    echo '<tr><td colspan="3">NO DATA</td></tr>';
}
?>
</table>
<a href="lobby.html" class="back-button">Back to Home Page</a>
</body>
</html>
