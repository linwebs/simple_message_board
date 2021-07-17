<?php

namespace Linwebs\SimpleMessageBoard\Src;

class Router {
	/**
	 * 取得單一 url 層級的內容
	 * Example:
	 * - origin url: http://localhost/simple_message_board/user/action/
	 * - required: get user
	 * - method: Router::url(2)
	 * @param string $pre_url 網址前綴
	 * @param int    $level 層級
	 * @return string
	 */
	public static function url(string $pre_url, int $level): string {
		$request = substr($_SERVER['REQUEST_URI'], strlen($pre_url));
		$original_uri = explode('?', $request, 2);
		$locale = explode('/', $original_uri[0]);
		return $locale[$level] ?? '';
	}
}