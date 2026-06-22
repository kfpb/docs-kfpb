<div class="navbar navbar-inner block-header">
	<div class="muted pull-left">E-Notulen</div>
</div>
<?
$aksi="include/hal_notulen/aksi_notulen.php";
switch($_GET[act]){
  // Tampil User
  default:
echo "<div class='title_left'>";
if($_SESSION[level]=='admin'){ echo"<a href='tambah-notulen.html' class='btn btn-round btn-success'>Tambah Data</a>"; } echo"</div>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Table $_GET[halamane]</h2>
                    
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    
                    <table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Date Isseus</th>
                          <th>Time</th>
                          <th>Agenda</th>";
                          if($_SESSION[level]=='admin'){ echo"<th>Action</th>";} echo"</tr>
                      </thead>
                      <tbody>";
           
      $tampil = mysql_query("SELECT * FROM notulen ORDER BY id_notulen ASC");
  
    while($r=mysql_fetch_array($tampil)){
          $subject =(strip_tags($r[agenda])); 
          $isi = substr($subject,0,100); 
          $isi = substr($subject,0,strrpos($isi," "));
   echo "<tr> 
   <td><a href='notulen-detail-$r[id_notulen].html'>$r[id_notulen]</a></td>
   <td><a href='notulen-detail-$r[id_notulen].html'>$r[date_isseus]</a></td>
   <td><a href='notulen-detail-$r[id_notulen].html'>$r[start_time] - $r[end_time]</a></td>
   <td><a href='notulen-detail-$r[id_notulen].html'>$isi ...</a></td>"; 
   if($_SESSION[level]=='admin'){ echo"<td><a href='edit-notulen-$r[id_notulen].html'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=notulen&act=hapus&id=$r[id_notulen]'><span class='badge bg-red'>Hapus</span></a></td>";} echo"
   
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

  
  
   case "tambahnotulen":
   if ($_SESSION[level]=='admin'){
   echo "
            </div>
            <div class=\"clearfix\"></div>
            <div class=\"row\">
              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                     <h2>Form Tambah Data <small>$_GET[halamane]</small></h2>
                    
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">
                    <br />
                    <form id='demo-form' method='POST' action='$aksi?halamane=notulen&act=input' enctype='multipart/form-data' data-parsley-validate class='form-horizontal form-label-left'>

                    

                       <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Date Isseus <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input name='date_isseus' id=\"birthday\" class=\"date-picker form-control col-md-7 col-xs-12\" required=\"required\" type=\"text\">
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Start Time</label>
                         <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='start_time' type=\"text\" required=\"required\" class=\"form-control\" data-inputmask=\"'mask' : '99:99'\">
                          <span class=\"fa fa-history form-control-feedback right\" aria-hidden=\"true\"></span>
                        </div>
                      </div>

                       <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">End Time</label>
                         <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='end_time' type=\"text\" required=\"required\" class=\"form-control\" data-inputmask=\"'mask' : '99:99'\">
                          <span class=\"fa fa-history form-control-feedback right\" aria-hidden=\"true\"></span>
                        </div>
                      </div>

                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='place'>Place <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='place' id='place' class='form-control col-md-7 col-xs-12' required='required' type='text'>
                        </div>
                      </div>

                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='agenda'>Agenda <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <textarea id=\"message\" required=\"required\" class=\"form-control\" name=\"agenda\" data-parsley-trigger=\"keyup\" data-parsley-minlength=\"5\" data-parsley-maxlength=\"200\" data-parsley-minlength-message=\"You need to enter at least a 5 caracters long comment..\"
                            data-parsley-validation-threshold=\"10\"></textarea>
                        </div>
                      </div>

                      
                      
                      <div class=\"form-group\">
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='participant'>Participant <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input required=\"required\"  name='participant' id=\"tags_1\" type=\"text\" class=\"form-control col-md-7 col-xs-12\" />
                          <div id=\"suggestions-container\" style=\"position: relative; float: left; width: 250px; margin: 10px;\"></div>
                        </div>
                      </div>

                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-md-offset-3'>
                          <a href='?halamane=notulen' class='btn btn-primary'>Cancel</a>
                          <button id='send' type='submit' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

         <!-- start form for validation -->
                    <form id=\"demo-form2\" data-parsley-validate>
                    </form>
                    <!-- end form for validations -->
            
           "; }
	  
	 
    else{
   echo "<h1>Anda tidak berhak mengakses halaman ini !</h1>";  }
	 
   break;
   
   case "tambahnotulendetail":
   if ($_SESSION[level]=='admin'){
	$edit=mysql_query("SELECT * FROM notulen WHERE id_notulen='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   echo "
            </div>
            <div class=\"clearfix\"></div>
            <div class=\"row\">
              <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                     <h2>Tambah Detail Agenda :  <small>$r[agenda]</small></h2>
                    
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">
                    <br />
                    <form id='demo-form' method='POST' action='$aksi?halamane=notulen&act=inputdetail' enctype='multipart/form-data' data-parsley-validate class='form-horizontal form-label-left'>
					<input type='hidden'  name='id_notulen' value='$_GET[id]'>
                    <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='issues'>Issues <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <textarea id=\"message\" required=\"required\" class=\"form-control\" name=\"issues\" data-parsley-trigger=\"keyup\" data-parsley-minlength=\"5\" data-parsley-maxlength=\"200\" data-parsley-minlength-message=\"You need to enter at least a 5 caracters long comment..\"
                            data-parsley-validation-threshold=\"10\"></textarea>
                        </div>
                      </div>
					  
					  <div class=\"form-group\">
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='pic'>PIC <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input required=\"required\"  name='pic' id=\"tags_1\" type=\"text\" class=\"form-control col-md-7 col-xs-12\" />
                          <div id=\"suggestions-container\" style=\"position: relative; float: left; width: 250px; margin: 10px;\"></div>
                        </div>
                      </div>

                       <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Due Date <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input name='due_date' id=\"birthday\" class=\"date-picker form-control col-md-7 col-xs-12\" required=\"required\" type=\"text\">
                        </div>
                      </div>

                     

                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='division'>Division <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='division' id='division' class='form-control col-md-7 col-xs-12' required='required' type='text'>
                        </div>
                      </div>

                      
					 <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='Remark'>Remark <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='remark' id='remark' class='form-control col-md-7 col-xs-12' required='required' type='text'>
                        </div>
                      </div>
                      
                      
                      

                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-md-offset-3'>
                          <a href='?halamane=notulen' class='btn btn-primary'>Cancel</a>
                          <button id='send' type='submit' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

         <!-- start form for validation -->
                    <form id=\"demo-form2\" data-parsley-validate>
                    </form>
                    <!-- end form for validations -->
            
           "; }
	  
	 
    else{
   echo "<h1>Anda tidak berhak mengakses halaman ini !</h1>";  }
	 
   break;
    
   case "editnotulen":
   $edit=mysql_query("SELECT * FROM notulen WHERE id_notulen='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
	  
   echo "<div class='page-title'>
              
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Ubah Data <small>$_GET[halamane]</small></h2>
                  
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                  
                    <form id='demo-form' method='POST' action='$aksi?halamane=notulen&act=update' enctype='multipart/form-data' data-parsley-validate class='form-horizontal form-label-left'>

                        <input type=hidden name=id value=$r[id_notulen]>
                       <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Date Isseus <span class=\"required\">*</span>
                        </label>
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                          <input name='date_isseus' id=\"birthday\" class=\"date-picker form-control col-md-7 col-xs-12\" required=\"required\" type=\"text\" value=$r[date_isseus]>
                        </div>
                      </div>

                      <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Start Time</label>
                         <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='start_time' type=\"text\" required=\"required\" class=\"form-control\" data-inputmask=\"'mask' : '99:99'\" value=$r[start_time]>
                          <span class=\"fa fa-history form-control-feedback right\" aria-hidden=\"true\"></span>
                        </div>
                      </div>

                       <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">End Time</label>
                         <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='end_time' type=\"text\" required=\"required\" class=\"form-control\" data-inputmask=\"'mask' : '99:99'\" value=$r[end_time]>
                          <span class=\"fa fa-history form-control-feedback right\" aria-hidden=\"true\"></span>
                        </div>
                      </div>

                     
                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='place'>Place <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input name='place' id='place' class='form-control col-md-7 col-xs-12' required='required' type='text' value=$r[place]>
                        </div>
                      </div>

                    
                       <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='agenda'>Agenda <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <textarea id=\"message\" required=\"required\" class=\"form-control\" name=\"agenda\" data-parsley-trigger=\"keyup\" data-parsley-minlength=\"5\" data-parsley-maxlength=\"200\" data-parsley-minlength-message=\"You need to enter at least a 5 caracters long comment..\"
                            data-parsley-validation-threshold=\"10\">$r[agenda]</textarea>
                        </div>
                      </div>

                      
                      
                      <div class=\"form-group\">
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='Participant'>participant <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input required=\"required\"  name='participant' id=\"tags_1\" type=\"text\" class=\"form-control col-md-7 col-xs-12\" value='$r[participant]'/>
                          <div id=\"suggestions-container\" style=\"position: relative; float: left; width: 250px; margin: 10px;\"></div>
                        </div>
                      </div>


                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-md-offset-3'>
                          <a href='?halamane=notulen' class='btn btn-primary'>Cancel</a>
                          <button id='send' type='submit' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
               <!-- start form for validation -->
                    <form id=\"demo-form2\" data-parsley-validate>
                    </form>
                    <!-- end form for validations -->";}
	
    break;  

  case "detailnotulen":

   $edit=mysql_query("SELECT * FROM notulen WHERE id_notulen='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   $tanggal=tgl_indo($r['date_isseus']);
   echo"<title><small><br/>$r[agenda]</small></title>";
   echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>Agenda Notulen <small>$r[agenda]</small></h2>
                    <ul class=\"nav navbar-right panel_toolbox\">
                     
                      <li class=\"dropdown\">
                        <a href='tambah-notulen-detail-$_GET[id].html' class='button'><i class=\"fa fa-plus\"></i></a>
                        
                      </li>
                      
                    </ul>
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">

                  <div class=\"alert alert-success alert-dismissible fade in\" role=\"alert\">
                    
                  <strong><p class=\"text-muted font-13 m-b-30\">
                    <table>
                    <tr>
                    <td width='30%'>Date</td>
                    <td>:</td>
                    <td>$tanggal</td>
                    </tr>
                    <tr>
                    <td>Time</td>
                    <td>:</td>
                    <td>$r[start_time] - $r[end_time]</td>
                    </tr>
                    <tr>
                    <td>Place</td>
                    <td>:</td>
                    <td>$r[place]</td>
                    </tr>
                    <tr>
                    <td>Participant</td>
                    <td>:</td>
                    <td>$r[participant]</td>
                    </tr>
                    </table></p></strong>
                  </div>

                    <table id=\"datatable-buttons\" class=\"table table-striped table-bordered\">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Info/Problems / Issues</th>
                          <th>PIC</th>
                          <th>Due Date</th>
                          <th>Status</th>
                          <th>Remarks</th>";
						  if($_SESSION[level]=='admin'){
                          echo"<th><center>Aksi</center></th>";
						  }
                        echo"</tr>
                      </thead>  


                      <tbody>";

                      $sql=mysql_query("SELECT * FROM notulen_detail WHERE id_notulen='$r[id_notulen]'");
                      $no=1;
                      while ($a=mysql_fetch_array($sql)) {
                        $tanggal=tgl_indo($a[due_date]);
                        echo"<tr>
                          <td>$no</td>
                          <td>$a[issues]</td>
                          <td>$a[pic]</td>
                          <td>$tanggal</td>
                          <td><center>"; 
						  if ($a['status']=='Closed'){ echo"<a href='$aksi?halamane=notulen&act=updatestatus&id=$a[id_notulen_detail]&status=Open&id_notulen=$r[id_notulen]'><span class='label label-success'>Closed</span></a>"; } 
						  if ($a['status']=='Open'){echo"<a href='$aksi?halamane=notulen&act=updatestatus&id=$a[id_notulen_detail]&status=Closed&id_notulen=$r[id_notulen]'><span class='label label-danger'>Open</span></a>"; } 
						  echo"</center></td>
                          <td>$a[remark]</td>";
						  if($_SESSION[level]=='admin'){
                          echo"
                          <td> <center><a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=notulen&act=hapusdetail&id=$a[id_notulen_detail]&id_notulen=$r[id_notulen]'><i class=\"fa fa-close\"></i></a></center></td>";
						  }
                        echo"
                        </tr>";
                      $no++;
                      }
                        
                      echo"</tbody>
                    </table>
                  </div>
                </div>
              ";
  
    break; 

    case "detailnotulenstatus":
   
   echo"<title> - $_GET[status]</title>";
   echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>Agenda Notulen <small>$r[agenda]</small></h2>
                    
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">

                  

                    <table id=\"datatable-buttons\" class=\"table table-striped table-bordered\">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Info/Problems / Issues</th>
                          <th>PIC</th>
                          <th>Due Date</th>
                          <th>Status</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>  


                      <tbody>";

                      $sql=mysql_query("SELECT * FROM notulen_detail WHERE status='$_GET[status]'");
                      $no=1;
                      while ($a=mysql_fetch_array($sql)) {
                        $tanggal=tgl_indo($a[due_date]);
                        echo"<tr>
                          <td>$no</td>
                          <td>$a[issues]</td>
                          <td>$a[pic]</td>
                          <td>$tanggal</td>
                          <td><center>"; if ($a['status']=='Closed'){ echo"<span class='label label-success'>Closed</span>"; } elseif ($a['status']=='Info'){ echo"<span class='label label-info'>Info</span>"; } else {echo"<span class='label label-danger'>Open</span>"; } echo"</center></td>
                          <td>$a[remark]</td>
                        </tr>";
                      $no++;
                      }
                        
                      echo"</tbody>
                    </table>
                  </div>
                </div>
              ";
  
    break;


    case "detailnotulenexpired":
   
   echo"<title> - $_GET[status]</title>";
   echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>Agenda Notulen <small>$r[agenda]</small></h2>
                    
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">

                  

                    <table id=\"datatable-buttons\" class=\"table table-striped table-bordered\">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Info/Problems / Issues</th>
                          <th>PIC</th>
                          <th>Due Date</th>
                          <th>Status</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>  


                      <tbody>";

                      $sql=mysql_query("SELECT * FROM notulen_detail WHERE due_date <= now() AND status = 'open' ORDER BY due_date ASC");
                      $no=1;
                      while ($a=mysql_fetch_array($sql)) {
                        $tanggal=tgl_indo($a[due_date]);
                        echo"<tr>
                          <td>$no</td>
                          <td>$a[issues]</td>
                          <td>$a[pic]</td>
                          <td>$tanggal</td>
                          <td><center>"; if ($a['status']=='Closed'){ echo"<span class='label label-success'>Closed</span>"; } elseif ($a['status']=='Info'){ echo"<span class='label label-info'>Info</span>"; } else {echo"<span class='label label-danger'>Open</span>"; } echo"</center></td>
                          <td>$a[remark]</td>
                        </tr>";
                      $no++;
                      }
                        
                      echo"</tbody>
                    </table>
                  </div>
                </div>
              ";
  
    break;  



    case "detailnotulenstatusall":
   
   echo"<title> - All Status</title>";
   echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>All Agenda Notulen</h2>
                    
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">

                  

                    <table id=\"datatable-buttons\" class=\"table table-striped table-bordered\">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Info/Problems / Issues</th>
                          <th>PIC</th>
                          <th>Due Date</th>
                          <th>Status</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>  


                      <tbody>";

                      $sql=mysql_query("SELECT * FROM notulen_detail ORDER BY id_notulen_detail");
                      $no=1;
                      while ($a=mysql_fetch_array($sql)) {
                         $tanggal=tgl_indo($a[due_date]);
                        echo"<tr>
                          <td>$no</td>
                          <td>$a[issues]</td>
                          <td>$a[pic]</td>
                          <td>$tanggal</td>
                          <td><center>"; if ($a['status']=='Closed'){ echo"<span class='label label-success'>Closed</span>"; } elseif ($a['status']=='Info'){ echo"<span class='label label-info'>Info</span>"; } else {echo"<span class='label label-danger'>Open</span>"; } echo"</center></td>
                          <td>$a[remark]</td>
                        </tr>";
                      $no++;
                      }
                        
                      echo"</tbody>
                    </table>
                  </div>
                </div>
              ";
  
    break;
   
  
   }
   ?>


   </div> 
   </div>
   </div>
   <div class='clear height-fix'></div> 
   </div></div>
