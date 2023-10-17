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
 * Twig_SupTwgSss_BaseNodeVisitor can be used to make node visitors compatible with Twig 1.x and 2.x.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class Twig_SupTwgSss_BaseNodeVisitor implements Twig_SupTwgSss_NodeVisitorInterface
{
    final public function enterNode(Twig_SupTwgSss_NodeInterface $node, Twig_SupTwgSss_Environment $env)
    {
        if (!$node instanceof Twig_SupTwgSss_Node) {
            throw new LogicException('Twig_SupTwgSss_BaseNodeVisitor only supports Twig_SupTwgSss_Node instances.');
        }

        return $this->doEnterNode($node, $env);
    }

    final public function leaveNode(Twig_SupTwgSss_NodeInterface $node, Twig_SupTwgSss_Environment $env)
    {
        if (!$node instanceof Twig_SupTwgSss_Node) {
            throw new LogicException('Twig_SupTwgSss_BaseNodeVisitor only supports Twig_SupTwgSss_Node instances.');
        }

        return $this->doLeaveNode($node, $env);
    }

    /**
     * Called before child nodes are visited.
     *
     * @return Twig_SupTwgSss_Node The modified node
     */
    abstract protected function doEnterNode(Twig_SupTwgSss_Node $node, Twig_SupTwgSss_Environment $env);

    /**
     * Called after child nodes are visited.
     *
     * @return Twig_SupTwgSss_Node|false The modified node or false if the node must be removed
     */
    abstract protected function doLeaveNode(Twig_SupTwgSss_Node $node, Twig_SupTwgSss_Environment $env);
}
