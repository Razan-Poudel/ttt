<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tic Tac Toe</title>
  <style>
    h1 {
      width: fit-content;
      display: block;
      margin: 1% auto;
      font-family: "Courier New", Courier, monospace;
    }

    .container {
      /* border: 2px solid red; */
      width: 37.5%;
      height: 500px;
      margin: auto;
      display: grid;
      gap: 0px;
      grid-template-columns: 2fr 2fr 2fr;
    }

    .button {
      height: 169px;
      width: 190px;
      margin: 0px;
      margin-left: 10%;
      background-color: white;
      /* padding: 10px; */
      border: 4px solid black;
    }

    #button1,
    #button2,
    #button3 {
      border-top: none;
    }

    #button1,
    #button4,
    #button7 {
      border-left: none;
    }

    #button3,
    #button6,
    #button9 {
      border-right: none;
    }

    #button7,
    #button8,
    #button9 {
      border-bottom: none;
    }

    img {
      height: 100px;
      width: 100px;
    }

    #result {
      font-size: large;
      margin-left: 40px;
      font-family: "Courier New", Courier, monospace;
      display: inline-block;
    }

    #restart {
      height: 50px;
      width: 90px;
      font-size: 17px;
      font-weight: 600;
      border-radius: 5px;
      outline: none;
      border: none;
      background-color: #00dd93;
      color: white;
      display: inline-block;
      margin: auto;
      margin-top: -25px;
    }

    .namebox {
      /* border: 2px solid red; */
      position: absolute;
      width: fit-content;
      height: fit-content;
      top: 50%;
      left: 30%;
      background-color: white;
      border-radius: 10px;
      box-shadow: grey 10px 10px 20px;
    }

    .names {
      display: block;
      height: 50px;
      width: 500px;
      margin: 5px;
      font-weight: 700;
      font-size: 30px;
      padding: 4px;
      padding-left: 50px;
      border: 4px solid rgb(95, 253, 42);
      border-radius: 10px;
      outline: none;
    }

    .config {
      height: 40px;
      width: 100px;
      display: inline-block;
      margin-left: 100px;
      border: none;
      border-radius: 5px;
      font-size: 20px;
      font-weight: bold;
      background-color: #00dd93;
      color: white;
      margin-bottom: 10px;
      margin-top: 10px;
    }

    button {
      cursor: pointer;
      outline: none;
    }
  </style>
  <link href="index.css" rel="stylesheet">
</head>

<body>
  <h1 id="score">
    Score </br>
    <div><span>Player 1:</span><span id="p1score">1</span></div>
    <div><span>Player 2:</span><span id="p2score">2</span></div>
  </h1>
  <div class="container">
    <button class="button" id="button1" onclick="clicked(this.id)"></button>
    <button class="button" id="button2" onclick="clicked(this.id)"></button>
    <button class="button" id="button3" onclick="clicked(this.id)"></button>
    <button class="button" id="button4" onclick="clicked(this.id)"></button>
    <button class="button" id="button5" onclick="clicked(this.id)"></button>
    <button class="button" id="button6" onclick="clicked(this.id)"></button>
    <button class="button" id="button7" onclick="clicked(this.id)"></button>
    <button class="button" id="button8" onclick="clicked(this.id)"></button>
    <button class="button" id="button9" onclick="clicked(this.id)"></button>
  </div>
  <div id="result">
    <h2>
   
    </h2>
  </div>
  <button id="restart" onclick="location.reload()">Restart</button>
  <div class="namebox">
    <input type="text" id="player1" class="names" placeholder="Enter the name of Player1(O)" />
    <input type="text" id="player2" class="names" placeholder="Enter the name of Player2(X)" />
    <button id="ok" class="config" onclick="ok()">OK</button>
    <button id="skip" onclick="ok()" class="config">skip</button>
  </div>
</body>
<script>
  let circle = "circle.png";
  let cross = "cross.png";
  let arr = Array.from(document.getElementsByClassName("button"));
  let turn;
  let p1, p2;
  let cell = [null, null, null, null, null, null, null, null, null];
  let color = [];
  // cell[4] = "X";
  // console.log(cell);
  let winner = null;
  turn = p1;
  gameover = false;
    function updatescore(score1,score2,o){ 

      let opt={
        method:'POST',
        headers:{
          'Content-Type':'application/json'

        },
        body:JSON.stringify({
          'p1':score1,
          'p2':score2,
          'o':o
        })
      }
    const url = "index.php";
    return fetch(url,opt).then(
        response => {
            if (!response.ok) {
                throw new Error('Response not found');
            }
            return response.json();

        });

    }


  function clicked(s) {
    updatescore(-1,-1,'r').then(resp=>{
      console.log(resp);
    });
    turn == p1
      ? ((pusher = "O"), (sym = circle), (turn = p2))
      : ((pusher = "X"), (sym = cross), (turn = p1));

    document.getElementById(s).removeAttribute("onclick");
    document.getElementById(s).innerHTML = "<img src='" + sym + "' alt='O'>";
    cell[parseInt(s.substring(s.length - 1)) - 1] = pusher;
    document.getElementById("result").innerHTML =
      "<h2>" + turn + "'s turn!!</h2>";
    check();
  }
  function check() {
    console.log(cell);
    if (cell[0] == "O" && cell[4] == "O" && cell[8] == "O") {
      winner = p1;
      color.push(0, 4, 8);
    } else if (cell[0] == "O" && cell[1] == "O" && cell[2] == "O") {
      winner = p1;
      color.push(0, 1, 2);
    } else if (cell[3] == "O" && cell[4] == "O" && cell[5] == "O") {
      winner = p1;
      color.push(3, 4, 5);
    } else if (cell[6] == "O" && cell[7] == "O" && cell[8] == "O") {
      winner = p1;
      color.push(6, 7, 8);
    } else if (cell[0] == "O" && cell[3] == "O" && cell[6] == "O") {
      winner = p1;
      color.push(0, 3, 6);
    } else if (cell[1] == "O" && cell[4] == "O" && cell[7] == "O") {
      winner = p1;
      color.push(1, 4, 7);
    } else if (cell[2] == "O" && cell[5] == "O" && cell[8] == "O") {
      winner = p1;
      color.push(2, 5, 8);
    } else if (cell[2] == "O" && cell[4] == "O" && cell[6] == "O") {
      winner = p1;
      color.push(2, 4, 6);
    } else if (cell[0] == "X" && cell[4] == "X" && cell[8] == "X") {
      winner = p2;
      color.push(0, 4, 8);
    } else if (cell[0] == "X" && cell[1] == "X" && cell[2] == "X") {
      winner = p2;
      color.push(0, 1, 2);
    } else if (cell[3] == "X" && cell[4] == "X" && cell[5] == "X") {
      winner = p2;
      color.push(3, 4, 5);
    } else if (cell[6] == "X" && cell[7] == "X" && cell[8] == "X") {
      winner = p2;
      color.push(6, 7, 8);
    } else if (cell[0] == "X" && cell[3] == "X" && cell[6] == "X") {
      winner = p2;
      color.push(0, 3, 6);
    } else if (cell[1] == "X" && cell[4] == "X" && cell[7] == "X") {
      winner = p2;
      color.push(1, 4, 7);
    } else if (cell[2] == "X" && cell[5] == "X" && cell[8] == "X") {
      winner = p2;
      color.push(2, 5, 8);
    } else if (cell[2] == "X" && cell[4] == "X" && cell[6] == "X") {
      winner = p2;
      color.push(2, 4, 6);
    } else {
      let e = true;
      for (let i = 0; i < cell.length; i++) {
        if (cell[i] == undefined || cell[i] == null) {
          e = false;
        }
      }
      if (e) {
        winner = "none";
      }
    }
    if (winner == p1) {
      document.getElementById("result").innerHTML =
        "<h2><strong style='color:green;'>Congratulations!</strong>" +
        winner +
        "(O) is the winner!!!</h2>";
      clearevl();
      colorit();
    } else if (winner == p2) {
      document.getElementById("result").innerHTML =
        "<h2><strong style='color:green;'>Congratulations!</strong>" +
        winner +
        "(X) is the winner!!!</h2>";
      clearevl();
      colorit();
    } else if (winner == "none") {
      document.getElementById("result").innerHTML =
        "<h2><strong style='color:yellow;'>Nobody is the winner!!</strong></h2>";
    }
  }
  function clearevl() {
    arr.forEach((element) => {
      element.removeAttribute("onclick");
    });
  }
  function colorit() {
    for (let i = 0; i < color.length; i++) {
      document.getElementById(
        "button" + (color[i] + 1)
      ).style.backgroundColor = "#b9f5c0";
    }
  }
  function ok() {
    if (
      document.getElementById("player1").value != undefined &&
      document.getElementById("player1").value != null &&
      document.getElementById("player1").value != ""
    ) {
      p1 = document.getElementById("player1").value;
    } else {
      p1 = "Player-1";
    }
    if (
      document.getElementById("player2").value != undefined &&
      document.getElementById("player2").value != null &&
      document.getElementById("player2").value != ""
    ) {
      p2 = document.getElementById("player2").value;
      if (p1 == p2) {
        p2 = " " + p2;
      }
    } else {
      p2 = "Player-2";
    }
    console.log(p1, p2);
    document.getElementsByClassName("namebox")[0].style.display = "none";
  }
</script>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){


$data=json_decode(file_get_contents('php://input'),true);

if(isset($data['p1'])){


  $receiveddata=$data['p1'];
  echo "<script>alert('".$receiveddata."');</script>";
}
$servername="localhost";
$username="sm";
$password="";
$database="db1";
$p1score=0;
$p2score=0;
//create connection

$conn= mysqli_connnect($servername,$username,$password,$database);

//cheeck connectioon
if(!$conn){
  die("Connection failed:".mysqli_connect_error());
}

//perform a query
$sql="SELECT * FROM table1";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
  $count=0;
while ($row=$result->fetch_assoc()) {
  if ($ount==0) {
    $p1score=$row["score"];
    
  }else{
    $p2score=$row["score"];

  }
  $count++;
}

//send the score in frontend


}else{
  $sql1="INSERT INTO table1 (player,score) VALUES ('p1',0)";
  $sql2="INSERT INTO table1 (player,score) VALUES ('p2',0)";
  if($conn->query($sql==TRUE)){
//database created and inserted zero
  }

}


mysqli_close($conn);
}
?>
</html>