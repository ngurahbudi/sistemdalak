<?  
	($rowedit['prs_map_latitude'] =="0" or is_null($rowedit['prs_map_latitude'])) ? $val1="" : $val1=  $rowedit['prs_map_latitude'] ;   
	($rowedit['prs_map_longitude'] =="0" or is_null($rowedit['prs_map_longitude'])) ? $val2="" : $val2=  $rowedit['prs_map_longitude'] ;  
	$keyAPI=$rowedit['google_key_api'] ;

?>

<div class="box-body" >
 
<h1>Lokasi Perusahaan</h1>
<div id="googleMap" style="width:100%;height:400px;"></div> 
<input name="txtx" id="txtx" type="hidden" value="<? echo $val1 ?>" />
<input name="txty" id="txty" type="hidden" value="<? echo $val2 ?>" />
<script>
/*
function myMap() {
var lx;
var ly;
 	//lx = document.getElementById("txtx").value;
	//ly=document.getElementById('txty').value
	//lx=-8.6364737; 
	//ly=115.2116003;
	lx=-8.704390; 
	ly=115.257602;	
var mapProp= {
    center:new google.maps.LatLng(lx,ly),
	 
    zoom:18,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
*/

function myMap() {
	var lx = document.getElementById("txtx").value;
	var ly = document.getElementById('txty').value
 	 
	if(lx=='0' || ly=='0' || lx=='' || ly=='')
	{
		lx=-8.6364737; 	// set default di GSD
	    ly=115.2116003;	
		lx="";
		ly="";
	}
		 
		  
  var myCenter = new google.maps.LatLng(lx,ly);
  var mapCanvas = document.getElementById("googleMap");
  var mapOptions = {center: myCenter, rotateControl: true,   zoom: 18   };
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter,animation: google.maps.Animation.BOUNCE});
  marker.setMap(map);
}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<? echo $keyAPI ?>&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->
         
         
</div>
<!-- /.box-body -->
<div class="box-footer">

</div>
<!-- /.box-footer -->