						<div class="row top_tiles">
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-beer"></i></div>
                  <div class="count"><?=$varian->nama_varian?></div>
                  <br>
                  <h3>Powder</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-thumb-tack"></i></div>
                  <div class="count"><small><?=$varian->nama_region?></small></div>
                  <br>
                  <h3>Cabang</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-cubes"></i></div>
                  <div class="count"><?=$varian->sisa?></div>
                  <br>
                  <h3>Sisa Stok</h3>
                </div>
              </div>
            </div>

            <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data <small>Karyawan</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" title="Hide"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link" title="Close"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <a href="<?=base_url('index.php/c_admin/add_karyawan')?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add</a>

          <div class="pull-right">          		
            <a href="<?=base_url('index.php/c_admin/inventory')?>" class="btn btn-warning btn-sm"><i class="fa fa-mail-reply"></i> Back</a>
        	</div>

          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action" id="myTable">
              <thead>
                <tr class="headings">
                  <th class="column-title">No</th>
                  <th class="column-title">Nama Menu</th>
                  <th class="column-title">Nama Penyajian </th>
                  <th class="column-title">Harga </th>
                  <th class="column-title" style="width: 10%;">Actions</th>
                </tr>
              </thead>

              <tbody>
              	<?php
              		$no = 1;
              		foreach ($powder as $key => $value) {
              			?>
              				<tr>
	              				<td><?=$no++?></td>
	              				<td><?=$value->nama_powder?></td>
	              				<td><?=$value->nama_penyajian?></td>
	              				<td><?=$value->harga?></td>
	              				<td align="center">
	              					<a href="#" class="tombol-hapus btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
	              				</td>
              				</tr>
              			<?php
              		}
              	?>
              </tbody>
            </table>
          </div>
	
        </div>
      </div>
    </div>
	</div>