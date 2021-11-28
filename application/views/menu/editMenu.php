<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">

            <label for="namaMenu">Menu</label>
            <input type="text" class="form-control" id="editMenu" name='editMenu' value="<?= $editMenu ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
        </div>
        <div class="form-group">
            <button type='submit' class="btn btn-primary">Edit</button>
        </div>

    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->