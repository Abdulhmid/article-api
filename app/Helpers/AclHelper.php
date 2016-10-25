<?php 

class AclHelper {

	public static function takeFunction($module_id = "", $origin = ""){
		$module = App\Models\Modules::where('module_id',$module_id)->first();
		$listfunction = ($origin <> "" 
					? explode(',', $module->function) 
					: explode(',', $module->function_alias) );
		
		return $listfunction;
	}

	public static function takeNumberFunction($module_id= "", $keyOut=""){
		$takeList = self::takeFunction($module_id, "origin");
		foreach ($takeList as $key => $value) {
			if($key == $keyOut)
				$valueFunction = $value;
		}
		return $valueFunction;
	}

	public static function takePermissionFunction(
		$groupId, 
		$module_id, 
		$valuefunction, 
		$acl = ""
	)
	{
		$data = App\Models\Modules_access::where('module_id',$module_id)
					 ->where('group_id',$groupId)
					 ->get();
		
		$listaccess = ($data->count() > 0 ? json_decode($data->first()->access_data, true) : 0) ;

		if ($listaccess > 0) :
			$valueacces = isset($listaccess[''.$valuefunction.'']) ? 
				$listaccess[''.$valuefunction.''] : "0" ;
			if ($valueacces == "1") :
				return "checked";
			else :
				return "";
			endif;
		else :
			return "";
		endif;			

	}

	/* Menu Addons */
	public static function menuHeadAddOns($module){
		$idModuel = App\Models\Modules::where('module_name',$module);
		if ($idModuel->count() > 0 ) {
			$moduleAddOns = App\Models\Modules_addons::where(
								'module_id',$idModuel->first()->module_id
							);
			if ($moduleAddOns->count() > 0) {
				if ($moduleAddOns->first()->active==1) {
					return 1;
				}else{
					return 0;
				}
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

}