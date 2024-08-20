/**
 * Install Plugins.
 *
 * @author  ClimaxThemes
 * @package	Kata
 * @since	1.0.0
 */
'use strict';
jQuery(document).ready(function ($) {
	$('.kt-install-plugins').on('click', function (e) {
		e.preventDefault();

		$('.kt-spiner').addClass('is-active').css('float', 'none');

		$.ajax({
			url: kataInstallPlugins.ajax_url,
			type: 'POST',
			data: {
				action: 'install_activate_plugins',
				security: kataInstallPlugins.nonce,
			},
			success: function (response) {
				console.log(response);
				if (response.success) {
					alert(response.data);
				} else {
					alert('Error: ' + response.data);
				}
				$('.kt-spiner').removeClass('is-active').css('float', 'right');
				window.location.reload();
			},
			error: function (xhr, status, error) {
				alert('AJAX error: ' + error);
				$('.kt-spiner').removeClass('is-active').css('float', 'right');
				window.location.reload();
			},
		});
	});
});
