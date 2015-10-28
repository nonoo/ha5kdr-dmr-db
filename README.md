ha5kdr-dmr-db
=============

Wordpress plugin which displays searchable, DMR user or repeater database tables.
Data is from http://dmr.ham-digital.net/

Downloader & updater scripts also included (notice: they should not be run from the www-data folder!)

#### Usage

Edit and rename **ha5kdr-dmr-db-config-example.inc.php** to **ha5kdr-dmr-db-config.inc.php**,
**ha5kdr-dmr-db-example.css** to **ha5kdr-dmr-db.css**, then enable the plugin on the
Wordpress plugin configuration page. Add **ha5kdr-dmr-db-repeaters-process.php** and
**ha5kdr-dmr-db-users-process.php** to crontab and make it run every hour, the database will
be updated hourly. Copy **loader-example.gif** to **loader.gif**.

To show the users table, insert this to a Wordpress page or post:

```
<ha5kdr-dmr-db-users />
```

To show the repeaters table, insert this to a Wordpress page or post:

```
<ha5kdr-dmr-db-repeaters />
```

You can see a working example [here](http://ham-dmr.hu/dmr-adatbazisok/).
