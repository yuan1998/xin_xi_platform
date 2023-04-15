<?php

namespace App\Admin\Controllers;

use App\Models\KsApp;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class KsAppController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new KsApp(), function (Grid $grid) {

            $grid->column('name');
            $grid->column('app_id');
            $grid->column('app_secret');
            $grid->column('id')->display(function () {
                $dataJson = json_encode([
                    'app_id' => $this->app_id
                ]);
                $dataJson =  urlencode($dataJson);
                $redirectUri = route('oauth.ks');
                $url = "https://developers.e.kuaishou.com/tools/authorize?app_id={$this->app_id}&scope=%5B%22ad_query%22%2C%22ad_manage%22%2C%22report_service%22%2C%22public_dmp_service%22%2C%22public_agent_service%22%2C%22public_account_service%22%5D&redirect_uri={$redirectUri}&state={$dataJson}&oauth_type=advertiser";
                return $url;
            })->copyable();
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
        return Show::make($id, new KsApp(), function (Show $show) {
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
        return Form::make(new KsApp(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('app_id');
            $form->text('app_secret');
        });
    }
}
