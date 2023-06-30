

<?php require_once(viewDir."templates/header.view.php") ?>

    <div class="row justify-content-center align-middle w-100">
        <div class="col-12 col-md-6">
           <div class="d-flex justify-content-between align-items-center">
              <h4 class="text-center text-primary my-4">Add Student</h4>
              <a href="<?php echo route("/") ?>" class="btn btn-outline-primary">List</a>
            </div>
            <form action="<?php echo route("/store") ?>" method="POST">
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="enter name">
                </div>
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Gender</label>
                    <input type="text" name="gender" class="form-control" placeholder="enter gender">
                </div>
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Class</label>
                    <input type="text" name="class" class="form-control" placeholder="enter class">
                </div>
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Nation</label>
                    <input type="text" name="nation" class="form-control" placeholder="enter nation">
                </div>
                
                <div class="text-end mt-4">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

<?php require_once(viewDir."templates/footer.view.php") ?>
