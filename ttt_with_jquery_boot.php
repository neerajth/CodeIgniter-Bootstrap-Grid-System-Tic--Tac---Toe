<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
        html, body, .container-fluid {            
            height:100%;
            /*border:1px solid black;*/
            padding:0px;margin:0px;
        }
        .mainpanel {
            width:100%;
            height:100%;
            padding:0px;margin:0px;
        }
        .gameboard {
            height: 100%;
            margin: auto;
        }
        .gameboard .row{
            height:29%;
        }
        .gameboard .turn{
            height:13%;
        }
        .leftpanel {
            height:100%;            
            background-color:#ccc; border:0px solid blue;
        }
        .rightpanel {
            height:100%;
            background-color:#ddd; border:0px solid lightblue;
        }
        .vcenter {
            display: inline-block;
            vertical-align: middle;
        }
        .valign {
          font-size: 20;
        }

        .valign > [class*="col"] {
          display: inline-block;
          float: none;
          font-size: 24px;
          vertical-align: middle;
        }
        .box {
            border:1px solid #000;
            height:100%;
            text-align: center; 
            width:33.33%;            
            font-size:60px;
        }
        .txtgreen {
            color:green;
        }
        
        .turn {
            text-align:center;
            padding-top:5px;            
        }        
        .tleft, .tright, .bright, .bleft { border:0; }
        .top { border-top:0;border-bottom: 0; }        
        .middle { border: 1; }
        .mleft, .mright  { border-left:0;border-right: 0; }         
        .bottom { border-bottom: 0; border-top: 0;}        
        
        .user_computer {
            height: 50%;
            width:100%;
        }
        .user_computer div {
            text-align:center;width:50%;float:left;
        }
        .user, .computer { height:100%;padding-top:5px; }
        .footer { height:100%; }
        i {             
            vertical-align: middle;
        }
        @media (min-width: 768px)            
        {
             div[class^="gameboard"]{width: 70%;height:70%;}
            
                .gameboard .row{
                    height:25%;
                }
                .gameboard .turn{
                    height:12.5%;
                }
                .box {
                    padding-top: 20px;
                }
        }
        
    </style>
    <script>
        gstruct = [["","0-1-2|0-3-6|0-4-8"],
                   ["","1-0-2|1-4-7"],
                   ["","2-1-0|2-4-6|2-5-8"],
                   ["","3-0-6|3-4-5"],
                   ["","4-1-7|4-3-5|4-0-8|4-2-6"],
                   ["","5-4-3|5-2-8"],
                   ["","6-7-8|6-3-0|6-4-2"],
                   ["","7-4-1|7-6-8"],
                   ["","8-4-0|8-5-2|8-7-6"]]
        var counter=0;
        var vagainst="user";
        $(document).ready(function() {
            
            $("."+vagainst).css("background","#ddd");
            
            $(".box").click(function() {
                var selectedid = $(this).attr("id");
                gamestatus=gamearea.executeStep(selectedid);
                console.log("against: " + vagainst);
                if ( gamestatus == "cont" && vagainst == "computer" ) {
                    availableboxes = new Array();
                    v=0;
                    $.each( gstruct, function(index, value)  { 
                        if (value[0] == "") {
                            availableboxes[v++] = index;
                        }                   
                    });
                    randomboxid=Math.floor(Math.random() * availableboxes.length);
                    console.log("random box id: " +randomboxid);
                    console.log(availableboxes);
                    console.log(availableboxes[randomboxid]);
                    setTimeout(function(){  gamearea.executeStep(availableboxes[randomboxid]); }, 300);
                }
            });
            
            
            $(".computer").click(function() {
                if ( vagainst == "computer" ) { 
                    return;
                }
                $(this).css("background","#ddd");
                $(".user").css("background","#ccc");
                vagainst="computer";
                gamearea.clearBoard();
            });
            $(".user").click(function() {
                if ( vagainst == "user" ) { 
                    return;
                }
                $(this).css("background","#ddd");
                $(".computer").css("background","#ccc");
                vagainst="user";
                gamearea.clearBoard();
            });
        });
        
        gamearea =  {
            executeStep: function (selectedid) {
                /*clear board if game is over and reset counter to 0*/
                if ( counter === -1 ) {
                    gamearea.clearBoard();                    
                    return;
                }
                
                var isValue=$("#"+selectedid).html();
                if ( !isValue ) {
                    var setvalue = "";
                    if ( counter %2 === 0 ) {                        
                        var player = "1";
                        $("#"+selectedid).html("<i class='fa fa-times' aria-hidden='true'></i>");                        
                        setvalue="X";
                    } else {
                        var player = "2";
                        $("#"+selectedid).html("<i class='fa fa-circle-thin' aria-hidden='true'></i>");                        
                        setvalue="0";
                    }
                gamearea.chgTurn(player);
                var gamestatus = gamearea.gameLogic(selectedid, setvalue);                    
                console.log("gamestatus:"+gamestatus);
                    if ( gamestatus == "stopgame") return gamestatus;
                } else {
                    return;
                }

                counter++; 
                /*gamearea.fInOutEffect(selectedid);*/

                if ( counter == 9 ) {
                    gamestatus=gamearea.stopGame(counter);
                }
                return gamestatus;
                console.log("player #" + player + "  Box id: "+selectedid + "  counter : "+counter);
                
            },
            stopGame: function(player) {
                $("#turn").css("color","green");                
                if ( player == 9 ) {            //if counter is complete / 9 then its TIE
                    $("#turn").text("TIE!");
                } else {
                    playername=(player=="X")?"[Player 1]":(vagainst=="computer")?"[Computer]":"[Player 2]";
                    $("#turn").text("("+ player +") WINNER! "+playername);                    
                }
                $("#turn").fadeIn("slow");
                counter=-1;
                console.log("now counter is : "+counter);
                
                $("#turn").animate({
                    fontSize: '+150%'
                });
                
                return "stopgame";
            },
            fInOutEffect: function(selectedid){
                $("#"+selectedid).fadeOut("fast");
                /*$("#"+selectedid).fadeIn("3000");*/
            },
            chgColor: function(selectedid) {
                $("#"+selectedid).addClass("txtgreen");
            },
            chgTurn: function(player){
                var playervalue = (player==1)?"0":"X";
                /*player=(player==1)?"2":"1";*/
                $("#turn").text("("+ playervalue +") Turn");
            },
            clearBoard: function(){                
              for ( i = 0 ; i < 9 ; i ++ ) {                  
                  $("#"+i).text("");
                  gstruct[i][0]="";
                  $("#"+i).removeClass("txtgreen");
              }
            counter=0;
            console.log("clearBoard: "+gstruct);
            console.log("counter: "+counter);
                $("#turn").text("(X) Turn");
                $("#turn").css("font-size","14px");
                $("#turn").css("color","black");
            },
            gameLogic: function(selectedid,setvalue){
                gstruct[selectedid][0]=setvalue;
                var vcombinations = gstruct[selectedid][1];
                var lvar = vcombinations.split("|");
                var gamestopstatus="cont";
                $.each( lvar, function()  {
                    var indexvalue = this.split("-");                    
                    console.log(indexvalue[0] + " - " + indexvalue[1] + " - " + indexvalue[2]);
                    console.log(gstruct[indexvalue[0]][0] + " == " + gstruct[indexvalue[1]][0] + " == " + gstruct[indexvalue[2]][0] );
                    var a = gstruct[indexvalue[0]][0];
                    var b = gstruct[indexvalue[1]][0];
                    var c = gstruct[indexvalue[2]][0];
                    if ( a === b && a === c && b === c) {                        
                        gamearea.chgColor(indexvalue[0]);   gamearea.chgColor(indexvalue[1]);   gamearea.chgColor(indexvalue[2]);
                        gamestopstatus = gamearea.stopGame(setvalue);                        
                        return;                     
                        console.log(" "+setvalue + " WINNER! gstruct: " + gstruct);      
                    }
                });
                return gamestopstatus;                
            }
        }
        
    </script>
    
</head>
    <body>
        <div class="container-fluid">
            <div class="row mainpanel">
                <div class="col-md-9 leftpanel">
                   
                        <div class="gameboard">
                            <div class="row turn hidden-xs">
                                <div class="col-md-12"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4 box tleft" id="0"></div>
                                <div class="col-md-4 col-xs-4 box top" id="1"></div>
                                <div class="col-md-4 col-xs-4 box tright" id="2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4 box mleft" id="3"></div>
                                <div class="col-md-4 col-xs-4 box middle" id="4"></div>
                                <div class="col-md-4 col-xs-4 box mright" id="5"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4 box bleft" id="6"></div>
                                <div class="col-md-4 col-xs-4 box bottom" id="7"></div>
                                <div class="col-md-4 col-xs-4 box bright" id="8"></div>
                            </div>
                            <div class="row turn">
                                <div class="col-md-12 col-xs-12 footer">
                                    <div id="turn" style="height:50%;">(X) Turn</div>
                                    <div class="user_computer">
                                        <div class="computer">
                                            <i class="fa fa-desktop fa-lg" aria-hidden="true"></i>
                                        </div>
                                        <div class="user">
                                            <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="col-md-3 hidden-xs rightpanel">
                    Last 5 matches scores
                </div>
            </div>
            
           
        </div>
    </body>
</html>


<!--
sound on click...

sleep in game against computer
Save record via codeignitor
Get new records from db
Refresh results box and game. 

Box font size should be resizable as per windows resize.
Box X 0 should be middle vertically align
-->