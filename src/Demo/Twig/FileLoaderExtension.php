<?php

namespace Demo\Twig;

/**
 * Class FileLoaderExtension
 *
 * @package Demo\Twig
 */
class FileLoaderExtension extends \Twig_Extension
{
    /**
     * @var string
     */
    private $rootDir;

    /**
     * FileLoaderExtension constructor.
     *
     * @param string $rootDir
     */
    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('show_file', [$this, 'showFile']),
            new \Twig_SimpleFunction('show_snippet', [$this, 'showSnippet'])
        ];
    }

    /**
     * Return the contents of a file as a string.
     *
     * @param $path
     * @return string
     */
    public function showFile(string $path): string
    {
        $path = $this->rootDir . '/src/Demo/' . $path;
        $contents = file_get_contents($path);

        return $contents;
    }

    /**
     * Same as showFile, but points to the snippet folder.
     *
     * @param string $path
     * @return string
     */
    public function showSnippet(string $path): string
    {
        return $this->showFile('../../web/assets/snippets/' . $path);
    }
}
