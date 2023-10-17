<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Remove whitespaces between HTML tags.
 *
 * <pre>
 * {% spaceless %}
 *      <div>
 *          <strong>foo</strong>
 *      </div>
 * {% endspaceless %}
 *
 * {# output will be <div><strong>foo</strong></div> #}
 * </pre>
 *
 * @final
 */
class Twig_SupTwgSss_TokenParser_Spaceless extends Twig_SupTwgSss_TokenParser
{
    public function parse(Twig_SupTwgSss_Token $token)
    {
        $lineno = $token->getLine();

        $this->parser->getStream()->expect(Twig_SupTwgSss_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideSpacelessEnd'), true);
        $this->parser->getStream()->expect(Twig_SupTwgSss_Token::BLOCK_END_TYPE);

        return new Twig_SupTwgSss_Node_Spaceless($body, $lineno, $this->getTag());
    }

    public function decideSpacelessEnd(Twig_SupTwgSss_Token $token)
    {
        return $token->test('endspaceless');
    }

    public function getTag()
    {
        return 'spaceless';
    }
}
