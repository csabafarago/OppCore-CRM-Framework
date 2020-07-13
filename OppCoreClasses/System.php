<?php

namespace OppCoreClasses;

use OppCoreClasses\Session\SessionManager;
use OppCoreClasses\SystemHelpers\LangTable;
use OppCoreClasses\View\Renderer;

class System {

    public function run() {
        $route = (new RouteHelper())->explodeRequestUrl();
        $this->handleRequest($this->initializeProject($route), $route);
    }

    private function initializeProject($route) {
        $page_config = include_once(ROOT_DIR . 'projects/domain_config.php');
        if (!empty($page_config [$_SERVER['SERVER_NAME']])) {
            $loaded_module_configs = ModuleHelper::LoadModuleConfigs($page_config);
            $session = new SessionManager();
            if(!$session->get('lang')){
                $session->set('lang', Helper::load('config')['site_config']['default_language']);
                $session->set('lang_id', (new LangTable)->getLangId());
            }
            Helper::$lang_code = $session->get('lang');
            if ($route[0] == '') {
                View\LayoutAppender::setMeta('title', Helper::load('config')['page_data']['page_title'][$session->get('lang')]);
                return ['module' => 'Homepage','controller' => 'Homepage', 'action' => 'index', 'view' => 'index'];
            } else {

                return (new RouteHelper())->ValidateURL($loaded_module_configs, $route);
            }
        } else {
            include __DIR__ . '/error_templates/project_error.php';
            exit;
        }
    }

    private function handleRequest($request_to_handle, $route) {
        $session = new SessionManager();
        if ($request_to_handle) {
            $isAdminURL = false;
            $administration_link = Helper::load('config')['security']['administration_link'];
            $login_url = Helper::load('config')['security']['login_url'];
            if (isset($route) && in_array($route[0], $administration_link)) {
                $isAdminURL = true;
                $admin_login_session = false;
                //TODO FIREWALL
                if (isset($session->get('user')->admin_login)) {
                    $admin_login_session = $session->get('user')->admin_login;
                }
                if (
                        (!isset($admin_login_session) ||
                        isset($admin_login_session) &&
                        $admin_login_session != 1) &&
                        (isset($route[1]) && !in_array($route[1],$login_url)||
                        !isset($route[1]))) {
                    Helper::redirectToUrl(Helper::getURL(['admin_home', 'login_page']));
                } else if (isset($route[1]) && in_array($route[1], $login_url) && $admin_login_session) {
                    Helper::redirectToUrl(Helper::getURL(['admin_home']));
                }
            }
            Helper::$modul = $request_to_handle['module'];
            Helper::$controller = $request_to_handle['controller'];
            Helper::$action = $request_to_handle['action']; //1 -> action
            Helper::$view = $request_to_handle['view']; //1 -> view
            Helper::$is_admin_url = $isAdminURL;
            echo (new Renderer())->renderContent(Helper::load('load_controller'), Helper::$action, $isAdminURL);
        } else {
            Helper::redirectToUrl(Helper::getURL(['error_404'], true));
        }
    }
}
