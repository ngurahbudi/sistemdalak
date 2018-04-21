

<div class="box-body  " >
		  <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <?
			foreach($row_history as $row)
			{
				$hariturun=$this->mycombo->NamaHari($row['tgl']);
				$hariturun.= ", " . $this->mycombo->FormatDMY($row['tgl']);
				switch ($row['jenismonitoring_id'])
				{
					case 	"PM"	: $bg="bg-green"; $fa="fa-binoculars" ; break;
					case	"PB"	: $bg="bg-yellow"; $fa="fa-balance-scale" ; break;
					case	"PS"	: $bg="bg-red"; $fa="fa-exclamation" ; break;
					default			: $bg="bg-blue"; $fa="fa-mail-reply-all" ;break;
 
				}
			?>
            <li class="time-label">
                  <span class="<? echo " $bg" ; ?>">
                    <? echo $hariturun; ?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa <? echo "$fa $bg " ?>"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> Update : <? echo $this->mycombo->FormatDMY($row['tglupdate']); ?></span>
                <h3 class="timeline-header "><a href="#"><? echo $row['jenismonitoring']; ?></a> </h3>
                <div class="timeline-body">
                    <? echo $row['catatanlapangan'] ?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <?
			}
			?>
            
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

 
 </div>
 <!-- /.box-body -->
 <div class="box-footer">
    
 </div>
  <!-- /.box-footer -->