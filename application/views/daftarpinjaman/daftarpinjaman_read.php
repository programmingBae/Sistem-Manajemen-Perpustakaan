<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>



    <h2 style="margin-top:0px">Daftarpinjaman Read</h2>
    <table class="table">
        <tr>
            <td>TanggalPinjam</td>
            <td><?php echo $tanggalPinjam; ?></td>
        </tr>
        <tr>
            <td>TanggalKembali</td>
            <td><?php echo $tanggalKembali; ?></td>
        </tr>
        <tr>
            <td>TanggalDikembalikan</td>
            <td><?php echo $tanggalDikembalikan; ?></td>
        </tr>
        <tr>
            <td>Denda</td>
            <td>Rp.<?php echo $denda; ?>,00</td>
        </tr>
        <tr>
            <td>IdBuku</td>
            <td><?php echo $idBuku; ?></td>
        </tr>
        <tr>
            <td>IdAnggota</td>
            <td><?php echo $idAnggota; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="<?php echo site_url('daftarpinjaman') ?>" class="btn btn-default">Cancel</a></td>
        </tr>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->