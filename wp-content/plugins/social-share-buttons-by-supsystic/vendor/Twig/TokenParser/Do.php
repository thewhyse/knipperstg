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
 * Evaluates an expression, discarding the returned value.
 *
 * @final
 */
class Twig_SupTwgSss_TokenParser_Do extends Twig_SupTwgSss_TokenParser
{
    public function parse(Twig_SupTwgSss_Token $token)
    {
        $expr = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->expect(Twig_SupTwgSss_Token::BLOCK_END_TYPE);

        return new Twig_SupTwgSss_Node_Do($expr, $token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'do';
    }
}
