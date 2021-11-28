<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>



    <h2 style="margin-top:0px">Daftarpinjaman List</h2>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <?php echo anchor(site_url('daftarpinjaman/create'), 'Create', 'class="btn btn-primary"'); ?>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 8px" id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-1 text-right">
        </div>
        <div class="col-md-3 text-right">
            <form action="<?php echo site_url('daftarpinjaman/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php
                        if ($q <> '') {
                        ?>
                            <a href="<?php echo site_url('daftarpinjaman'); ?>" class="btn btn-default">Reset</a>
                        <?php
                        }
                        ?>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>TanggalPinjam</th>
            <th>TanggalKembali</th>
            <th>TanggalDikembalikan</th>
            <th>Denda</th>
            <th>IdBuku</th>
            <th>IdAnggota</th>
            <th>Action</th>
        </tr><?php
                foreach ($daftarpinjaman_data as $daftarpinjaman) {
                ?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td><?php echo $daftarpinjaman->tanggalPinjam ?></td>
                <td><?php echo $daftarpinjaman->tanggalKembali ?></td>
                <td><?php echo $daftarpinjaman->tanggalDikembalikan ?></td>
                <td>Rp.<?php echo $daftarpinjaman->denda ?>,00</td>
                <td><?php echo $daftarpinjaman->idBuku ?></td>
                <td><?php echo $daftarpinjaman->idAnggota ?></td>
                <td style="text-align:center" width="200px">
                    <?php
                    echo anchor(site_url('daftarpinjaman/read/' . $daftarpinjaman->kodePeminjaman), 'Read');
                    echo ' | ';
                    echo anchor(site_url('daftarpinjaman/update/' . $daftarpinjaman->kodePeminjaman), 'Pengembalian');

                    ?>
                </td>
            </tr>
        <?php
                }
        ?>
    </table>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        </div>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->