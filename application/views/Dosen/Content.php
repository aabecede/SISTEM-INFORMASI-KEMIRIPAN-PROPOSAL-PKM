<div id="page-wrapper">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-3">
    			Jumlah PDF Fix
    			<br><?php $query = $this->db->query('SELECT COUNT(DISTINCT(namadokumen)) as jumlah from katapdf_target ')->row();
    			echo $query->jumlah;
    			?>
    		</div>
    		<div class="col-md-3">
    			Jumlah PDF Abstrak
    			<br><?php $query = $this->db->query('SELECT COUNT(DISTINCT(namadokumen)) as jumlah from abstrak ')->row();
    			echo $query->jumlah;
    			?>
    		</div>
    		<div class="col-md-3">
    			Jumlah PDF Bab 1
    			<br><?php $query = $this->db->query('SELECT COUNT(DISTINCT(namadokumen)) as jumlah from bab1 ')->row();
    			echo $query->jumlah;
    			?>
    		</div>
    		<div class="col-md-3">
    			Jumlah PDF Bab 3
    			<br>
    			<?php $query = $this->db->query('SELECT COUNT(DISTINCT(namadokumen)) as jumlah from bab2 ')->row();
    			echo $query->jumlah;
    			?>
    		</div>
    	</div>
    </div>
</div>