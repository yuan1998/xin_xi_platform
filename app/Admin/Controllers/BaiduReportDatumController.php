<?php

namespace App\Admin\Controllers;

use App\Admin\Grid\Tools\PullAccountData;
use App\Models\BaiduReportData;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BaiduReportDatumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(BaiduReportData::query()->orderBy('date','desc'), function (Grid $grid) {
            $grid->tools([new PullAccountData('拉取百度数据', 'bd')]);
            $grid->scrollbarX();
            $grid->export();
//            $grid->column('id')->sortable();
            $grid->column('date')->display(function ($val) {
                return substr($val , 0 , 10);
            });
            $grid->column('userName');
            $grid->column('campaignName');
            $grid->column('campaignId');
            $grid->column('impression');
            $grid->column('click');
            $grid->column('cost');
            $grid->column('ctr');
            $grid->column('cpc');
            $grid->column('cpm');
            $grid->column('aggrFormSubmitSuccess');
            $grid->column('formSubmitCost');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('userName');
                $filter->like('campaignName');
                $filter->like('campaignId');
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
        return Show::make($id, new BaiduReportData(), function (Show $show) {
            $show->field('id');
            $show->field('date');
            $show->field('userName');
            $show->field('campaignName');
            $show->field('campaignId');
            $show->field('impression');
            $show->field('click');
            $show->field('cost');
            $show->field('ctr');
            $show->field('cpc');
            $show->field('cpm');
            $show->field('aggrFormSubmitSuccess');
            $show->field('formSubmitCost');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new BaiduReportData(), function (Form $form) {
            $form->display('id');
            $form->text('date');
            $form->text('userName');
            $form->text('campaignName');
            $form->text('campaignId');
            $form->text('impression');
            $form->text('click');
            $form->text('cost');
            $form->text('ctr');
            $form->text('cpc');
            $form->text('cpm');
            $form->text('aggrFormSubmitSuccess');
            $form->text('formSubmitCost');
        });
    }
}
