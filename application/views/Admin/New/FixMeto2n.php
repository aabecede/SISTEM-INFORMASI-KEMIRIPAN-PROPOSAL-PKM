
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
        <div class="panel panel-info">
            <div class="panel-body">
                <form action="<?php echo site_url('admin2/NprosesSimilarity');?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        
                        <label>Tanggal Pdf Sumber</label>
                        <input type="date" name="tgl_awal" class="form-control">

                        <label>Persentase</label>
                        <input type="number" name="persen" class="form-control" min="0" max="100">

                    </div>
                    
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <label>Tanggal Pdf Target</label>
                        <input type="date" name="tgl_akhir" class="form-control">
                    </div>


                    <div class="col-lg-12 col-md-12" col-xs-12>
                        <input type="submit" name="submit" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>