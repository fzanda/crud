<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['Client_ID'])) {
        $id = $_REQUEST['Client_ID'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addressError = null;
        $contactError = null;
        $phoneError = null;
        $postcodeError = null;
         
        // keep track post values
        $Client_Name = $_POST['Client_Name'];
        $Client_Address = $_POST['Client_Address'];
        $Client_Contact = $_POST['Client_Contact'];
        $Client_Phone = $_POST['Client_Phone'];
        $Client_Postcode = $_POST['Client_Postcode'];
        
         
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
            $contactError = 'Please enter the Contact Person';
            $valid = false;
        }
        
        if (empty($Client_Phone)) {
            $phoneError = 'Please enter the Telephone number';
            $valid = false;
        }
        
        if (empty($Client_Postcode)) {
            $postcodeError = 'Please enter the Postcode';
            $valid = false;
        }
        
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE client set Client_Name = ?, Client_Address = ?, Client_Contact = ?, Client_Phone = ?, Client_Postcode = ? WHERE Client_ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($Client_Name,$Client_Address,$Client_Contact,$Client_Phone,$Client_Postcode,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM client where Client_ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $Client_Name = $data['Client_Name'];
        $Client_Address = $data['Client_Address'];
        $Client_Contact = $data['Client_Contact'];
        $Client_Phone = $data['Client_Phone'];
        $Client_Postcode = $data['Client_Postcode'];
        Database::disconnect();
    }
?><!DOCTYPE html>
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
		    			<h3>Update a Customer</h3>
		    		</div>
             
                    <form class="form-horizontal" action="update.php?Client_ID=<?php echo $id?>" method="post">
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
                            <?php endif;?>
                        </div>
                      </div> 
                      <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>