<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <h2 style="margin-top:0px">Anggota Read</h2>
    <table class="table">
        <tr>
            <td>NamaAnggota</td>
            <td><?php echo $namaAnggota; ?></td>
        </tr>
        <tr>
            <td>AlamatAnggota</td>
            <td><?php echo $alamatAnggota; ?></td>
        </tr>
        <tr>
            <td>StatusKeanggotaan</td>
            <td><?php echo $statusKeanggotaan; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="<?php echo site_url('anggota') ?>" class="btn btn-default">Cancel</a></td>
        </tr>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->