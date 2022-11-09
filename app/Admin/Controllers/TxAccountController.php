<?php

namespace App\Admin\Controllers;

use App\Models\TxAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TxAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new TxAccount(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('account_id');
            $grid->column('access_token');
            $grid->column('refresh_token');
            $grid->column('enable');
        
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
        return Show::make($id, new TxAccount(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('account_id');
            $show->field('access_token');
            $show->field('refresh_token');
            $show->field('enable');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new TxAccount(), function (Form $form) {
            $form->display('id');
            $form->text('username');
            $form->text('account_id');
            $form->text('access_token');
            $form->text('refresh_token');
            $form->text('enable');
        });
    }
}
