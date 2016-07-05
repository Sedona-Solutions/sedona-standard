<?php

namespace AppBundle\Datatables;

use Doctrine\ORM\EntityManagerInterface;
use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Twig_Environment;

/**
 * Base CRUD Datatable View
 */
abstract class AbstractCrudDatatableView extends AbstractDatatableView
{

    private $linesFormatter = [];


    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $securityToken,
        Twig_Environment $twig,
        TranslatorInterface $translator,
        RouterInterface $router,
        EntityManagerInterface $em,
        array $templates
    )
    {
        parent::__construct(
            $authorizationChecker,
            $securityToken,
            $twig,
            $translator,
            $router,
            $em,
            $templates
        );
        $this->initLineFormatter();
    }

    public function addLineFormatter(callable $lineFormatter = null)
    {
        $this->linesFormatter[] = $lineFormatter;
    }


    protected function initLineFormatter() {
    }

    /**
     * {@inheritdoc}
     */
    public function getLineFormatter()
    {
        $formatters = $this->linesFormatter;

        $formatter = function($line) use ($formatters) {
            foreach($formatters as $callable) {
                if (is_callable($callable)) {
                    $line = call_user_func($callable, $line);
                }
            }
            return $line;
        };

        return $formatter;
    }

}
