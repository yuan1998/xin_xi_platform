<?php

namespace App\Admin\Controllers;

use App\Admin\Grid\Tools\PullAccountData;
use App\Models\UcReportDatum;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UcReportDatumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make( UcReportDatum::query()->orderBy('date','desc'), function (Grid $grid) {
            $grid->tools([new PullAccountData('拉取UC数据', 'uc')]);
            $grid->scrollbarX();
            $grid->export();

            $grid->column('date')->display(function ($val) {
                return substr($val, 0, 10);
            });
            $grid->column('account_id');
            $grid->column('account_name');
            $grid->column('campaign_id');
            $grid->column('campaign_name');
            $grid->column('campaign_type');
            $grid->column('impression');
            $grid->column('click');
            $grid->column('cost');
            $grid->column('ctr');
            $grid->column('cpc');
            $grid->column('cpm');
            $grid->column('transfer');
            $grid->column('td');
            $grid->column('td_rate');
            $grid->column('td_cost');
            $grid->column('tc');
            $grid->column('tc_rate');
            $grid->column('tc_cost');
            $grid->column('tc_type');

            $grid->filter(function (Grid\Filter $filter) {

                $filter->like('account_id');
                $filter->like('account_name');
                $filter->between('date')
                    ->date();
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
        return Show::make($id, new UcReportDatum(), function (Show $show) {
            $show->field('id');
            $show->field('date');
            $show->field('account_id');
            $show->field('account_name');
            $show->field('campaign_id');
            $show->field('campaign_name');
            $show->field('campaign_type');
            $show->field('impression');
            $show->field('click');
            $show->field('cost');
            $show->field('ctr');
            $show->field('cpc');
            $show->field('cpm');
            $show->field('transfer');
            $show->field('td');
            $show->field('td_rate');
            $show->field('td_cost');
            $show->field('tc');
            $show->field('tc_rate');
            $show->field('tc_cost');
            $show->field('tc_type');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new UcReportDatum(), function (Form $form) {
            $form->display('id');
            $form->text('date');
            $form->text('account_id');
            $form->text('account_name');
            $form->text('campaign_id');
            $form->text('campaign_name');
            $form->text('campaign_type');
            $form->text('impression');
            $form->text('click');
            $form->text('cost');
            $form->text('ctr');
            $form->text('cpc');
            $form->text('cpm');
            $form->text('transfer');
            $form->text('td');
            $form->text('td_rate');
            $form->text('td_cost');
            $form->text('tc');
            $form->text('tc_rate');
            $form->text('tc_cost');
            $form->text('tc_type');
        });
    }
}
