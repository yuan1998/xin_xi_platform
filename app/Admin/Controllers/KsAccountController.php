<?php

namespace App\Admin\Controllers;

use App\Models\KsAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class KsAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new KsAccount(), function (Grid $grid) {
            $grid->disableEditButton();
            $grid->disableViewButton();
            $grid->column('id')->sortable();
            $grid->column('comment')->editable();
            $grid->column('enable')->switch();
            $grid->column('run_date');
            $grid->column('run_status_log');
            $grid->column('advertiser_id');
            $grid->column('user_id');
            $grid->column('corporation_name');
            $grid->column('user_name');
            $grid->column('industry_id');
            $grid->column('industry_name');
            $grid->column('primary_industry_id');
            $grid->column('primary_industry_name');
            $grid->column('delivery_type');
            $grid->column('effect_first');

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
        return Show::make($id, new KsAccount(), function (Show $show) {
            $show->field('id');
            $show->field('enable');
            $show->field('app_id');
            $show->field('comment');
            $show->field('token_key');
            $show->field('advertiser_id');
            $show->field('user_id');
            $show->field('corporation_name');
            $show->field('user_name');
            $show->field('industry_id');
            $show->field('industry_name');
            $show->field('primary_industry_id');
            $show->field('primary_industry_name');
            $show->field('delivery_type');
            $show->field('effect_first');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new KsAccount(), function (Form $form) {
            $form->display('id');
            $form->text('enable');
            $form->text('app_id');
            $form->text('comment');
            $form->text('token_key');
            $form->text('advertiser_id');
            $form->text('user_id');
            $form->text('corporation_name');
            $form->text('user_name');
            $form->text('industry_id');
            $form->text('industry_name');
            $form->text('primary_industry_id');
            $form->text('primary_industry_name');
            $form->text('delivery_type');
            $form->text('effect_first');
        });
    }
}
