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
 * @final
 */
class Twig_SupTwgSss_Extension_StringLoader extends Twig_SupTwgSss_Extension
{
    public function getFunctions()
    {
        return array(
            new Twig_SupTwgSss_SimpleFunction('template_from_string', 'Twig_SupTwgSss_template_from_string', array('needs_environment' => true)),
        );
    }

    public function getName()
    {
        return 'string_loader';
    }
}

/**
 * Loads a template from a string.
 *
 * <pre>
 * {{ include(template_from_string("Hello {{ name }}")) }}
 * </pre>
 *
 * @param Twig_SupTwgSss_Environment $env      A Twig_SupTwgSss_Environment instance
 * @param string           $template A template as a string or object implementing __toString()
 *
 * @return Twig_SupTwgSss_Template
 */
function Twig_SupTwgSss_template_from_string(Twig_SupTwgSss_Environment $env, $template)
{
    return $env->createTemplate((string) $template);
}
