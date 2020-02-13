<!-- Begin Page Content -->
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
                <th scope="col">Lend</th>



            </tr>
        </thead>
        <tbody>


            <?php $i = 1 ?>
            <?php foreach ($borrower as $borrow) { ?>
                <?php if ($borrow['id_admin'] == null) {  ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $borrow['name'] ?></td>
                        <td><?= $borrow['item'] ?></td>
                        <td><?= $borrow['quantity_borrow'] ?></td>
                        <td><?= $borrow['date_borrow'] ?></td>
                        <td><?= $borrow['date_end'] ?></td>
                        <td><?= $borrow['reason'] ?></td>
                        <td><a href="" class="badge badge-success" data-toggle="modal" data-target="#VerifyItem<?= $borrow['id_borrow'] ?> ">Lend</a></td>
                    </tr>
                    <?php $i++ ?>
                <?php } ?>


                <!-- Edit Modal -->
                <div class="modal fade" id="VerifyItem<?= $borrow['id_borrow'] ?>" tabindex=" -1" role="dialog" aria-labelledby="VerifyItemLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="VerifyItemLabel">Verify Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Menu/AdminVerify/') . $borrow['id_borrow'] . '/' .
                                                    $borrow['id_item'] ?> ?>" method="post">
                                    <input type="hidden" name="quantity_borrow" value="<?= $borrow['quantity_borrow'] ?>">
                                    <input type="hidden" name="id_admin" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="id_status" value="2">
                                    <p>Verify Borrow <?= $borrow['quantity_borrow'] ?> <?= $borrow['item'] ?> to <?= $borrow['name'] ?> ?</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            <?php } ?>

        </tbody>
    </table>

</div>
</div>