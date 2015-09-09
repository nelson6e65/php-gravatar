<?php
/**
 * Custom autoloader for non-composer installations.
 * This function only load classes under 'NelsonMartell' namespace and skips in
 * any other case.
 * If NML class file is not found, throws and exception.
 *
 * Note: If you are using "NelsonMartell" as main namespace in a file that not
 * belongs to NML, you should include it before to load "NML/autoload.php" or,
 * using SPL autoload features, register autoload function for that class(es)
 * using "prepend" argument set to TRUE.
 * Example, if your autoload function is named "no_NML_autoload_function", you
 * can use something like:
 * spl_autoload_register("no_NML_autoload_function", true, TRUE).
 *
 * @param string $class NML class name (full cualified name).
 *
 * @return void
 */
function autoload_NM_GRAVATAR($class)
{
    static $DS = DIRECTORY_SEPARATOR;

    if ($class[0] == '\\') {
        $class = substr($class, 1);
    }

    $classArray = explode('\\', $class);

    if ($classArray[0] == 'NelsonMartell') {
        if ($classArray[1] == 'Gravatar') {
            unset($classArray[0]);
            $classArray[1] = 'src';
        } else {
            // Is not a 'NelsonMartell\Gravatar' namespace.
            return;
        }
    } else {
        // Is not a 'NelsonMartell' namespace.
        return;
    }

    $path = sprintf('%s'.$DS.'..'.$DS.'%s.php', __DIR__, implode($DS, $classArray));

    if (is_file($path)) {
        require_once($path);
    } else {
        throw new InvalidArgumentException("Error loading '$class' class. File '$path' is not present.");
    }
}
