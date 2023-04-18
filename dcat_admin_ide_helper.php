<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection enable
     * @property Grid\Column|Collection run_date
     * @property Grid\Column|Collection run_status
     * @property Grid\Column|Collection run_status_log
     * @property Grid\Column|Collection targets
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection aggrFormSubmitSuccess
     * @property Grid\Column|Collection campaignId
     * @property Grid\Column|Collection campaignName
     * @property Grid\Column|Collection click
     * @property Grid\Column|Collection cost
     * @property Grid\Column|Collection cpc
     * @property Grid\Column|Collection cpm
     * @property Grid\Column|Collection ctr
     * @property Grid\Column|Collection date
     * @property Grid\Column|Collection formSubmitCost
     * @property Grid\Column|Collection impression
     * @property Grid\Column|Collection userName
     * @property Grid\Column|Collection app_id
     * @property Grid\Column|Collection app_secret
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection advertiser_id
     * @property Grid\Column|Collection advertiser_name
     * @property Grid\Column|Collection advertiser_role
     * @property Grid\Column|Collection comment
     * @property Grid\Column|Collection enable_robot
     * @property Grid\Column|Collection log
     * @property Grid\Column|Collection rebate
     * @property Grid\Column|Collection token_id
     * @property Grid\Column|Collection ad_id
     * @property Grid\Column|Collection ad_name
     * @property Grid\Column|Collection avg_click_cost
     * @property Grid\Column|Collection avg_show_cost
     * @property Grid\Column|Collection campaign_id
     * @property Grid\Column|Collection campaign_name
     * @property Grid\Column|Collection convert
     * @property Grid\Column|Collection convert_cost
     * @property Grid\Column|Collection convert_rate
     * @property Grid\Column|Collection form
     * @property Grid\Column|Collection stat_datetime
     * @property Grid\Column|Collection corporation_name
     * @property Grid\Column|Collection delivery_type
     * @property Grid\Column|Collection effect_first
     * @property Grid\Column|Collection industry_id
     * @property Grid\Column|Collection industry_name
     * @property Grid\Column|Collection primary_industry_id
     * @property Grid\Column|Collection primary_industry_name
     * @property Grid\Column|Collection user_name
     * @property Grid\Column|Collection aclick
     * @property Grid\Column|Collection action_cost
     * @property Grid\Column|Collection action_ratio
     * @property Grid\Column|Collection bclick
     * @property Grid\Column|Collection charge
     * @property Grid\Column|Collection event_add_wechat
     * @property Grid\Column|Collection event_add_wechat_cost
     * @property Grid\Column|Collection event_add_wechat_ratio
     * @property Grid\Column|Collection event_jin_jian_landing_page
     * @property Grid\Column|Collection event_jin_jian_landing_page_cost
     * @property Grid\Column|Collection event_valid_clues
     * @property Grid\Column|Collection event_valid_clues_cost
     * @property Grid\Column|Collection form_action_ratio
     * @property Grid\Column|Collection form_cost
     * @property Grid\Column|Collection form_count
     * @property Grid\Column|Collection impression_1k_cost
     * @property Grid\Column|Collection negative
     * @property Grid\Column|Collection photo_click
     * @property Grid\Column|Collection photo_click_cost
     * @property Grid\Column|Collection photo_click_ratio
     * @property Grid\Column|Collection stat_date
     * @property Grid\Column|Collection submit
     * @property Grid\Column|Collection api_id
     * @property Grid\Column|Collection api_key
     * @property Grid\Column|Collection owner_id
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection access_token
     * @property Grid\Column|Collection account_id
     * @property Grid\Column|Collection refresh_token
     * @property Grid\Column|Collection page_reservation_cost
     * @property Grid\Column|Collection page_reservation_count
     * @property Grid\Column|Collection valid_click_count
     * @property Grid\Column|Collection view_count
     * @property Grid\Column|Collection account_name
     * @property Grid\Column|Collection campaign_type
     * @property Grid\Column|Collection tc
     * @property Grid\Column|Collection tc_cost
     * @property Grid\Column|Collection tc_rate
     * @property Grid\Column|Collection tc_type
     * @property Grid\Column|Collection td
     * @property Grid\Column|Collection td_cost
     * @property Grid\Column|Collection td_rate
     * @property Grid\Column|Collection transfer
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection client_id
     * @property Grid\Column|Collection token_date
     * @property Grid\Column|Collection secret
     * @property Grid\Column|Collection advertiserId
     * @property Grid\Column|Collection buttonClick
     * @property Grid\Column|Collection clickCount
     * @property Grid\Column|Collection formsubmitCount
     * @property Grid\Column|Collection reportDate
     * @property Grid\Column|Collection showCount
     * @property Grid\Column|Collection spent
     *
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection enable(string $label = null)
     * @method Grid\Column|Collection run_date(string $label = null)
     * @method Grid\Column|Collection run_status(string $label = null)
     * @method Grid\Column|Collection run_status_log(string $label = null)
     * @method Grid\Column|Collection targets(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection aggrFormSubmitSuccess(string $label = null)
     * @method Grid\Column|Collection campaignId(string $label = null)
     * @method Grid\Column|Collection campaignName(string $label = null)
     * @method Grid\Column|Collection click(string $label = null)
     * @method Grid\Column|Collection cost(string $label = null)
     * @method Grid\Column|Collection cpc(string $label = null)
     * @method Grid\Column|Collection cpm(string $label = null)
     * @method Grid\Column|Collection ctr(string $label = null)
     * @method Grid\Column|Collection date(string $label = null)
     * @method Grid\Column|Collection formSubmitCost(string $label = null)
     * @method Grid\Column|Collection impression(string $label = null)
     * @method Grid\Column|Collection userName(string $label = null)
     * @method Grid\Column|Collection app_id(string $label = null)
     * @method Grid\Column|Collection app_secret(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection advertiser_id(string $label = null)
     * @method Grid\Column|Collection advertiser_name(string $label = null)
     * @method Grid\Column|Collection advertiser_role(string $label = null)
     * @method Grid\Column|Collection comment(string $label = null)
     * @method Grid\Column|Collection enable_robot(string $label = null)
     * @method Grid\Column|Collection log(string $label = null)
     * @method Grid\Column|Collection rebate(string $label = null)
     * @method Grid\Column|Collection token_id(string $label = null)
     * @method Grid\Column|Collection ad_id(string $label = null)
     * @method Grid\Column|Collection ad_name(string $label = null)
     * @method Grid\Column|Collection avg_click_cost(string $label = null)
     * @method Grid\Column|Collection avg_show_cost(string $label = null)
     * @method Grid\Column|Collection campaign_id(string $label = null)
     * @method Grid\Column|Collection campaign_name(string $label = null)
     * @method Grid\Column|Collection convert(string $label = null)
     * @method Grid\Column|Collection convert_cost(string $label = null)
     * @method Grid\Column|Collection convert_rate(string $label = null)
     * @method Grid\Column|Collection form(string $label = null)
     * @method Grid\Column|Collection stat_datetime(string $label = null)
     * @method Grid\Column|Collection corporation_name(string $label = null)
     * @method Grid\Column|Collection delivery_type(string $label = null)
     * @method Grid\Column|Collection effect_first(string $label = null)
     * @method Grid\Column|Collection industry_id(string $label = null)
     * @method Grid\Column|Collection industry_name(string $label = null)
     * @method Grid\Column|Collection primary_industry_id(string $label = null)
     * @method Grid\Column|Collection primary_industry_name(string $label = null)
     * @method Grid\Column|Collection user_name(string $label = null)
     * @method Grid\Column|Collection aclick(string $label = null)
     * @method Grid\Column|Collection action_cost(string $label = null)
     * @method Grid\Column|Collection action_ratio(string $label = null)
     * @method Grid\Column|Collection bclick(string $label = null)
     * @method Grid\Column|Collection charge(string $label = null)
     * @method Grid\Column|Collection event_add_wechat(string $label = null)
     * @method Grid\Column|Collection event_add_wechat_cost(string $label = null)
     * @method Grid\Column|Collection event_add_wechat_ratio(string $label = null)
     * @method Grid\Column|Collection event_jin_jian_landing_page(string $label = null)
     * @method Grid\Column|Collection event_jin_jian_landing_page_cost(string $label = null)
     * @method Grid\Column|Collection event_valid_clues(string $label = null)
     * @method Grid\Column|Collection event_valid_clues_cost(string $label = null)
     * @method Grid\Column|Collection form_action_ratio(string $label = null)
     * @method Grid\Column|Collection form_cost(string $label = null)
     * @method Grid\Column|Collection form_count(string $label = null)
     * @method Grid\Column|Collection impression_1k_cost(string $label = null)
     * @method Grid\Column|Collection negative(string $label = null)
     * @method Grid\Column|Collection photo_click(string $label = null)
     * @method Grid\Column|Collection photo_click_cost(string $label = null)
     * @method Grid\Column|Collection photo_click_ratio(string $label = null)
     * @method Grid\Column|Collection stat_date(string $label = null)
     * @method Grid\Column|Collection submit(string $label = null)
     * @method Grid\Column|Collection api_id(string $label = null)
     * @method Grid\Column|Collection api_key(string $label = null)
     * @method Grid\Column|Collection owner_id(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection access_token(string $label = null)
     * @method Grid\Column|Collection account_id(string $label = null)
     * @method Grid\Column|Collection refresh_token(string $label = null)
     * @method Grid\Column|Collection page_reservation_cost(string $label = null)
     * @method Grid\Column|Collection page_reservation_count(string $label = null)
     * @method Grid\Column|Collection valid_click_count(string $label = null)
     * @method Grid\Column|Collection view_count(string $label = null)
     * @method Grid\Column|Collection account_name(string $label = null)
     * @method Grid\Column|Collection campaign_type(string $label = null)
     * @method Grid\Column|Collection tc(string $label = null)
     * @method Grid\Column|Collection tc_cost(string $label = null)
     * @method Grid\Column|Collection tc_rate(string $label = null)
     * @method Grid\Column|Collection tc_type(string $label = null)
     * @method Grid\Column|Collection td(string $label = null)
     * @method Grid\Column|Collection td_cost(string $label = null)
     * @method Grid\Column|Collection td_rate(string $label = null)
     * @method Grid\Column|Collection transfer(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection client_id(string $label = null)
     * @method Grid\Column|Collection token_date(string $label = null)
     * @method Grid\Column|Collection secret(string $label = null)
     * @method Grid\Column|Collection advertiserId(string $label = null)
     * @method Grid\Column|Collection buttonClick(string $label = null)
     * @method Grid\Column|Collection clickCount(string $label = null)
     * @method Grid\Column|Collection formsubmitCount(string $label = null)
     * @method Grid\Column|Collection reportDate(string $label = null)
     * @method Grid\Column|Collection showCount(string $label = null)
     * @method Grid\Column|Collection spent(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection version
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection username
     * @property Show\Field|Collection enable
     * @property Show\Field|Collection run_date
     * @property Show\Field|Collection run_status
     * @property Show\Field|Collection run_status_log
     * @property Show\Field|Collection targets
     * @property Show\Field|Collection token
     * @property Show\Field|Collection aggrFormSubmitSuccess
     * @property Show\Field|Collection campaignId
     * @property Show\Field|Collection campaignName
     * @property Show\Field|Collection click
     * @property Show\Field|Collection cost
     * @property Show\Field|Collection cpc
     * @property Show\Field|Collection cpm
     * @property Show\Field|Collection ctr
     * @property Show\Field|Collection date
     * @property Show\Field|Collection formSubmitCost
     * @property Show\Field|Collection impression
     * @property Show\Field|Collection userName
     * @property Show\Field|Collection app_id
     * @property Show\Field|Collection app_secret
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection advertiser_id
     * @property Show\Field|Collection advertiser_name
     * @property Show\Field|Collection advertiser_role
     * @property Show\Field|Collection comment
     * @property Show\Field|Collection enable_robot
     * @property Show\Field|Collection log
     * @property Show\Field|Collection rebate
     * @property Show\Field|Collection token_id
     * @property Show\Field|Collection ad_id
     * @property Show\Field|Collection ad_name
     * @property Show\Field|Collection avg_click_cost
     * @property Show\Field|Collection avg_show_cost
     * @property Show\Field|Collection campaign_id
     * @property Show\Field|Collection campaign_name
     * @property Show\Field|Collection convert
     * @property Show\Field|Collection convert_cost
     * @property Show\Field|Collection convert_rate
     * @property Show\Field|Collection form
     * @property Show\Field|Collection stat_datetime
     * @property Show\Field|Collection corporation_name
     * @property Show\Field|Collection delivery_type
     * @property Show\Field|Collection effect_first
     * @property Show\Field|Collection industry_id
     * @property Show\Field|Collection industry_name
     * @property Show\Field|Collection primary_industry_id
     * @property Show\Field|Collection primary_industry_name
     * @property Show\Field|Collection user_name
     * @property Show\Field|Collection aclick
     * @property Show\Field|Collection action_cost
     * @property Show\Field|Collection action_ratio
     * @property Show\Field|Collection bclick
     * @property Show\Field|Collection charge
     * @property Show\Field|Collection event_add_wechat
     * @property Show\Field|Collection event_add_wechat_cost
     * @property Show\Field|Collection event_add_wechat_ratio
     * @property Show\Field|Collection event_jin_jian_landing_page
     * @property Show\Field|Collection event_jin_jian_landing_page_cost
     * @property Show\Field|Collection event_valid_clues
     * @property Show\Field|Collection event_valid_clues_cost
     * @property Show\Field|Collection form_action_ratio
     * @property Show\Field|Collection form_cost
     * @property Show\Field|Collection form_count
     * @property Show\Field|Collection impression_1k_cost
     * @property Show\Field|Collection negative
     * @property Show\Field|Collection photo_click
     * @property Show\Field|Collection photo_click_cost
     * @property Show\Field|Collection photo_click_ratio
     * @property Show\Field|Collection stat_date
     * @property Show\Field|Collection submit
     * @property Show\Field|Collection api_id
     * @property Show\Field|Collection api_key
     * @property Show\Field|Collection owner_id
     * @property Show\Field|Collection email
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection access_token
     * @property Show\Field|Collection account_id
     * @property Show\Field|Collection refresh_token
     * @property Show\Field|Collection page_reservation_cost
     * @property Show\Field|Collection page_reservation_count
     * @property Show\Field|Collection valid_click_count
     * @property Show\Field|Collection view_count
     * @property Show\Field|Collection account_name
     * @property Show\Field|Collection campaign_type
     * @property Show\Field|Collection tc
     * @property Show\Field|Collection tc_cost
     * @property Show\Field|Collection tc_rate
     * @property Show\Field|Collection tc_type
     * @property Show\Field|Collection td
     * @property Show\Field|Collection td_cost
     * @property Show\Field|Collection td_rate
     * @property Show\Field|Collection transfer
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection client_id
     * @property Show\Field|Collection token_date
     * @property Show\Field|Collection secret
     * @property Show\Field|Collection advertiserId
     * @property Show\Field|Collection buttonClick
     * @property Show\Field|Collection clickCount
     * @property Show\Field|Collection formsubmitCount
     * @property Show\Field|Collection reportDate
     * @property Show\Field|Collection showCount
     * @property Show\Field|Collection spent
     *
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection enable(string $label = null)
     * @method Show\Field|Collection run_date(string $label = null)
     * @method Show\Field|Collection run_status(string $label = null)
     * @method Show\Field|Collection run_status_log(string $label = null)
     * @method Show\Field|Collection targets(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection aggrFormSubmitSuccess(string $label = null)
     * @method Show\Field|Collection campaignId(string $label = null)
     * @method Show\Field|Collection campaignName(string $label = null)
     * @method Show\Field|Collection click(string $label = null)
     * @method Show\Field|Collection cost(string $label = null)
     * @method Show\Field|Collection cpc(string $label = null)
     * @method Show\Field|Collection cpm(string $label = null)
     * @method Show\Field|Collection ctr(string $label = null)
     * @method Show\Field|Collection date(string $label = null)
     * @method Show\Field|Collection formSubmitCost(string $label = null)
     * @method Show\Field|Collection impression(string $label = null)
     * @method Show\Field|Collection userName(string $label = null)
     * @method Show\Field|Collection app_id(string $label = null)
     * @method Show\Field|Collection app_secret(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection advertiser_id(string $label = null)
     * @method Show\Field|Collection advertiser_name(string $label = null)
     * @method Show\Field|Collection advertiser_role(string $label = null)
     * @method Show\Field|Collection comment(string $label = null)
     * @method Show\Field|Collection enable_robot(string $label = null)
     * @method Show\Field|Collection log(string $label = null)
     * @method Show\Field|Collection rebate(string $label = null)
     * @method Show\Field|Collection token_id(string $label = null)
     * @method Show\Field|Collection ad_id(string $label = null)
     * @method Show\Field|Collection ad_name(string $label = null)
     * @method Show\Field|Collection avg_click_cost(string $label = null)
     * @method Show\Field|Collection avg_show_cost(string $label = null)
     * @method Show\Field|Collection campaign_id(string $label = null)
     * @method Show\Field|Collection campaign_name(string $label = null)
     * @method Show\Field|Collection convert(string $label = null)
     * @method Show\Field|Collection convert_cost(string $label = null)
     * @method Show\Field|Collection convert_rate(string $label = null)
     * @method Show\Field|Collection form(string $label = null)
     * @method Show\Field|Collection stat_datetime(string $label = null)
     * @method Show\Field|Collection corporation_name(string $label = null)
     * @method Show\Field|Collection delivery_type(string $label = null)
     * @method Show\Field|Collection effect_first(string $label = null)
     * @method Show\Field|Collection industry_id(string $label = null)
     * @method Show\Field|Collection industry_name(string $label = null)
     * @method Show\Field|Collection primary_industry_id(string $label = null)
     * @method Show\Field|Collection primary_industry_name(string $label = null)
     * @method Show\Field|Collection user_name(string $label = null)
     * @method Show\Field|Collection aclick(string $label = null)
     * @method Show\Field|Collection action_cost(string $label = null)
     * @method Show\Field|Collection action_ratio(string $label = null)
     * @method Show\Field|Collection bclick(string $label = null)
     * @method Show\Field|Collection charge(string $label = null)
     * @method Show\Field|Collection event_add_wechat(string $label = null)
     * @method Show\Field|Collection event_add_wechat_cost(string $label = null)
     * @method Show\Field|Collection event_add_wechat_ratio(string $label = null)
     * @method Show\Field|Collection event_jin_jian_landing_page(string $label = null)
     * @method Show\Field|Collection event_jin_jian_landing_page_cost(string $label = null)
     * @method Show\Field|Collection event_valid_clues(string $label = null)
     * @method Show\Field|Collection event_valid_clues_cost(string $label = null)
     * @method Show\Field|Collection form_action_ratio(string $label = null)
     * @method Show\Field|Collection form_cost(string $label = null)
     * @method Show\Field|Collection form_count(string $label = null)
     * @method Show\Field|Collection impression_1k_cost(string $label = null)
     * @method Show\Field|Collection negative(string $label = null)
     * @method Show\Field|Collection photo_click(string $label = null)
     * @method Show\Field|Collection photo_click_cost(string $label = null)
     * @method Show\Field|Collection photo_click_ratio(string $label = null)
     * @method Show\Field|Collection stat_date(string $label = null)
     * @method Show\Field|Collection submit(string $label = null)
     * @method Show\Field|Collection api_id(string $label = null)
     * @method Show\Field|Collection api_key(string $label = null)
     * @method Show\Field|Collection owner_id(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection access_token(string $label = null)
     * @method Show\Field|Collection account_id(string $label = null)
     * @method Show\Field|Collection refresh_token(string $label = null)
     * @method Show\Field|Collection page_reservation_cost(string $label = null)
     * @method Show\Field|Collection page_reservation_count(string $label = null)
     * @method Show\Field|Collection valid_click_count(string $label = null)
     * @method Show\Field|Collection view_count(string $label = null)
     * @method Show\Field|Collection account_name(string $label = null)
     * @method Show\Field|Collection campaign_type(string $label = null)
     * @method Show\Field|Collection tc(string $label = null)
     * @method Show\Field|Collection tc_cost(string $label = null)
     * @method Show\Field|Collection tc_rate(string $label = null)
     * @method Show\Field|Collection tc_type(string $label = null)
     * @method Show\Field|Collection td(string $label = null)
     * @method Show\Field|Collection td_cost(string $label = null)
     * @method Show\Field|Collection td_rate(string $label = null)
     * @method Show\Field|Collection transfer(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection client_id(string $label = null)
     * @method Show\Field|Collection token_date(string $label = null)
     * @method Show\Field|Collection secret(string $label = null)
     * @method Show\Field|Collection advertiserId(string $label = null)
     * @method Show\Field|Collection buttonClick(string $label = null)
     * @method Show\Field|Collection clickCount(string $label = null)
     * @method Show\Field|Collection formsubmitCount(string $label = null)
     * @method Show\Field|Collection reportDate(string $label = null)
     * @method Show\Field|Collection showCount(string $label = null)
     * @method Show\Field|Collection spent(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     * @method $this newCopyable(...$params)
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
