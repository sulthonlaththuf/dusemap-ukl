<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message') ?>



    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Borrower</th>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Borrow</th>
                <th scope="col">Back</th>
                <th scope="col">Reason</th>
                <th scope="col">Action</th>



            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($borrower as $borrow) { ?>
                <?php if ($borrow['id_admin'] !== null) {  ?>
                    <?php if ($borrow['id_user'] == $user['id'] && $borrow['id_status'] == 2) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $borrow['name'] ?></td>
                            <td><?= $borrow['item'] ?></td>
                            <td><?= $borrow['quantity_borrow'] ?></td>
                            <td><?= $borrow['date_borrow'] ?></td>
                            <td><?= $borrow['date_end'] ?></td>
                            <td><?= $borrow['reason'] ?></td>
                            <td><a href="" class="badge badge-success" data-toggle="modal" data-target="#ReturnItem<?= $borrow['id_borrow'] ?>">Return</a></td>

                        </tr>

            </div>
            <!-- Edit Modal -->
            <div class="modal fade" id="ReturnItem<?= $borrow['id_borrow'] ?>" tabindex="-1" role="dialog" aria-labelledby="ReturnItemLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ReturnItemLabel">Return</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('Borrow/ReturnItem/') . $borrow['id_borrow'] . '/' . $borrow['id_item'] ?>" method="post">
                                <input type="hidden" name='id_status' value="3">
                                <input type="hidden" name='quantity_borrow' value='<?= $borrow['quantity_borrow'] ?>'>
                                <?php if ($borrow['quantity_borrow'] > 1) { ?>
                                    <p>You sure you want to return <?= $borrow['quantity_borrow'] ?> <?= $borrow['item'] ?>s now ?</p>
                                <?php } else { ?>
                                    <p>You sure you want to return <?= $borrow['quantity_borrow'] ?> <?= $borrow['item'] ?> now ?</p>
                                <?php } ?>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <?php $i++ ?>
        <?php } ?>
    <?php } ?>

<?php } ?>

</tbody>
</table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->