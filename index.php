<?php 
    // MobileDetect.net for detecting device
    require_once 'Mobile_Detect.php';
    $detect = new Mobile_Detect;
    
    if ( $detect->isMobile()) {
        header('Location: indexMobile.php');
    }
?>
<!DOCTYPE HTML>
<html lang=en>
    <head>
        <title>Ashdeals</title>
        <link rel='icon' type='image/png' href ='Images/small.png'>
        <meta charset = "UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="CSS/animate.css">
        <link rel="stylesheet" type="text/css" href="CSS/hover.css">
        <script src="viewportchecker.js"></script>   
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <!-- Google Web Font Import -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
    </head>
<body>

<div id='header'>
    <img id='logoMain' src='Images/logo.png'>
    
<!-- Mail Pop-Up -->
<input type='image' src="Images/contact.png" id='myBtn' class='hvr-wobble-vertical'>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <p></p>
    <span class="close">×</span>
    <!-- PHP Mail Form -->
      <iframe name='refresh' style='display: none'></iframe>
      <form method="post" id='contactForm' target='refresh'>
        <input type="text" class='contactInput' name='name' placeholder="Name">  
        <input type="text" class='contactInput' name='email' placeholder="Email">
        <textarea name='message' class='contactInput' placeholder="Your Message"></textarea>
        <input class='button hvr-shrink' id="contactSubmit" type="submit" name="contactSubmit" value="Send">
      </form>
      
<?php 
    if(isset($_POST['contactSubmit'])) {
    
    $name = $_POST['name'];
    $subject = "New Ashdeals.us Email";
    $email = $_POST['email'];
    $message = "Name: " . $name . "\r\n" . $_POST['message'] . "<br>";
        
    require_once 'PHPMailer/PHPMailerAutoload.php';
   // require_once 'PHPMailer/class.smtp.php';
    $mail = new PHPMailer;
    $mail->isSMTP();

    //$mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'lclarke@unca.edu';
    $mail->Password = 'Randan27!';
    
    
    $mail->IsHTML(true);

    $mail->SetFrom('Admin@Ashdeals.us');
    $mail->AddAddress('lclarke@unca.edu', 'Lucas Clarke');

    $mail->Subject = $subject;
    $mail->msgHTML = $message;
    $mail->Body =  $message;
    $mail->send();
    }
?>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the submit button element
var submit = document.getElementById("contactSubmit");

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
    $('#myModal').addClass('animated fadeIn');
    $('.modal-content').addClass('animated fadeInUp');
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// Close Window After Submit
submit.onclick = function() {
    $('#myModal').addClass('animated fadeOut');
    $('.modal-content').addClass('animated fadeOutUp');
    $('#myBtn').addClass('animated fadeOutRight');
    setTimeout('modal.style.display = "none";', 700); 
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
    }
}
</script>

<div id='forms'>   
    <form method="post">
        <p class='search'></p>
        <input type="text" name="search" placeholder="Location Name" class='formField'>
        <input class='button hvr-shrink' id="initial" type="submit" name="locSubmit" value="Search">
    </form>
    
<div id='catForm'>
    <form method='post'>
       <p class="search"></p> 
       <select name="search" class='formField' id='dropdown'>
            <option value="">Catagory...</option>
            <option value="Bar">Bar</option>
            <option value="BBQ">BBQ</option>
            <option value="Brewery">Brewery</option>
            <option value="Burger">Burger</option>
            <option value="Chicken">Chicken</option>
            <option value="Chicken">Developer Pick</option>
            <option value="Italian">Italian</option>
            <option value="Mexican">Mexican</option>
            <option value="Pizza">Pizza</option>
          </select>
        <input class='button hvr-shrink' type="submit" name="catSubmit" value="Search">
      </form>
    </div><br><!-- catForm -->
    
    <div id='dayForm'>
        <form method="get">
          <input type="checkbox" name='day[]' id='day1' value="Sunday"><label for='day1'>Sunday</label>
          <input type="checkbox" name='day[]' id='day2' value="Monday"><label for='day2'>Monday</label>
          <input type="checkbox" name='day[]' id='day3' value="Tuesday"><label for='day3'>Tuesday</label>
          <input type="checkbox" name='day[]' id='day4' value="Wednesday"><label for='day4'>Wednesday</label>
          <input type="checkbox" name='day[]' id='day5' value="Thursday"><label for='day5'>Thursday</label>
          <input type="checkbox" name='day[]' id='day6' value="Friday"><label for='day6'>Friday</label>
          <input type="checkbox" name='day[]' id='day7' value="Saturday"><label for='day7'>Saturday</label>
          <input class='button hvr-shrink' type="submit" name='daySubmit' id='daySubmit' value="Search">
        </form>
    </div><!-- dayForm -->
    </div><!-- forms -->
    </div><!-- header -->
    
<?php 
    
    // Setting 'Today'
    date_default_timezone_set('EST');
    $today = date("N"); // Integer Representing Today
   
    // Location Search //
    if (isset($_POST['locSubmit'])) {
        
        //$sql = "SELECT * FROM deals WHERE day IN ('Monday')";
        $sql = "SELECT * FROM deals WHERE location like '%" . $_POST['search'] . "%'";
        search($sql);
    
    // Category Search //
    } elseif (isset($_POST['catSubmit'])) {
        
        $sql = "SELECT * FROM deals WHERE catagory like '%" . $_POST['search'] . "%'"; 
        search($sql);
    
    // Day Search //
    } elseif (isset($_GET['daySubmit'])) {
        
        if (isset($_GET['day'])){
        
        $dayArray = $_GET['day']; // Array Of Selected Days
            
        $dayString = "'" . implode("', '", $dayArray) . "'"; //Turn Array into 
    
            if (count($dayArray) > 1) {
                $sql = "SELECT * FROM deals WHERE day IN (" . $dayString . ")";
            }
        
            elseif (count($dayArray == 1)) { // Makes Sure not to show empty string
                $sql = "SELECT * FROM deals WHERE day IN (" . $dayString . ") AND deal != ''"; 
                }
            
            else { // No Results Error Check
                $sql = "SELECT * FROM deals";
            }
        
        //print_r($dayArray);
        daySearch($sql);
        } // If isset
        
        else {
           $sql = "SELECT * FROM deals";
           search($sql); 
        }
        
    } else { // Last Call AKA No Input
        
        $sql = "SELECT * FROM deals";
        search($sql);
        
    };
    
    // Search Function
function search($sql){ 
    include("connection.php");
    
    // Setting 'Today'
    date_default_timezone_set('EST');
    $today = date("N"); // Integer Representing Today
    
    // Query Database  
    $result = $mysqli->query($sql);   
    $array = array();
    $odd = true;
    
    while($row = mysqli_fetch_assoc($result)){    
        $array[] = $row;
    };

    if ($result->num_rows !=0){

    echo "<div id='tableContainer' class='tableContainer'>";
    echo "<table class='scrollTable'>";
     echo "<thead class='fixedHeader'>";
      echo "<tr class='headerWrap animated fadeInUp'>    
            <th class='headerLocation'>Location</th>
            <th class='headerDay 0'>Sunday</th>
            <th class='headerDay 1'>Monday</th>
            <th class='headerDay 2'>Tuesday</th>
            <th class='headerDay 3'>Wednesday</th>
            <th class='headerDay 4'>Thursday</th>
            <th class='headerDay 5'>Friday</th>
            <th class='headerDay 6'>Saturday</th>
        </tr>
    </thead>
    
    <tbody class='scrollContent'>";
      
      for ($i = 0; $i < count($array); $i++){
        
        if ($odd == true){
        echo "<tr class='odd animated flipInX'>";
        }
        
        else {
        echo "<tr class='even animated flipInX'>";
        }
          
          echo "<td class='location'>" . $array[$i]['location'] . "</td>";
          
          echo "<td class='deal 0'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal 1'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal 2'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal 3'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal 4'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal 5'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal 6'>" . $array[$i]['deal'] . "</td>";
        echo "</tr>";
        
        $odd = !$odd;
      };
        echo "</tbody>";
        echo "</table>"; 
        echo "</div>";
    } // If Results != 0
    
    else { // No Results Img
        echo "<img src='Images/noResults.png' class='noResults animated flipInX'>";
    }
    
}; // Search Function
    
    // Day Search Function //
    function daySearch($sql){ // Search Function
    include("connection.php");
    
    // Setting 'Today'
    date_default_timezone_set('EST');
    $today = date("l"); // Integer Representing Today
       
        global $dayArray; // Must declare to use outside var's
        global $dayString;
        echo "<div id='tableContainer' class='tableContainer'>";
            echo "<table class='scrollTable'>";
             echo "<thead class='fixedHeader'>
                <tr class='headerWrap animated fadeInUp'>
                <th class='headerLocation'>Location</th>";
        
        // Create the headers for each day selected
        for ($j = 0; $j < count($dayArray); $j++){
            if ($dayArray[$j] == $today){
               echo "<th class='headerDay today'>" . $dayArray[$j] . "</th>";
            }
            else {
                echo "<th class='headerDay'>" . $dayArray[$j] . "</th>";
            }
        }
        echo "</thead>";
    echo "</tr>";
    echo "<tbody class='scrollContent'>";  
        
    // Query Database  
    $result = $mysqli->query($sql);   
    $array = array();
    $odd = true;
    
    while($row = mysqli_fetch_assoc($result)){    
        $array[] = $row;
    };

    if ($result->num_rows !=0){
        
      for ($i = 0; $i < count($array); $i++){
          //echo ($array['deal']);
        // Creating Odd and Even Classes
        if ($odd == true){
        echo "<tr class='odd animated flipInX'>";
            
        } else {
        echo "<tr class='even animated flipInX'>";
        } // End Odd & Even
          
          echo "<td class='location'>" . $array[$i]['location'] . "</td>";
     
           // For Loop for Each Day Chosen
             for ($j = 0; $j < count($dayArray) - 1; $j++){
              
              echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
                 $i++;
                } // For Loop
            
            echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";

            echo "</tr>";
        
        $odd = !$odd;
      };
        echo "</tbody>";
        echo "</table>"; 
        echo "</div>";
    } // If Results != 0
    
    else {
        // Format as Image Later //
        echo "<img src='Images/noResults.png' class='noResults animated flipInX'>";
    } 
}; // Search Function
    
    function initSearch($sql){ // Load Todays Deals
    include("connection.php");
    
    // Setting 'Today'
    date_default_timezone_set('EST');
    $today = date("l"); // Integer Representing Today
       
        echo "<div id='tableContainer' class='tableContainer'>";
            echo "<table class='scrollTable'>";
             echo "<thead class='fixedHeader'>
                <tr class='headerWrap animated fadeInUp'>
                <th class='headerLocation'>Location</th>";
      
            echo "<th class='headerDay today'>" . $today . "</th>";

        echo "</thead>";
    echo "</tr>";
    echo "<tbody class='scrollContent'>";  
        
    // Query Database  
    $result = $mysqli->query($sql);   
    $array = array();
    $odd = true;
    
    while($row = mysqli_fetch_assoc($result)){    
        $array[] = $row;
    };
        
      for ($i = 0; $i < count($array); $i++){

        // Creating Odd and Even Classes
        if ($odd == true){
        echo "<tr class='odd animated flipInX'>";
            
        } else {
        echo "<tr class='even animated flipInX'>";
        } // End Odd & Even
          
        echo "<td class='location'>" . $array[$i]['location'] . "</td>";
     
        echo "<td class='deal today'>" . $array[$i]['deal'] . "</td>";
                 $i++;

        echo "</tr>";
        
        $odd = !$odd;
      };
        echo "</tbody>";
        echo "</table>"; 
        echo "</div>";
}; // Search Function
      
    ?>
   
    <script type="text/javascript"> 
        $(document).ready(function(){
            
            //Animate the Contact Button
            //setTimeout(function() {$('#myBtn').animate({left: '-200px'}); }, 2000);
            
            // X-Scroll for Mobile
            $(".scrollContent").scroll(function ()
            {   
                $(".fixedHeader").offset({ left: -1*this.scrollLeft });
            });
            
           // Match header width to table width   
           // ONLY RUN ON MOBILE       
           //$(".fixedHeader").width($('.odd').width());
            
           // Add the 'Today' class to day header
           $("." + <?php echo $today ?>).addClass('today');
            
           // Add the 'Today' class to the deals of Today     
           var i = $('.today').index() + 1;
           $("td:nth-child(" + i + ")").addClass('today');
        }); 
    </script> 

</body>                                                               
</html>