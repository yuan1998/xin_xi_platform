<?php

namespace App\Admin\Controllers;

use App\Models\BaiduAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BaiduAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BaiduAccount(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('username');
            $grid->column('access_token');
//            $grid->column('password');
            $grid->column('authType')->using(BaiduAccount::$AuthTypeOptions);
            $grid->column('type')->using(BaiduAccount::$TypeOptions);
//            $grid->column('targets');
            $grid->column('created_at');
//            $grid->column('updated_at')->sortable();

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
        return Show::make($id, new BaiduAccount(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('token');
            $show->field('password');
            $show->field('type');
            $show->field('targets');
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
        return Form::make(new BaiduAccount(), function (Form $form) {
            $form->display('id');
            $form->text('username');
            $form->text('password');
            $form->text('token');
            $form->switch('enable')->default(1);
            $form->radio('type')
                ->when(2, function (Form $form) {
                    $form->tags('targets')->saving(function ($val) {
                        return implode(',', $val);
                    });
                })
                ->options(BaiduAccount::$TypeOptions)
                ->default(0);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
