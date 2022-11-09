<?php

namespace App\Admin\Controllers;

use App\Admin\Grid\Tools\PullAccountData;
use App\Models\KsReportDatum;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class KsReportDatumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make( KsReportDatum::query()->orderBy('stat_date','desc'), function (Grid $grid) {
            $grid->tools([new PullAccountData('拉取快手数据','ks')]);

            $grid->scrollbarX();

            $grid->column('advertiser_id');
            $grid->column('stat_date')->display(function ($val) {
                return substr($val,0,10);
            });
            $grid->column('charge');
            $grid->column('show');
            $grid->column('photo_click');
            $grid->column('aclick');
            $grid->column('bclick');
            $grid->column('photo_click_ratio');
            $grid->column('action_ratio');
            $grid->column('impression_1k_cost');
            $grid->column('photo_click_cost');
            $grid->column('action_cost');
            $grid->column('negative');
            $grid->column('submit');
            $grid->column('form_count');
            $grid->column('form_cost');
            $grid->column('form_action_ratio');
            $grid->column('event_jin_jian_landing_page');
            $grid->column('event_jin_jian_landing_page_cost');
            $grid->column('event_valid_clues');
            $grid->column('event_valid_clues_cost');
            $grid->column('event_add_wechat');
            $grid->column('event_add_wechat_cost');
            $grid->column('event_add_wechat_ratio');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('advertiser_id');
                $filter->between('stat_date')
                    ->date();
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
        return Show::make($id, new KsReportDatum(), function (Show $show) {
            $show->field('id');
            $show->field('advertiser_id');
            $show->field('stat_date');
            $show->field('charge');
            $show->field('show');
            $show->field('photo_click');
            $show->field('aclick');
            $show->field('bclick');
            $show->field('photo_click_ratio');
            $show->field('action_ratio');
            $show->field('impression_1k_cost');
            $show->field('photo_click_cost');
            $show->field('action_cost');
            $show->field('negative');
            $show->field('submit');
            $show->field('form_count');
            $show->field('form_cost');
            $show->field('form_action_ratio');
            $show->field('event_jin_jian_landing_page');
            $show->field('event_jin_jian_landing_page_cost');
            $show->field('event_valid_clues');
            $show->field('event_valid_clues_cost');
            $show->field('event_add_wechat');
            $show->field('event_add_wechat_cost');
            $show->field('event_add_wechat_ratio');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new KsReportDatum(), function (Form $form) {
            $form->display('id');
            $form->text('advertiser_id');
            $form->text('stat_date');
            $form->text('charge');
            $form->text('show');
            $form->text('photo_click');
            $form->text('aclick');
            $form->text('bclick');
            $form->text('photo_click_ratio');
            $form->text('action_ratio');
            $form->text('impression_1k_cost');
            $form->text('photo_click_cost');
            $form->text('action_cost');
            $form->text('negative');
            $form->text('submit');
            $form->text('form_count');
            $form->text('form_cost');
            $form->text('form_action_ratio');
            $form->text('event_jin_jian_landing_page');
            $form->text('event_jin_jian_landing_page_cost');
            $form->text('event_valid_clues');
            $form->text('event_valid_clues_cost');
            $form->text('event_add_wechat');
            $form->text('event_add_wechat_cost');
            $form->text('event_add_wechat_ratio');
        });
    }
}
