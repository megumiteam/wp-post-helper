# megumi/wp-post-helper

[![Build Status](https://travis-ci.org/megumiteam/wp-post-helper.svg?branch=master)](https://travis-ci.org/megumiteam/wp-post-helper) [![Latest Stable Version](https://poser.pugx.org/megumi/wp-post-helper/v/stable.svg)](https://packagist.org/packages/megumi/wp-post-helper) [![Total Downloads](https://poser.pugx.org/megumi/wp-post-helper/downloads.svg)](https://packagist.org/packages/megumi/wp-post-helper) [![Latest Unstable Version](https://poser.pugx.org/megumi/wp-post-helper/v/unstable.svg)](https://packagist.org/packages/megumi/wp-post-helper) [![License](https://poser.pugx.org/megumi/wp-post-helper/license.svg)](https://packagist.org/packages/megumi/wp-post-helper)

Helper class for the `wp_insert_post()`

## Installation

Create a composer.json in your project root.

```
{
    "require": {
        "megumi/wp-post-helper": "*"
    }
}
```

## Documentation

### Basic usage

```
$args = array(
    'post_name'    => 'slug',                  // slug
    'post_author'  => '1',                     // author's ID
    'post_date'    => '2012-11-15 20:00:00',   // post date and time
    'post_type'    => 'post',                 // post type (you can use custom post type)
    'post_status'  => 'publish',               // post status, publish, draft and so on
    'post_title'   => 'title',                 // post title
    'post_content' => 'content',               // post content
    'post_category'=> array( 1, 4 ),           // category IDs in an array
    'post_tags'    => array( 'tag1', 'tag2' ), // post tags in an array
);

$helper = new Megumi\WP\Post\Helper( $args );
$post_id = $helper->insert();
```

### Attachements

```
$args = array(
    ...
);

$helper = new Megumi\WP\Post\Helper( $args );
$post_id = $helper->insert();

$attachment_id = $helper->add_media(
    'http://placehold.jp/100x100.png', // path or url
    'title',
    'description',
    'caption',
    false
);
```

### Adding a value to a custom field

```
$args = array(
    ...
);

$helper = new Megumi\WP\Post\Helper( $args );
$post_id = $helper->insert();

$post->add_meta(
   'meta_key',  // meta key
   'meta_val',  // meta value
   true         // add it as unique (true) or not (false)
);
```

### Aadding a value as a format of Advanced Custom Field

```
$args = array(
    ...
);

$helper = new Megumi\WP\Post\Helper( $args );
$post_id = $helper->insert();

$post->add_field(
   'field_xxxxxxxxxxxxx',   // key
   'field_val'          // value
);
```

## Contributing

Clone this project.

```
$ git clone git@github.com:megumiteam/wp-post-helper.git
```

### Run testing

Initialize the testing environment locally:

(you'll need to already have mysql, svn and wget available)

```
$ bash bin/install-wp-tests.sh wordpress_test root '' localhost latest
```

Install phpunit.

```
$ composer install
```

The unit test files are in the `tests/` directory.

To run the unit tests, just execute:

```
$ phpunit
```

### Issue

[https://github.com/megumiteam/wp-post-helper/issues](https://github.com/megumiteam/wp-post-helper/issues)
