<?php

namespace App\Admin\Controllers;

use App\Models\JlApp;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class JlAppController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new JlApp(), function (Grid $grid) {

            $grid->column('name');
            $grid->column('app_id');
            $grid->column('app_secret');
            $grid->column('id')->display(function () {
                $dataJson = json_encode([
                    'app_id' => $this->app_id
                ]);
                $dataJson =  urlencode($dataJson);
                $baseUrl= env('APP_URL');
                $redirectUri = "{$baseUrl}/api/auth/jl";
                $url = "https://ad.oceanengine.com/openapi/audit/oauth.html?app_id={$this->app_id}&redirect_uri={$redirectUri}&state={$dataJson}";

                return $url;
            });
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
        return Show::make($id, new JlApp(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('app_id');
            $show->field('app_secret');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new JlApp(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('app_id');
            $form->text('app_secret');
        });
    }
}
