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
            <h4><?php echo $totalproses;?></h4>
        </div>
    </div>
    <div class="row">
    	<div class="panel panel-default">
    		<div class="panel-body">
		    <?php
			    for ($i=0; $i < sizeof($match) ; $i++) { 
				# code...
				echo $match[$i];
				}

		    ?>
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