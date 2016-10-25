<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modules extends Model
{

    use SoftDeletes;

    protected $table      = 'modules';
    protected $primaryKey = 'module_id';
    protected $guarded    = ['module_id'];
    protected $dates      = ['deleted_at'];

    public function makeInfo($id = "")
    {
        $row = $this->where('module_name', $id)->get();
        $data = array();
        foreach ($row as $r) {
            $data['id'] = $r->module_id;
            $data['table'] = $r->module_db;
        }
        return $data;
    }

    function validAccess($id, $groupId)
    {

        $row = Modules_access::where('module_id', '=', $id)
            ->where('group_id', '=', $groupId)
            ->get();

        if (count($row) >= 1) {
            $row = $row[0];
            if ($row->access_data != '') {
                $data = json_decode($row->access_data, true);
            } else {
                $data = array();
            }
            return $data;

        } else {
            return false;
        }

    }

    public function getGroup($id)
    {
        return Groups::find($id)['group_id'];
    }
}
