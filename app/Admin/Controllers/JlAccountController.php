<?php

namespace App\Admin\Controllers;

use App\Models\JlAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class JlAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new JlAccount(), function (Grid $grid) {
            $grid->scrollbarX();
            $grid->column('id')->sortable();
            $grid->column('advertiser_id');
            $grid->column('advertiser_name');
            $grid->column('run_date');
            $grid->column('run_status_log');
            $grid->column('rebate');
            $grid->column('comment');
            $grid->column('log');
            $grid->column('app_id');
            $grid->column('token_id');
            $grid->column('advertiser_role');
            $grid->column('enable');
            $grid->column('enable_robot');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

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
        return Show::make($id, new JlAccount(), function (Show $show) {
            $show->field('id');
            $show->field('advertiser_id');
            $show->field('advertiser_name');
            $show->field('rebate');
            $show->field('comment');
            $show->field('log');
            $show->field('app_id');
            $show->field('token_id');
            $show->field('advertiser_role');
            $show->field('enable');
            $show->field('enable_robot');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new JlAccount(), function (Form $form) {
            $form->display('id');
            $form->text('advertiser_id');
            $form->text('advertiser_name');
            $form->text('rebate');
            $form->text('comment');
            $form->text('log');
            $form->text('app_id');
            $form->text('token_id');
            $form->text('advertiser_role');
            $form->text('enable');
            $form->text('enable_robot');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
