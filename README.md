# documin

*documin* is a minimal document management system. It provides a simple means of managing small file archives where files can both be browsed hierarchically by users and referenced by ID via a web interface accessed by external systems. It was originally created to link financial records to an accounting system.

<p align="center">
  <img src="https://raw.githubusercontent.com/jptrainor/documin/master/etc/documin-screenshot.jpg"
       alt="documin screenshot"/>
</p>

## Getting Started

Configure your web server to expose a file system directory that you want to manage. Copy documin.php to the root of the managed directory tree. Optionally rename documin.php to index.php. Be sure the directory is writable by the web server process. Optionally review and change the configuration settings in documin.php. That's it, you're done!

## Requirements

*documin* was created to meet the following requirements:

* Web browser interface to an ordinary file system where file records are archived.
* Write access to the archive file system, via a web browser, in order to add new files and directories.
    * No ability to modify files - i.e. an "add only" interface.
    * Limited ability to delete files and directories in the form of a time limited undo operation.
* Reference files by ID as a query parameter to a simple URL.
* References by ID are unaffected by reorganization of the files (e.g. manually changing the layout of directory tree used to organize the files), moving to a different server, changing the database, restoring the files from a backup, etc.
* Identify archived file duplication.
    * Same file stored in two different places.
    * Both files share the same ID and the system must be aware of their differing locations. This situation is identified for the user when they access the file.
* Little to no need to maintain a database, or even be aware of the existence of a database.
* Trivially simple to deploy.
* No need to index the entire file set in order to get started. The system becomes aware of a file the first time it is accessed by the browser.
* Ability to easily reindex the entire database if files are moved around for any reason.
* No security implemented by the web interface beyond the add-only interface.
    * Security is left to the underlying web server, operating system, and file system configuration.

## File Drag and Drop

 *documin* supports drag and drop file submission using [DropzoneJS] (http://www.dropzonejs.com). The *documin* web page will attempt to load [dropzone.js from cdnjs.com] (https://cdnjs.com/libraries/dropzone). If it succeeds then a drop area is enabled on the web page. If dropzone.js is not available via the CDN, or if for any reason initialization of dropzone fails, then *documin* functions normally but with the drop area hidden.

## Referencing Files By ID

Use a web browser to visit the directory where documin.php was placed on your server. Browse the directory tree to locate the file to which you want to link. Note the ID field, each ID is a path independent link to the file, e.g.:

    http://my-server/my-documin-files/?fileid=306919836

Note that the above url assumes you have renamed documin.php to index.php. This is not strictly necessary. The *documin* script can have any name you like but if it is not index.php then, of course, you must include that name in the url.

The ID that is generated by *documin* is the decimal representation of the file content's 128 bit MD5 hash value modulo 2^31. This makes it suitable for use by external systems that require a signed 32 bit integer file ID (as is the case for the system with which *documin* had to originally integrate). Note that a *documin* configuration parameter exists that permits use of the full 128 bit hex encoded MD5 value, or a decimal modulo 2^63 value.

## Admin

*documin* has a simple admin interface:

    http://my-server/my-documin-files/?admin

The admin interface provides the ability to delete the *documin* database and to re-index the file system. This is necessary, for example, if the directory structure has changed. The *documin* database is simply an sqlite file stored in the root directory of the managed file system.

## Credits

The simple single file structure of documin.php was inspired by, and derived from, [Encode Explorer](http://encode-explorer.siineiolekala.net). Everything that didn't meet the *documin* requirements was removed from the original Encode Explorer code. New code was added to support file id generation, database management, file linking by id, and file drag and drop. The database is [SQLite](http://www.sqlite.org). File drag and drop support is provided by [DropzoneJS](http://www.dropzonejs.com).
