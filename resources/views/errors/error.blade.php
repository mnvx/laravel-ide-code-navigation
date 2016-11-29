<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex,nofollow" />
    <style>
        /* Copyright (c) 2010, Yahoo! Inc. All rights reserved. Code licensed under the BSD License: http://developer.yahoo.com/yui/license.html */
        html{color:#000;background:#FFF;}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}li{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}q:before,q:after{content:'';}abbr,acronym{border:0;font-variant:normal;}sup{vertical-align:text-top;}sub{vertical-align:text-bottom;}input,textarea,select{font-family:inherit;font-size:inherit;font-weight:inherit;}input,textarea,select{*font-size:100%;}legend{color:#000;}

        html { background: #eee; padding: 10px }
        img { border: 0; }
        #sf-resetcontent { width:970px; margin:0 auto; }
        .sf-reset { font: 11px Verdana, Arial, sans-serif; color: #333 }
        .sf-reset .clear { clear:both; height:0; font-size:0; line-height:0; }
        .sf-reset .clear_fix:after { display:block; height:0; clear:both; visibility:hidden; }
        .sf-reset .clear_fix { display:inline-block; }
        .sf-reset * html .clear_fix { height:1%; }
        .sf-reset .clear_fix { display:block; }
        .sf-reset, .sf-reset .block { margin: auto }
        .sf-reset abbr { border-bottom: 1px dotted #000; cursor: help; }
        .sf-reset p { font-size:14px; line-height:20px; color:#868686; padding-bottom:20px }
        .sf-reset strong { font-weight:bold; }
        .sf-reset a { color:#6c6159; cursor: default; }
        .sf-reset a img { border:none; }
        .sf-reset a:hover { text-decoration:underline; }
        .sf-reset em { font-style:italic; }
        .sf-reset h1, .sf-reset h2 { font: 20px Georgia, "Times New Roman", Times, serif }
        .sf-reset .exception_counter { background-color: #fff; color: #333; padding: 6px; float: left; margin-right: 10px; float: left; display: block; }
        .sf-reset .exception_title { margin-left: 3em; margin-bottom: 0.7em; display: block; }
        .sf-reset .exception_message { margin-left: 3em; display: block; }
        .sf-reset .traces li { font-size:12px; padding: 2px 4px; list-style-type:decimal; margin-left:20px; }
        .sf-reset .block { background-color:#FFFFFF; padding:10px 28px; margin-bottom:20px;
            -webkit-border-bottom-right-radius: 16px;
            -webkit-border-bottom-left-radius: 16px;
            -moz-border-radius-bottomright: 16px;
            -moz-border-radius-bottomleft: 16px;
            border-bottom-right-radius: 16px;
            border-bottom-left-radius: 16px;
            border-bottom:1px solid #ccc;
            border-right:1px solid #ccc;
            border-left:1px solid #ccc;
            word-wrap: break-word;
        }
        .sf-reset .block_exception { background-color:#ddd; color: #333; padding:20px;
            -webkit-border-top-left-radius: 16px;
            -webkit-border-top-right-radius: 16px;
            -moz-border-radius-topleft: 16px;
            -moz-border-radius-topright: 16px;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            border-top:1px solid #ccc;
            border-right:1px solid #ccc;
            border-left:1px solid #ccc;
            overflow: hidden;
            word-wrap: break-word;
        }
        .sf-reset a { background:none; color:#868686; text-decoration:none; }
        .sf-reset a:hover { background:none; color:#313131; text-decoration:underline; }
        .sf-reset ol { padding: 10px 0; }
        .sf-reset h1 { background-color:#FFFFFF; padding: 15px 28px; margin-bottom: 20px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
    </style>
    <script type="text/javascript">//<![CDATA[
        function toggle(id, clazz) {
            var el = document.getElementById(id),
                    current = el.style.display,
                    i;
            if (clazz) {
                var tags = document.getElementsByTagName('*');
                for (i = tags.length - 1; i >= 0; i--) {
                    if (tags[i].className === clazz) {
                        tags[i].style.display = 'none';
                    }
                }
            }
            el.style.display = current === 'none' ? 'block' : 'none';
        }
        function switchIcons(id1, id2) {
            var icon1, icon2, display1, display2;
            icon1 = document.getElementById(id1);
            icon2 = document.getElementById(id2);
            display1 = icon1.style.display;
            display2 = icon2.style.display;
            icon1.style.display = display2;
            icon2.style.display = display1;
        }
        function _goToEditorCodeLine(file, line){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "http://localhost:63342/api/file?file=" + file + "&line=" + line, true);
            xmlhttp.send();
        }
        //]]></script>
</head>
<body>
<div id="sf-resetcontent" class="sf-reset">
    <h1>Whoops, looks like something went wrong.</h1>
<?php
    $content = '';
    if (config('app.debug')) {
        try {
            $count = count($exception->getAllPrevious());
            $total = $count + 1;
            foreach ($exception->toArray() as $position => $e) {
                $ind = $count - $position + 1;
                $class = formatClass($e['class']);
                $message = escapeHtml($e['message']);
                $content .= sprintf(<<<'EOF'
                                <h2 class="block_exception clear_fix">
                                    <span class="exception_counter">%d/%d</span>
                                    <span class="exception_title">%s%s:</span>
                                    <span class="exception_message">%s</span>
                                </h2>
                                <div class="block">
                                    <ol class="traces list_exception">

EOF
                        , $ind, $total, $class, formatPath($e['trace'][0]['file'], $e['trace'][0]['line']), $message);
                foreach ($e['trace'] as $trace) {
                    $content .= '       <li>';
                    if ($trace['function']) {
                        $content .= sprintf('at %s%s%s(%s)', formatClass($trace['class']), $trace['type'], $trace['function'], formatArgs($trace['args']));
                    }
                    if (isset($trace['file']) && isset($trace['line'])) {
                        $content .= formatPath($trace['file'], $trace['line']);
                    }
                    $content .= "</li>\n";
                }

                $content .= "    </ol>\n</div>\n";
            }
        } catch (\Exception $e) {
        }
    }
    echo $content;

    function formatPath($path, $line)
    {
        $path = htmlspecialchars($path, ENT_QUOTES | ENT_SUBSTITUTE);;
        $file = preg_match('#[^/\\\\]*$#', $path, $file) ? $file[0] : $path;

        if ($linkFormat = ini_get('xdebug.file_link_format') ?: get_cfg_var('xdebug.file_link_format')) {
            $link = strtr(htmlspecialchars($linkFormat, ENT_QUOTES | ENT_SUBSTITUTE), array('%f' => $path, '%l' => (int) $line));

            return sprintf(' in <a href="%s" title="Go to source">%s line %d</a>', $link, $file, $line);
        }

        return sprintf(' in <a title="%s line %3$d" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;">%s line %d</a>', $path, $file, $line)
                . ' <span style="background-color: #e7f0f7; padding: 3px; border-radius: 4px;">
        <a href="#" onclick="_goToEditorCodeLine(\'' . $path . '\', \'' . $line . '\'); return false;">Go to line</a>
    </span>';
    }

    function formatClass($class)
    {
        $parts = explode('\\', $class);

        return sprintf('<abbr title="%s">%s</abbr>', $class, array_pop($parts));
    }

    function formatArgs(array $args)
    {
        $result = array();
        foreach ($args as $key => $item) {
            if ('object' === $item[0]) {
                $formattedValue = sprintf('<em>object</em>(%s)', formatClass($item[1]));
            } elseif ('array' === $item[0]) {
                $formattedValue = sprintf('<em>array</em>(%s)', is_array($item[1]) ? formatArgs($item[1]) : $item[1]);
            } elseif ('string' === $item[0]) {
                $formattedValue = sprintf("'%s'", escapeHtml($item[1]));
            } elseif ('null' === $item[0]) {
                $formattedValue = '<em>null</em>';
            } elseif ('boolean' === $item[0]) {
                $formattedValue = '<em>'.strtolower(var_export($item[1], true)).'</em>';
            } elseif ('resource' === $item[0]) {
                $formattedValue = '<em>resource</em>';
            } else {
                $formattedValue = str_replace("\n", '', var_export(escapeHtml((string) $item[1]), true));
            }

            $result[] = is_int($key) ? $formattedValue : sprintf("'%s' => %s", $key, $formattedValue);
        }

        return implode(', ', $result);
    }

    function escapeHtml($str)
    {
        return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE);
    }
?>
</div>
</body>
</html>