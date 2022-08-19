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

namespace Sonata\DoctrinePHPCRAdminBundle\Filter;

use Sonata\AdminBundle\Filter\Filter as BaseFilter;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Filter\Model\FilterData;
use Sonata\DoctrinePHPCRAdminBundle\Datagrid\ProxyQuery;

abstract class Filter extends BaseFilter
{
    /**
     * @var bool
     */
    protected $active = false;

    /**
     * @param ProxyQuery $queryBuilder
     * @param mixed      $value
     */
    public function apply(ProxyQueryInterface $query, FilterData $filterData): void
    {
        $this->value = $value;
        $this->filter($queryBuilder, $queryBuilder->getAlias(), $this->getFieldName(), $value);
    }

    /**
     * {@inheritdoc}
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Add the where statement for this filter to the query.
     */
    protected function getWhere(ProxyQuery $proxy)
    {
        $queryBuilder = $proxy->getQueryBuilder();
        if (self::CONDITION_OR === $this->getCondition()) {
            return $queryBuilder->orWhere();
        }

        return $queryBuilder->andWhere();
    }
}
