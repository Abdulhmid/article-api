<?php

namespace App\DataTables;

use App\Models\Modules;
use Yajra\Datatables\Services\DataTable;

class ModulesDatatables extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('addons', function ($row) {
                if ($row->addons == "1") {
                    return "Ya";
                }else{
                    return "Tidak";
                }
            })
            ->editColumn('created_at', function ($row) {
                return \GLobalHelper::formatDate($row->created_at);
            })
            ->editColumn('updated_at', function ($row) {
                return \GLobalHelper::formatDate($row->updated_at);
            })
            ->addColumn('action', function ($row) {
                $column = "<a href=\"" . route('modules.edit', $row->module_id) . "\" class=\"btn btn-flat btn-default btn-sm\" data-toggle=\"tooltip\" data-original-title=\"Edit\">
                    <i class=\"fa fa-pencil\"></i> Edit
                </a>";
                $column .= "<a href=\"" . route('modules.destroy', $row->module_id) . "\" class=\"btn btn-flat btn-danger btn-sm btn-delete\" data-toggle=\"tooltip\" data-original-title=\"Delete\" onclick=\"swal_alert(this,null,'delete','" . csrf_token() . "'); return false;\">
                    <i class=\"fa fa-trash-o\"></i> Hapus
                </a>";

                return $column;
            })
            ->removeColumn('id')
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Modules::query();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '215px','title'=>'Aksi'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'module_name_alias' => [
                'title' => 'Nama',
                'width' => '15%'
            ],
            'function_alias' => [
                'title' => 'Fungsi',
                'width' => '15%'
            ],
            'addons' => [
                'title' => 'Modul Addons',
                'width' => '5%'
            ],
            'description' => [
                'title' => 'Deskripsi',
                'width' => '20%'
            ],
            'created_at' => [
                'title' => 'Created',
                'width' => '15%'
            ],
            'updated_at' => [
                'title' => 'Updated',
                'width' => '15%'
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'modulesdatatables_' . time();
    }
}
