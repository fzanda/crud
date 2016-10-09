
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    
</head>
 
<body>
    
    <div class="container">
        <div class="span10 offset1">
            
            <div class="row">
                <h3>Read a Customer</h3>
            </div>
  <?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['Client_ID'])) {
        $id = $_REQUEST['Client_ID'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM client where Client_ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>                   
            <div class="form-horizontal" >
                <div class="control-group">
                    <label class="control-label">NAME:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Client_Name'];?>
                            </label>
                        </div>
                    </div>
                      
                <div class="control-group">
                    <label class="control-label">ADDRESS:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Client_Address'];?>
                            </label>
                        </div>
                    </div>
                    
                <div class="control-group">
                    <label class="control-label">CONTACT PERSON:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Client_Contact'];?>
                            </label>
                        </div>
                    </div>
                    
                <div class="control-group">
                    <label class="control-label">PHONE NUMBER:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Client_Phone'];?>
                            </label>
                        </div>
                    </div>
                    
                <div class="control-group">
                    <label class="control-label">POSTCODE:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Client_Postcode'];?>
                            </label>
                        </div>
                    </div>                      
                        <div class="form-actions">
                          <a class="btn" href="index.php">Back</a>
                       </div>
            </div>
        </div>
    </div>
    
</body>
</html>