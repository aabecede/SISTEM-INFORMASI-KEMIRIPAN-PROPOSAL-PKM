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
        <div class="col-md-12 col-lg-12 col-sm-12">
           <div class="panel panel-default">
                <div class="panel-body">
                    <table id="tbl1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($tabel1 as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $value->username ?></td>
                            <td><?php echo $value->password ?></td>
                            <td>Aksi</td>
                        </tr>
                        <?php 
                        $no++;
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>No</td>
                                <td>Username</td>
                                <td>Password</td>
                                <td>Aksi</td>
                            </tr>
                        </tfoot>
                    </table>
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