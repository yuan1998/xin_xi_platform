<?php

namespace App\Admin\Controllers;

use App\Models\VivoApp;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class VivoAppController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new VivoApp(), function (Grid $grid) {
            $grid->column('id')->display(function () {
                return \Inertia\Inertia::render('VivoAuth', [
                    'app' => [
                        'client_id' => $this->client_id,
                        'id' => $this->id,
                    ],
                    'redirectUri' => route('oauth.vivo')
                ])
                    ->rootView('admin.app')
                    ->toResponse(request())
                    ->content();
            });
            $grid->column('name');
            $grid->column('client_id');
            $grid->column('secret');
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
        return Show::make($id, new VivoApp(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('client_id');
            $show->field('secret');
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
        return Form::make(new VivoApp(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('client_id');
            $form->text('secret');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
