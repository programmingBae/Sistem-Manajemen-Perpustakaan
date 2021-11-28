<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <h2 style="margin-top:0px">Daftarpinjaman <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
         <div class="form-group">
            <label for="int">IdBuku <?php echo form_error('idBuku') ?></label>
            <input type="text" class="form-control" name="idBuku" id="idBuku" placeholder="IdBuku" value="<?php echo $idBuku; ?>" />
        </div>
        <div class="form-group">
            <label for="int">IdAnggota <?php echo form_error('idAnggota') ?></label>
            <input type="text" class="form-control" name="idAnggota" id="idAnggota" placeholder="IdAnggota" value="<?php echo $idAnggota; ?>" />
        </div>
        <div class="form-group">
            <label for="date">TanggalPinjam <?php echo form_error('tanggalPinjam') ?></label>
            <input type="date" class="form-control" name="tanggalPinjam" id="tanggalPinjam" placeholder="TanggalPinjam" value="<?php echo $tanggalPinjam; ?>" />
        </div>
        <div class="form-group">
            <label for="date"> <?php echo form_error('tanggalKembali') ?></label>
            <input type="hidden" class="form-control" name="tanggalKembali" id="tanggalKembali" placeholder="TanggalKembali" value="<?php echo $tanggalKembali; ?>" />
        </div>
        <div class="form-group">
            <label for="date"><?php echo form_error('tanggalDikembalikan') ?></label>
            <input type="hidden" class="form-control" name="tanggalDikembalikan" id="tanggalDikembalikan" placeholder="TanggalDikembalikan" value="<?php echo $tanggalDikembalikan; ?>" />
        </div>
        <div class="form-group">
            <label for="int"><?php echo form_error('denda') ?></label>
            <input type="hidden" class="form-control" name="denda" id="denda" placeholder="Denda" value="<?php echo $denda; ?>" />
        </div>
       
        <input type="hidden" name="kodePeminjaman" value="<?php echo $kodePeminjaman; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('daftarpinjaman') ?>" class="btn btn-default">Cancel</a>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->