<?php

namespace App\Admin\Controllers;

use App\Models\UcAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UcAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UcAccount(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('password');
            $grid->column('token');
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
        return Show::make($id, new UcAccount(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('password');
            $show->field('token');
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
        return Form::make(new UcAccount(), function (Form $form) {
            $form->display('id');
            $form->text('username');
            $form->text('password');
            $form->text('token');
            $form->switch('enable')->default(1);


            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
