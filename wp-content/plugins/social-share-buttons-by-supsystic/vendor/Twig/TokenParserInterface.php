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
 * Interface implemented by token parsers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface Twig_SupTwgSss_TokenParserInterface
{
    /**
     * Sets the parser associated with this token parser.
     */
    public function setParser(Twig_SupTwgSss_Parser $parser);

    /**
     * Parses a token and returns a node.
     *
     * @return Twig_SupTwgSss_NodeInterface
     *
     * @throws Twig_SupTwgSss_Error_Syntax
     */
    public function parse(Twig_SupTwgSss_Token $token);

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag();
}
