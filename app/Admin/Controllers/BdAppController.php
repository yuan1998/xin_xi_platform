<?php

namespace App\Admin\Controllers;

use App\Models\BdApp;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BdAppController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new BdApp(), function (Grid $grid) {
            $grid->column('id', '操作')->display(function () {
                $platformId = '4960345965958561794';
                $redirectUri = route('oauth.bd');
                // https://u.baidu.com/oauth/page/index?platformId=4960345965958561794&appId=17b6be72a9fe5b397aaeb65bc7bfc52b&scope=71,72,1009335&state=449d9e3909d0180a18ba292a4b3dd67f&callback=http://juliang.xahmyk.cn/api/auth/bd
                return "https://u.baidu.com/oauth/page/index?platformId={$platformId}&appId={$this->app_id}&state=449d9e3909d0180a18ba292a4b3dd67f&callback={$redirectUri}";
            })->newCopyable("复制授权链接");
            $grid->column('name');
            $grid->column('app_id');
//            $grid->column('app_secret');
//            $grid->column('version');
//            $grid->column('created_at');
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
        return Show::make($id, new BdApp(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('app_id');
            $show->field('app_secret');
            $show->field('version');
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
        return Form::make(new BdApp(), function (Form $form) {
            $form->display('id');
            $form->select('version')->options(BdApp::$VersionOptions)->default(1);
            $form->text('name')->required();
            $form->text('app_id')->required();
            $form->text('app_secret')->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
