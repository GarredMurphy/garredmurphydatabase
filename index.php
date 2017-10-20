
<!DOCTYPE html>
<?php

    
    include 'database.php';
    
    function displayDeviceList() {
        
        $sql = "SELECT * from heroku_e746fa7e355c8e7.device WHERE 1";
        $name_parameters = array();
        
        if (isset($_GET['submit']))
        {
            if (!empty($_GET['device-name']))
            {
                $sql .= " AND deviceName LIKE :deviceName";
                $named_parameters[":deviceName"] = "%" . $_GET['device-name'] . "%";
                
            }
            if (!empty($_GET['device-type']))
            {
                $sql .= " AND deviceType = '". $_GET['device-type'] . "'";
            }
            
            if (isset($_GET['available']))
            {
                $sql .= " AND status = 'available'";
            }
            
            if (isset($_GET['order-by']))
            {
                $sql .= " ORDER BY " .$_GET['order-by'];
            }
            else {
                $sql .= " ORDER BY deviceName";
            }
            
            
        }
        $dbConn = getDatabaseConnection();
    
    
        
    
        $statement = $dbConn->prepare($sql);
    
        $statement->execute($named_parameters);
    
        $records = $statement->fetchAll();
    
        foreach($records as $record) {
            echo $record["deviceName"]. " ".$record["deviceType"]." ".$record["price"]." ".$record["status"]."<br />";
        }
    
    }
    
    function getDeviceTypes()
    {
        
        $dbConn = getDatabaseConnection();
        $sql = "SELECT DISTINCT(deviceType) from heroku_e746fa7e355c8e7.device";
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll();
        foreach($records as $record) {
            echo "<option value ='". $record["deviceType"] . "'>". $record["deviceType"]."</option>";
        }
    }
    
?>
<html>
    <link href="css/styles.css" rel ="stylesheet" type="text/css" />
    <body>
        <form>
            Device Name <input type="text" name = "device-name">
            
            <br />
            
            Device Type:
            <select name="device-type">
                <option value =""></option>
                <?=getDeviceTypes()?>
            </select>
            <br />
            <input type="checkbox" name ="available"> Available
            
            
            <br />
            
            <input type ="radio" name="order-by" value="price"> Price
            <input type ="radio" name="order-by" value="deviceName"> Name
            <br />
            <input type="submit" value ="Search" name="submit">
        
        </form>
        
        <?=displayDeviceList()?>
    </body>
</html>