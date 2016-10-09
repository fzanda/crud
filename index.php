<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php
     include 'database.php';
    ?>
    
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
        <div class="row">
            <h3>Module 2 Part 3</h3>
        </div>
            
        <div class="row">
            <p><a href="create.php" class="btn btn-success">Create</a></p>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact person</th>
                            <th>Phone</th>
                            <th>Postcode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                           
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM client ORDER BY Client_ID DESC';
                            foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['Client_Name'] . '</td>';
                                echo '<td>'. $row['Client_Address'] . '</td>';
                                echo '<td>'. $row['Client_Contact'] . '</td>';
                                echo '<td>'. $row['Client_Phone'] . '</td>';
                                echo '<td>'. $row['Client_Postcode'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn btn-warning" href="read.php?Client_ID='.$row['Client_ID'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?Client_ID='.$row['Client_ID'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?Client_ID='.$row['Client_ID'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                                }
                   
                        Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>    
               <div class="container">
        <div class="row">
            <h3>Data View from Multiple Tables</h3>
        </div>
            
        <div class="row">
           
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Resource Name</th>
                            <th>Project Name</th>
                            <th>Project Start Date</th>
                            <th>Client</th>
                            <th>Hourly Usage Rate</th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                           
                            $pdo = Database::connect();
                            $sql= 'SELECT resources.Resources_Name, project.Project_Name, project.Project_Startdate, client.Client_Name, project_has_resources.hourly_Usage_Rate
                                FROM project, client, resources, project_has_resources
                                WHERE project.Client_Client_ID = client.Client_ID
                                AND project.Project_ID = project_has_resources.Project_Project_ID
                                AND project_has_resources.Resources_Resources_ID = resources.Resources_ID
                                ORDER BY project.Project_Name DESC';
                                foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['Resources_Name'] . '</td>';
                                echo '<td>'. $row['Project_Name'] . '</td>';
                                echo '<td>'. $row['Project_Startdate'] . '</td>';
                                echo '<td>'. $row['Client_Name'] . '</td>';
                                echo '<td>'. $row['hourly_Usage_Rate'] . '</td>';
                                //echo '<td width=250></td>';
                                echo '</tr>';
                                }
                        Database::disconnect();
                        ?>
                        </tbody>
                </table>
        </div>
        
    </div> <!-- /container -->
</body>
</html>