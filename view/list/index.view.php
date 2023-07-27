

<?php require_once(viewDir."templates/header.view.php") ?>

    <div class="row justify-content-center align-middle w-100">
        <div class="col-12 ">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="text-center text-primary my-4">Student List</h4>
              <a href="<?php echo route("/create") ?>" class="btn btn-outline-primary">Create</a>
            </div>
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr class=" fw-bolder text-primary">
                        <td>Id</td>
                        <td>Name</td>
                        <td>Gender</td>
                        <td>Class</td>
                        <td>Nation</td>
                        <td>Created_at</td>
                        <td>Control</td>
                    </tr>
                </thead>
                <tbody>
                   <?php
                       $students= $data['students'] ;
                       foreach($students as $student):


                    ?>
                     <tr>
                        <td><?= $student['id']?></td>
                        <td><?= $student['name'] ?></td>
                        <td><?= $student['gender'] ?></td>
                        <td><?= $student['class'] ?></td>
                        <td><?= $student['nation_short'] ?></td>
                        <td>
                            <a href="<?= route("/edit",["id"=>$student['id']]) ?>" class="btn btn-sm btn-primary">Edit</a>
                            <form action="<?= route("/delete")?>" method="POST" class="d-inline">
                            <input type="text" hidden name="_method" value="DELETE">
                            <input type="text" name="id" hidden value="<?= $student['id'] ?>">
                             <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                        <td><?= $student['created_at'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          <div class="d-flex justify-content-between">
            <span>
               Total : <?php if($data['total']) echo $data['total'] ?>
            </span>
            
             <?= paginator($data) ?>

            
          </div>
        </div>
    </div>

<?php require_once(viewDir."templates/footer.view.php") ?>
