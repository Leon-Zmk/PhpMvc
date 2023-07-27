

<?php require_once(viewDir."templates/header.view.php") ?>

<?php $student=$data['student'] ?>

    <div class="row justify-content-center align-middle w-100">
        <div class="col-12 col-md-6">
           <div class="d-flex justify-content-between align-items-center">
              <h4 class="text-center text-primary my-4">Add Student</h4>
              <a href="<?php echo route("/") ?>" class="btn btn-outline-primary">List</a>
            </div>
            <form action="<?= route("/update") ?>" method="POST">
                <input type="text" hidden name="_method" value="UPDATE" />
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $student['name'] ?>"  placeholder="enter name">
                </div>
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Gender</label>
                    <input type="text" name="gender" class="form-control" value="<?= $student['gender'] ?>" placeholder="enter gender">
                </div>
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Class</label>
                    <input type="text" name="class" class="form-control" value="<?= $student['class'] ?>" placeholder="enter class">
                </div>
                <div class="form-group">
                    <label class="form-label mb-2 text-primary" for="">Nation</label>
                    <input type="text" name="nation" class="form-control" value="<?= $student['nation_short'] ?>" placeholder="enter nation">
                </div>
                
                <div class="text-end mt-4">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

<?php require_once(viewDir."templates/footer.view.php") ?>
