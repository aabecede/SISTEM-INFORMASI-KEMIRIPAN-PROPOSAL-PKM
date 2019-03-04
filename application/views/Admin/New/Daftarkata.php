<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"><?php echo $icon;?></li>
		</ol>
	</div>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $icon;?></h1>
        </div>
    </div>

	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<table id="tbl1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kata</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        
                        foreach ($tabel1 as $key => $value) { ?>
                        <tr>
                            <td><?php echo ($key+1) ?></td>
                            <td><?php echo $value->huruf ?></td>
                        </tr>
                        <?php 
                        } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>No</td>
                                <td>Nama Kata</td>
                            </tr>
                        </tfoot>
                    </table>
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