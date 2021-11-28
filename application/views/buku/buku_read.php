<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <h2 style="margin-top:0px">Buku Read</h2>
    <table class="table">
        <tr>
            <td>NamaBuku</td>
            <td><?php echo $namaBuku; ?></td>
        </tr>
        <tr>
            <td>Penerbit</td>
            <td><?php echo $penerbit; ?></td>
        </tr>
        <tr>
            <td>Pengarang</td>
            <td><?php echo $pengarang; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="<?php echo site_url('buku') ?>" class="btn btn-default">Cancel</a></td>
        </tr>
    </table>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->