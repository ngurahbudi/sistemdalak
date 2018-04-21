 
 <table width="" class="table table-bordered table-striped " id="datatabel2">
     <thead>
       <tr>
         <th width="">No</th>
         <th width=""> Keterangan</th>
         <th width=""> File </th>
         <th width=""> Aksi </th>
        </tr>
     </thead>
     <tbody>
       <? 
	   $i=0;
	   foreach($row_arsip as $row)
	   {	
	   	$i += 1;
		$prstxt=str_replace(".","-",$row['prs_id']); 
		$target_dir= base_url()."upload/$prstxt/" . $row['nama_arsip'];
		$target_hapus=base_url()."perusahaan/edit/".$row['prs_id']."/" . $row['arsip_id'];
	    ?>
       <tr>
       	 <td> <? echo $i ?></td>	
         <td> <? echo $row['keterangan'] ?></td>
         <td><a href="<? echo $target_dir; ?>" target="_blank" ><i class="fa fa-file">&nbsp;</i><? echo $row['nama_arsip'] ?></a></td>  
         <td><a href="#" class="hapus" data-id="<? echo $row['arsip_id'] ?>" data-prsid="<? echo $row['prs_id'] ?>" data-nama="<? echo $row['nama_arsip'] ?>" data-folder="<? echo $prstxt ?>" >Hapus</a></td>
        </tr>
       <? } ?>
     </tbody>
   </table>
   