<?php

namespace App\DataTables;

use App\Models\OurFeature;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OurFeatureDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = '<a href="' . route('admin.our-features.edit', $query->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';
                $delete = '<a href="' . route("admin.our-features.destroy", $query->id) . '" class="delete-item btn btn-sm btn-danger ml-2"><i class="fas fa-trash"></i></a>';
                return $edit . $delete;
            })
            ->addColumn('icon', function ($query) {
                return '<i class="' . $query->icon . '" style="font-size: 40px;"></i>';
            })
            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return "<span class='badge badge-primary'>Active</span>";
                } else {
                    return "<span class='badge badge-danger'>Inactive</span>";
                }
            })
            ->rawColumns(['action', 'icon', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OurFeature $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ourfeature-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('icon'),
            Column::make('title'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'OurFeature_' . date('YmdHis');
    }
}
