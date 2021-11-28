<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <h2 style="margin-top:0px">Anggota <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">NamaAnggota <?php echo form_error('namaAnggota') ?></label>
            <input type="text" class="form-control" name="namaAnggota" id="namaAnggota" placeholder="NamaAnggota" value="<?php echo $namaAnggota; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">AlamatAnggota <?php echo form_error('alamatAnggota') ?></label>
            <input type="text" class="form-control" name="alamatAnggota" id="alamatAnggota" placeholder="AlamatAnggota" value="<?php echo $alamatAnggota; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">StatusKeanggotaan <?php echo form_error('statusKeanggotaan') ?></label>
            <input type="text" class="form-control" name="statusKeanggotaan" id="statusKeanggotaan" placeholder="StatusKeanggotaan" value="<?php echo $statusKeanggotaan; ?>" />
        </div>
        <input type="hidden" name="idAnggota" value="<?php echo $idAnggota; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('anggota') ?>" class="btn btn-default">Cancel</a>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->