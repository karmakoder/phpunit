<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * PHP Version 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Testing
 * @package    PHPUnit2
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2002-2005 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: HTML.php 539 2006-02-13 16:08:42Z sb $
 * @link       http://pear.php.net/package/PHPUnit2
 * @since      File available since Release 2.3.0
 */

require_once 'PHPUnit2/Util/CodeCoverage/Renderer.php';

/**
 * Renders Code Coverage information in HTML format.
 *
 * Formatting of the generated HTML can be achieved through
 * CSS (codecoverage.css).
 *
 * Example
 *
 * <code>
 * td.ccLineNumber, td.ccCoveredLine, td.ccUncoveredLine, td.ccNotExecutableLine {
 *   font-family: monospace;
 *   white-space: pre;
 * }
 *
 * td.ccLineNumber, td.ccCoveredLine {
 *   background-color: #aaaaaa;
 * }
 *
 * td.ccNotExecutableLine {
 *   color: #aaaaaa;
 * }
 * </code>
 *
 * @category   Testing
 * @package    PHPUnit2
 * @author     Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright  2002-2005 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PHPUnit2
 * @since      Class available since Release 2.1.0
 */
class PHPUnit2_Util_CodeCoverage_Renderer_HTML extends PHPUnit2_Util_CodeCoverage_Renderer {
    const pageHeader =
'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <link href="codecoverage.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
';

    const pageFooter =
'  </body>
</html>
';

    const sourceFileHeader =
'   <table style="border: 1px solid black" cellspacing="0" cellpadding="0" width="100%">
';

    const sourceFileFooter =
'   </table>
';

    const codeLine =
'     <tr><td class="ccLineNumber">%s</td><td class="%s">%s</td></tr>
';

    /**
     * @return string
     * @access protected
     * @since  Method available since Release 2.1.1
     */
    protected function header() {
        return self::pageHeader;
    }

    /**
     * @return string
     * @access protected
     * @since  Method available since Release 2.1.1
     */
    protected function footer() {
        return self::pageFooter;
    }

    /**
     * @param  string $sourceFile
     * @return string
     * @access protected
     */
    protected function startSourceFile($sourceFile) {
        return self::sourceFileHeader;
    }

    /**
     * @param  string $sourceFile
     * @return string
     * @access protected
     */
    protected function endSourceFile($sourceFile) {
        return self::sourceFileFooter;
    }

    /**
     * @param  array $codeLines
     * @param  array $executedLines
     * @return string
     * @access protected
     */
    protected function renderSourceFile($codeLines, $executedLines) {
        $buffer = '';
        $line   = 1;

        foreach ($codeLines as $codeLine) {
            $lineStyle = 'ccNotExecutableLine';

            if (isset($executedLines[$line])) {
                if ($executedLines[$line] > 0) {
                    $lineStyle = 'ccCoveredLine';
                } else {
                    $lineStyle = 'ccUncoveredLine';
                }
            }

            $buffer .= sprintf(
              self::codeLine,

              $line,
              $lineStyle,
              htmlspecialchars(rtrim($codeLine))
            );

            $line++;
        }

        return $buffer;
    }
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */
?>
