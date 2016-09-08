<!DOCTYPE HTML>
<html lang=en>
    <head>
        <title>Ashdeals</title>
        <link rel='icon' type='image/png' href ='Images/small.png'>
        <meta charset = "UTF-8">
        
        <link rel="stylesheet" media='screen and (min-width: 800px)'  href="CSS/stylesheet.css">
            <link rel="stylesheet" media='screen and (min-width: 500px) and (max-width: 799px)'  href="CSS/mobile.css">
            <link rel="stylesheet" media='screen and (max-width: 499px)'  href="CSS/mobile.css">
        
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

<div id='forms'>    
    <form method="post">
        <p class='search'></p>
        <input type="text" name="search" placeholder="Location Name" class='formField'>
        <input class='button hvr-shrink' type="submit" name="locSubmit" value="Search">
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
    
            <br>
        <form method="get">
          <input type="checkbox" name='day[]' value="Sunday">Sunday
          <input type="checkbox" name='day[]' value="Monday">Monday
          <input type="checkbox" name='day[]' value="Tuesday">Tuesday
          <input type="checkbox" name='day[]' value="Wednesday">Wednesday
          <input type="checkbox" name='day[]' value="Thursday">Thursday
          <input type="checkbox" name='day[]' value="Friday">Friday
          <input type="checkbox" name='day[]' value="Saturday">Saturday
          <input class='button hvr-shrink' type="submit" name='daySubmit' value="Search">
        </form>
    </div><br><!-- catForm -->
    </div><!-- forms -->
    </div><!-- header -->
    

<?php 
    // Setting 'Today'
    date_default_timezone_set('EST');
    $today = date("N"); // Integer Representing Today


    if (isset($_POST['locSubmit'])) {
        
        $sql = "SELECT * FROM deals WHERE location like '%" . $_POST['search'] . "%'";
        search($sql);
    
    } elseif (isset($_POST['catSubmit'])) {
        
        $sql = "SELECT * FROM deals WHERE catagory like '%" . $_POST['search'] . "%'"; 
        search($sql);
        
    } elseif (isset($_GET['daySubmit'])) {
        
        $dayArray = implode(", ", $_GET['day']);
        echo $dayArray;
        $sql = "SELECT * FROM deals WHERE day IN (" . $dayArray . ")"; 
        daySearch($sql);
        
    } else {
        
        $sql = "SELECT * FROM deals";
        
    };
    
function search($sql){ // Search Function
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
    echo "<table>";
        
      echo "<tr class='headerWrap animated fadeInUp'>    
            <th class='headerLocation'>Location</th>
            <th class='headerDay'>Sunday</th>
            <th class='headerDay'>Monday</th>
            <th class='headerDay'>Tuesday</th>
            <th class='headerDay'>Wednesday</th>
            <th class='headerDay'>Thursday</th>
            <th class='headerDay'>Friday</th>
            <th class='headerDay'>Saturday</th>
        </tr>";
        
      for ($i = 0; $i < count($array); $i++){
        
        if ($odd == true){
        echo "<tr class='odd animated flipInX'>";
        }
        
        else {
        echo "<tr class='even animated flipInX'>";
        }
          
          echo "<td class='location'>" . $array[$i]['location'] . "</td>";
          
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
        echo "</tr>";
        
        $odd = !$odd;
      };
        echo "</table>"; 
    } // If Results != 0
    
    else {
        // Format as Image Later //
        echo "<img src='Images/noResults.png' class='noResults animated flipInX'>";
    }
    
}; // Search Function
    
    function daySearch($sql){ // Search Function
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
    echo "<table>";
        
      echo "<tr class='headerWrap animated fadeInUp'>    
            <th class='headerLocation'>Location</th>
            <th class='headerDay'>Sunday</th>
            <th class='headerDay'>Monday</th>
            <th class='headerDay'>Tuesday</th>
            <th class='headerDay'>Wednesday</th>
            <th class='headerDay'>Thursday</th>
            <th class='headerDay'>Friday</th>
            <th class='headerDay'>Saturday</th>
        </tr>";
        
      for ($i = 0; $i < count($array); $i++){
        
        if ($odd == true){
        echo "<tr class='odd animated flipInX'>";
        }
        
        else {
        echo "<tr class='even animated flipInX'>";
        }
          
          echo "<td class='location'>" . $array[$i]['location'] . "</td>";
          
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
          $i++;
          echo "<td class='deal'>" . $array[$i]['deal'] . "</td>";
        echo "</tr>";
        
        $odd = !$odd;
      };
        echo "</table>"; 
    } // If Results != 0
    
    else {
        // Format as Image Later //
        echo "<img src='Images/noResults.png' class='noResults animated flipInX'>";
    }
    
}; // Search Function
      
    ?>
    
    <script type="text/javascript"> 
        $(document).ready(function(){
           if (<?php echo $i ?> == <?php echo $today ?> || (<?php echo $i - $today ?>) % 7 == 0){
           $('td').addClass('today');
        }}); 
    </script>

</body>                                                               
</html>