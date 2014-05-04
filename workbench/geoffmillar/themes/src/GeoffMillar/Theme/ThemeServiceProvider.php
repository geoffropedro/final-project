<?php namespace GeoffMillar\Theme;

use Illuminate\Support\ServiceProvider;
use Event;

class ThemeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('geoffmillar/theme');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		require __DIR__ . '/../../routes.php';
		$this->registerEvents();
	}

	protected function registerEvents()
	{
		Event::subscribe(new Subscribers\ThemeEventHandler);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
