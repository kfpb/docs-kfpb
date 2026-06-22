
<?php    
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="halaman/hal_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil User
  default:
echo "<div class='title_left'><a href='?halamane=kategori&act=tambahkategori' class='btn btn-round btn-success'>Tambah Data</a></div>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Table $_GET[halamane]</h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                      
                      <li><a class='close-link'><i class='fa fa-close'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    
                    <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Kategori</th>
                          <th><center>Status</center></th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>";
           
      $tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori ASC");
  
    while($r=mysql_fetch_array($tampil)){
   echo "<tr> 
   <td>$r[id_kategori]</td>
   <td>$r[nama_kategori]</td>
   <td><center>"; if ($r['blokir']=='N'){ echo"<span class='label label-success'>Aktif</span>"; } else {echo"<span class='label label-danger'>Block</span>"; } echo"</center></td>
   
   <td><a href='?halamane=kategori&act=editkategori&id=$r[id_kategori]'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=kategori&act=hapus&id=$r[id_kategori]'><span class='badge bg-red'>Hapus</span></a></td>
   </tr> ";
  }
                
                echo"</tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->";

   break;  

  
  
   case "tambahkategori":
   if ($_SESSION[level]=='admin'){
   echo " <!-- page content -->
        
            <div class='page-title'>
              
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Tambah Data <small>$_GET[halamane]</small></h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                      <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>
                        <ul class='dropdown-menu' role='menu'>
                          <li><a href='#'>Settings 1</a>
                          </li>
                          <li><a href='#'>Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class='close-link'><i class='fa fa-close'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>

                    <form method='POST' action='$aksi?halamane=kategori&act=input' enctype='multipart/form-data' class='form-horizontal form-label-left' novalidate>

                        <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='nama_kategori'>Nama Kategori <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='nama_kategori' name='nama_kategori' required='required' data-validate-length-range='1,50' class='form-control col-md-7 col-xs-12'>
                        </div>
                      </div>
                      
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-md-offset-3'>
                          <a href='?halamane=kategori' class='btn btn-primary'>Cancel</a>
                          <button id='send' type='submit' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>"; }
	  
	 
    else{
   echo "<h1>Anda tidak berhak mengakses halaman ini !</h1>";  }
	 
   break;
    
   case "editkategori":
   $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
	  
   echo "<div class='page-title'>
              
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Ubah Data <small>$_GET[halamane]</small></h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                      <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>
                        <ul class='dropdown-menu' role='menu'>
                          <li><a href='#'>Settings 1</a>
                          </li>
                          <li><a href='#'>Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class='close-link'><i class='fa fa-close'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>

                    <form method='POST' action='$aksi?halamane=kategori&act=update' enctype='multipart/form-data' class='form-horizontal form-label-left' novalidate>
                        <input type=hidden name=id value=$r[id_kategori]>
                        <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='nama_kategori'>Nama Kategori <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='nama_kategori' name='nama_kategori' required='required' data-validate-length-range='1,50' class='form-control col-md-7 col-xs-12' value='$r[nama_kategori]'>
                        </div>
                      </div>
                      
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-md-offset-3'>
                          <a href='?halamane=kategori' class='btn btn-primary'>Cancel</a>
                          <button id='send' type='submit' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>";}
	
  
	
    break;  
   }
   //kurawal akhir hak akses halamane
   

   }
   ?>


   </div> 
   </div>
   </div>
   <div class='clear height-fix'></div> 
   </div></div>
