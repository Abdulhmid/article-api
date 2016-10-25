<?php


namespace App\Http\Controllers\Backend;

use App\Models\Modules;

trait AccessCheckerTrait
{
    private function checkAccess($function)
    {
        if (\Auth::user()->group_id != 1 ) {
            if (isset($this->accessAcl[$function])) {
                if ($this->accessAcl == "" || $this->accessAcl[$function] == 0)
                    abort(403);
            }else{
              abort(403);
            }
        }
    }

    private function accessAcl(){
        return ($this->info ? Modules::validAccess($this->info['id'], $this->groupid) : "");
    }
}