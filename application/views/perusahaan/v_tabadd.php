<?

?>
 
<form class="form-horizontal" method="post" id="form1" name="form1" action="<? echo base_url() ?>perusahaan/add" >
 <div class="box-body">
     <div class="form-group">
        <label for="txtperusahaan" class="block col-sm-2 control-label">Nama perusahaan</label>
            <div class="col-sm-4">
                <span class="block  "><input type="hidden" class="form-control" name="txtID" id="txtID"   placeholder="Auto ID">
                    <input name="txtperusahaan"   type="text" class="form-control" id="txtperusahaan"   placeholder="Nama perusahaan" />		
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
                            <option   value="<? echo $row['jalan_id']; ?>"    ><? echo $row['namajalan']; ?></option>
                         <? } ?>
                </select>
            </div>
    </div>
    <div class="form-group">
        <label for="txtlokasidet" class="block col-sm-2 control-label">Lokasi Detil</label>
            <div class="col-sm-6">
                <span class="block  ">
                    <input name="txtlokasidet"   type="text" class="form-control" id="txtlokasidet" alt="lokasi"  placeholder="Nomor Jalan, Nama Gang, Nama Blok, Tanpa nama jalan" />		
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
                            <option   value="<? echo $row['kelurahan_id']; ?>"    ><? echo $row['kelurahan']." ( $row[kecamatan_id] )"; ?></option>
                         <? } ?>
              </select>
            </div>
    </div>
    <div class="form-group">
        <label for="txttelpkantor" class="block col-sm-2 control-label">Telp. Kantor</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txttelpkantor"   type="text" class="form-control" id="txttelpkantor" alt="lokasi"  placeholder="Telp Kantor" />		
                </span>            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtnohp" class="block col-sm-2 control-label">No. HP</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtnohp"   type="text" class="form-control" id="txtnohp"   placeholder="Handphone" />		
                </span>
            </div>
        </label>
    </div> 
    <div class="form-group">
        <label for="txtnamakontak" class="block col-sm-2 control-label">Nama Contact Person</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtnamakontak"   type="text" class="form-control" id="txtnamakontak"   placeholder="nama contact" />		
                </span>
            </div>
        </label>
    </div> 
     <div class="form-group">
        <label for="txtemail" class="block col-sm-2 control-label">Alamat Email</label>
            <div class="col-sm-3">
                <span class="block  ">
                    <input name="txtemail"   type="text" class="form-control" id="txtemail"   placeholder="alamat email" />		
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
       <input name="cmdSimpan" type="submit" value="Simpan" id="cmdSimpan" class="btn btn-primary">
        <input name="cmdBatal" type="button" value="Batal" id="cmdBatal" class="btn btn-info" onClick="window.location.replace('<? echo base_url() ?>perusahaan');">
      </div>
    </div>
 </div>
  <!-- /.box-footer -->
</form>

