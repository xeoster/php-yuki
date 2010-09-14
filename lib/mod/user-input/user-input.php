<?php
/**
 * Descriptive Text goes here...
 *
 * @author Paul Vorbach <vorbach@genitis.org>
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @version 0.1.0
 * @package org.genitis.yuki.mod.user-input
 */

$san_str_replacement = array(
	'<!--'       => '&lt;!--',
	'-->'        => '--&gt;',
	'<![CDATA['  => '&lt;![CDATA[',
	'<?'         => '&lt;?',
	'?>'         => '?&gt;'
);

$san_regex_replacement = array(
	'javascript\s*:'            => '[removed]',
	'expression\s*(\(|&\#40;)'  => '[removed]',
	'vbscript\s*:'              => '[removed]',
	'Redirect\s+302'            => '[removed]'
);

define('PREG_IP', '#(\d{0,3}\.){3}\d{0,3}#i');
define('PREG_PROTOCOL', '#^([[:alpha:]]+://|mailto:)#i');
define('PREG_EMAIL', '#^[[:alnum:]äöü][[:alnum:]._\-äöü]*@([[:alnum:]äöü]+\.)*[[:alnum:]äöü]+\.[[:alnum:]]+$#i');
//define('PREG_URL', '');

/**
 * Matches strings that begin with a protocol.
 * @param string $protocol
 * @return boolean
 */
function validate_protocol(&$protocol) {
	return preg_match('#^([[:alpha:]]+://|mailto:)#i', $protocol) ? TRUE : FALSE;
}

/**
 * Matches strings that seem to be an email address.
 * @param string $email
 * @return boolean
 */
function validate_email(&$email) {
	return preg_match(PREG_EMAIL, $email);
}

/**
 * Sanitizes the HTML contents of a user entry.
 * @param string $html
 * @return string
 */
function sanitize_user_html(&$html) {
	return $html;
}

/**
 * Sanitizes a string so that html characters are replaced by their entities.
 * @param string $string
 * @return string
 */
function sanitize_string(&$string) {
	return htmlspecialchars($string, ENT_QUOTES);
}

/**
 * Sanitizes a string to a (valid) URL.
 * @param string $url
 * @return string
 */
function sanitize_url(&$url) {
	// if there’s no protocol given
	if (!match_protocol($url)) {
		// if it’s an email adress
		if (strpos($url, '@'))
			$url = 'mailto://'.$url;
		else
			$url = 'http://'.$url;
	}

	return htmlspecialchars($url);
}
