<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Marks a section of a template as being reusable.
 *
 * <pre>
 *  {% block head %}
 *    <link rel="stylesheet" href="style.css" />
 *    <title>{% block title %}{% endblock %} - My Webpage</title>
 *  {% endblock %}
 * </pre>
 *
 * @final
 */
class Twig_SupTwgSss_TokenParser_Block extends Twig_SupTwgSss_TokenParser
{
    public function parse(Twig_SupTwgSss_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $name = $stream->expect(Twig_SupTwgSss_Token::NAME_TYPE)->getValue();
        if ($this->parser->hasBlock($name)) {
            throw new Twig_SupTwgSss_Error_Syntax(sprintf("The block '%s' has already been defined line %d.", $name, $this->parser->getBlock($name)->getTemplateLine()), $stream->getCurrent()->getLine(), $stream->getSourceContext());
        }
        $this->parser->setBlock($name, $block = new Twig_SupTwgSss_Node_Block($name, new Twig_SupTwgSss_Node(array()), $lineno));
        $this->parser->pushLocalScope();
        $this->parser->pushBlockStack($name);

        if ($stream->nextIf(Twig_SupTwgSss_Token::BLOCK_END_TYPE)) {
            $body = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
            if ($token = $stream->nextIf(Twig_SupTwgSss_Token::NAME_TYPE)) {
                $value = $token->getValue();

                if ($value != $name) {
                    throw new Twig_SupTwgSss_Error_Syntax(sprintf('Expected endblock for block "%s" (but "%s" given).', $name, $value), $stream->getCurrent()->getLine(), $stream->getSourceContext());
                }
            }
        } else {
            $body = new Twig_SupTwgSss_Node(array(
                new Twig_SupTwgSss_Node_Print($this->parser->getExpressionParser()->parseExpression(), $lineno),
            ));
        }
        $stream->expect(Twig_SupTwgSss_Token::BLOCK_END_TYPE);

        $block->setNode('body', $body);
        $this->parser->popBlockStack();
        $this->parser->popLocalScope();

        return new Twig_SupTwgSss_Node_BlockReference($name, $lineno, $this->getTag());
    }

    public function decideBlockEnd(Twig_SupTwgSss_Token $token)
    {
        return $token->test('endblock');
    }

    public function getTag()
    {
        return 'block';
    }
}
