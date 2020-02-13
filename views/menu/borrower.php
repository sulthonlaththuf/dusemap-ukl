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
                <th scope="col">Status</th>



            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($borrower as $borrow) { ?>
                <?php if ($borrow['id_admin'] !== null && $borrow['id_status'] == 2) {  ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $borrow['name'] ?></td>
                        <td><?= $borrow['item'] ?></td>
                        <td><?= $borrow['quantity_borrow'] ?></td>
                        <td><?= $borrow['date_borrow'] ?></td>
                        <td><?= $borrow['date_end'] ?></td>
                        <td><?= $borrow['reason'] ?></td>
                        <td><i class="fas fa-check fa-fw text-center text-success"></i></td>
                    </tr>
                    <?php $i++ ?>
                <?php } ?>

            <?php } ?>

        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->