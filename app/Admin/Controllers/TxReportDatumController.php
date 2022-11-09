<?php

namespace App\Admin\Controllers;

use App\Admin\Grid\Tools\PullAccountData;
use App\Models\TxReportDatum;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TxReportDatumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(TxReportDatum::query()->orderBy('date','desc'), function (Grid $grid) {
            $grid->tools([new PullAccountData('拉取腾讯数据', 'tx')]);
            $grid->scrollbarX();
            $grid->export();

            $grid->column('date')->display(function ($val) {
                return substr($val , 0 , 10);
            });
            $grid->column('account_id');
            $grid->column('view_count');
            $grid->column('valid_click_count');
            $grid->column('ctr');
            $grid->column('cpc');
            $grid->column('cost');
            $grid->column('page_reservation_count');
            $grid->column('page_reservation_cost');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('account_id');
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
        return Show::make($id, new TxReportDatum(), function (Show $show) {
            $show->field('id');
            $show->field('date');
            $show->field('account_id');
            $show->field('view_count');
            $show->field('valid_click_count');
            $show->field('ctr');
            $show->field('cpc');
            $show->field('cost');
            $show->field('page_reservation_count');
            $show->field('page_reservation_cost');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new TxReportDatum(), function (Form $form) {
            $form->display('id');
            $form->text('date');
            $form->text('account_id');
            $form->text('view_count');
            $form->text('valid_click_count');
            $form->text('ctr');
            $form->text('cpc');
            $form->text('cost');
            $form->text('page_reservation_count');
            $form->text('page_reservation_cost');
        });
    }
}
