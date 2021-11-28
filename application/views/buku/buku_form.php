<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <h2 style="margin-top:0px">Buku <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">NamaBuku <?php echo form_error('namaBuku') ?></label>
            <input type="text" class="form-control" name="namaBuku" id="namaBuku" placeholder="NamaBuku" value="<?php echo $namaBuku; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Penerbit <?php echo form_error('penerbit') ?></label>
            <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="Penerbit" value="<?php echo $penerbit; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Pengarang <?php echo form_error('pengarang') ?></label>
            <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Pengarang" value="<?php echo $pengarang; ?>" />
        </div>
        <input type="hidden" name="idBuku" value="<?php echo $idBuku; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('buku') ?>" class="btn btn-default">Cancel</a>
    </form>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->