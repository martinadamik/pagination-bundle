# Everlution Pagination bundle

## Features

- simple pagination for tables
- sorting headers for tables
- based on Doctrine Paginator (for now)

## Installation

### Step 1: Download the Bundle


```console
$ composer require everlutionsk/pagination-bundle
```

### Step 2: Enable the Bundle

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Everlution\PaginationBundle\EverlutionPaginationBundle(),
        );

        // ...
    }

    // ...
}
```

## Configuration

Where will be the pagination definitions loaded from:

```yaml
everlution_pagination:
    default_page_size: 3 # defaults to 20
    max_page_size: 10 # defaults to 100
    sortable_header_template: @AppBundle::sortable_header.html.twig # template for sortable header
    default_sort_query_string: some_string # defaults to 'sort'
```


## Usage

### User controller list action:

```php
    public function listAction()
    {
        return $this->render(
            'AppBundle:User:list.html.twig',
            ['userPage' => $this->get('uc.client.list')->getPage()]
        );
    }
```

### Templating in list.html.twig:

```twig
    <table>
      <thead>
      <tr>
        {# first argument is label which is automatically translated; second is query string - please do use underscore notation #}
        {{ sortable_header('Name', 'name') }}
        {{ sortable_header('Job title', 'job_title') }}
        <th>Status</th>
        <th>Options</th>
      </tr>
      </thead>
      <tbody>
      {% for user in userPage.items %}
        <tr>
          <td>{{ user }}</td>
          <td>{{ user.jobTitle }}</td>
          <td>{ status of the user ... }</td>
          <td>{ links for edit/delete ... }</td>
        </tr>
      {% endfor %}
      </tbody>
    </table>
    {{ paginate(userPage) }}
```

### UseCase for listing:

```php
<?php

declare(strict_types=1);

namespace Library\UseCase\User;

use Everlution\PaginationBundle\Pagination\MaxResultsExceeded;
use Everlution\PaginationBundle\Pagination\Page;
use Everlution\PaginationBundle\Pagination\Pagination;
use Everlution\PaginationBundle\Pagination\QueryToPagination;
use Library\UseCase\User\Persistence\UserViewListQuery;
use Symfony\Component\HttpFoundation\RequestStack;

class ListUsers
{
    const DEFAULT_PAGINATION_OFFSET = 0;

    /** @var UserViewListQuery */
    private $listQuery;
    /** @var RequestStack */
    private $requestStack;
    /** @var Pagination */
    private $pagination;

    public function __construct(
        UserViewListQuery $listQuery,
        QueryToPagination $pagination,
        RequestStack $requestStack
    ) {
        $this->requestStack = $requestStack;
        $this->listQuery = $listQuery;
        $this->pagination = $pagination;
    }

    public function getPage(): Page
    {
        $request = $this->requestStack->getCurrentRequest();

        try {
            $query = $this->listQuery->getUserViewListQuery();
            $this->pagination->setQueryBuilder($query);

            // limit and offsete here are provided automagically by RequestTransformer from {page} parameter of URL
            return $this->pagination->paginate(
                (int) $request->get('limit', Page::DEFAULT_PAGE_SIZE),
                (int) $request->get('offset', self::DEFAULT_PAGINATION_OFFSET)
            );
        } catch (MaxResultsExceeded $exception) {
            throw new WrongPaginationArgument($exception->getMessage());
        }
    }
}
```

Service definition:

```yaml
services:
  uc.client.list:
    class: Library\UseCase\User\ListUsers
    arguments:
      - '@doctrine.repository.user'
      - '@user.pagination'
      - '@request_stack'
```

Repository method for getting data:

```php
    public function getUserViewListQuery(): QueryBuilder
    {
        return $this
            ->createQueryBuilder('user')
            ->select('PARTIAL user.{id, firstName, lastName, jobTitle}');
    }
```

### Actual sort implementation detail:

Name sorting:

```php
<?php

namespace Library\UseCase\User\Sort;

use Doctrine\ORM\QueryBuilder;
use Everlution\PaginationBundle\Pagination\Sort\Column\DoctrineSortColumn;
use Everlution\PaginationBundle\Pagination\Sort\Rule\SortRule;
use Everlution\PaginationBundle\Sort\RequestSortQuery;

class Name implements SortRule
{
    public function accept(QueryBuilder &$builder, RequestSortQuery $query): void
    {
        # getName() is automagically generated getter based on name provided in sortable_header() TWIG function
        if (!$query->getName() instanceof DoctrineSortColumn) {
            return;
        }

        $builder
            ->addOrderBy('user.firstName', $query->getName()->getDirection())
            ->addOrderBy('user.lastName', $query->getName()->getDirection());
    }
}
```

Job title sorting:

```php
<?php

namespace Library\UseCase\User\Sort;

use Doctrine\ORM\QueryBuilder;
use Everlution\PaginationBundle\Pagination\Sort\Column\DoctrineSortColumn;
use Everlution\PaginationBundle\Pagination\Sort\Rule\SortRule;
use Everlution\PaginationBundle\Sort\RequestSortQuery;

class JobTitle implements SortRule
{
    public function accept(QueryBuilder &$builder, RequestSortQuery $query): void
    {
        # sortable_header() TWIG function accepts underscore naming for query string which are automatically converted to camelCase for getters
        if (!$query->getJobTitle() instanceof DoctrineSortColumn) {
            return;
        }

        $builder->addOrderBy('user.jobTitle', $query->getJobTitle()->getDirection());
    }
}
```

Service definition:

```yaml
services:
  # implementation of Doctrine sorting
  user.sort.name:
    class: Library\UseCase\User\Sort\Name
    public: false
  user.sort.job_title:
    class: Library\UseCase\User\Sort\JobTitle
    public: false

  # container for Doctrine sorting rules
  user.sort.rules_provider:
    class: Everlution\PaginationBundle\Pagination\Sort\SortRulesContainer
    public: false
    calls:
      - ['addRule', ['@user.sort.name']]
      - ['addRule', ['@user.sort.job_title']]

  # concrete implementation of user list sorting
  user.sort.doctrine_sort_query:
    class: Everlution\PaginationBundle\Pagination\Sort\DoctrineSortQuery
    arguments:
      - "@user.sort.rules_provider"
      - '@pagination.sort.request_sort_query'


  # implementation of Doctrine filters
  user.filter.name:
    class: Library\UseCase\User\Filter\Name
    public: false
  user.filter.job_title:
    class: Library\UseCase\User\Filter\JobTitle
    public: false
    
  # definition of user filter container with all filters
  user.filter.container:
    class: Everlution\PaginationBundle\Pagination\Filter\FilterContainer
    arguments:
      -
        - "@user.filter.name"
        - '@user.filter.job_title'
      
  # query pagination with concrete sort for Docrine
  user.pagination:
    class: Everlution\PaginationBundle\Pagination\QueryPagination
    arguments:
      - '@user.filter.container'
      - '@user.sort.doctrine_sort_query'
      - '%everlution.pagination.max_page_size%'
```

## TODO

- automate sort rules creation
- create abstraction to Doctrine so we can use whatever we want (Elasticsearch etc)
- provide usage for Filtering the table
- pagination template for multiple css frameworks (SemanticUI, Bootstrap, Materialize)
