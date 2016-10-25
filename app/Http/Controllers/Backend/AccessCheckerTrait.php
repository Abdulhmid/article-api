<?php


namespace App\Http\Controllers\Backend;

use App\Models\Modules;


trait AccessCheckerTrait
{
    private function checkAccess($function)
    {
        if (\Auth::user()->group_id != 1 ) {
            $getAccess = $this->info ? 
                                $this->modules->validAccess($this->info['id'], \Auth::user()->group_id) : "";
            if (isset($getAccess[$function])) {
                if ($getAccess == "" || $getAccess[$function] == 0)
                    abort(403);
            }else{
              abort(403);
            }
        }



    }
}