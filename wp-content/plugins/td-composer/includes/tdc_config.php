<?php
/**
 * Created by ra.
 * Date: 3/7/2016
 */


define('TDC_VERSION',   '__td_aurora_deploy_version__'); // this is used in the theme to determine if the plugin is installed
define('TDC_URL',       plugins_url('td-composer'));


class tdc_config {


	static $js_files_for_wp_admin = array (
		'tdcWindowFrame'        => '/assets/js/tdcWindowFrame.js',
		'tdcNotice'             => '/assets/js/tdcNotice.js',
		'tdcShortcodeParser'    => '/assets/js/tdcShortcodeParser.js',
		'tdcInit'               => '/assets/js/wp-admin/tdcInit.js',  //@todo this should load only on edit post in wp-admin
		'tdcDebug'              => '/assets/js/tdcDebug.js',  //inject tdcDebug in the iframe also
	);


	static $js_files_for_wrapper = array (
		'tdcNotice'             => '/assets/js/tdcNotice.js',
		'tdcDebug'              => '/assets/js/tdcDebug.js',
		'tdcUtil'               => '/assets/js/tdcUtil.js',
		'tdcRecycle'            => '/assets/js/tdcRecycle.js',

		'tdcSavePost'           => '/assets/js/tdcSavePost.js',
		'tdcShortcodeParser'    => '/assets/js/tdcShortcodeParser.js',
		'tdcJobManager'         => '/assets/js/tdcJobManager.js',

		'tdcAdminWrapperUI'     => '/assets/js/tdcAdminWrapperUI.js',

		'tdcOperationUI'        => '/assets/js/ui/tdcOperationUI.js',

		'tdcRowUI'              => '/assets/js/ui/tdcRowUI.js',
		'tdcColumnUI'           => '/assets/js/ui/tdcColumnUI.js',
		'tdcInnerRowUI'         => '/assets/js/ui/tdcInnerRowUI.js',
		'tdcInnerColumnUI'      => '/assets/js/ui/tdcInnerColumnUI.js',
		'tdcElementsUI'         => '/assets/js/ui/tdcElementsUI.js',
		'tdcElementUI'          => '/assets/js/ui/tdcElementUI.js',

		'tdcRecycleUI'          => '/assets/js/ui/tdcRecycleUI.js',

		'tdcMaskUI'                 => '/assets/js/ui/mask/tdcMaskUI.js',
		'tdcRowHandlerUI'           => '/assets/js/ui/mask/tdcRowHandlerUI.js',
		'tdcColumnHandlerUI'        => '/assets/js/ui/mask/tdcColumnHandlerUI.js',
		'tdcInnerRowHandlerUI'      => '/assets/js/ui/mask/tdcInnerRowHandlerUI.js',
		'tdcInnerColumnHandlerUI'   => '/assets/js/ui/mask/tdcInnerColumnHandlerUI.js',
		'tdcElementHandlerUI'       => '/assets/js/ui/mask/tdcElementHandlerUI.js',

		'tdcIFrameData'         => '/assets/js/data/tdcIFrameData.js',
		'tdcAdminIFrameUI'      => '/assets/js/tdcAdminIFrameUI.js',

		'tdcMain'               => '/assets/js/tdcMain.js',
		'tdcSidebarPanel'       => '/assets/js/tdcSidebarPanel.js',
		'tdcSidebar'            => '/assets/js/tdcSidebar.js',
		'tdcSidebarController'  => '/assets/js/tdcSidebarController.js',
		'tdcCss'                => '/assets/js/tdcCssEditor.js',

		'tdcColorPicker'        => '/assets/js/tdcColorPicker.js',
		'cssJs'                 => '/assets/js/external/css.js',

		'tdcLoader'             => '/assets/js/tdcLoader.js',

		'tdcLivePanel'          => '/assets/js/tdcLivePanel.js',
		'tdcLivePanelMenuSettings'  => '/assets/js/tdcLivePanelMenuSettings.js',
		'tdcLivePanelPageSettings'  => '/assets/js/tdcLivePanelPageSettings.js',
	);


	static $js_files_for_widget = array (
        'tdcAdminIFrameUI'      => '/assets/js/tdcAdminIFrameUI.js',
        'tdcCss'                => '/assets/js/tdcCssEditor.js',
        'tdcSidebarPanel'       => '/assets/js/tdcSidebarPanel.js',
        'tdcUtil'               => '/assets/js/tdcUtil.js',
        'tdcJobManager'         => '/assets/js/tdcJobManager.js',
    );


	static $js_files_for_iframe = array (
		'tdcComposerBlocksApi'  => '/assets/js/iframe/tdcComposerBlocksApi.js',
		'tdcDebug'              => '/assets/js/tdcDebug.js',  //inject tdcDebug in the iframe also
	);

	static $js_files_for_live_css = array(
		'td_live_css_state'                     => '/css-live/assets/js/tdLiveCssState.js',
		'td_live_css_inject'                    => '/css-live/assets/js/tdLiveCssInject.js',
		'td_live_css_less'                      => '/css-live/assets/external/less.min.js',
	);

	static $js_files_for_extension_live_css = array(
		'td_live_css_main_tdc'                  => '/css-live/assets/js/tdLiveCssMainTdc.js',
	);

	static $js_files_for_plugin_live_css = array(
		'td_live_css_main'                      => '/css-live/assets/js/tdLiveCssMain.js',
	);
}
