<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use ShopPress\Modules\Wishlist\Main as Wishlist;


$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$user_id 				= get_current_user_id();
$downloadable_products 	= is_admin() ? array() : WC()->customer->get_downloadable_products();

?>
<div class="welcome-message">
	<div class="wlc-left">
		<img alt="" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiI+DQogIDxkZWZzPg0KICAgIDxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoIj4NCiAgICAgIDxyZWN0IGlkPSJSZWN0YW5nbGVfMjEwMiIgZGF0YS1uYW1lPSJSZWN0YW5nbGUgMjEwMiIgd2lkdGg9IjE2LjIwOSIgaGVpZ2h0PSIxOCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC45OTYgNjYpIiBmaWxsPSIjNzM3ZDhiIi8+DQogICAgPC9jbGlwUGF0aD4NCiAgPC9kZWZzPg0KICA8ZyBpZD0iaWNvbiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoOC4wMDQpIj4NCiAgICA8Y2lyY2xlIGlkPSJFbGxpcHNlXzgxNDQiIGRhdGEtbmFtZT0iRWxsaXBzZSA4MTQ0IiBjeD0iMTYiIGN5PSIxNiIgcj0iMTYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC04LjAwNCkiIGZpbGw9IiNmN2Y4ZjkiLz4NCiAgICA8ZyBpZD0iTWFza19Hcm91cF8xMjgiIGRhdGEtbmFtZT0iTWFzayBHcm91cCAxMjgiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xIC01OSkiIGNsaXAtcGF0aD0idXJsKCNjbGlwLXBhdGgpIj4NCiAgICAgIDxnIGlkPSJHcm91cF82NTU0OCIgZGF0YS1uYW1lPSJHcm91cCA2NTU0OCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMS4xNzEgNjYuMTc1KSI+DQogICAgICAgIDxwYXRoIGlkPSJQYXRoXzEzMzI5IiBkYXRhLW5hbWU9IlBhdGggMTMzMjkiIGQ9Ik0zOTcuMDkxLDE1Mi40YS41ODQuNTg0LDAsMCwwLC43NzctLjI3OGwzLjA3MS02LjQ4NWEuNTg0LjU4NCwwLDEsMC0xLjA1NS0uNWwtMy4wNzEsNi40ODVBLjU4NC41ODQsMCwwLDAsMzk3LjA5MSwxNTIuNFoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0zODcuMTA0IC0xNDIuMDgpIiBmaWxsPSIjNzM3ZDhiIi8+DQogICAgICAgIDxwYXRoIGlkPSJQYXRoXzEzMzMwIiBkYXRhLW5hbWU9IlBhdGggMTMzMzAiIGQ9Ik0zMzUuMyw5NC4xNzJhLjU4NC41ODQsMCwwLDAsLjc3Ny0uMjc4bDMuNy03LjgwOWEuNTg0LjU4NCwwLDEsMC0xLjA1NS0uNWwtMy43LDcuODA5QS41ODMuNTgzLDAsMCwwLDMzNS4zLDk0LjE3MloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0zMjguMDExIC04NS4xMzIpIiBmaWxsPSIjNzM3ZDhiIi8+DQogICAgICAgIDxwYXRoIGlkPSJQYXRoXzEzMzMxIiBkYXRhLW5hbWU9IlBhdGggMTMzMzEiIGQ9Ik0xODYuODQxLDk2LjAxM2E1LjE4MSw1LjE4MSwwLDAsMS05LjM2NC00LjQzNGwyLjE3Ni00LjU5NWEyLjMxMywyLjMxMywwLDAsMSwuNiwyLjc1OGwtLjk0MSwxLjk4OGEuNTg0LjU4NCwwLDAsMCwuMjc4Ljc3NywzLjE3LDMuMTcsMCwwLDEsMi4wNzIsMi42MTQuNTgzLjU4MywwLDEsMCwxLjE2NS0uMDU4LDQuMSw0LjEsMCwwLDAtMi4yMjEtMy4zMzhsMy45NzMtOC4zODlhLjU4NC41ODQsMCwwLDAtMS4wNTUtLjVMMTgxLjM2NCw4Ny40YTMuNDU3LDMuNDU3LDAsMCwwLTEuNzA4LTEuNzg4LjU4NC41ODQsMCwwLDAtLjc3Ny4yNzhsLTIuNDU4LDUuMTlBNi4zNDgsNi4zNDgsMCwxLDAsMTg3LjksOTYuNTEzbDMuNzEyLTcuODRhLjU4NC41ODQsMCwwLDAtMS4wNTUtLjVaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTc1LjgxMSAtODIuNTAyKSIgZmlsbD0iIzczN2Q4YiIvPg0KICAgICAgPC9nPg0KICAgIDwvZz4NCiAgPC9nPg0KPC9zdmc+DQo=" />
		<?php
			echo "<span class='wlc-text'>" . __( 'Hello', 'kata' ) . '&nbsp;' . esc_html( $current_user->display_name ) . '</span>';
		?>
	</div>
	<div class="wlc-right">
		<?php
			echo "<span class='wlc-text'>" . __( 'Not', 'kata' ) . '&nbsp;' . esc_html( $current_user->display_name ) . "&quest;</span> <a href='" . esc_url( wc_logout_url() ) . "' class='button'>" . __( 'Logout', 'kata' ) . '</a>';
		?>
	</div>
</div>

<div class="dashboard-widgets">
	<div class="dashboard-widget orders-widget">
		<span class="widget-name">
			<?php echo __( 'Orders', 'kata' ); ?>
		</span>
		<span class="widget-icon">
			<img alt="" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDMyIDMyIj4NCiAgPGcgaWQ9Ikdyb3VwXzY1NTUwIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NTUwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtNjQxIC04NTIpIj4NCiAgICA8Y2lyY2xlIGlkPSJFbGxpcHNlXzgxNTAiIGRhdGEtbmFtZT0iRWxsaXBzZSA4MTUwIiBjeD0iMTYiIGN5PSIxNiIgcj0iMTYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDY0MSA4NTIpIiBmaWxsPSIjZmZmNWU0Ii8+DQogICAgPGcgaWQ9Ikljb25fU21hbGxfTG9jayIgZGF0YS1uYW1lPSJJY29uIC8gU21hbGwgLyBMb2NrIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2NDkgODU5KSI+DQogICAgICA8cGF0aCBpZD0iSWNvbnNfU21hbGxfT3JkZXIiIGRhdGEtbmFtZT0iSWNvbnMgLyBTbWFsbCAvIE9yZGVyIiBkPSJNMTQsMThIMmEyLDIsMCwwLDEtMi0yVjJBMiwyLDAsMCwxLDIsMEgxNGEyLDIsMCwwLDEsMiwyVjE2QTIsMiwwLDAsMSwxNCwxOFpNMywxLjVBMS40OTMsMS40OTMsMCwwLDAsMS41MDcsMi44NTZMMS41LDNWMTVhMS40OTMsMS40OTMsMCwwLDAsMS4zNTUsMS40OTNMMywxNi41SDEzYTEuNDkyLDEuNDkyLDAsMCwwLDEuNDkzLTEuMzU1TDE0LjUsMTVWM2ExLjQ5MywxLjQ5MywwLDAsMC0xLjM1NS0xLjQ5M0wxMywxLjVabTQuMjUxLDExSDMuNzVhLjc1Ljc1LDAsMSwxLDAtMS41aDMuNWEuNzUuNzUsMCwwLDEsMCwxLjVabTUtM0gzLjc1YS43NS43NSwwLDEsMSwwLTEuNWg4LjVhLjc1Ljc1LDAsMCwxLDAsMS41Wm0wLTNIMy43NWEuNzUuNzUsMCwxLDEsMC0xLjVoOC41YS43NS43NSwwLDAsMSwwLDEuNVoiIGZpbGw9IiNmM2IwNTciLz4NCiAgICA8L2c+DQogIDwvZz4NCjwvc3ZnPg0K" />
		</span>
		<span class="widget-number">
			<?php echo wp_kses_post( wc_get_customer_order_count( $user_id ) ); ?>
		</span>
		<span class="widget-link">
			<a href="./orders"><?php echo __( 'See All', 'kata' ); ?></a>
			<svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10">
				<path d="M92.034,76.719l-.657.675,3.832,3.857H84v.937H95.208l-3.832,3.857.657.675,4.967-5Z" transform="translate(-84.001 -76.719)"/>
			</svg>
		</span>
	</div>
	<div class="dashboard-widget wishlist-widget">
		<span class="widget-name">
			<?php echo __( 'Wishlist Items', 'kata' ); ?>
		</span>
		<span class="widget-icon">
			<img alt="" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDMyIDMyIj4NCiAgPGcgaWQ9Ikdyb3VwXzY1NTUwIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NTUwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtNjQxIC04NTIpIj4NCiAgICA8Y2lyY2xlIGlkPSJFbGxpcHNlXzgxNTAiIGRhdGEtbmFtZT0iRWxsaXBzZSA4MTUwIiBjeD0iMTYiIGN5PSIxNiIgcj0iMTYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDY0MSA4NTIpIiBmaWxsPSIjZmZlZWYyIi8+DQogICAgPHBhdGggaWQ9Indpc2hsaXN0IiBkPSJNNTMuMjUsMjgyLjAzYTQuOTc1LDQuOTc1LDAsMCwxLDUuMTUtNC43OCw1LjI1OSw1LjI1OSwwLDAsMSwzLjYsMS41NDIsNS4yNTksNS4yNTksMCwwLDEsMy42LTEuNTQyLDQuOTc1LDQuOTc1LDAsMCwxLDUuMTUsNC43OCw3LjgwNyw3LjgwNywwLDAsMS0xLjg4Miw0Ljg1MiwxOC4yMzQsMTguMjM0LDAsMCwxLTMuODg1LDMuNDg0LDEzLjcyNCwxMy43MjQsMCwwLDEtMS41MzMuOTQxLDIuNiwyLjYsMCwwLDEtMi45LDAsMTMuNzI0LDEzLjcyNCwwLDAsMS0xLjUzMy0uOTQxLDE4LjIzNiwxOC4yMzYsMCwwLDEtMy44ODUtMy40ODRBNy44MDcsNy44MDcsMCwwLDEsNTMuMjUsMjgyLjAzWm01LjE1LTMuMjhhMy40NzksMy40NzksMCwwLDAtMy42NSwzLjI4LDYuMzE4LDYuMzE4LDAsMCwwLDEuNTU2LDMuOTE4LDE2LjcyNiwxNi43MjYsMCwwLDAsMy41NjUsMy4xODUsMTIuMzEyLDEyLjMxMiwwLDAsMCwxLjM2LjgzOCwyLjE2OCwyLjE2OCwwLDAsMCwuNzcuMjc5LDIuMTY4LDIuMTY4LDAsMCwwLC43Ny0uMjc5LDEyLjMxMywxMi4zMTMsMCwwLDAsMS4zNi0uODM4LDE2LjcyNiwxNi43MjYsMCwwLDAsMy41NjUtMy4xODUsNi4zMTgsNi4zMTgsMCwwLDAsMS41NTYtMy45MTgsMy40NzksMy40NzksMCwwLDAtMy42NS0zLjI4LDMuOTUxLDMuOTUxLDAsMCwwLTMuMDA1LDEuNjE5Ljc1Ljc1LDAsMCwxLTEuMTg5LDBBMy45NTEsMy45NTEsMCwwLDAsNTguNCwyNzguNzVaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1OTQuNzUgNTg0LjUpIiBmaWxsPSIjZjM3ZjliIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz4NCiAgPC9nPg0KPC9zdmc+DQo=" />
		</span>
		<span class="widget-number">
			<?php echo wp_kses_post( Wishlist::get_total_wishlist_products() ); ?>
		</span>
		<span class="widget-link">
			<a href="./my-wishlist"><?php echo __( 'See All', 'kata' ); ?></a>
			<svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10">
				<path d="M92.034,76.719l-.657.675,3.832,3.857H84v.937H95.208l-3.832,3.857.657.675,4.967-5Z" transform="translate(-84.001 -76.719)"/>
			</svg>
		</span>
	</div>
	<div class="dashboard-widget downloads-widget">
		<span class="widget-name">
			<?php echo __( 'Downloads', 'kata' ); ?>
		</span>
		<span class="widget-icon">
			<img alt="" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDMyIDMyIj4NCiAgPGcgaWQ9Ikdyb3VwXzY1NTUwIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NTUwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtNjQxIC04NTIpIj4NCiAgICA8Y2lyY2xlIGlkPSJFbGxpcHNlXzgxNTAiIGRhdGEtbmFtZT0iRWxsaXBzZSA4MTUwIiBjeD0iMTYiIGN5PSIxNiIgcj0iMTYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDY0MSA4NTIpIiBmaWxsPSIjZWFmYmYwIi8+DQogICAgPHBhdGggaWQ9Ikljb25zX1NtYWxsX0Rvd25sb2FkIiBkYXRhLW5hbWU9Ikljb25zIC8gU21hbGwgLyBEb3dubG9hZCIgZD0iTTE0LDE4SDJhMiwyLDAsMCwxLTItMlYyQTIsMiwwLDAsMSwyLDBIMTRhMiwyLDAsMCwxLDIsMlYxNkEyLDIsMCwwLDEsMTQsMThaTTIuNSwxLjVhMSwxLDAsMCwwLS45OTQuODgzTDEuNSwyLjV2MTNhMSwxLDAsMCwwLC44ODMuOTk0TDIuNSwxNi41aDExYTEsMSwwLDAsMCwuOTk0LS44ODNMMTQuNSwxNS41VjIuNWExLDEsMCwwLDAtLjg4My0uOTk0TDEzLjUsMS41Wm04Ljc1MSwxMmgtNi41YS43NS43NSwwLDEsMSwwLTEuNWg2LjVhLjc1Ljc1LDAsMSwxLDAsMS41Wk04LjAwNSwxMS4wMTVhLjc1My43NTMsMCwwLDEtLjYxNi0uMzIyTDUuNzA3LDkuMDA4QS43NS43NSwwLDAsMSw2Ljc2OCw3Ljk0N2wuNDg2LjQ4N1Y0Ljc1N2EuNzUuNzUsMCwxLDEsMS41LDBWOC40MjlsLjQ4My0uNDgyQS43NS43NSwwLDAsMSwxMC4zLDkuMDA4TDguNjMzLDEwLjY3NUEuNzQ1Ljc0NSwwLDAsMSw4LjAwNSwxMS4wMTVaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2NDkgODU5KSIgZmlsbD0iIzU5Y2U4OCIvPg0KICA8L2c+DQo8L3N2Zz4NCg==" />
		</span>
		<span class="widget-number">
			<?php echo wp_kses_post( count( $downloadable_products ) ); ?>
		</span>
		<span class="widget-link">
			<a href="./downloads"><?php echo __( 'See All', 'kata' ); ?></a>
			<svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 13 10">
				<path d="M92.034,76.719l-.657.675,3.832,3.857H84v.937H95.208l-3.832,3.857.657.675,4.967-5Z" transform="translate(-84.001 -76.719)"/>
			</svg>

		</span>
	</div>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
