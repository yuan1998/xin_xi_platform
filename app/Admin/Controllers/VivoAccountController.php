<?php

namespace App\Admin\Controllers;

use App\Models\VivoAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class VivoAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new VivoAccount(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('uuid');
            $grid->column('access_token');
            $grid->column('refresh_token');
            $grid->column('token_date');
            $grid->column('enable');
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
        return Show::make($id, new VivoAccount(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('uuid');
            $show->field('access_token');
            $show->field('refresh_token');
            $show->field('token_date');
            $show->field('enable');
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
        return Form::make(new VivoAccount(), function (Form $form) {
            $form->display('id');
            $form->text('username');
            $form->text('uuid');
            $form->text('access_token');
            $form->text('refresh_token');
            $form->text('token_date');
            $form->text('enable');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
