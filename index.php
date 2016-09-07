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
    </div><br><!-- catForm -->
    </div><!-- forms -->
    </div><!-- header -->
    
    
<?php 
   include("connection.php");

    if (isset($_POST['locSubmit'])) {
        
        $sql = "SELECT * FROM deals WHERE location like '%" . $_POST['search'] . "%'";
    
    } elseif (isset($_POST['catSubmit'])) {
        
        $sql = "SELECT * FROM deals WHERE catagory like '%" . $_POST['search'] . "%'";    
        
    } else {
        
        $sql = "SELECT * FROM deals";
        
    };
    
   
    // Query Database  
    $result = $mysqli->query($sql);
    $num_rows = ($result->num_rows) / 7;

    
    //Count the returned rows
    if ($result->num_rows !=0){

    
    echo "<div id='tableWrapper'>";
    echo"<div id='tableScroll'>";
         echo "<table>
            <thead>
            <tr class='odd'>
                <th><span class='header'>Location</span></th>
                <th><span class='header'>Sunday</span></th>
                <th><span class='header'>Monday</span></th>
                <th><span class='header'>Tuesday</span></th>
                <th><span class='header'>Wednesday</span></th>
                <th><span class='header'>Thursday</span></th>
                <th><span class='header'>Friday</span></th>
                <th><span class='header'>Saturday</span></th>
            <thead>
            </tr>";
        
        
        $row = mysqli_fetch_array($result); 

        $i = 0; // Counter to append 'Odd' or 'Even' row class
        
        // Setting 'Today'
        date_default_timezone_set('EST');
        $today = date("N"); // Integer Representing Today
        
        do {
            
            // Loop To Append Even of Odd Classes to Rows
            if ($i % 2 == 0) {
                echo "<tr class='even animated flipInX'>";
            }
            
            else {
                echo "<tr class='odd animated flipInX'>";
            }
        
        echo "<td class='location'><div><a href='" . $row['url'] . "'>" . $row['location'] . "</a></div></td>"; 
        echo "<td class='deal 0'><div>" . $row['deal'] . "</div></td>";
            $row = mysqli_fetch_array($result);
        echo "<td class='deal 1'>" . $row['deal'] . "</div></td>";
            $row = mysqli_fetch_array($result);        
        echo "<td class='deal 2'>" . $row['deal'] . "</div></td>";
            $row = mysqli_fetch_array($result);
        echo "<td class='deal 3'>" . $row['deal'] . "</div></td>";
            $row = mysqli_fetch_array($result);
        echo "<td class='deal 4'>" . $row['deal'] . "</div></td>";
            $row = mysqli_fetch_array($result);
        echo "<td class='deal 5'>" . $row['deal'] . "</div></td>";
            $row = mysqli_fetch_array($result);    
        echo "<td class='deal 6'>" . $row['deal'] . "</div></td>";
            $row = mysqli_fetch_array($result);
    echo "</tr>";

    $i++;
    } while ($i < $num_rows);
        echo "</tr>";
        
    } else { 
        echo "No Results.";}
    
echo "</table>";
echo "<div>"; //TableScroll
echo "<div>"; //TableWrapper
    ?>
    
    <script type="text/javascript"> 
        $(document).ready(function(){
           // Add the 'Today' class to column of days that apply today
           $('td.' + <?php echo $today ?>).addClass('today');
        }); 
       
           // Append animated class when opjects enter view screen
           // ViewPointChecker.js Copyright (c) 2014 Dirk Groenen
        $(document).ready(function() {
            $('.post').addClass("hidden").viewportChecker({
                classToAdd: 'visible animated fadeIn',
                offset: 100
               });
        });
    </script>

</body>                                                               
</html>