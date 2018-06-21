/**
 * Parse provided url, extract and return the YouTube video id.
 * @param array $atts {
 *     @type string $url A YouTube video link.
 * }
 * @return string YouTube video id.
 */
function getYoutubeId($atts) {
    $parts = parse_url($atts[url]);
    if (isset($parts['host'])) {
        $host = $parts['host'];
        if (false === strpos($host, 'youtube') && false === strpos($host, 'youtu.be')) {
            return;
        }
    }
    if (isset($parts['query'])) {
        parse_str($parts['query'], $qs);
        if (isset($qs['v'])) {
            return $qs['v'];
        }
        else if (isset($qs['vi'])) {
            return $qs['vi'];
        }
    }
    if (isset($parts['path'])) {
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path) - 1];
    }
    return;
}

add_shortcode( 'parse_youtube_url', 'getYoutubeId' );
