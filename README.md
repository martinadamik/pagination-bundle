# Everlution Pagination bundle

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
```


## Usage

coming soon

## TODO

- write proper documentation and usage
- pagination template for multiple css frameworks (SemanticUI, Bootstrap, Materialize)
- template for sorting table headers
- paginate table
