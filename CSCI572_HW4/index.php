<?php
 header('Content-Type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_WARNING); 
 $limit=10;
 $query=isset($_REQUEST['q'])?$_REQUEST['q']:false;
 $results=false;

 if($query){
 	
 	require_once('Apache/Solr/Service.php');
 	$solr=new Apache_Solr_Service('192.168.0.31',8983,'/solr/csci572/');
 	if(get_magic_quotes_gpc()==1){
 		$query=stripslashes($query);
 	}
 	try{
 		if(isset($_GET['way'])==false){
 			$choice="Lucence";
 		}
 		else{
 			$choice=$_GET['way'];
 		}
		if(strcmp($choice,"Lucence")==0){
			$results=$solr->search($query,0,$limit);
		}
 		if(strcmp($choice,"PageRank")==0){
 			$param=array('sort'=>'pageRankFile desc');
 			$results=$solr->search($query,0,$limit,$param);
 		}
 		
 	}
 	catch(Exception $e){
 		die("<html><head><title>SEARCH ERROR</title></head><body><pre>{$e->__toString()}</pre></body></html>");
 	}
 }
?>
<html>
    <head>
        <title>csci572 homework4</title>
    </head>
    <body bgcolor="#FAEBD7">
	  <div align="center">
         <form accept-charset="utf-8" method="get">
              <label for="q">Search:</label>
              <input id="q" name="q" type="text" value="<?php echo htmlspecialchars($query,ENT_QUOTES,'utf-8');?>"/>
              <input type="submit"/><br/>
              <input type="radio" name="way" value="PageRank"/>pageRank&nbsp;&nbsp;
              <input type="radio" name="way" value="Lucence"/>Lucene<br/>
              
         </form>
      </div>
<?php // display results 
  
	if ($results) { 
	 
		$total = (int) $results->response->numFound; 
		
		$start = min(1, $total); 
		$end = min($limit, $total); 
?> 
<div>
	Results <?php echo $start; ?> - <?php echo $end;?> of <?php echo $total; ?>:
</div> 
<ol> 
	<?php 
		// iterate result documents 
		foreach ($results->response->docs as $doc) { 
	?> 
	<li> 
	<table style="border: 1px solid black; text-align: left"> 
	<?php // iterate document fields / values 
		foreach ($doc as $field => $value) { 
		
		     
		     $flag1=strcmp($field,'id');
			 $flag2=strcmp($field,'description');
			 $flag3=strcmp($field,'title');
			 $flag4=strcmp($field,'og_url');
			 if($flag1!=0 && $flag2!=0 && $flag3!=0 && $flag4!=0){
				  continue;
			 }
			 else if($flag1==0){
				 $ID=$value;
			 }
			 else if($flag2==0){
				 $DES=$value;
			 }
			 else if($flag3==0){
				  $title=$value;
			 }
			 else if($flag4==0){
				 $url=$value;
			 }
			
	   }
             echo '<tr>';
			 echo   '<th>Title:</th>';
             echo '<td  width="100%"><a href='.$url.'>'.htmlspecialchars($title,ENT_QUOTES,'utf-8').'</a></td>';
			 echo '</tr>';
			 
			 echo '<tr>';
			 echo   '<th>URL:</th>';
             echo '<td  width="100%"><a href='.$url.'>'.htmlspecialchars($url,ENT_QUOTES,'utf-8').'</a></td>';
			 echo '</tr>';	

			 
			 echo '<tr>';
			 echo   '<th>ID:</th>';
             echo '<td  width="100%">'.htmlspecialchars($ID,ENT_QUOTES,'utf-8').'</td>';
			 echo '</tr>';	

			 
			 echo '<tr>';
			 echo   '<th>Description:</th>';
             echo '<td  width="100%">'.htmlspecialchars($DES,ENT_QUOTES,'utf-8').'</td>';
			 echo '</tr>';	   
	  ?>
	</table>
	</li> 
	<?php 
	   } 
	?> 
</ol> 
	<?php 
	   } 
     ?>

</body>
</html>