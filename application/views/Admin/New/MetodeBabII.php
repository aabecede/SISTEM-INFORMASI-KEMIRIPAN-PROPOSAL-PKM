
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
            <h4><?php echo @$totalproses;
            echo @$jurusan;
            ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-body">
                <a href="<?php echo site_url('admin2/exactmatch_abs');?>" class="btn btn-info">Abstrak</a>
                <a href="<?php echo site_url('admin2/exactmatch_bab1');?>" class="btn btn-info">Bab 1</a>
                <a href="<?php echo site_url('admin2/exactmatch_bab2');?>" class="btn btn-info">Bab 2</a>
                <a href="<?php echo site_url('admin2/NprosesSimilarity');?>" class="btn btn-info">Semua</a>
                <form action="<?php echo site_url('admin2/exactmatch_bab2');?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <label>Tanggal Awal</label>
                        <input type="input" name="tgl_awal" class="form-control">

                        <label>Persentase</label>
                        <input type="number" min="0" max="100" name="persen" class="form-control">

                    </div>
                    
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <label>Tanggal Akhir</label>
                        <input type="input" name="tgl_akhir" class="form-control">
                        <label>Jurusan</label>
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
                    </div>

                    <div class="col-lg-12 col-md-12" col-xs-12>
                        <input type="submit" class="btn btn-success">
                    </div>

                </form>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <label>Perbandingan PDF Tanggal</label>
                    <br><label><?php echo @$tanggal;?></label>
                </div>
                <?php
                if(@$match == true){
                    foreach ($match as $key => $value) {
                    
                    echo $value;

                    }
                }else{

                    echo 'Silahkan pilih tanggal perbandingan';
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