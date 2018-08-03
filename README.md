# Sydney-map
## Introduction

It is a project that I have implemented before and mainly written in PHP and JavaScript. Previously it ran smoothly on my local machine (Windows). Now I manage to migrate it online.

The original idea was to implement the basic feature of a map. You can visit my website to take a look on it :) [MyMap](http://mymap.yingcongzhu.com)

The users are supposed to be able to search points of interest located in Sydney and other points of interest within a specific range around a specific point. ~~Also they are supposed to be able to plan a route between 2 points on the map.~~ 

## Implementation

The points of interest are stored in server on PostgreSQL with postgis extension enabled. The map is rendered with OpenLayers.  The APIs of OpenLayers are also used to display components like markers and pop-ups on the map.

Tools I have used

- [PostgreSQL](https://www.postgresql.org/)
- [Postgis](http://postgis.net/)
- [osm2pgsql](https://github.com/openstreetmap/osm2pgsql)
- [osm2pgrouting](https://github.com/pgRouting/osm2pgrouting)
- [Geoserver](http://geoserver.org/)
- [Tomcat(as the container for Geoserver)](http://tomcat.apache.org/)

Among them, osm2pgsql is used to load osm file to a PostgreSQL DB for location query and osm2pgrouting is used to load osm file to a PostgreSQL DB for route planning purpose.

So the basic idea is to deliver the request from front-end to back-end. Query the PostgreSQL database for points of interest. Deliver the coordinates of what have matched back to front-end and display the result on the map.

## Problem

When the project was run on my local environment (WAMP), everything works fine. However, there are Cross-Origin Read Blocking (CROB) problems when the map send a CORS request to Geoserver to plan a route. So the polyline stands for planned route can't be displayed on the map. I have been stuck on it for days. I really hope one day I can solve it.

That's the link I have referenced, none of them work for me.

[Enabling CORS in GeoServer (jetty)?](https://gis.stackexchange.com/questions/210109/enabling-cors-in-geoserver-jetty)

[CORS on Tomcat](https://enable-cors.org/server_tomcat.html)

[Tomcat Doc about enabling CORS](http://tomcat.apache.org/tomcat-7.0-doc/config/filter.html#CORS_Filter)

That's a gif screenshot on what route planning is meant to be.

![](https://raw.githubusercontent.com/zyucong/MarkdownPhoto/master/%E6%88%91%E7%9A%84%E6%AF%95%E8%AE%BE/routing.gif)

## Reference

[A workshop for pgrouting](https://workshop.pgrouting.org/2.2.10/en/index.html)