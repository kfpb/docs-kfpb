
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
$aksi="halaman/hal_member/aksi_member.php";
switch($_GET[act]){
  // Tampil User
  default:
echo "<div class='title_left'><a href='tambah-member.html' class='btn btn-round btn-success'>Tambah Data</a></div>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Table $_GET[act]</h2>
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
                          <th>nama_lengkap</th>
                          <th>email</th>
                          <th>foto</th>
                          <th>level</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>";
 
  $tampil = mysql_query("SELECT * FROM member ORDER BY username ASC");
  
    while($r=mysql_fetch_array($tampil)){
   echo "<tr> 
   <td>$r[nama_lengkap]</td>
   <td>$r[email]</td>
   <td><img src='foto_user/small_$r[foto]' width='30%'></td>
   <td>$r[level]</td>
   
   <td><a href='edit-member-$r[username].html'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=member&act=hapus&id=$r[username]&hal=pegawai&acts=pegawai'><span class='badge bg-red'>Hapus</span></a></td>
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

   case "tambahmember":
   if ($_SESSION[level]=='admin'){
   echo "<div class=\"row\">
              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>Daftar Anggota</h2>
                    <ul class=\"nav navbar-right panel_toolbox\">
                      <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a>
                      </li>
                      <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><i class=\"fa fa-wrench\"></i></a>
                        <ul class=\"dropdown-menu\" role=\"menu\">
                          <li><a href=\"#\">Settings 1</a>
                          </li>
                          <li><a href=\"#\">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class=\"close-link\"><i class=\"fa fa-close\"></i></a>
                      </li>
                    </ul>
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">
                    <br />
                    <form id=\"demo-form2\" data-parsley-validate class=\"form-horizontal form-label-left\" name=\"form\" action=\"$aksi?halamane=member&act=input\" method=\"post\" enctype=\"multipart/form-data\">
                    
                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Nama Lengkap <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"text\" id=\"nama_lengkap\" name=\"nama_lengkap\" required=\"required\" class=\"form-control col-md-7 col-xs-12\">
                        </div>
                      </div>

                        <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">No HP <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"text\" id=\"hp\" name=\"hp\" required=\"required\" class=\"form-control col-md-7 col-xs-12\">
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">Email <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"email\" id=\"email\" name=\"email\" required=\"required\" class=\"form-control col-md-7 col-xs-12\">
                        </div>
                      </div>

                       <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"password\">Password <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"password\" id=\"password\" name=\"password\" required=\"required\" class=\"form-control col-md-7 col-xs-12\">
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">Foto <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"file\" name=\"fupload\" id=\"exampleInputFile\" required=\"required\">
                       <p class=\"help-block\">Upload foto disini.</p>
                        </div>
                      </div>

                      <div class=\"ln_solid\"></div>
                      <div class=\"form-group\">
                        <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                          <button type=\"submit\" class=\"btn btn-primary\">Cancel</button>
                          <button type=\"submit\" class=\"btn btn-success\">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>"; }
	  
	 
    else{
   echo "<h1>Anda tidak berhak mengakses halaman ini !</h1>";  }
	 


   break;
    
   case "editmember":
   $edit=mysql_query("SELECT * FROM member WHERE username='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
	  
  echo "<div class=\"row\">
              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>Ubah Anggota</h2>
                    <ul class=\"nav navbar-right panel_toolbox\">
                      <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a>
                      </li>
                      <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><i class=\"fa fa-wrench\"></i></a>
                        <ul class=\"dropdown-menu\" role=\"menu\">
                          <li><a href=\"#\">Settings 1</a>
                          </li>
                          <li><a href=\"#\">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class=\"close-link\"><i class=\"fa fa-close\"></i></a>
                      </li>
                    </ul>
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">
                    <br />
                    <form id=\"demo-form2\" data-parsley-validate class=\"form-horizontal form-label-left\" name=\"form\" action=\"$aksi?halamane=member&act=update\" method=\"post\" enctype=\"multipart/form-data\">
                    <input type=hidden name=id value=$r[username]>
                   

                      


                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Nama Lengkap <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"text\" id=\"nama_lengkap\" name=\"nama_lengkap\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[nama_lengkap]'>
                        </div>
                      </div>

                      
                     

                        <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">No HP <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"text\" id=\"hp\" name=\"hp\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[hp]'>
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">Email <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"email\" id=\"email\" name=\"email\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[email]'>
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Password <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"password\" id=\"password\" name=\"password\" required=\"required\" class=\"form-control col-md-7 col-xs-12\">
                        </div>
                      </div>

                       <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">Foto <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                        <img src=\"foto_user/$r[foto]\" alt=\"\">
                        
                          <input type=\"file\" name=\"fupload\" id=\"exampleInputFile\">
                  <p class=\"help-block\">Upload foto disini.</p>
                        </div>
                      </div>

                      <div class=\"ln_solid\"></div>
                      <div class=\"form-group\">
                        <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                          <button type=\"submit\" class=\"btn btn-primary\">Cancel</button>
                          <button type=\"submit\" class=\"btn btn-success\">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>";
          }
	
    break;  

    case "editpemohon":
   $edit=mysql_query("SELECT * FROM member WHERE id_member='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
    
  echo "<div class=\"row\">
              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>Ubah Anggota</h2>
                    <ul class=\"nav navbar-right panel_toolbox\">
                      <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a>
                      </li>
                      <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><i class=\"fa fa-wrench\"></i></a>
                        <ul class=\"dropdown-menu\" role=\"menu\">
                          <li><a href=\"#\">Settings 1</a>
                          </li>
                          <li><a href=\"#\">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class=\"close-link\"><i class=\"fa fa-close\"></i></a>
                      </li>
                    </ul>
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">
                    <br />
                    <form id=\"demo-form2\" data-parsley-validate class=\"form-horizontal form-label-left\" name=\"form\" action=\"$aksi?halamane=member&act=updatepemohon\" method=\"post\" enctype=\"multipart/form-data\">
                    <input type=hidden name=id value=$r[id_member]>
                    <input type=hidden name=hal value=$_GET[hal]>
                     <input type=hidden name=cal value=$_GET[cal]>
                    <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Username <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"text\" id=\"username\" name=\"username\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[username]'>
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Password <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"password\" id=\"password\" name=\"password\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[password]'>
                        </div>
                      </div>


                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Nama Lengkap <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"text\" id=\"nama_lengkap\" name=\"nama_lengkap\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[nama_lengkap]'>
                        </div>
                      </div>

                      

                     
                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">Foto <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                        <img src=\"foto_user/$r[foto]\" alt=\"\">
                        
                          <input type=\"file\" name=\"fupload\" id=\"exampleInputFile\">
                  <p class=\"help-block\">Upload foto disini.</p>
                        </div>
                      </div>

                        <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">No HP <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"text\" id=\"hp\" name=\"hp\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[hp]'>
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last-name\">Email <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input type=\"email\" id=\"email\" name=\"email\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value='$r[email]'>
                        </div>
                      </div>


                      <div class=\"ln_solid\"></div>
                      <div class=\"form-group\">
                        <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                          <button type=\"submit\" class=\"btn btn-primary\">Cancel</button>
                          <button type=\"submit\" class=\"btn btn-success\">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>";
          }
  
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
