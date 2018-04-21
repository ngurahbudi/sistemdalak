<?

?>
 
<form class="form-horizontal" method="post" id="form2" name="form2" action="<? echo base_url() ?>perusahaan/edit" >
 <div class="box-body">
    <div class="form-group">
        <label for="txtbidangusaha" class="block col-sm-2 control-label">Bidang Usaha</label>
          <div class="col-sm-6">
                <span class="block  "><input type="hidden" class="form-control" name="txtID" id="txtID" value="<?  echo $rowedit['prs_id'];  ?>" >
                <input type="hidden" class="form-control" name="tabnomor" id="tabnomor" value="tab2" >
                    <input name="txtbidangusaha"   type="text" class="form-control" id="txtbidangusaha" value="<?  echo $rowedit['prs_bidangusaha'];  ?>"  placeholder="Bidang usaha" />		
                </span>            
           </div>
        </label>
    </div> 
    <div class="form-group col-sm-6  " style="display:inline-block; "  >
        <label class="control-label col-xs-12 col-sm-4  " for="txtnomorsuratasli">No. Akta Pendirian</label>
      <div class="  col-sm-8" >
            <div class="clearfix">
                 <input name="txtnoakta"   type="text" class="form-control" id="txtnoakta" value="<?  echo $rowedit['prs_noakta'];  ?>"  placeholder="Nomor Akta Pendirian" />
            </div>
      </div> 
   </div>
 
   <div class="form-group col-sm-4" style="display:inline-block; " >
        <label class="control-label  col-sm-5  " for="txttglham" >Tgl.Akta Pendirian</label>
      <div class=" col-sm-6" >
            <div class="input-group">
                <input class="form-control date-picker" id="txttglakta" name="txttglakta" value="<?  ($rowedit['prs_tglakta'] =="0000-00-00" or is_null($rowedit['prs_tglakta'])) ? $val="" : $val=$this->mycombo->FormatDMY($rowedit['prs_tglakta']);    echo $val;  ?>" placeholder="dd-mm-yyyy" type="text" data-date-format="dd-mm-yyyy" />
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
      </div>
   </div> 
  <div class="form-group col-sm-6  " style="display:inline-block; "  >
      <label class="control-label col-xs-12 col-sm-4  " for="txtnoham">No. Pengesahan MENHAM</label>
        <div class="  col-sm-8" >
            <div class="clearfix">
                 <input name="txtnoham"   type="text" class="form-control" id="txtnoham" value="<?  echo $rowedit['prs_noHAM'];  ?>"  placeholder="Nomor Pengesahan dari Kementrian HAM" />
            </div>
        </div> 
   </div>
 
   <div class="form-group col-sm-4"   >
        <label class="control-label  col-sm-5  " for="txttglham" >Tgl.Pengesahan MENHAM</label>
      <div class=" col-sm-6" >
            <div class="input-group">
                <input class="form-control date-picker" id="txttglham" name="txttglham" value="<?  ($rowedit['prs_tglHAM'] =="0000-00-00" or is_null($rowedit['prs_tglHAM'])) ? $val="" : $val=$rowedit['prs_tglHAM']; echo $val;  ?>" placeholder="dd-mm-yyyy" type="text" data-date-format="dd-mm-yyyy" />
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
      </div>
   </div> 
   <div class="clearfix"></div>
   <div class="form-group">
        <label for="txtcatatan" class="block col-sm-2 control-label">LKPM Terakhir</label>
        <div class="col-sm-6">
                  <div class="input-group">
                 <textarea name="txtlkpmterakhir" class="form-control" cols="50" rows="3"><?   echo $rowedit['LKPM_terakhir'];   ?></textarea>
                 </div>
        </div>
    </div> 
   <p></p>
   <table width="" class="table table-bordered table-striped " id="datatabel2">
     <thead>
       <tr>
         <th width="121">Kelengkapan</th>
         <th width="360"> Ada/Valid</th>
        </tr>
     </thead>
     <tbody>
       
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada NPWP</td>
         <td> 
               <label><input name="cekNPWP" type="checkbox" class="minimal" id="cekNPWP" value="1"  <? ($rowedit['prs_adaNPWP'] =="0" or is_null($rowedit['prs_adaNPWP'])) ? $val="" : $val="checked=checked"; echo $val;  ?> >
            </label> </td>
        </tr>
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada SHM</td>
         <td><input name="cekSHM" type="checkbox" class="minimal" id="cekSHM" value="1" <? ($rowedit['prs_adaSHM'] =="0" or is_null($rowedit['prs_adaSHM'])) ? $val="" : $val="checked=checked"; echo $val;  ?> /></td>
       </tr>
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada IMB</td>
         <td><input name="cekIMB" type="checkbox" class="minimal" id="cekIMB" value="1" <? ($rowedit['prs_adaIMB'] =="0" or is_null($rowedit['prs_adaIMB'])) ? $val="" : $val="checked=checked"; echo $val;  ?> /></td>
       </tr>
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada Sewa Tanah</td>
         <td><input name="cekSewaTanah" type="checkbox" class="minimal" id="cekSewaTanah" value="1" <? ($rowedit['prs_adasewatanah'] =="0" or is_null($rowedit['prs_adasewatanah'])) ? $val="" : $val="checked=checked"; echo $val;  ?> /></td>
       </tr>
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada Sewa Gedung</td>
         <td><input name="cekSewaGedung" type="checkbox" class="minimal" id="cekSewaGedung" value="1" <? ($rowedit['prs_adasewagedung'] =="0" or is_null($rowedit['prs_adasewagedung'])) ? $val="" : $val="checked=checked"; echo $val;  ?>/></td>
       </tr>
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada UKL-UPL</td>
         <td><input name="cekUKL" type="checkbox" class="minimal" id="cekUKL" value="1" <? ($rowedit['prs_adaUKLUPL'] =="0" or is_null($rowedit['prs_adaUKLUPL'])) ? $val="" : $val="checked=checked"; echo $val;  ?>/></td>
       </tr>
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada LKPM</td>
         <td><input name="cekLKPM" type="checkbox" class="minimal" id="cekLKPM" value="1" <? ($rowedit['prs_adaLKPM'] =="0" or is_null($rowedit['prs_adaLKPM'])) ? $val="" : $val="checked=checked"; echo $val;  ?>/></td>
       </tr>
       <tr>
         <td><i class="fa fa-gear" >&nbsp&nbsp&nbsp</i>Ada KITAS</td>
         <td><input name="cekKITAS" type="checkbox" class="minimal" id="cekKITAS" value="1" <? ($rowedit['prs_adaKITAS'] =="0" or is_null($rowedit['prs_adaKITAS'])) ? $val="" : $val="checked=checked"; echo $val;  ?>/></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
     </tbody>
   </table>
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

