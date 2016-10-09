<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addressError = null;
        $phoneError = null;
        $contactError = null;
        $postcodeError = null;
         
        // keep track post values
        $Client_Name = $_POST['Client_Name'];
        $Client_Address = $_POST['Client_Address'];
        $Client_Contact = $_POST['Client_Contact'];
        $Client_Phone = $_POST['Client_Phone'];
        $Client_Postcode = $_POST['Client_Postcode'];
        
        //$client_city = $_POST['Postcode_City'];
        //$client_post = $_POST['Postcode_ID'];
         
        // validate input
        $valid = true;
        if (empty($Client_Name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        } 
         
        if (empty($Client_Address)) {
            $addressError = 'Please enter Address';
            $valid = false;
        } 
         
        if (empty($Client_Contact)) {
            $contactError = 'Please enter Contact Person';
            $valid = false;
        } 
        
        if (empty($Client_Phone)) {
            $phoneError = 'Please enter Phone Number';
            $valid = false;
        } 
        
        if (empty($Client_Postcode)) {
            $postcodeError = 'Please enter Postcode';
            $valid = false;
        } 
         
        
        // insert data
        if ($valid) {
          
          
            if($pdo = Database::connect())
            {
              echo "Database updated ";
            }
            else{
              echo "Database was not updated";
            }
            
            echo "<br><br>";
            
            
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /*
            $sql = "BEGIN; INSERT INTO client (Client_Name, Client_Address, Client_Contact, Client_Phone, Client_Postcode ) VALUES(?, ? , ? , ? , ?);
                            INSERT INTO postcode (Postcode_ID, Postcode_City) VALUES(?,?);
                            COMMIT";
            */
            $sql = "INSERT INTO client (Client_Name, Client_Address, Client_Contact, Client_Phone, Client_Postcode) VALUES(?, ? , ? , ? , ?)";
            //$sql= "INSERT INTO client (Client_Name, Postcode_Postcode_ID) VALUES (?, ?)"; $client_post,$client_city
            $q = $pdo->prepare($sql);
            if
            (
              $q->execute(
               
                array(
                  $Client_Name,$Client_Address,$Client_Contact,$Client_Phone,$Client_Postcode
                )
              )
            )
            
            Database::disconnect();
            
        }
        
    } 
?>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="Client_Name" type="text"  placeholder="Name" value="<?php echo !empty($Client_Name)?$Client_Name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($addressError)?'error':'';?>">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="Client_Address" type="text" placeholder="Address" value="<?php echo !empty($Client_Address)?$Client_Address:'';?>">
                            <?php if (!empty($addressError)): ?>
                                <span class="help-inline"><?php echo $addressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($contactError)?'error':'';?>">
                        <label class="control-label">Contact Person</label>
                        <div class="controls">
                            <input name="Client_Contact" type="text"  placeholder="Contact Person" value="<?php echo !empty($Client_Contact)?$Client_Contact:'';?>">
                            <?php if (!empty($contactError)): ?>
                                <span class="help-inline"><?php echo $contactError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                        <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <input name="Client_Phone" type="text"  placeholder="Phone" value="<?php echo !empty($Client_Phone)?$Client_Phone:'';?>">
                            <?php if (!empty($phoneError)): ?>
                                <span class="help-inline"><?php echo $phoneError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                     <div class="control-group <?php echo !empty($postcodeError)?'error':'';?>">
                        <label class="control-label">Postcode</label>
                        <div class="controls">
                            <input name="Client_Postcode" type="text"  placeholder="Postcode" value="<?php echo !empty($Client_Postcode)?$Client_Postcode:'';?>">
                            <?php if (!empty($postcodeError)): ?>
                                <span class="help-inline"><?php echo $postcodeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div> 
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                    </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>