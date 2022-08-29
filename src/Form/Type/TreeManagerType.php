<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\DoctrinePHPCRAdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TreeManagerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['root'] = $options['root'];
        //$view->vars['create_in_overlay'] = $options['create_in_overlay'];
        //$view->vars['edit_in_overlay'] = $options['edit_in_overlay'];
        //$view->vars['delete_in_overlay'] = $options['delete_in_overlay'];
        parent::buildView($view, $form, $options);
    }

    /**
     * NEXT_MAJOR: remove this method.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['root']);

        // The new OptionsResolver API
        $resolver->setDefined(['create_in_overlay', 'edit_in_overlay', 'delete_in_overlay']);

        $resolver->setDefaults([
            'create_in_overlay' => true,
            'edit_in_overlay' => true,
            'delete_in_overlay' => true,
        ]);
    }

    /**
     * NEXT_MAJOR: remove this method.
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'doctrine_phpcr_odm_tree_manager';
    }
}
