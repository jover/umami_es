# Umami ElasticSearch &amp; ReactiveSearch

Drupal 8 module which demonstrates the use of [ElasticSearch](https://www.elastic.co/products/elasticsearch), optionally in combination with [ReactiveSearch](https://opensource.appbase.io/reactivesearch/).
To make the connection to an ElasticSearch server, this module relies on [ElasticSearch Helper](https://www.drupal.org/project/elasticsearch_helper) module.

## Prerequisites

* a working Drupal 8 website installed using the _Umami_ profile
* an _ElasticSearch_ server, a version being compatible with the _ElasticSearch Helper_ module
* make sure CORS is allowed in the _ElasticSearch_ settings

## Installation

Enable this module using the standard Drupal way.

## Indexing

```bash
drush elasticsearch:helper:setup
drush elasticsearch:helper:reindex
```

## Help

### ElasticSearch - CORS

Edit the configuration file of ElasticSearch (elasticsearch.yml) and make sure CORS is enabled.
Don't forget to restart the ElasticSearch in order to use the updated configuration.
```bash
http.cors.enabled: true
http.cors.allow-credentials: true
http.cors.allow-origin: /https?:\/\/(localhost)?(127.0.0.1)?(:[0-9]+)?/
http.cors.allow-headers: X-Requested-With, Content-Type, Content-Length, Authorization, Accept
```
> In my case, on Mac OSX, this file was location at: /usr/local/etc/elasticsearch/elasticsearch.yml
