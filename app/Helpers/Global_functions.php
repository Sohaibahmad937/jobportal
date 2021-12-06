<?php
function Menu($parent_id=0){
    
    // echo Request::segment(2);
    // exit;
    
    $result = DB::table('menus')->where('main_menu_id',3)->where('parent_menu_id',$parent_id)->where('publish',1)->orderBy('sort','ASC')->get();
	if(!empty($result)){
		foreach($result as $res)
		{
			$access = moduleacess($res->link,'access',$res->menu_id);
			//if($SESS->session->userdata('role')=='1')$access['access']=1;
            $Display_cart_icon_or_not=0;
            $sqlM = DB::table('menus')->where('parent_menu_id',$res->menu_id)->where('publish',1)->count();
            if($sqlM>0) $Display_cart_icon_or_not=1; else $Display_cart_icon_or_not=0;
    		
			if($res->link!=''){
				$link = url($res->link);	
			}else{
				$link ='#';
			}
			// if($res['link']==$ci->uri->segment(1)){
			// 	$active = "active";
			// }else{
				$active = "";
			// }
			#echo $access['access'];
			$lan = Lang::locale();
			if($lan == 'gu'){
				$menu_title = $res->menu_title_guj;
			}elseif($lan == 'hi'){
				$menu_title = $res->menu_title_hin;
			}else{
				$menu_title = $res->menu_title;
			}
			if($access){
			echo'<li class="menu '.$active.'">';
			if($Display_cart_icon_or_not=='1'){
				echo'<a href="#menu_'.$res->menu_id.'" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
					<div class="">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
						<span> '.$menu_title.'</span>
					</div>
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
					</div>
				</a>';
			}else{
				echo'<a href="'.$link.'" class="dropdown-toggle"> <div class="">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> <span>'.$menu_title.'</span></div> </a>';
			}
			if($Display_cart_icon_or_not=='1'){
				echo '<ul class="collapse submenu list-unstyled" id="menu_'.$res->menu_id.'" data-parent="#accordionExample">';
						Menu($res->menu_id);
				echo'</ul>';	
				}
			echo'</li>';	
			}
		}
	}
}

function moduleacess($link,$type,$id = ''){
	$role = Auth::user()->role;
	if($role == 1) return true;
	if($link == ''){
		$result = DB::table('role_privilege')->where('role_id',$role)->where('module_id',$id)->where($type,1)->count();
	}else{
		$result = DB::table('role_privilege')->where('role_id',$role)->where('module_link',$link)->where($type,1)->count();
	}
    
    if($result>0){
        return true;
    }else{
        return false;
    }

}

function FrontUserInfo($id){
	$result = DB::table('front_users')->select('phone','token','email','name')->where('id',$id)->first();
	$data = [
		'phone' => '-',
		'token' => '-',
		'email' => '-',
		'name' => '-'
	];
	if(!empty($result)){
		$data['phone'] = $result->phone;
		$data['token'] = $result->token;
		$data['email'] = $result->email;
		$data['name'] = $result->name;
	}
	return $data;
}


function group_by($key, $data) {
    $result = array();

    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }

    return $result;
}

function RoleName($id){
	$result = DB::table('roles')->where('id',$id)->first();
	if(!empty($result)){
		return $result->name;
	}else{
		return '-';
	}
}

function InsurerName($id){
	$result = DB::table('insurar')->select('name')->where('id',$id)->first();
	if(!empty($result)){
		return $result->name;
	}else{
		return '-';
	}
}

function TallerName($id){
	$result = DB::table('workshop')->select('name')->where('id',$id)->first();
	if(!empty($result)){
		return $result->name;
	}else{
		return '-';
	}
}


function UserInfo($id){
	$result = DB::table('users')->select('name')->where('id',$id)->first();
	$data = [
		'name' => '-'
	];
	if(!empty($result)){
		$data['name'] = $result->name;
	}
	return $data;
}

function GetSupplierId($user_id = null){
	if($user_id == ''){
		$user_id = Auth::user()->id;
	}
	$id = NULL;
	$result = DB::table('supplier')->select('id')->where('user_id',$user_id)->first();
	if(!empty($result)){
		$id = $result->id;
	}
	return $id;
}
function GetTransPorterId($user_id = null){
	if($user_id == ''){
		$user_id = Auth::user()->id;
	}
	$id = NULL;
	$result = DB::table('transporter')->select('id')->where('user_id',$user_id)->first();
	if(!empty($result)){
		$id = $result->id;
	}
	return $id;
}

function DPRetailerFromUserID($user_id = null){
	if($user_id == ''){
		$user_id = Auth::user()->id;
	}
	
	$result = DB::table('delivery_partner')->leftJoin('users as u1',function($join){
		$join->on('delivery_partner.user_id','=','u1.id');
	})
	->leftJoin('users as u2',function($join){
		$join->on('delivery_partner.retailer_id','=','u2.id');
	})
	->select('u2.name as retailer_name','u1.name as delivery_partner_name','delivery_partner.user_id as delivery_partner_id','delivery_partner.retailer_id as retailer_id')
	->where('delivery_partner.user_id',$user_id)
	->first();
	
	$data = [
		'delivery_partner_name' => '',
		'delivery_partner_id' => '',
		'retailer_id' => '',
		'retailer_name' => '',
	];

	if(!empty($result)){
		$data = [
			'delivery_partner_name' => $result->delivery_partner_name,
			'delivery_partner_id' => $result->delivery_partner_id,
			'retailer_id' => $result->retailer_id,
			'retailer_name' => $result->retailer_name,
		];	
	}

	return $data;
	
	//~ $query = DB::table('delivery_partner')->leftJoin('users as u1',function($join){
		//~ $join->on('delivery_partner.user_id','=','u1.id');
	//~ });
	//~ $query->leftJoin('retailer as u2',function($join){
		//~ $join->on('delivery_partner.retailer_id','=','u2.id');
	//~ });
	//~ $query->leftJoin('users as u3',function($join){
		//~ $join->on('u2.user_id','=','u3.id');
	//~ });
	//~ $query->select('u1.name as delivery_partner_name','delivery_partner.id as delivery_partner_id','delivery_partner.retailer_id','u3.name as retailer_name');
	//~ $query->where('delivery_partner.user_id',$user_id);

	//~ $result = $query->first();

	

}


function GetSlug($name){
	$str = str_replace(' ', '_',$name);
	$str = str_replace('&', '',$str);
	$str = preg_replace('/[^A-Za-z0-9\_]/', '',$str);
	$str = strtoupper($str);
	return $str;
}

function GetCurrency(){
	// return '₹';
	return 'Rs.';
}

function format_number($n = '')
{
	return ($n === '') ? '' : number_format( (float) (round($n,2)), 2, '.', '');
}

function referal_code(){
	return mt_rand(10000000,99999999);
}
?>
