<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
    
     <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><?php echo $icon;?></li>
        </ol>
    </div><!--/.row-->
        
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $icon;?></h1>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-12">
                    <a href="<?php echo site_url('admin2/uppdf');?>" class="btn btn-primary">Import PDF</a>
                    <a href="<?php echo site_url('admin2/presesimilarity');?>" class="btn btn-primary">Presentase Kesamaan Proposal PKM</a>
                    <a href="<?php echo site_url('admin2/NprosesSimilarity');?>" class="btn btn-primary">Presentase Kesamaan Proposal PKM</a>
                    <a href="<?php echo site_url('admin2/exactmatch_bab1');?>" class="btn btn-primary">Presentase Kesamaan Proposal ( BAB I) PKM</a>
                    </div>
                    <br><br>
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <h3>Data Baru</h3>
                        <table id="tbl1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
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