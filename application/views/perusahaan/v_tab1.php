<?

?>
 
<form class="form-horizontal" method="post" id="form1" name="form1" action="<? echo base_url() ?>perusahaan/edit" >
 <div class="box-body">
 	 <div class="form-group">
        <label for="txtlokasidet" class="block col-sm-2 control-label">ID Perusahaan</label>
            <div class="col-sm-3">
                <span class="block  ">
                     	<input type="text" class="form-control" name="txtID" readonly="readonly" id="txtID" value="<?  echo $rowedit['prs_id'];  ?>" >
                </span>  </div>
        </label>
    </div> 
     <div class="form-group">
        <label for="txtperusahaan" class="block col-sm-2 control-label">Nama perusahaan</label>
            <div class="col-sm-4">
                <span class="block  ">
                <input type="hidden" class="form-control" name="tabnomor" id="tabnomor" value="tab1" >	
                    <input name="txtperusahaan"   type="text" class="form-control" id="txtperusahaan" value="<?  echo $rowedit['prs_nama'];  ?>"  placeholder="Nama perusahaan" />		
                </span>            
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtperusahaan" class="block col-sm-2 control-label">Lokasi Jalan</label>
            <div class="col-sm-4" >
                <select id="cbojalan" name="cbojalan" class="select2 "  data-placeholder="- Pilih -"  >  
                 <option   value=""    > </option>
                    <?    
                            foreach($row_cbojalan as $row )
                            {
                    ?>
                            <option   value="<? echo $row['jalan_id']; ?>"  <? ($rowedit['jalan_id']==$row['jalan_id']) ? $select="selected" : $select="" ; echo $select; ?>   ><? echo $row['namajalan']; ?></option>
                         <? } ?>
                </select>
            </div>
    </div>
    <div class="form-group">
        <label for="txtlokasidet" class="block col-sm-2 control-label">Lokasi Detil</label>
            <div class="col-sm-6">
                <span class="block  ">
                    <input name="txtlokasidet"   type="text" class="form-control" id="txtlokasidet" alt="lokasi" value="<?  echo $rowedit['prs_lokasidet'];  ?>" placeholder="Nomor Jalan, Nama Gang, Nama Blok, Tanpa nama jalan" />		
                </span>            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="cbokelurahan" class="block col-sm-2 control-label">Kelurahan</label>
            <div class="col-sm-6" >
                <select id="cbokelurahan" name="cbokelurahan" class="select2 "  data-placeholder="- Pilih -"  >  
                 <option   value=""    > </option>
                    <?    
                            foreach($row_cbokelurahan as $row )
                            {
                    ?>
                            <option   value="<? echo $row['kelurahan_id']; ?>"  <? ($rowedit['kelurahan_id']==$row['kelurahan_id']) ? $select2="selected" : $select2="" ; echo $select2; ?>   > <? echo $row['kelurahan']." ( $row[kecamatan_id] )"; ?></option>
                         <? } ?>
              </select>
            </div>
    </div>
    <div class="form-group">
        <label for="txttelpkantor" class="block col-sm-2 control-label">Telp. Kantor</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txttelpkantor"   type="text" class="form-control" id="txttelpkantor" alt="lokasi" value="<?  echo $rowedit['prs_telpkantor'];  ?>"  placeholder="Telp Kantor" />		
                </span>            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtnohp" class="block col-sm-2 control-label">No. HP</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtnohp"   type="text" class="form-control" id="txtnohp"  value="<?  echo $rowedit['prs_telpcontact'];  ?>"  placeholder="Handphone" />		
                </span>
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtnamakontak" class="block col-sm-2 control-label">Nama Contact Person</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtnamakontak"   type="text" class="form-control" id="txtnamakontak" value="<?  echo $rowedit['prs_namacontact'];  ?>"  placeholder="nama contact" />		
                </span>
            </div>
        </label>
    </div> 
     <div class="form-group">
        <label for="txtnamakontak" class="block col-sm-2 control-label">Alamat Email</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtemail"   type="text" class="form-control" id="txtemail" value="<?  echo $rowedit['prs_email'];  ?>"  placeholder="alamat email" />		
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

