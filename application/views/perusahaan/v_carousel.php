  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  <? 
  $i=-1;
  foreach($row_filefoto as $row2)
  { 
  		$i=$i+1;
		($i===0) ? $aktif="active" : $aktif="";
  ?>
    <li data-target="#myCarousel" data-slide-to="<? echo $i ?>" class="<? echo $aktif ?>"></li>
    <? } ?>
    
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
  <?
  $i=0; $aktif="";
  foreach($row_filefoto as $row)
  {
  	$i=$i+1;
	($i===1) ? $aktif="active" : $aktif="";
	$dir=str_replace(".","-",$row['prs_id']);
	$hariturun=$this->mycombo->NamaHari($row['jadwal_tgl']);
	$hariturun.= ", " . $this->mycombo->FormatDMY($row['jadwal_tgl']);
  ?>
    <div class="item <? echo $aktif; ?>">
      <img src="<? echo base_url() ?>upload/<? echo $dir ."/". $row['nama_file'] ?>" alt="">
      <div class="carousel-caption">
        <h3><? echo $row['jenismonitoring'] ?></h3>
        <p><? echo $hariturun ?></p>
      </div>
    </div>
	<?
	}
	if($i===0)
	{
	?>
    <div class="item active ">
      <img src="<? echo base_url() ?>upload/no image.jpg" alt="">
      <div class="carousel-caption">
        <h3> </h3>
        <p> </p>
      </div>
    </div>
    
    <? }  ?> 
  </div>

  <!-- Left and right controls -->
  <? if($i>0)
	{ ?>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
  <? } ?>
</div>