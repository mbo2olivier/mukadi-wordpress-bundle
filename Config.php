<?php
namespace Mukadi\WordpressBundle;

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Config.
 *
 * This is the Worpress configurator class
 *
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
class Config {
    /**
     * The base path for the WordPlate installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The public web directory path and Wordpress install path.
     *
     * @var string
     */
    protected $wpPath;

    /**
     * Create a new application instance.
     *
     * @param string $publicPath
     *
     * @return void
     */
    public function __construct(string $wpPath)
    {
        $this->wpPath = $wpPath;

        try {
            (new Dotenv())->load($this->getBasePath().'/.env');
        } catch (InvalidPathException $e) {
            //
        }
    }

    /**
     * Star the application engine.
     *
     * @return void
     */
    public function apply()
    {
        // The WordPress environment.
        $env = env('APP_ENV', 'dev');
        if($env === 'dev'){
            $env = 'local';
        }else if($env === 'prod'){
            $env = 'production';
        }
        define('WP_ENV', $env);

        // For developers: WordPress debugging mode.
        define('WP_DEBUG_LOG', env('WP_DEBUG_LOG', false));
        define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY', WP_DEBUG));
        define('SCRIPT_DEBUG', env('SCRIPT_DEBUG', WP_DEBUG));

        // The database configuration with database name, username, password,
        // hostname charset and database collae type.
        $url = env('DATABASE_URL');
        $dbname = parse_url($url,PHP_URL_PATH);
        define('DB_NAME', substr($dbname,1));
        define('DB_USER', parse_url($url,PHP_URL_USER));
        define('DB_PASSWORD', parse_url($url,PHP_URL_PASS));
        define('DB_HOST', parse_url($url,PHP_URL_HOST));
        define('DB_CHARSET', env('DB_CHARSET', 'utf8mb4'));
        define('DB_COLLATE', env('DB_COLLATE', 'utf8mb4_unicode_ci'));

        // Set the unique authentication keys and salts.
        define('AUTH_KEY', env('AUTH_KEY'));
        define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
        define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
        define('NONCE_KEY', env('NONCE_KEY'));
        define('AUTH_SALT', env('AUTH_SALT'));
        define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
        define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
        define('NONCE_SALT', env('NONCE_SALT'));

        // Set the home url to the current domain.
        $request = Request::createFromGlobals();
        define('WP_HOME', env('WP_URL', $request->getSchemeAndHttpHost()));

        // Set the WordPress directory path.
        define('WP_SITEURL', env('WP_SITEURL', WP_HOME));

        // Set the WordPress content directory path.
        define('WP_CONTENT_DIR', env('WP_CONTENT_DIR', sprintf('%s/%s',$this->getBasePath(),"wp")));
        define('WP_CONTENT_URL', env('WP_CONTENT_URL', sprintf('%s/%s',WP_HOME,'wp')));

        // Set the trash to less days to optimize WordPress.
        define('EMPTY_TRASH_DAYS', env('EMPTY_TRASH_DAYS', 7));

        // Set the default WordPress theme.
        define('WP_DEFAULT_THEME', env('WP_THEME'));

        // Constant to configure core updates.
        define('WP_AUTO_UPDATE_CORE', env('WP_AUTO_UPDATE_CORE', 'minor'));

        // Specify the number of post revisions.
        define('WP_POST_REVISIONS', env('WP_POST_REVISIONS', 2));

        // Cleanup WordPress image edits.
        define('IMAGE_EDIT_OVERWRITE', env('IMAGE_EDIT_OVERWRITE', true));

        // Prevent file edititing from the dashboard.
        define('DISALLOW_FILE_EDIT', env('DISALLOW_FILE_EDIT', true));

        // Set the absolute path to the WordPress directory.
        if (!defined('ABSPATH')) {
            define('ABSPATH', $this->getWpPath().'/');
        }

    }

    /**
     * Get the base path for the application.
     *
     * @return string
     */
    public function getBasePath(): string
    {
        if (is_null($this->basePath)) {
            return realpath($this->wpPath.'/../');
        }

        return $this->basePath;
    }

    /**
     * Get the base path for the application.
     *
     * @param string $basePath
     *
     * @return void
     */
    public function setBasePath(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Get the public web directory path.
     *
     * @return string
     */
    public function getWpPath(): string
    {
        return $this->publicPath;
    }

    /**
     * Set the public web directory path.
     *
     * @param string $wpPath
     *
     * @return void
     */
    public function setWpPath(string $wpPath)
    {
        $this->wpPath = $wpPath;
    }
}