<?php namespace Illuminate\Console;

trait AppNamespaceDetectorTrait {

	/**
	 * Get the application namespace from the Composer file.
	 *
	 * @param  string  $namespacePath
	 * @return string
	 */
	protected function getAppNamespace()
	{
		$composer = (array) json_decode(file_get_contents(base_path().'/composer.json', true));

		foreach ((array) data_get($composer, 'autoload.psr-4') as $namespace => $path)
		{
			$composerPath = realpath(base_path().'/'.$path);
			if (app_path() == $composerPath) return $namespace;
		}

		throw new \RuntimeException("Unable to detect application namespace.");
	}

}