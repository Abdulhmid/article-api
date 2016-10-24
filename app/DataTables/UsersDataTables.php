<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UsersDataTables extends DataTable
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
            ->editColumn('photo','<img src="{!! GLobalHelper::checkImage($photo) !!}" style="max-height:100px" class="thumbnail"> ')
            ->editColumn('created_at', function ($row) {
                return \GLobalHelper::formatDate($row->created_at);
            })
            ->editColumn('updated_at', function ($row) {
                return \GLobalHelper::formatDate($row->updated_at);
            })
            ->addColumn('action', function ($row) {
                $column = "<a href=\"" . route('users.edit', $row->id) . "\" class=\"btn btn-flat btn-default btn-sm\" data-toggle=\"tooltip\" data-original-title=\"Edit\">
                    <i class=\"fa fa-pencil\"></i> Edit
                </a>";
                $column .= "<a href=\"" . route('users.destroy', $row->id) . "\" class=\"btn btn-flat btn-danger btn-sm btn-delete\" data-toggle=\"tooltip\" data-original-title=\"Delete\" onclick=\"swal_alert(this,null,'delete','" . csrf_token() . "'); return false;\">
                    <i class=\"fa fa-trash-o\"></i> Hapus
                </a>";

                return $column;
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::with(['groups'])
                       ->select('*');

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
                    ->addAction(['width' => '150px','title' => 'Aksi'])
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
            'group_id' => [
                'visible' => false,
                'title' => 'Nama'
            ],
            'photo' => [
                'title' => 'Photo'
            ],
            'username' => [
                'title' => 'Username'
            ],
            'name' => ['title' => 'Nama'],
            'email' => ['title' => 'Email'],
            'created_at' => [
                'title' => 'Ditulis'
            ],
            'updated_at' => [
                'title' => 'Diubah'
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
        return 'admindatatables_' . time();
    }
}
