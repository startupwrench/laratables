# Laratables

A Laravel package to convert Eloquent queries into JSON output to work with Datatables. 
This is a fork of: https://github.com/yuri-moens/laratables to fix some issues, and errors for a production app, feel free to use it, but no warranties expressed.

## Installation

Add the following to your `composer.json` file.

```
require {
	"startupwrench/laratables": "dev-master"
}
```

Run `composer install`.

Open `app/config/app.php` and add:

`Startupwrench\Laratables\LaratablesServiceProvider::class,`

Also add the alias:

`'Laratables'      => Startupwrench\Laratables\LaratablesFacade::class,`

And publish the configuration from the command line:

`php artisan vendor:publish`

## Usage

Use the model function to set the main Eloquent model.

`$dt = Laratables::model('NewsItem');`

Set any optional relationship you want to use.

`$dt->with('user', 'category');`

Set the columns you want to retrieve. Columns of relationship models are written as <relationship>.<column>

`$dt->columns([ 'id', 'title', 'user.first_name', 'newsCategory.name', 'created_at', 'updated_at' ]);`

Wrap some optional HTML around a column. Parameters can be passed by wrapping them in curly braces.

```
$dt->wrapHtml('title', '<a href="news/{id}/edit">', '</a>');
$dt->wrapHtml('user.first_name', '<a href="users/{user->id}/edit">', '</a>');
```

Additional columns can also be added manually.

`$dt->addColumn('delete','<a class="btn btn-danger" href="news/{id}" data-method="delete">Delete</a>');`

Get the JSON output.

`$response = $dt->make();`

### Chaining

The property setters all return the L4EloquentDatatables object so you can easily chain commands. The aforementioned example can be rewritten as following.

```
Laratables::model('NewsItem') 
	->with('user', 'newsCategory')
	->columns([ 'id', 'title', 'user.first_name', 'newsCategory.name', 'created_at', 'updated_at' ])
	->wrapHtml('title', '<a href="news/{id}/edit">', '</a>')
	->wrapHtml('user.first_name', '<a href="users/{user->id}/edit">', '</a>')
	->addRawColumn('delete','<a class="btn btn-danger" href="news/{id}" data-method="delete">Delete</a>')
	->make();
```

## Limitations

This is a fairly simple package with very few features. It was made for personal use but I figured other people might have a use for it. The most important limitation in my opinion is that you cannot sort columns of relationship models. If anyone is interested in writing support for this, you are more than welcome to do so.
