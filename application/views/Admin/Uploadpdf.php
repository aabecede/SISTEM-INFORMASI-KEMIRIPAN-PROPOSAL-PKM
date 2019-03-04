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
            <div class="col-md-6">
                <div class="white-box analytics-info">
                    <h4>Tampilan</h4>
                     <table id="tbl1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
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
                                <td>Nama</td>
                                <td>Tanggal Upload</td>
                                <td>Aksi</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="white-box analytics-info">
                    <h4>Upload PDF</h4>
                    <form action="<?php echo site_url('admin/importpdf');?>" method="post" enctype="multipart/form-data">
                        <table class="table table-responsive">
                            <tr>
                                <td><input type="file" name="filepdf" required=""></td>
                                <input type="hidden" name="uploader" value="<?php echo $nama;?>">
                            </tr>
                            <tr>
                                <td><input type="submit" value="Upload" class="btn btn-primary"></td>
                            </tr>
                        </table>
                    </form>
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
</script>