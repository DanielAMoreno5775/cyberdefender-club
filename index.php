<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TCCD CyberDefenders Club</title>
    <link rel="shortcut icon" href="../webstyles/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../webstyles/main.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--[endif]-->
</head>
<body data-spy="scroll" data-target=".navbar-collapse">
    <?php
        $websiteSuccess = "";
        $websiteErr = "";
    
		class  Input {
        	static function int($val) {
            	$val = strip_tags(stripslashes(trim(htmlspecialchars($val))));
            	$val = filter_var($val, FILTER_VALIDATE_INT);
            	if ($val == false) {
            		$websiteErr .= "\r\n901: Invalid Number";
            	}
            	if (!preg_match("/^[0-9]*$/",$val)) {
                    $websiteErr .= "\r\n901: Invalid Number";
                }
            	return $val;
            }
            
        	static function name($val) {
            	if (!is_string($val)) {
            		$websiteErr .= "\r\n902: Invalid Name";
            	}
            	$val = strip_tags(stripslashes(trim(htmlspecialchars($val))));
            	return $val;
            }
            
            static function email($val) {
            	$val = strip_tags(stripslashes(trim(htmlspecialchars($val))));
            	$val = filter_var($val, FILTER_VALIDATE_EMAIL);
            	if ($val == false) {
            		$websiteErr .= "\r\n903: Invalid Email";
            	}
            	if (!preg_match("/^[a-zA-Z-@0-9]*$/",$val)) {
                    $websiteErr .= "\r\n903: Invalid Email";
                }
            	return $val;
            }
		}
		    
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        	$conn = mysqli_connect("localhost", "id19680378_clubpresident", "jDlX%WJzDknEID5GjHRq", "id19680378_signuplist");
        		
        	// Check connection
        	if(!$conn){
                $websiteErr .= "Connection To Database Failed";
        	}
        		
        	// Taking all 3 values from the form and ensure something was entered
        	if ($conn && !empty($_REQUEST['email_addr']) && !empty($_REQUEST['student_name']) && !empty($_REQUEST['student_ID'])) {
        	    $email = Input::email($_REQUEST['email_addr']);
        		$name = Input::name($_REQUEST['student_name']);
        		$sid = Input::int($_REQUEST['student_ID']);
        		
        		$eLength = strlen($email);
            	if ($eLength < 4 || $eLength > 75) {
                   $websiteErr .= "\r\nEmail should have 4-75 characters";	
            	}
        		
        		$nLength = strlen($name);
            	if ($nLength < 2 || $nLength > 75) {
                   $websiteErr .= "\r\nName should have 2-75 characters";	
            	}
            	
            	$sLength = strlen($sid);
            	if ($sLength < 2 || $sLength > 12) {
                   $websiteErr .= "\r\nStudent ID should have 2-12 digits";	
            	}

        		if (empty($websiteErr)) {
        		    // Performing insert query execution
                	$sql = "INSERT INTO `signUpList`(`Email`, `Name`, `StudentID`) VALUES ('$email','$name','$sid') ";
                		
                	if (mysqli_query($conn, $sql)) {
                        $websiteSuccess = "Thank you for your interest in the club";
                        
                        $msg = "Someone has just registered for the club.";
                        $msg .= "\r\n\r\nStudent Name: " . $name . "\r\n\r\nEmail: " . $email . "\r\n\r\nStudent ID: " . $sid;
                        $msg = wordwrap($msg,70);
                        mail("tccdcyberdefenderclubsite@gmail.com","New Applicant",$msg);
                    } else {
                        $websiteErr .= "Submission Failed";
                    }
        		}
        	}
        	// Close connection
        	mysqli_close($conn);
	    }
	?>
    
    
    
    <nav class="navbar navbar-expand-md navbar-fixed-top navbar-dark bg-dark bevel navbarContainer">
        <div class="container navbarContainer">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed custom-toggler" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="../webstyles/toro.png" id="toroImage" class="navbar-brand" />
                <a class="navbar-brand" id="myLogo">TCCD NW CyberDefenders Club</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#signUpAndHome">Home</a></li>
                    <li><a href="#about">What We Do</a></li>
                    <li><a href="#NCL">National Cyber League</a></li>
                    <li><a href="#Meetings">Meetings</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container contentContainer" id="signUpAndHome" background="../webstyles/background1.png">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" id="topRow">
                <div id="topRowText">
					<p class="bold center marginTop" id="location">TCCD NW</p>
                    <!--Font used here is Action Force which comes in MS Office-->
                    <img src="../webstyles/CyberDefenders2.PNG" id="titleImage" class="center img-fluid" />
                    <p class="bold">Master your skills in cybersecurity and ethical hacking alongside students with similar interests and gain credentials that you can put on your r&#233;sum&#233;!</p>
                    <p class="bold marginTop">Interested? Sign up below!</p>
                </div>
				<div id="ErrorMessage">
					<?php 
					    if (!empty($websiteErr) && empty($websiteSuccess)) {
					        echo nl2br($websiteErr);
					    }
					?>
				</div>
				<div id="SuccessMessage">
					<?php
					    if (empty($websiteErr) && !empty($websiteSuccess)) {
					        echo nl2br($websiteSuccess);
					    }
					?>
				</div>
                <form class="marginTop" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></span>
                        <input type="text" class="form-control" placeholder="Your Name" name="student_name" required />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="email" class="form-control" placeholder="Your Email" name="email_addr" required />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></span>
                        <input type="number" class="form-control" placeholder="Your Student ID Number" name="student_ID" required />
                    </div>
                    <button type="submit" class="btn btn-warning btn-lg marginTop">Sign Up</button>

                </form>
            </div>
        </div>
    </div>
    <div class="container contentContainer" id="about">
        <div class="row center">
            <h1 class="center title ">What We Do</h1>
        </div>
        <div class="row marginBottom">
			<div class="col-sm-4 marginTop bevel aboutText">
                <h2><span class="glyphicon glyphicon-home"></span> Meetings</h2>
                <p>Meet other students with similar interest every week. Benefit from their expertise in cybersecurity concepts such as pen testing, cryptography, malware, and GRC.</p>
            </div>
            <div class="col-sm-4 marginTop bevel aboutText">
                <h2><span class="glyphicon glyphicon-lock"></span> National Cyber League</h2>
                <p>Compete against thousands of people from across the nation! Showcase your knowledge of cybersecurity concepts and tools like Kali! Receive score reports to place on your r&#233;sum&#233;!</p>
            </div>
            <div class="col-sm-4 marginTop bevel aboutText">
                <h2><span class="glyphicon glyphicon-bell"></span> Current News</h2>
                <p>Learn about the latest events in the cybersecurity world. Discuss the incidents, the mistakes that allowed it, and how to prevent similar incidents in the future. </p>
            </div>
        </div>

    </div>
    <div class="container contentContainer" id="NCL">
        <div class="row">
            <h1 class="center title"><a href="https://nationalcyberleague.org/" class="outsideLinkTitle">National Cyber League</a></h1>
            <p class="lead center">The National Cyber League is a competition hosted by Cyber Skyline with thousands of participants from across the U.S.A. For the price of $35 each semester paid directly to NCL, you will be able to participate and test your knowledge in open source intelligence, cryptography, password cracking, log analysis, network traffic analysis, wireless access exploitation, forensics, scanning, web app exploitation, and enumeration.</p>
            <!--Every semester, you will likely need to update the coach observation URL in the following a tag. You just need to copy-paste the new link between the quotes.-->
            <p class="lead center">If you want to join the CyberDefender Club team, please follow <a href="https://cyberskyline.com/events/ncl/coach/1F8B-R2B7-Y2LL" class="discordLink">this link</a> to the NCL page and sign into your account.</p>
            <p class="center"><a href="https://nationalcyberleague.org/"><img src="../webstyles/ncl-logo.png" class="NCLImage" /></a></p>
        </div>
    </div>
    <div class="container contentContainer" id="Meetings">
        <div class="row center">
            <h1 class="center title">Meetings</h1>
        </div>
        <div class="row marginBottom">
            <div class="col-sm-7 marginTop center">
                <img src="../webstyles/meeting.png" class="MeetingImage" />
            </div>
            <div class="col-md-4 marginTop meetingsText">
				<!--If necessary, this is where you will change the time for meetings, their location, or the Discord link-->
                <p>We meet every Wednesday from 2pm to 3pm in room WSTU 2807, adjoining the computer lab on the Northwest campus of Tarrant County College District.</p>
                <p>The link to the student-run Discord channel is <a href="https://discord.gg/EkgYQhjDeZ" class="discordLink">here</a>. This is the perfect place to ask questions or just generally chat with other students that have a similar set of interests.</p>
                <p>If necessary, please contact the club's sponsor, Professor John Kidd, at john.kidd@tccd.edu</p>
            </div>
        </div>

    </div>
	<button onclick="topFunction()" id="topButton" title="Go to top"><strong>&#8593;</strong></button>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files asneeded -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $(".contentContainer").css("min-height", $(window).height());
		
		//Get the to-top button
            var mybutton = document.getElementById("topButton");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () { scrollFunction() };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            // When the user clicks on the button, go to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
    </script>

</body>
</html>
