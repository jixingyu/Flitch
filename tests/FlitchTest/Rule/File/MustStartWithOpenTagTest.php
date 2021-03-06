<?php
/**
 * Flitch
 *
 * @link      http://github.com/DASPRiD/Flitch For the canonical source repository
 * @copyright 2011-2012 Ben Scholzen 'DASPRiD'
 * @license   http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace FlitchTest\Rule\File;

use Flitch\File\Tokenizer;
use Flitch\Rule\File\MustStartWithOpenTag;
use Flitch\Test\RuleTestCase;

class MustStartWithOpenTagTest extends RuleTestCase
{
    public function testLeadingWhitespace()
    {
        $tokenizer = new Tokenizer();
        $file      = $tokenizer->tokenize(
            'foo.php',
            " <?php\n"
        );

        $rule = new MustStartWithOpenTag();
        $rule->visitFile($file);

        $this->assertRuleViolations($file, array(
            array(
                'line'     => 1,
                'column'   => 1,
                'message'  => 'File does not start with PHP open tag',
                'source'   => 'Flitch\File\MustStartWithOpenTag'
            ),
        ));
    }

    public function testNoLeadingWhitespace()
    {
        $tokenizer = new Tokenizer();
        $file      = $tokenizer->tokenize(
            'foo.php',
            "<?php\n"
        );

        $rule = new MustStartWithOpenTag();
        $rule->visitFile($file);

        $this->assertRuleViolations($file, array());
    }
}
