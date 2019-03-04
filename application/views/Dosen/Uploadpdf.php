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
                     <table id="tbl1" class="table table-striped table-bordered table-responsive" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Tanggal Upload</th>
                                <th>Upload Oleh</th>
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
                            <td><?php echo $value->uploader;?></td>
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
                                <td>Upload Oleh</td>
                                <td>Aksi</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="white-box analytics-info">
                    <h4>Upload PDF</h4>
                    <form action="<?php echo site_url('dosen/importpdf');?>" method="post" enctype="multipart/form-data">
                        <table class="table table-responsive">
                            <tr>
                                <td><input type="file" name="filepdf" required=""></td>
                                <input type="hidden" name="uploader" value="<?php echo $nama;?>">
                            </tr>
                            <tr>
                                <td><label>Jurusan</label>
                                     <?php
                        $data_jurusan = array(
                            'TI',
                            'SIPIL',
                            'LISTRIK',
                            'MESIN',
                            'Elektro',
                            'AKUNTANSI',
                        );
                        echo '<select name="jurusan" class="form-control">';
                        foreach ($data_jurusan as $key => $value) {
                            echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                        echo '</select>';
                        ?>
                                </td>

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