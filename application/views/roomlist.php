<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link href='http://fonts.googleapis.com/css?family=Orbitron:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css"> -->
        <!-- <link rel="stylesheet" href="css/style.css"> -->

        <?php include('general/css.php') ?>
        <!--script src="js/vendor/modernizr-2.6.2.min.js"></script-->
    </head>
    <body class="">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <canvas id="stage"></canvas>

        <div class="content-front">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="profile-block orbitron clearfix">
                            <?php $profile = Auth::getLoggedInUserInfo(); ?>
                            <div class="pull-left" style="margin-top:10px">
                                <h1 class=""><strong>Q-WAR</strong></h1>
                            </div>
                            <div class="pull-right">
                                <div class="profile-image" style="background-image: url(<?php 
                                    echo site_url("profilepicture/get/".$profile['user_id']."");
                                ?>);"></div>
                                <!-- <img src="http://localhost/qwarlocal/profilepicture/get/6" alt=""> -->
                            </div>
                            <div class="pull-right" style="margin-right:20px;">
                                 <h3 style="margin-bottom: 0;"><?php echo $profile["name"] ?></h3>
                                 <p class="text-right" style="margin-bottom: 0;margin-top:0;"><small>Lv: 1</small></p>
                                 <div class="relativepos">
                                    <div class="progress">
                                            <span class="sr-only">45% Complete</span>
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo percentage_user_exp($profile['experience']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo percentage_user_exp($profile['experience']); ?>%">
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            <div id="roomlist">
                <div class="container"> 
                    <div class="row">
                        <?php 
                            if (isset($room)) {
                                foreach ($room as $roomlist) {
                                    ?>
                                    <div class="col-sm-3">
                                        <div class="room-box">
                                            <div class="room-title orbitron"><strong><?php echo $roomlist['room_name'] ?></strong></div>
                                            <div class="room-text">
                                                <p>By: <?php echo $roomlist['name'] ?></p>
                                                <p>Total Player: 0/8</p>
                                                <p><?php echo $roomlist['topic_name']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

        <!-- script src="js/plugins.js"></script-->
        <!-- script src="js/main.js"></script-->
        <?php   include('general/javascript.php') ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

        <script>
            function dot(width, height, speed) {
              //Picks a random starting coordinate and speed within the bounds given
              this.x = Math.round(Math.random()*width);
              this.y = Math.round(Math.random()*height);
              this.speedX = Math.round(Math.random()*speed-speed/2);
              this.speedY = Math.random(Math.random()*speed-speed/2);
            }

            function dotGraph() {
              var maxDistance = 50;
              var numDots = 300;
              
              var canvas = document.getElementById("stage");
              var stage;
              var width = window.innerWidth;
              var height = window.innerHeight;
              var dots = [];
              var timer;
              
              var tick = function () {
                
                //Paints over old frame
                stage.fillStyle = "#2b699c";
                stage.rect(0, 0, width, height);
                stage.fill();
                
                stage.fillStyle = "#FFFFFF";
                var i=0;
                for (i=0; i<dots.length; i++) {
                  
                  //Move dot
                  dots[i].x+=dots[i].speedX;
                  dots[i].y+=dots[i].speedY;
                  
                  //Bounce dot off walls
                  if (dots[i].x<0) {
                    dots[i].x=0;
                    dots[i].speedX *= -1;
                  }
                  if (dots[i].x>width) {
                    dots[i].x=width;
                    dots[i].speedX *= -1;
                  }
                  if (dots[i].y<0) {
                    dots[i].y=0;
                    dots[i].speedY *= -1;
                  }
                  if (dots[i].y>height) {
                    dots[i].y=height;
                    dots[i].speedY *= -1;
                  }
                  
                  //Draw dot
                  stage.beginPath();
                  stage.arc(dots[i].x,dots[i].y,3,0,2*Math.PI);
                  stage.fill();
                }
                
                //Calculate distances between every dot
                var distances = [];
                for (i=0; i<dots.length; i++) {
                  for (var j=i+1; j<dots.length; j++) {
                    
                    //Add the line to the draw list if it's shorter than the specified max distance
                    var dist = Math.sqrt(Math.pow(dots[i].x-dots[j].x, 2) + Math.pow(dots[i].y-dots[j].y, 2));
                    if (dist <= maxDistance) distances.push([i, j, dist]);
                  }
                }

                //Draw the lines
                for (i=0; i<distances.length; i++) {
                  
                  //The farther the distance of the line, the less opaque it will be drawn
                  stage.strokeStyle = "rgba(255, 255, 255, " + (maxDistance-distances[i][2])/maxDistance + ")";
                  stage.beginPath();
                  stage.moveTo(dots[distances[i][0]].x, dots[distances[i][0]].y);
                  stage.lineTo(dots[distances[i][1]].x, dots[distances[i][1]].y);
                  stage.stroke();
                }
              };
              
              var resizeCanvas = function() {
                width = window.innerWidth;
                height = window.innerHeight;
                canvas.width=width;
                canvas.height=height;
                console.log(width + ", " + height);
              };
              
              window.addEventListener("resize", function () {
                resizeCanvas();
              });
              
              //Maximize and set up canvas
              resizeCanvas();
              if (canvas.getContext) {
                stage = canvas.getContext("2d");
                
                //Create dots
                for (var i=0; i<numDots; i++) {
                  dots.push(new dot(width, height, 3));
                }
                
                //Set up timed function
                timer=setInterval(tick, 40);
              } else {
                alert("Canvas not supported.");
              }
            }

            var graph = new dotGraph();
        </script>
    </body>
</html>
