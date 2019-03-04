<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $board;?></h4>
            </div>
        </div>
        <!-- title -->
        <div class="row">
                    <!-- .col -->
            <div class="panel panel-header">
                <div class="panel panel-body">
                    <div class="col-md-12">
                    <a href="<?php echo site_url('admin/uppdf');?>" class="btn btn-primary">Import PDF</a>
                    <a href="<?php echo site_url('admin/presesimilarity');?>" class="btn btn-primary">Presentase Kesamaan Proposal PKM</a>
                    </div>
                    <br><br>
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <h3>Data Baru</h3>
                        <table id="tbl1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dokumen</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($tabel1 as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->nama ?></td>
                            <td><?php echo $value->tgl_up ?></td>
                            <td>Aksi</td>
                        </tr>
                        <?php 
                        $no++;
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>No</td>
                                <td>Nama Dokumen</td>
                                <td>Tanggal Upload</td>
                                <td>Aksi</td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <h3>Data Lama</h3>
                        <table id="tbl2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dokumen</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($tabel2 as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->nama ?></td>
                            <td><?php echo $value->tgl_up ?></td>
                            <td>Aksi</td>
                        </tr>
                        <?php 
                        $no++;
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>No</td>
                                <td>Nama Dokumen</td>
                                <td>Tanggal Upload</td>
                                <td>Aksi</td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#tbl1').DataTable({
            "columnDefs": [{ 
                "targets": [ -1 ],
                "orderable": false,
            }]
        });
     $('#tbl2').DataTable({
            "columnDefs": [{ 
                "targets": [ -1 ],
                "orderable": false,
            }]
        });
</script>