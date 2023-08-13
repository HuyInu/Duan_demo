<?php
//=============================FUNCTIONS THỐNG KÊ=========================================//

////////////////////KHO BỘT////////////////
function insert_thongKeTonKhoKhoKhacKhoBot($a){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	$cid = ceil(trim($a['cid']));
	$idloaivang = ceil(trim($a['idloaivang']));
	
	$fromDate = $a['fromdays'];
	$toDate = $a['todays'];	
	$datenow = date("Y-m-d");	

	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];
	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng đầu kỳ					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);					
					$sltonsddk = $rstonsddk['sltonv'];
					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du
					             from $GLOBALS[db_sp].".$table." 
								 where idloaivang=".$idloaivang." and trangthai=2 and type=3
								";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = $rston['sltonv'];					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày					
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);			
					//					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = $rstonsddk['sltonv'] ;
					$thangdauky = $rstonsddk['dated']; 					
					//get số lượng từ ngày đến đầu tháng
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 and trangthai=2
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3);
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du
					             from $GLOBALS[db_sp].".$table."
								 where idloaivang=".$idloaivang." and trangthai=2 and type=3
								 and dated >= '".$fromDate."'
								 and dated <= '".$toDate."'
					";
					$rshaodu =  $GLOBALS["sp"]->getRow($sqlhaodu);
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type=1 and trangthai=2
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
					
					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
					$slton = $sltonsddk + $sltontndn;					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];		
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}

function thongKeTonKhoKhoKhacKhoBot($cid, $idloaivang, $fromDate, $toDate){
	$arrlist = array();
	$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt =  '';
	$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
	//$cid = ceil(trim($a['cid']));
	//$idloaivang = ceil(trim($a['idloaivang']));
	
	//$fromDate = $a['fromdays'];
	//$toDate = $a['todays'];
	$datenow = date("Y-m-d");
	
	$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
	$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
	
	$table = $rsgettable['table'];
	$tablehachtoan = $rsgettable['tablehachtoan'];

	if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
		if(!empty($fromDate)){
			$fromDate = explode('/',$fromDate);
			$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';
			
			$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];
			
			$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
			$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
		}
		if(!empty($toDate)){			
			$toDate = explode('/',$toDate);
			$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
			$whnhap.=' and dated <= "'.$toDate.'" ';
			$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
		}
		
		//die($toDate);
		if($idloaivang > 0){
			////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
			$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
			$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
			if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
				if(empty($whnhap)){//// ngày không có chọn
					$datedauthang = date("Y").'-'.date("m").'-01';
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					/////////////////////get số lượng hao dư đầu kỳ
					$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
					
					$sltonsddk = round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'];
					
					$sltonsddk = round(($sltonsddk - $rshaodusddk['haochenhlech']),3) + $rshaodusddk['duchenhlech'];

					$arrlist['sltonsddk'] = $sltonsddk;
					/////////////////////get số lượng hao dư
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$datedauthang."'
					";
					
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);

					////////////////get số tồn hiện tại
					$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
					$rston = $GLOBALS['sp']->getRow($sqlton);
					
					$slton = round(round(($rston['sltonv'] - $rshaodu['hao']),3) + $rshaodu['du'],3);
					$slton = round(round(($slton - $rshaodu['haochenhlech']),3) + $rshaodu['duchenhlech'],3);
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rston['slnhapv'];
					$arrlist['slxuat'] = $rston['slxuatv'];
					$arrlist['slton'] = $slton;
				}
				else{/////// if có chọn ngày
				
					$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
					$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
					
					/////////////////////get số lượng hao dư đầu kỳ
					 $sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
								 where idloaivang=".$idloaivang." 
								 and dated <= '".$thangtruoc."'
					";
					
					$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
					
					$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
					$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);

					$sltonsddk = round(round(($rstonsddk['sltonv'] - $rshaodusddk['hao']),3) + $rshaodusddk['du'],3);
					$sltonsddk = round(round(($sltonsddk - $rshaodusddk['haochenhlech']),3) + $rshaodusddk['duchenhlech'],3);
					
					$thangdauky = $rstonsddk['dated']; 
					
					/////////////////////get số lượng hao dư từ ngày đến đầu tháng
					$sqlhaodutndt = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
								 where idloaivang=".$idloaivang." 
								 and dated < '".$fromDate."'
								 and dated >= '".$datedauthang."'
					";
					$rshaodutndt = $GLOBALS['sp']->getRow($sqlhaodutndt);
				
					$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 
									and typechuyen=2 
									and dated < '".$fromDate."'  
									and dated >= '".$datedauthang."' 
					"; 
					$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
					//die($sqlnhaptndt);
					$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang." 
									and type=1 and trangthai=2
									and datedxuat < '".$fromDate."'  
									and datedxuat >= '".$datedauthang."' 
					"; 
					$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
					
					$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3) + round(($rshaodutndt['du'] - $rshaodutndt['hao']),3);
					$sltontndt = round(($sltontndt + round(($rshaodutndt['duchenhlech'] - $rshaodutndt['haochenhlech']),3)),3); 
					$sltonsddk = round(($sltonsddk + $sltontndt),3);

					/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
					$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$table."haodu 
								 where idloaivang=".$idloaivang." 
								 and dated >= '".$fromDate."'
								 and dated <= '".$toDate."'
					";
					//die($sqlhaodu);
					$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
					
					$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
									 where idloaivang=".$idloaivang." 
									 and type=1 
									 and typechuyen=2 
									 and dated >= '".$fromDate."'  
									 and dated <= '".$toDate."' 
						"; 
					$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
					
					$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
					            where idloaivang=".$idloaivang."
								and type=1 and trangthai=2
								and datedxuat >= '".$fromDate."'  
								and datedxuat <= '".$toDate."' 
					"; 
					$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	

					$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3) + round(($rshaodu['du'] - $rshaodu['hao']),3);
					$sltontndn = $sltontndn + round(($rshaodu['duchenhlech'] - $rshaodu['haochenhlech']),3);
					$slton = $sltonsddk + $sltontndn;
					
					
					$arrlist['slhao'] = $rshaodu['hao'];
					$arrlist['sldu'] = $rshaodu['du'];
					
					$arrlist['slhaochenhlech'] = $rshaodu['haochenhlech'];
					$arrlist['slduchenhlech'] = $rshaodu['duchenhlech'];
					
					$arrlist['slnhap'] = $rsnhap['slnhapvang'];
					$arrlist['slxuat'] = $rsxuat['slxuatvang'];
					
					$arrlist['slton'] = $slton;
					$arrlist['sltonsddk'] = $sltonsddk;
				}
				$arrlist['idloaivang'] = $idloaivang;	
				$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
				
			}
		}
		else{
			$arrlist['idloaivang'] = 0;	
		}
	}
	else{
		die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
	}
	return $arrlist;
}
//==================THỐNG KÊ TỒN KHO LƯU MẪU===========================================//
	function thongKeTonKhoLuuMau($cid,$idloaivang,$fromDate,$toDate){
		$arrlist = array();
		$whnhap = $whxuat = $sqlktvang = $rsktvang = $sqlton = $rston = $sqltonsddk = $rstonsddk = $sqlhaodusddk = $rshaodusddk = $sqlhaodutndt = $rshaodutndt = $sqlnhaptndt = $rsnhaptndt = $sqlxuattndt = $rsxuattndt = "";
		$slton = $sltonsddk = $slnhap = $slxuat = $sltontndt =0;
		$cid = ceil(trim($cid));
		$idloaivang = ceil(trim($idloaivang));
		$datenow = date("Y-m-d");
		
		$sqlgettable = "select * from $GLOBALS[db_sp].categories where id=".$cid;
		$rsgettable = $GLOBALS['sp']->getRow($sqlgettable);
		
		$table = $rsgettable['table'];
		$tablehachtoan = $rsgettable['tablehachtoan'];
		if(!empty($rsgettable['table']) && !empty($rsgettable['tablehachtoan'])){
			if(!empty($fromDate)){
				$fromDate = explode('-',$fromDate);
				$fromDate = $fromDate[2].'/'.$fromDate[1].'/'.$fromDate[0];
				$fromDate = explode('/',$fromDate);
				$datedauthang = $fromDate[2].'-'.$fromDate[1].'-01';				
				$fromDate = $fromDate[2].'-'.$fromDate[1].'-'.$fromDate[0];				
				$whnhap.=' and dated >= "'.$fromDate.'" '; // ngày nhận
				$whdatechuyen.=' and dated >= "'.$fromDate.'" ';
			}
			if(!empty($toDate)){					
				$toDate = explode('-',$toDate);
				$toDate = $toDate[2].'/'.$toDate[1].'/'.$toDate[0];		
				$toDate = explode('/',$toDate);
				$toDate = $toDate[2].'-'.$toDate[1].'-'.$toDate[0];
				$whnhap.=' and dated <= "'.$toDate.'" ';
				$whdatechuyen.=' and datedxuat <= "'.$toDate.'" ';
			}
			if($idloaivang > 0){
				////////kiểm tra loại vàng đó có trong kho hay kg để xuất ra
				$sqlktvang = "select * from $GLOBALS[db_sp].".$table." where type=1 and typechuyen=2 and idloaivang = ".$idloaivang." limit 1";
				$rsktvang = $GLOBALS['sp']->getRow($sqlktvang);
				if(ceil($rsktvang['id']) > 0){///////có tồn tại loại vàng
					if(empty($whnhap)){//// ngày không có chọn
						$datedauthang = date("Y").'-'.date("m").'-01';
						$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
						$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
						/////////////////////get số lượng hao dư đầu kỳ
						$sqlhaodusddk = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
									 where idloaivang=".$idloaivang." 
									 and dated <= '".$thangtruoc."'
						";
						$rshaodusddk = $GLOBALS['sp']->getRow($sqlhaodusddk);
						//get tồn đầu kỳ
						$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
						$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
						
						$sltonsddk = $rstonsddk['sltonv'];
						$arrlist['sltonsddk'] = $sltonsddk;
						/////////////////////get số lượng hao dư
						$sqlhaodu = "select ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du, ROUND(SUM(haochenhlech), 3) as haochenhlech, ROUND(SUM(duchenhlech), 3) as duchenhlech from $GLOBALS[db_sp].".$tablehachtoan." 
									 where idloaivang=".$idloaivang." 
									 and dated <= '".$datedauthang."'
						";
						
						$rshaodu = $GLOBALS['sp']->getRow($sqlhaodu);
	
						////////////////get số tồn hiện tại
						$sqlton = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." order by id desc limit 1";
						$rston = $GLOBALS['sp']->getRow($sqlton);
						
						$slton = $rston['sltonv'];
						
						$arrlist['slhao'] = $rshaodu['hao'];
						$arrlist['sldu'] = $rshaodu['du'];
						
						$arrlist['slnhap'] = $rston['slnhapv'];
						$arrlist['slxuat'] = $rston['slxuatv'];
						$arrlist['slton'] = $slton;
					}
					else{/////// if có chọn ngày
					
						$thangtruoc = strtotime(date("Y-m-d", strtotime($datedauthang)) . " -1 month");
						$thangtruoc = strftime("%Y-%m-%d",$thangtruoc);
						
						$sqltonsddk = "select * from $GLOBALS[db_sp].".$tablehachtoan." where idloaivang=".$idloaivang." and dated <= '".$thangtruoc."' order by id desc limit 1";
						$rstonsddk = $GLOBALS['sp']->getRow($sqltonsddk);
						
						$sltonsddk = $rstonsddk['sltonv'];
						$thangdauky = $rstonsddk['dated']; 
						
						
					//die($sqlhaodutndt);
						$sqlnhaptndt = "select ROUND(SUM(cannangv), 3)  as slnhapvang from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang." 
										and type=1 
										and typechuyen=2 
										and dated < '".$fromDate."'  
										and dated >= '".$datedauthang."' 
						"; 
						$rsnhaptndt = $GLOBALS["sp"]->getRow($sqlnhaptndt);	
						//die($sqlnhaptndt);
						$sqlxuattndt = "select ROUND(SUM(cannangv), 3) as slxuatvang from $GLOBALS[db_sp].".$table." 
										where idloaivang=".$idloaivang." 
										and type in(2,3)
										and datedxuat < '".$fromDate."'  
										and datedxuat >= '".$datedauthang."' 
						"; 
						$rsxuattndt = $GLOBALS["sp"]->getRow($sqlxuattndt);	
						
						$sltontndt = round(($rsnhaptndt['slnhapvang'] - $rsxuattndt['slxuatvang']),3); 
						$sltonsddk = round(($sltonsddk + $sltontndt),3);
	
						/////////////////////get số lượng nhập, xuất, hao, dư, tồn, từ ngày đến ngày 
						
						$sqlnhap = "select ROUND(SUM(cannangv), 3) as slnhapvang from $GLOBALS[db_sp].".$table." 
										 where idloaivang=".$idloaivang." 
										 and type=1 
										 and typechuyen=2 
										 and dated >= '".$fromDate."'  
										 and dated <= '".$toDate."' 
							"; 
						$rsnhap = $GLOBALS["sp"]->getRow($sqlnhap);	
						
						$sqlxuat = "select ROUND(SUM(cannangv), 3) as slxuatvang, ROUND(SUM(hao), 3) as hao, ROUND(SUM(du), 3) as du from $GLOBALS[db_sp].".$table." 
									where idloaivang=".$idloaivang."
									and type in(2,3)
									and datedxuat >= '".$fromDate."'  
									and datedxuat <= '".$toDate."' 
						"; 
	
						$rsxuat = $GLOBALS["sp"]->getRow($sqlxuat);	
	
						$sltontndn = round(($rsnhap['slnhapvang'] -  $rsxuat['slxuatvang']),3);
						$slton = $sltonsddk + $sltontndn;
						
						
						$arrlist['slhao'] = $rsxuat['hao'];
						$arrlist['sldu'] = $rsxuat['du'];
						
						$arrlist['slnhap'] = $rsnhap['slnhapvang'];
						$arrlist['slxuat'] = $rsxuat['slxuatvang'];
						
						$arrlist['slton'] = $slton;
						$arrlist['sltonsddk'] = $sltonsddk;
						}
					$arrlist['idloaivang'] = $idloaivang;	
					$arrlist['tongQ10'] = getTongQ10($arrlist['slton'], $arrlist['idloaivang']);
					
				}
			}
			else{
				$arrlist['idloaivang'] = 0;	
			}
		}
		else{
			die('Table này chưa được thêm, vui lòng liên hệ với admin để được xử lý.');	
		}
		return $arrlist;
	}
//===========================KẾT THÚC FUNCTIONS THỐNG KÊ=======================================//
//=============================FUNCTIONS HẠCH TOÁN============================================//
//===========KHO KHÁC KHO LƯU MẪU=======================//
function ghiSoHachToanVangKhoKhacKhoLuuMau($tablehachtoan, $tablenhan, $id){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	
	$item = getTableRow($tablenhan,' and id='.$id); 
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($item['type']==1){
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		}
	else{
		$slxuatvhrc = $item['cannangvh'];
		$slxuatvrc = $item['cannangv'];
		$slxuathrc = $item['cannangh'];
		}
	$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){
		if($item['typevkc']==1){
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1";
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				$sltonvh = $rstru1day['sltonvh'];
				$sltonv = $rstru1day['sltonv'];
				$sltonh = $rstru1day['sltonh'];			
				}
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3);
			
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3);
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;	
			$arrnx1day['idloaivang'] = $item['idloaivang']; 
			}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
		}
	else{
		if($item['typevkc']==1){
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3);
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
			}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
		}		
	}
//=======//
function ghiSoHachToanVangKhoLuuMau($tablehachtoan, $tablenhan, $id, $typehachtoan){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$datenow = date("Y-m-d");
	$datedauthang = date("Y").'-'.date("m").'-01';
	$timnow = date('H:i:s');
	$item = getTableRow($tablenhan,' and id='.$id); 
	clearstatcache();
	unset($arrnx1day);
	$arrnx1day =  array();
	$arrnx1day['typevkc'] = $item['typevkc'];
	
	$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
	$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
	$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
	if($typehachtoan =='nhapkho'){
		$item['type'] = 1;
		}
	if($typehachtoan =='xuatkho'){
		$item['type'] = 2;
		}	
	if($item['type']==1){
		$slnhapvhrc = $item['cannangvh'];
		$slnhapvrc = $item['cannangv'];
		$slnhaphrc = $item['cannangh'];
		
		$dongianhaprc = $item['dongiaban'];;
		$slnhapkimcuongrc = 1;	
		}
	else{ 	
		if($tablenhan == 'kho_giamdockynhan' && $item['idloaivang'] == 12 && $item['typekhodau'] == 'khosanxuat_thanhpham'){
			$rskhothanhpham = getTableRow('khosanxuat_khothanhpham',' and id='.$item['idmaphieukho']); 
			$slxuatvhrc = $rskhothanhpham['cannangvh'];
			$slxuatvrc = $rskhothanhpham['cannangv'];
			$slxuathrc = $rskhothanhpham['cannangh'];
			}
		else{
			$slxuatvhrc = $item['cannangvh'];
			$slxuatvrc = $item['cannangv'];
			$slxuathrc = $item['cannangh'];
			}
		
		if($tablenhan == 'khokhac_kholammoi'){
			$haorc = $item['hao'];
			$durc = $item['du'];
			}
		else{
			$haorc = $item['haochuyen'];
			$durc = $item['duchuyen'];		
			}
		$dongiaxuatrc = $item['dongiaban'];
		$slxuatkimcuongrc = 1;
		}
	
	if($item['typevkc']==1){		
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
		}
	else{
		$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=".$item['typevkc'];	
		}
	$rsdate = $GLOBALS['sp']->getRow($sqldate);	
	if(empty($rsdate['id'])){	
		if($item['typevkc']==1){
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; 
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
		
			if($rstru1day['id'] > 0){
				$sltonvh = $rstru1day['sltonvh'];
				$sltonv = $rstru1day['sltonv'];
				$sltonh = $rstru1day['sltonh'];
				}
			$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3) ;
			$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
			
			$arrnx1day['sltonvh'] = $sltonvh;
			$arrnx1day['sltonv'] = $sltonv;
			$arrnx1day['sltonh'] = $sltonh;
			
			$arrnx1day['slnhapvh'] = $slnhapvhrc;
			$arrnx1day['slnhapv'] = $slnhapvrc;
			$arrnx1day['slnhaph'] = $slnhaphrc;
			$arrnx1day['slxuatvh'] = $slxuatvhrc;
			$arrnx1day['slxuatv'] = $slxuatvrc;
			$arrnx1day['slxuath'] = $slxuathrc;
			
			$arrnx1day['hao'] = $haorc;
			$arrnx1day['du'] = $durc;
			
			$arrnx1day['idloaivang'] = $item['idloaivang']; 
			}
		else{
			$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." order by dated desc limit 1";
			$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
			
			if($rstru1day['id'] > 0){
				$sltonkimcuong = $rstru1day['sltonkimcuong'];
				$tongdongia = $rstru1day['tongdongia'];
				}	
			$sltonkimcuong = round(round(($sltonkimcuong + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3);
			$tongdongia = round(round(($tongdongia + $dongianhaprc),3) - $dongiaxuatrc,3);
			
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuongrc;
			
			$arrnx1day['dongianhap'] = $dongianhaprc;
			$arrnx1day['dongiaxuat'] = $dongiaxuatrc;
			$arrnx1day['tongdongia'] = $tongdongia;
			}
		$arrnx1day['dated'] = $datedauthang;
		vaInsert($tablehachtoan,$arrnx1day);
		}
	else{
		if($item['typevkc']==1){
			$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
			$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
			$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
			
			$hao = round(($rsdate['hao'] + $haorc),3);
			$du = round(($rsdate['du'] + $durc),3) ;
			
			$arrnx1day['slnhapvh'] = $slnhapvh;
			$arrnx1day['slxuatvh'] = $slxuatvh;
			$arrnx1day['sltonvh'] = $sltonvh;
			
			$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
			$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
			$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
									
			$arrnx1day['slnhapv'] = $slnhapv;
			$arrnx1day['slxuatv'] = $slxuatv;
			$arrnx1day['sltonv'] = $sltonv;
			
			$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
			$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
			$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3) ;
									
			$arrnx1day['slnhaph'] = $slnhaph;
			$arrnx1day['slxuath'] = $slxuath;
			$arrnx1day['sltonh'] = $sltonh;
		
			$arrnx1day['hao'] = $hao;
			$arrnx1day['du'] = $du;
			}
		else{
			$slnhapkimcuong = round(($rsdate['slnhapkimcuong'] + $slnhapkimcuongrc),3);
			$slxuatkimcuong = round(($rsdate['slxuatkimcuong'] + $slxuatkimcuongrc),3) ;
			$sltonkimcuong = round(round(($rsdate['sltonkimcuong'] + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3) ;
			
			$dongianhap = round(($rsdate['dongianhap'] + $dongianhaprc),3);
			$dongiaxuat = round(($rsdate['dongiaxuat'] + $dongiaxuatrc),3);
			$tongdongia = round(round(($rsdate['tongdongia'] + $dongianhaprc),3) - $dongiaxuatrc,3) ;
			
			$arrnx1day['slnhapkimcuong'] = $slnhapkimcuong;
			$arrnx1day['slxuatkimcuong'] = $slxuatkimcuong;
			$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
			
			$arrnx1day['dongianhap'] = $dongianhap;
			$arrnx1day['dongiaxuat'] = $dongiaxuat;
			$arrnx1day['tongdongia'] = $tongdongia;
			}
		vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
		}		
	}
	//=========================//
	function ghiSoHachToanKCKhoKhacKhoLuuMau($tablehachtoan, $tablenhan, $id, $typehachtoan){
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$datenow = date("Y-m-d");
		$datedauthang = date("Y").'-'.date("m").'-01';
		$timnow = date('H:i:s');
		$item = getTableRow($tablenhan,' and id='.$id); 
		clearstatcache();
		unset($arrnx1day);
		$arrnx1day =  array();
		$arrnx1day['typevkc'] = $item['typevkc'];
		
		$slnhapvhrc = $slnhapvrc = $slnhaphrc = $slnhapkimcuongrc = $slxuatvhrc = $slxuatvrc = $slxuathrc = $slxuatkimcuongrc = 0;
		$slnhapvh = $slxuatvh = $sltonvh = $slnhapkimcuong = $slxuatkimcuong = $sltonkimcuong = 0;
		$slnhapv = $slxuatv = $sltonv = $tongdongia = $dongiaxuatrc = $dongianhaprc = $dongianhap = $dongiaxuat = $hao = $du = $haorc = $durc = 0;
		if($typehachtoan =='nhapkho'){
			$item['type'] = 1;
			}
		if($typehachtoan =='xuatkho'){
			$item['type'] = 2;
			}	
		if($item['type']==1){
			$slnhapvhrc = $item['cannangvh'];
			$slnhapvrc = $item['cannangv'];
			$slnhaphrc = $item['cannangh'];
			
			$dongianhaprc = $item['dongiaban'];;
			$slnhapkimcuongrc = 1;	
			}
		else{ 	
			if($tablenhan == 'kho_giamdockynhan' && $item['idloaivang'] == 12 && $item['typekhodau'] == 'khosanxuat_thanhpham'){
				$rskhothanhpham = getTableRow('khosanxuat_khothanhpham',' and id='.$item['idmaphieukho']); 
				$slxuatvhrc = $rskhothanhpham['cannangvh'];
				$slxuatvrc = $rskhothanhpham['cannangv'];
				$slxuathrc = $rskhothanhpham['cannangh'];
				}
			else{
				$slxuatvhrc = $item['cannangvh'];
				$slxuatvrc = $item['cannangv'];
				$slxuathrc = $item['cannangh'];
				}
			
			if($tablenhan == 'khokhac_kholammoi'){
				$haorc = $item['hao'];
				$durc = $item['du'];
				}
			else{
				$haorc = $item['haochuyen'];
				$durc = $item['duchuyen'];		
				}
			$dongiaxuatrc = $item['dongiaban'];
			$slxuatkimcuongrc = 1;
			}
		
		if($item['typevkc']==1){		
			$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and idloaivang=".$item['idloaivang']." and typevkc=".$item['typevkc'];	
			}
		else{
			$sqldate = "select * from $GLOBALS[db_sp].".$tablehachtoan." where dated='".$datedauthang."' and typevkc=".$item['typevkc'];	
			}
		$rsdate = $GLOBALS['sp']->getRow($sqldate);	
		if(empty($rsdate['id'])){	
			if($item['typevkc']==1){
				$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." and idloaivang=".$item['idloaivang']." order by dated desc limit 1"; 
				$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
			
				if($rstru1day['id'] > 0){
					$sltonvh = $rstru1day['sltonvh'];
					$sltonv = $rstru1day['sltonv'];
					$sltonh = $rstru1day['sltonh'];
					}
				$sltonvh = round(round(($sltonvh + $slnhapvhrc),3) - $slxuatvhrc,3) ;
				$sltonv = round(round(($sltonv + $slnhapvrc),3) - $slxuatvrc,3) ;
				$sltonh = round(round(($sltonh + $slnhaphrc),3) - $slxuathrc,3) ;
				
				$arrnx1day['sltonvh'] = $sltonvh;
				$arrnx1day['sltonv'] = $sltonv;
				$arrnx1day['sltonh'] = $sltonh;
				
				$arrnx1day['slnhapvh'] = $slnhapvhrc;
				$arrnx1day['slnhapv'] = $slnhapvrc;
				$arrnx1day['slnhaph'] = $slnhaphrc;
				$arrnx1day['slxuatvh'] = $slxuatvhrc;
				$arrnx1day['slxuatv'] = $slxuatvrc;
				$arrnx1day['slxuath'] = $slxuathrc;
				
				$arrnx1day['hao'] = $haorc;
				$arrnx1day['du'] = $durc;
				
				$arrnx1day['idloaivang'] = $item['idloaivang']; 
				}
			else{
				$sqltru1day = "select * from $GLOBALS[db_sp].".$tablehachtoan." where typevkc=".$item['typevkc']." order by dated desc limit 1";
				$rstru1day = $GLOBALS['sp']->getRow($sqltru1day);
				
				if($rstru1day['id'] > 0){
					$sltonkimcuong = $rstru1day['sltonkimcuong'];
					$tongdongia = $rstru1day['tongdongia'];
					}	
				$sltonkimcuong = round(round(($sltonkimcuong + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3);
				$tongdongia = round(round(($tongdongia + $dongianhaprc),3) - $dongiaxuatrc,3);
				
				$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
				$arrnx1day['slnhapkimcuong'] = $slnhapkimcuongrc;
				$arrnx1day['slxuatkimcuong'] = $slxuatkimcuongrc;
				
				$arrnx1day['dongianhap'] = $dongianhaprc;
				$arrnx1day['dongiaxuat'] = $dongiaxuatrc;
				$arrnx1day['tongdongia'] = $tongdongia;
				}
			$arrnx1day['dated'] = $datedauthang;
			vaInsert($tablehachtoan,$arrnx1day);
			}
		else{
			if($item['typevkc']==1){
				$slnhapvh = round(($rsdate['slnhapvh'] + $slnhapvhrc),3);
				$slxuatvh = round(($rsdate['slxuatvh'] + $slxuatvhrc),3) ;
				$sltonvh = round(round(($rsdate['sltonvh'] + $slnhapvhrc),3) - $slxuatvhrc,3) ;
				
				$hao = round(($rsdate['hao'] + $haorc),3);
				$du = round(($rsdate['du'] + $durc),3) ;
				
				$arrnx1day['slnhapvh'] = $slnhapvh;
				$arrnx1day['slxuatvh'] = $slxuatvh;
				$arrnx1day['sltonvh'] = $sltonvh;
				
				$slnhapv = round(($rsdate['slnhapv'] + $slnhapvrc),3);
				$slxuatv = round(($rsdate['slxuatv'] + $slxuatvrc),3) ;
				$sltonv = round(round(($rsdate['sltonv'] + $slnhapvrc),3) - $slxuatvrc,3);
										
				$arrnx1day['slnhapv'] = $slnhapv;
				$arrnx1day['slxuatv'] = $slxuatv;
				$arrnx1day['sltonv'] = $sltonv;
				
				$slnhaph = round(($rsdate['slnhaph'] + $slnhaphrc),3);
				$slxuath = round(($rsdate['slxuath'] + $slxuathrc),3) ;
				$sltonh = round(round(($rsdate['sltonh'] + $slnhaphrc),3) - $slxuathrc,3) ;
										
				$arrnx1day['slnhaph'] = $slnhaph;
				$arrnx1day['slxuath'] = $slxuath;
				$arrnx1day['sltonh'] = $sltonh;
			
				$arrnx1day['hao'] = $hao;
				$arrnx1day['du'] = $du;
				}
			else{
				$slnhapkimcuong = round(($rsdate['slnhapkimcuong'] + $slnhapkimcuongrc),3);
				$slxuatkimcuong = round(($rsdate['slxuatkimcuong'] + $slxuatkimcuongrc),3) ;
				$sltonkimcuong = round(round(($rsdate['sltonkimcuong'] + $slnhapkimcuongrc),3) - $slxuatkimcuongrc,3) ;
				
				$dongianhap = round(($rsdate['dongianhap'] + $dongianhaprc),3);
				$dongiaxuat = round(($rsdate['dongiaxuat'] + $dongiaxuatrc),3);
				$tongdongia = round(round(($rsdate['tongdongia'] + $dongianhaprc),3) - $dongiaxuatrc,3) ;
				
				$arrnx1day['slnhapkimcuong'] = $slnhapkimcuong;
				$arrnx1day['slxuatkimcuong'] = $slxuatkimcuong;
				$arrnx1day['sltonkimcuong'] = $sltonkimcuong;
				
				$arrnx1day['dongianhap'] = $dongianhap;
				$arrnx1day['dongiaxuat'] = $dongiaxuat;
				$arrnx1day['tongdongia'] = $tongdongia;
				}
			vaUpdate($tablehachtoan,$arrnx1day,' id='.$rsdate['id']);
			}		
		}
	
//===========KẾT THÚC KHO KHÁC KHO LƯU MẪU=============//
//=============================KẾT THÚC FUNCTIONS HẠCH TOÁN===================================//
//=============================FUNCTIONS OTHER===============================================//
	function insert_getNameKhoShort($a){
	$title = '';
	if($a['id'] > 0){
		$title = getLinkTitle($a['id'],1);
		if(!empty($title) && $a['id'] != 708 ){
			$title = explode('&raquo;',$title);
			$title = $title[0].' &raquo; '. $title[1];	
			}
		}
	return $title;
	}
	//======================//
	function getLinkTitleKhoShort($id,$type){
		$title = '';
		$title = getLinkTitle($id,$type);
		$title = explode('&raquo;',$title);
		$title = $title[0].' &raquo; '. $title[1];	
		return $title;
		}
//==========================KẾT THÚC FUNCTIONS OTHER========================================//
?>

