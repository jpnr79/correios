function plugin_correios_check_prerequisites() {
    if (version_compare(GLPI_VERSION, '9.5', 'lt')) {
        Toolbox::logInFile('correios', sprintf(
            'ERROR [%s:%s] GLPI version too low: %s, user=%s',
            __FILE__, __FUNCTION__, GLPI_VERSION, $_SESSION['glpiname'] ?? 'unknown'
        ));
        echo "This plugin requires GLPI >= 9.5";
        return false;
    }
    return true;
}
<?php
if (!defined('GLPI_ROOT')) { define('GLPI_ROOT', realpath(__DIR__ . '/../..')); }
function plugin_init_glpi_correios() {
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['glpi-correios'] = true;
    $PLUGIN_HOOKS['item_add']['glpi-correios'] = ['Location' => 'correios_hook_function'];
}

function plugin_version_glpi_correios() {
    return [
        'name'           => 'Consulta Correios',
        'version'        => '1.0.0',
        'author'         => 'Seu Nome',
        'license'        => 'GPLv3+',
        'homepage'       => 'https://github.com/seu-repositorio',
        'minGlpiVersion' => '9.5'
    ];
}

function plugin_glpi_correios_install() {
    return true;
}

function plugin_glpi_correios_uninstall() {
    return true;
}

// Backwards/alternate function names
// Some GLPI installations expect functions named `plugin_*_correios` (plugin folder name)
// while this file used `plugin_*_glpi_correios`. Provide small wrappers so both
// signatures work and avoid fatal "method must be defined" errors.
if (!function_exists('plugin_init_correios')) {
    function plugin_init_correios() {
        return plugin_init_glpi_correios();
    }
}

if (!function_exists('plugin_version_correios')) {
    function plugin_version_correios() {
        return plugin_version_glpi_correios();
    }
}

if (!function_exists('plugin_correios_install')) {
    function plugin_correios_install() {
        return plugin_glpi_correios_install();
    }
}

if (!function_exists('plugin_correios_uninstall')) {
    function plugin_correios_uninstall() {
        return plugin_glpi_correios_uninstall();
    }
}
