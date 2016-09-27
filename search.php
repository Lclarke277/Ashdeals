
<?php
echo "You Made It";
if (isset($_POST['locSubmit'])) {
    $sql = "SELECT * FROM deals WHERE location like '%" . $_POST['search'] . "%'";
    search($sql);
};

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
?>