<?

?>
 
<form class="form-horizontal" method="post" id="form1" name="form1" action="<? echo base_url() ?>perusahaan/edit" >
 <div class="box-body">
     
    <div class="form-group">
        <label for="txtnodaftarpma" class="block col-sm-2 control-label">Nomor Pendaftaran PMA</label>
          <div class="col-sm-5">
                <span class="block  "> <input type="hidden" class="form-control" name="txtID" id="txtID" value="<?  echo $rowedit['prs_id'];  ?>">
                	<input type="hidden" class="form-control" name="tabnomor" id="tabnomor" value="tab3" >
                    <input name="txtnodaftarpma"   type="text" class="form-control" id="txtnodaftarpma" value="<?  echo $rowedit['prs_nodaftarPMA'];  ?>"  placeholder="Nomor pendaftaran PMA" />		
                </span>            
           </div>
        </label>
    </div>  
    <div class="form-group">
        <label for="txtnositu" class="block col-sm-2 control-label">Nomor SITU</label>
            <div class="col-sm-5">
                <span class="block  ">
                    <input name="txtnositu"   type="text" class="form-control" id="txtnositu" alt=""  value="<?  echo $rowedit['prs_noSITU'];  ?>" placeholder="Nomor Surat Ijin Tempat Usaha" />		
                </span>
      </div>
        </label>
    </div> 
    
    <div class="form-group">
        <label for="txtnoho" class="block col-sm-2 control-label">Nomor HO</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtnoho"   type="text" class="form-control" id="txtnoho" alt="" value="<?  echo $rowedit['prs_noHO'];  ?>" placeholder="Nomor HO" />		
                </span>
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtnotdp" class="block col-sm-2 control-label">Nomor TDP</label>
            <div class="col-sm-3">
                <span class="block">
                    <input name="txtnotdp"   type="text" class="form-control" id="txtnotdp" value="<?  echo $rowedit['prs_noTDP'];  ?>"  placeholder="Nomor TDP" />		
                </span>
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtijinusaha" class="block col-sm-2 control-label">Nomor IPPMA</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtnoippma"   type="text" class="form-control" id="txtnoippma"  value="<?  echo $rowedit['prs_noIPPMA'];  ?>" placeholder="Nomor Ijin Prinsip PMA" />		
                </span>
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtijinusaha" class="block col-sm-2 control-label">Tahun Berlaku IPPMA</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txttahunippma"   type="text" class="form-control" id="txttahunippma" value="<?  echo $rowedit['prs_tahunberlakuIPPMA'];  ?>"  placeholder="Tahun Berlaku Ijin Prinsip PMA" />		
                </span>
            </div>
        </label>
    </div> 
  <div class="form-group">
        <label for="txtijinusaha" class="block col-sm-2 control-label">Nomor IPPRB</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtijinperubahan"   type="text" class="form-control" id="txtijinperubahan" value="<?  echo $rowedit['prs_noIPPRB'];  ?>"  placeholder="Nomor Ijin Prinsip Perubahan" />		
                </span>
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtijinusaha" class="block col-sm-2 control-label">Nomor IPPRLS</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtijinperluasan"   type="text" class="form-control" id="txtijinperluasan" value="<?  echo $rowedit['prs_noIPPRLS'];  ?>"  placeholder="Nomor Ijin Prinsip Perluasan" />		
                </span>
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtijinusaha" class="block col-sm-2 control-label">Nomor Ijin Usaha/Operasional</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtijinusaha"   type="text" class="form-control" id="txtijinusaha" value="<?  echo $rowedit['prs_noIjinUsaha'];  ?>"  placeholder="Nomor Ijin Operasional" />		
                </span>
            </div>
        </label>
    </div>  
 </div>
 <!-- /.box-body -->
 <div class="box-footer">
    <div class="form-group">
      <label for="" class="col-sm-2 control-label"></label>

      <div class="col-sm-6">
       <input name="cmdUpdate" type="submit" value="Update" id="cmdUpdate" class="btn btn-primary">
        <input name="cmdBatal" type="button" value="Batal" id="cmdBatal" class="btn btn-info" onClick="window.location.replace('<? echo base_url() ?>perusahaan');">
      </div>
    </div>
 </div>
  <!-- /.box-footer -->
</form>

