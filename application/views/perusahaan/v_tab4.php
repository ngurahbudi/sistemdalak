<?

?>
 
<form class="form-horizontal" method="post" id="form4" name="form4" action="<? echo base_url() ?>perusahaan/edit" >
 <div class="box-body">
    <div class="form-group">
        <label for="txtperusahaan" class="block col-sm-2 control-label">Kategory Perusahaan.</label>
            <div class="col-sm-4" >
                <select id="cbokategory" name="cbokategory" class="select2 "  data-placeholder="- Pilih -"  >  
                 <option   value=""    > </option>
                    <?    
                            foreach($row_cbokategory as $row )
                            {
                    ?>
                            <option   value="<? echo $row['kategory_id']; ?>"  <? ($rowedit['kategory_id']==$row['kategory_id']) ? $select="selected" : $select="" ; echo $select; ?> ><? echo $row['kategory']; ?></option>
                         <? } ?>
                </select>
            </div>
    </div> 
    <div class="form-group">
        <label for="cbomasalah" class="block col-sm-2 control-label">Permasalahan Prshn.</label>
            <div class="col-sm-4" >
                <select id="cbomasalah" name="cbomasalah" class="select2 "  data-placeholder="- Pilih -"  >  
                 <option   value=""    > </option>
                    <?    
                            foreach($row_cbomasalah as $row )
                            {
                    ?>
                            <option   value="<? echo $row['klasmasalah_id']; ?>"  <? ($rowedit['klasmasalah_id']==$row['klasmasalah_id']) ? $select="selected" : $select="" ; echo $select; ?> ><? echo $row['klasmasalah']; ?></option>
                         <? } ?>
                </select>
            </div>
    </div> 
    <div class="form-group">
        <label for="txtnilairp" class="block col-sm-2 control-label">Jumlah Investasi (Rp)</label>
          <div class="col-sm-5">
                <span class="block  "> <input type="hidden" class="form-control" name="txtID" id="txtID" value="<?  echo $rowedit['prs_id'];  ?>">
                <input type="hidden" class="form-control" name="tabnomor" id="tabnomor" value="tab4" >
                    <input name="txtnilairp"   type="text" class="form-control" id="txtnilairp" value="<?  echo $rowedit['prs_nilaiInvestasiRP'];  ?>"  placeholder="Nilai Investasi dalam satuan Rupiah (Rp)" />		
                </span>            
           </div>
        </label>
    </div>  
    <div class="form-group">
        <label for="txtkaryawanwna" class="block col-sm-2 control-label">Jumlah Investasi (USD)</label>
            <div class="col-sm-5">
                <span class="block  ">
                    <input name="txtnilaiusd"   type="text" class="form-control" id="txtnilaiusd" alt="" value="<?  echo $rowedit['prs_nilaiInvestasiUSD'];  ?>" placeholder="Nilai Investasi dalam satuan USD" />		
                </span>
      		</div>
        </label>
    </div> 
    <div class="form-group col-sm-6 inline-block">
        <label for="txtlongitude" class="block col-sm-4 control-label">Jml. Karyawan WNI Laki</label>
      <div class="col-sm-4">
                <span class="block  ">
                    <input name="txtwnilaki"   type="text" class="form-control" id="txtwnilaki" alt="" value="<?  echo $rowedit['prs_jumlahWNI_laki'];  ?>" placeholder="WNI Laki" />		
                </span>
	  </div>
        </label>
    </div>  
    <div class="form-group col-sm-6 inline-block ">
        <label for="txtlatitude" class="block col-sm-5 control-label">Jml. Karyawan WNI Perempuan</label>
      <div class="col-sm-4">
                <span class="block  ">
                    <input name="txtwniperempuan"   type="text" class="form-control" id="txtwniperempuan" alt="" value="<?  echo $rowedit['prs_jumlahWNI_perempuan'];  ?>" placeholder="WNI Perempuan" />		
                </span>
	  </div>
        </label>
    </div>  
    <div class="clearfix"></div>
     <div class="form-group col-sm-6 inline-block">
        <label for="txtlongitude" class="block col-sm-4 control-label">Jml. Karyawan WNA Laki</label>
      <div class="col-sm-4">
                <span class="block  ">
                    <input name="txtwnalaki"   type="text" class="form-control" id="txtwnalaki" alt="" value="<?  echo $rowedit['prs_jumlahWNA_laki'];  ?>" placeholder="WNA Laki" />		
                </span>
	  </div>
        </label>
    </div>  
    <div class="form-group col-sm-6 inline-block ">
        <label for="txtlatitude" class="block col-sm-5 control-label">Jml. Karyawan WNA Perempuan</label>
      <div class="col-sm-4">
                <span class="block  ">
                    <input name="txtwnaperempuan"   type="text" class="form-control" id="txtwnaperempuan" alt="" value="<?  echo $rowedit['prs_jumlahWNA_perempuan'];  ?>" placeholder="WNA Perempuan" />		
                </span>
	  </div>
        </label>
    </div> 
     <div class="clearfix"></div>
     <div class="form-group col-sm-6 inline-block">
        <label for="txtlat" class="block col-sm-4 control-label">Koordinat Latitude</label>
      <div class="col-sm-4">
                <span class="block  ">
                    <input name="txtlat"   type="text" class="form-control" id="txtlat" alt="" value="<?  echo $rowedit['prs_map_latitude'];  ?>"  placeholder="google maps latitude" />		
                </span>
	  </div>
        </label>
    </div>  
    <div class="form-group col-sm-6 inline-block ">
        <label for="txtlong" class="block col-sm-5 control-label">Koordinat Longitude</label>
      <div class="col-sm-4">
                <span class="block  ">
                    <input name="txtlong"   type="text" class="form-control" id="txtlong" alt="" value="<?  echo $rowedit['prs_map_longitude'];  ?>" placeholder="google maps longitude" />		
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

