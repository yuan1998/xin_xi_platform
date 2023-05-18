<?php

namespace App\Admin\Controllers;

use App\Admin\Grid\Tools\PullAccountData;
use App\Models\JlReportDatum;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class JlReportDatumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(JlReportDatum::query()->orderBy('stat_datetime','desc'), function (Grid $grid) {
            $grid->tools([new PullAccountData('拉取巨量数据', 'jl')]);
            $grid->scrollbarX();
            $grid->export();


            $grid->column('stat_datetime')->display(function ($val) {
                return substr($val, 0, 10);
            });
            $grid->column('ad_name');
            $grid->column('campaign_id');
            $grid->column('campaign_name');
            $grid->column('ad_id');
            $grid->column('show');
            $grid->column('click');
            $grid->column('cost');
            $grid->column('ctr');
            $grid->column('avg_click_cost');
            $grid->column('avg_show_cost');
            $grid->column('convert');
            $grid->column('convert_cost');
            $grid->column('convert_rate');
            $grid->column('form');

            $grid->filter(function (Grid\Filter $filter) {

                $filter->like('ad_name');
                $filter->like('ad_id');
                $filter->like('campaign_name');
                $filter->like('campaign_id');
                $filter->whereBetween('stat_datetime', function ($query) {
                    $start = $this->input['start'] ?? null;
                    $end = $this->input['end'] ?? null;
                    if ($start)
                        $query->whereDate('stat_datetime', ">=", "$start 00:00:00");
                    if ($end)
                        $query->whereDate('stat_datetime', "<=", "$end 23:59:59");
                })->date();
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new JlReportDatum(), function (Show $show) {
            $show->field('id');
            $show->field('stat_datetime');
            $show->field('ad_name');
            $show->field('campaign_id');
            $show->field('campaign_name');
            $show->field('ad_id');
            $show->field('show');
            $show->field('click');
            $show->field('cost');
            $show->field('ctr');
            $show->field('avg_click_cost');
            $show->field('avg_show_cost');
            $show->field('convert');
            $show->field('convert_cost');
            $show->field('convert_rate');
            $show->field('form');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new JlReportDatum(), function (Form $form) {
            $form->display('id');
            $form->text('stat_datetime');
            $form->text('ad_name');
            $form->text('campaign_id');
            $form->text('campaign_name');
            $form->text('ad_id');
            $form->text('show');
            $form->text('click');
            $form->text('cost');
            $form->text('ctr');
            $form->text('avg_click_cost');
            $form->text('avg_show_cost');
            $form->text('convert');
            $form->text('convert_cost');
            $form->text('convert_rate');
            $form->text('form');
        });
    }
}
