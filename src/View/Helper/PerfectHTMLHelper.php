<?php
namespace App\View\Helper;

use Cake\View\Helper\HtmlHelper;

class PerfectHTMLHelper extends HtmlHelper
{
// Add your code to override the core HtmlHelper
    public function linkSB($title, $classes = [], $url = null)
    {
        $escapeTitle = true;
        if ($url !== null) {
            $url = $this->Url->build($url);
        } else {
            $url = $this->Url->build($title);
            $title = htmlspecialchars_decode($url, ENT_QUOTES);
            $title = h(urldecode($title));
            $escapeTitle = false;
        }

        if ($escapeTitle === true) {
            $title = h($title);
        } elseif (is_string($escapeTitle)) {
            $title = htmlentities($title, ENT_QUOTES, $escapeTitle);
        }

        $templater = $this->templater();

        return $templater->format('linkSB', [
            'url' => $url,
            'content' => $title,
            'classes' => $classes

        ]);
    }
    public function cssAS($path, array $options = [])
    {
        $options += ['once' => true, 'block' => null, 'rel' => 'stylesheet'];

        if (is_array($path)) {
            $out = '';
            foreach ($path as $i) {
                $out .= "\n\t" . $this->css($i, $options);
            }
            if (empty($options['block'])) {
                return $out . "\n";
            }

            return null;
        }

        if (strpos($path, '//') !== false) {
            $url = $path;
        } else {
            $url = $this->Url->css($path, $options);
            $options = array_diff_key($options, ['fullBase' => null, 'pathPrefix' => null]);
        }

        if ($options['once'] && isset($this->_includedAssets[__METHOD__][$path])) {
            return null;
        }
        unset($options['once']);
        $this->_includedAssets[__METHOD__][$path] = true;
        $templater = $this->templater();

        if ($options['rel'] === 'import') {
            $out = $templater->format('style', [
                'attrs' => $templater->formatAttributes($options, ['rel', 'block']),
                'content' => '@import url(' . $url . ');',
            ]);
        } else {
            $out = $templater->format('cssAS', [
                'rel' => $options['rel'],
                'url' => $url,
                'attrs' => $templater->formatAttributes($options, ['rel', 'block']),
            ]);
        }

        if (empty($options['block'])) {
            return $out;
        }
        if ($options['block'] === true) {
            $options['block'] = __FUNCTION__;
        }
        $this->_View->append($options['block'], $out);
    }

    public function scriptAS($url, array $options = [])
    {
        $defaults = ['block' => null, 'once' => true];
        $options += $defaults;

        if (is_array($url)) {
            $out = '';
            foreach ($url as $i) {
                $out .= "\n\t" . $this->script($i, $options);
            }
            if (empty($options['block'])) {
                return $out . "\n";
            }

            return null;
        }

        if (strpos($url, '//') === false) {
            $url = $this->Url->script($url, $options);
            $options = array_diff_key($options, ['fullBase' => null, 'pathPrefix' => null]);
        }
        if ($options['once'] && isset($this->_includedAssets[__METHOD__][$url])) {
            return null;
        }
        $this->_includedAssets[__METHOD__][$url] = true;

        $out = $this->formatTemplate('scriptAS', [
            'url' => $url,
            'attrs' => $this->templater()->formatAttributes($options, ['block', 'once']),
        ]);

        if (empty($options['block'])) {
            return $out;
        }
        if ($options['block'] === true) {
            $options['block'] = __FUNCTION__;
        }
        $this->_View->append($options['block'], $out);
    }

}