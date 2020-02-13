<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= $this->session->flashdata('message') ?>

    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Information</th>
                <th scope="col">Action</th>


            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($items as $item) { ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $item['item'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['information'] ?></td>
                    <td>
                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#BorrowItem<?= $item['id_item'] ?>">Borrow</a>

                    </td>
                </tr>
                <?php $i++ ?>

                <!-- Edit Modal -->
                <div class="modal fade" id="BorrowItem<?= $item['id_item'] ?>" tabindex="-1" role="dialog" aria-labelledby="BorrowItemLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="BorrowItemLabel">Borrow Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Borrow/userBorrowing') ?>" method="post">
                                    <input type="hidden" name="id_user" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="id_item" value="<?= $item['id_item'] ?>">
                                    <div class="form-group">
                                        <label class="text-center text-primary" for="quantity_borrow">How much you want to borrow <b><?= $item['item'] ?></b></label>
                                        <input type="number" class="form-control" id="quantity_borrow" name='quantity_borrow' placeholder="Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-center text-primary" for="date_borrow">What time you want to borrow</label>
                                        <input type="date" class="form-control" id="date_borrow" name='date_borrow' placeholder="Time for borrow">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-center text-primary" for="date_end">Till</label>
                                        <input type="date" class="form-control" id="date_end" name='date_end' placeholder="End of borrow">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-center text-primary" for="reason">Reason</label>
                                        <textarea class="form-control" id="reason" name='reason'></textarea>
                                    </div>
                                    <input type="hidden" name="id_status" value="2">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>



            <?php } ?>

        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->