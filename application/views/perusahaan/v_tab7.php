

<div class="box-body" >
<form class="form-horizontal" method="post" id="form_arsip" name="form_arsip" action="<? echo base_url() ?>perusahaan/edit" >
	<label class="label label-info">Arsip Fisik</label>
    <fieldset  style="border:thin;border-style:dotted;border-color:#999999">	
    <div class="form-group" style="margin-top:10px">
        <label for="txtketerangan" class="block col-sm-2 control-label" >Nomor Kotak Arsip</label>
          <div class="col-sm-4">
                <span class="block"> 
                	<input type="hidden" class="form-control" name="txtID" id="txtID" value="<?  echo $rowedit['prs_id'];  ?>" >
                    <input name="txtnomorkotak"   type="text" class="form-control" id="txtnomorkotak"  value="<?  echo $rowedit['arsip_nokotak'];  ?>"  placeholder="Nomor Kotak Arsip" />		
                </span>            
          </div>  
    </div>
     <div class="form-group">
      <label for="" class="col-sm-2 control-label"></label>

      <div class="col-sm-6">
       <input name="cmdUpdate2" type="submit" value="Update" id="cmdUpdate2" class="btn btn-xs btn-primary">
        
      </div>
    </div>
    
    </fieldset>

</form>
<fieldset  style="border:thin;border-style:dotted;border-color:#999999">
<form class="form-horizontal" method="post" id="form7" name="form7" enctype="multipart/form-data" action="<? echo base_url() ?>perusahaan/edit" >
	<label class="label label-info">Arsip Digital</label>
    	
    <div class="form-group" style="margin-top:10px">
        <label for="txtketerangan" class="block col-sm-2 control-label" >Keterangan File</label>
          <div class="col-sm-4">
                <span class="block  ">
                <input type="hidden" class="form-control" name="txtID" id="txtID" value="<?  echo $rowedit['prs_id'];  ?>" >
                <input type="hidden" class="form-control" name="tabnomor" id="tabnomor" value="tab7" >
                    <input name="txtketerangan"   type="text" class="form-control" id="txtketerangan"   placeholder="Ket File" />		
                </span>            
          </div>  
    </div> 
    <div class="form-group">
        <label for="cboperusahaan" class="block col-sm-2 control-label">File Arsip</label>
            <div class=" col-sm-3" >
                <div class="clearfix" id="bantu">
                    <input type="file"  class="tes" id="txtfile" name="txtfile[]"/> 
                </div>
                 
          </div>
    </div> 
    <div class="form-group">
      <label for="" class="col-sm-2 control-label"></label>

      <div class="col-sm-6">
       <input name="cmdUpdate" type="submit" value="Upload" id="cmdUpdate" class="btn btn-xs btn-primary">
        
      </div>
    </div>
    
</form>
	<div id="xtabelarsip" class="col-md-12"></div>
  
   </fieldset>      
         
</div>
<!-- /.box-body -->
<div class="box-footer">

</div>
<!-- /.box-footer -->