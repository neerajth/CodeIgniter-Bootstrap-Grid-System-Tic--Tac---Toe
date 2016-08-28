Technical documentation:
CodeIgniter
    Views:
            errors: for displaying error if any.            
            templates: it contains header and footer template. header.php contains basic css and js files along with js base_url setting.
            welcome_message.php: contains a welcome screen with 0, 1, 2 levels.
            tictactoe: this is the game view.
            scores: this view is rendering socres from controller in json format.
    Controllers:
            Welcome.php: loads helper and default welcome_message view    
            Scores.php: loads scores model, helper, scores via default index method and insert scores via create method.
            Tictactoe.php: loads scores model, helper, scores and sets game level for its view.
    Models:
            Scores_model.php: gets latest 5 games scores from db and sets scores table records. its also logging info in the logs.
            
MySQL
        please execute following in database.
            CREATE TABLE `scores2` (
              `id` int(11) NOT NULL primary key AUTO_INCREMENT,
              `against` varchar(10) NOT NULL,
              `winner` varchar(32) NOT NULL,
              `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
            )
jQuery
        
gstruct:        
        this is a global holding nine blocks X, 0s and their corresponding combinations. e.g. for array inded 2 value could be [2][0]=X and [2][1] = "2-1-0|2-4-6|2-5-8"

counter:
        a global variable holds counter value on every move.

vagainst:
        this globlale variable stores if game is Player Vs Player or Player Vs Computer.
    
box.click():
        its called on game block click and executeStep as per vagainst variable value.
computer.click() and friend:click():
        these method toggle vagainst value and switches user to computer mode.

A gamearea namespace is created which has following methods.
executeStep()
        this method executes the step, set X or 0 value in box. it calls gamelogic and stop game if all counts are over.
        
offensiveMove()
        game is divided into different methods for computer vs player mode. offensive is called first and will choose available 0s combinations if available.

intelligentMove()
        this is called for defensive mode and will be called only if there is no 0s combinations available.

getIntersection()
        this is a support method for intelligentMove which checks the intersections points.

complexMove()
        this method is support method for defensive process and checks X && 0 or 0 && X if available.

stopGame()
        this method wipe info from gstruct, counter and other variables.

saveGame()
        this method calls the CodeIgniter URL via AJAX POST method to save scores info. This method is also responsible for rendering received JSON data from server. Game result is saved and latest 5 records are fetched in this method.

renderScores()
        this is a support method for saveGame method.

fInOutEffect()
        this method was earlier used to perform fadein out effect when a box is clicked.

chgColor()
        this method changes the color of winning combinations using bootstrap text-info class.

chgTurn()
        this method declares the result in bottom label.

clearBoard()
        this method is called onclick when game is over or when a fresh game is opened.

gameLogic()
        this is the main method checks the winning combinations and call related methods.


Bootstrap
    layout is generated using bootstrap. its game board and scores board is using grid system. various bootstrap classes are used as per need.

JSON
    Scores data interchange between server and client is done using JSON.

Font Awesome
    -used font awesome for X, 0 and other icons.

Logs: Along with default, the game scores info is tracked in the logs.
        - $config['log_threshold'] = 4; //log all messages,


Player Vs Computer game detail.
- i have coded three different levels of game while playing with computer.
    0 - basic level where computer will play a random.          [ tictactoe.js ] 
    1 - intermediate where computer will be in defensive mode.  [ tictactoe_1.js ] 
    2 - advance where computer will be first offensive and then defensive. [ tictactoe_2.js ] 
I can code a very advance level also in which computer will always or there will be tie in the game.


Software requirements:
    --php 5.5
    --mysql 5

Installation:
    To deploy this game, please change following settings.

    file path: aplication / config / config.php
        base_url: change this path as per your web server and project folder location.

        $config['base_url'] = 'http:// your localhost path';
        $db['default'] = array(
            'dsn'	=> '',
            'hostname' => 'localhost',
            'username' => '',
            'password' => '',
            'database' => '',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );

    
Git
    -code is available via git and can be cloned via following URL.
    git clone https://neerajth@bitbucket.org/neerajth/tictactoe.git

Demo URL:
    http://snwebtechnologies.com/tictactoe/

extension [advanced version]:
    - I can make the functionality such that two players can play from different networks.


Author: Neeraj Thakur
Email: neerajth@gmail.com