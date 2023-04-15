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
            $grid->column('id','操作')->display(function () {
                $dataJson = json_encode([
                    'app_id' => $this->app_id
                ]);
                $dataJson = urlencode($dataJson);
                $redirectUri = route('oauth.jl');
                if ($this->version === 3)
                    $url = "https://open.oceanengine.com/audit/oauth.html?app_id={$this->app_id}&state={$dataJson}&material_auth=1&redirect_uri={$redirectUri}";
                else {
                    $url = "https://ad.oceanengine.com/openapi/audit/oauth.html?app_id={$this->app_id}&redirect_uri={$redirectUri}&state={$dataJson}";
                }

                return $url;
            })->newCopyable("复制授权链接");
            $grid->column('name');
            $grid->column('version', '版本')->using(JlApp::$VersionOptions);
            $grid->column('app_id');
            $grid->column('app_secret');

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
            $form->select('version', '版本')
                ->options(JlApp::$VersionOptions)
                ->default(2);
            $form->text('name');
            $form->text('app_id');
            $form->text('app_secret');
        });
    }
}
