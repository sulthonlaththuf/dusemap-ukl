<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <a href="" class='btn btn-primary mb-3' data-toggle="modal" data-target="#newItemModal">Add Item</a>

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
                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#UpdateItem<?= $item['id_item'] ?>">Edit</a>
                        <a href="" class="badge badge-danger" data-toggle="modal" data-target="#DeleteItem<?= $item['id_item'] ?>">Delete</a>

                    </td>
                </tr>
                <?php $i++ ?>

    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="UpdateItem<?= $item['id_item'] ?>" tabindex="-1" role="dialog" aria-labelledby="UpdateItemLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateItemLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Menu/UpdateItem/') . $item['id_item'] ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="item" name='item' placeholder="Item Name" value="<?= $item['item'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="quantity" name='quantity' placeholder="Quantity Name" value="<?= $item['quantity'] ?>">
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" name="information" aria-label="With textarea"><?= $item['information'] ?></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <!-- Delete Modal  -->
    <div class="modal fade" id="DeleteItem<?= $item['id_item'] ?>" tabindex="-1" role="dialog" aria-labelledby="DeleteItemLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteItemLabel">Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form action="<?= base_url('Menu/DeleteItem/') . $item['id_item'] ?>" method="post">
                    <div class="modal-body">
                        <p>Are you sure you want to delete <?= $item['item'] ?> ?.</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_item" value="<?= $item['id_item'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

</tbody>
</table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="newItemModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newItemModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Menu/edit_item') ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="item" name='item' placeholder="Item Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="quantity" name='quantity' placeholder="Quantity Name">
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="information" name='information' placeholder="Information Name"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>