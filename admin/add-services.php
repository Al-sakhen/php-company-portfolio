<?php 
  require('./includes/head.php')
?>
    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <?php 
                    if(isset($_SESSION['create'])){ ?>
                        <div class="aletr alert-success h-10
                         d-flex justify-content-center align-items-center mb-5">
                            <?= $_SESSION['create']; ?>
                        </div>
                    <?php 
                        unset($_SESSION['create']);    
                }
                ?>
                <h3 class="mb-3">Add Service</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="../handlers/db.php" method="post">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" class="form-control">
                            </div>

                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"  rows="3"></textarea>
                            </div>
                            
                            <div class="form-group">
                              <label>Icon</label>
                              <input type="text" name="icon" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                  <option value="0">not active</option>
                                  <option value="1">active</option>
                                </select>
                            </div>
                        
                              
                            <div class="text-center mt-5">
                                <button name="addService" type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>