<?php

namespace App\DataTables;

use App\Models\News;
use Yajra\Datatables\Services\DataTable;

class NewsDataTables extends DataTable
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
            ->editColumn('created_at', function ($row) {
                return \GLobalHelper::formatDate($row->created_at);
            })
            ->editColumn('updated_at', function ($row) {
                return \GLobalHelper::formatDate($row->updated_at);
            })
            ->addColumn('action', function ($row) {
                $column = "<a href=\"" . route('news.edit', $row->id) . "\" class=\"btn btn-flat btn-default btn-sm\" data-toggle=\"tooltip\" data-original-title=\"Edit\">
                    <i class=\"fa fa-pencil\"></i> Edit
                </a>
                <a href=\"" . route('news.destroy', $row->id) . "\" class=\"btn btn-flat btn-danger btn-sm btn-delete\" data-toggle=\"tooltip\" data-original-title=\"Delete\" onclick=\"swal_alert(this,null,'delete','" . csrf_token() . "'); return false;\">
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
        $query = News::query();

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
                    ->addAction(['width' => '80px'])
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
            'title' => [
                'title' => 'Judul',
                'width' => '35%'
            ],
            'created_at' => [
                'title' => 'Ditulis',
                'width' => '25%'
            ],
            'updated_at' => [
                'title' => 'Diubah',
                'width' => '25%'
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
        return 'groupsdatatables_' . time();
    }
}
