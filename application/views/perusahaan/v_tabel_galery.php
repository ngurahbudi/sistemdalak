 
 <table width="" class="table table-bordered table-striped " id="datatabel3">
     <thead>
       <tr>
         <th width="">No</th>
         <th width=""> Nama File</th>
         <th width=""> Foto </th>
         <th width=""> Aksi </th>
        </tr>
     </thead>
     <tbody>
       <? 
	   $i=0;
	   foreach($row_filefoto as $row)
	   {	
	   	$i += 1;
		$prstxt=str_replace(".","-",$row['prs_id']);
	 	$target_dir= base_url()."upload/$prstxt/" . $row['nama_file'];
		 
	    ?>
       <tr>
       	 <td> <? echo $i ?></td>	
         <td> <? echo $row['nama_file'] ?></td>
         <td><img height="50px" src="<? echo $target_dir ?>" /></td>  
         <td><a href="#" class="hapusfoto" data-id="<? echo $row['id_file'] ?>"  data-prsid="<? echo $row['prs_id'] ?>" data-nama="<? echo $row['nama_file'] ?>" data-folder="<? echo $prstxt ?>" data-monitid="<? echo $row['monit_id'] ?>" >Hapus</a></td>
        </tr>
       <? } ?>
     </tbody>
   </table>
   