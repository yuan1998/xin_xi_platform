<?php

namespace App\Admin\Controllers;

use App\Admin\Grid\Tools\PullAccountData;
use App\Models\VivoReportData;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class VivoReportDatumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(VivoReportData::query()->orderBy('reportDate', 'desc'), function (Grid $grid) {
            $grid->tools([new PullAccountData('拉取Vivo数据', 'vivo')]);
            $grid->scrollbarX();
            $grid->export();

            $grid->column('reportDate')->display(function ($val) {
                return substr($val, 0, 10);
            });
            $grid->column('advertiserId');
            $grid->column('showCount');
            $grid->column('clickCount');
            $grid->column('spent');
            $grid->column('formsubmitCount');
            $grid->column('buttonClick');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('advertiserId');
                $filter->between('reportDate')
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
        return Show::make($id, new VivoReportData(), function (Show $show) {
            $show->field('id');
            $show->field('showCount');
            $show->field('reportDate');
            $show->field('formsubmitCount');
            $show->field('clickCount');
            $show->field('buttonClick');
            $show->field('spent');
            $show->field('advertiserId');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new VivoReportData(), function (Form $form) {
            $form->display('id');
            $form->text('showCount');
            $form->text('reportDate');
            $form->text('formsubmitCount');
            $form->text('clickCount');
            $form->text('buttonClick');
            $form->text('spent');
            $form->text('advertiserId');
        });
    }
}
