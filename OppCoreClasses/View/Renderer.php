<?php
namespace OppCoreClasses\View;

use OppCoreClasses\Helper;
use OppCoreClasses\RouteHelper;
use OppCoreClasses\Session\SessionManager;

class Renderer{
    
    private $session = null;
    private $positions = null;
        
    public function renderContent($Controller, $action, $isAdminURL) {
        $this->session = new SessionManager();
        $controller = new $Controller();
        $action .= 'Action';
        $mainContent = $controller->$action();
        if(isset($mainContent['json']) || isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            isset($mainContent['output']) ? $mainContent['output'] .= LayoutAppender::generateAppendedFooterJs(): '';
            header('Content-Type: application/json');
            return json_encode($mainContent);
        }
        //Layout fájl figyelmen kívül hagyása JSON vissszatéréshez kell vagy pl Login layouthoz
        if($controller->terminate){
            return $mainContent['output'].LayoutAppender::generateAppendedFooterJs();
        }

        $set_layout = (isset($mainContent['set_layout']) ? $mainContent['set_layout'] : false);
        $position_url = '';
        if(!$isAdminURL){
            $position_url = 'home';
        } else {
            LayoutAppender::setMeta('title', 'Admin - '.Helper::load('config')['page_data']['page_title'][$this->session->get('lang')]);
        }
        $userAgentIsMobile = $this->isMobile();

        foreach (RouteHelper::$params as $key => $value){
            $position_url .= '/'.$key;
        }
        $view = new View((
                $isAdminURL ? 'admin_layout' : (!$userAgentIsMobile ? 'layout' : 'mobile_layout')),
                $set_layout);
        $this->positions = Helper::load(
            $isAdminURL ? 'backend_positions' : (!$userAgentIsMobile ? 'positions' : 'mobile_positions'),
            [
                'lang' => $this->session->get('lang'),
                'url' => $position_url
            ]);
        $view->set('content', $mainContent['output']);
        $view->set('meta_tags', LayoutAppender::getMetaData());
        foreach($this->positions as $position => $submodules){
            $view->set($position, $this->renderSubmoduleInToPosition($submodules, $position));
        }
        if(DEVELOPER_MODE){
            $view->set('debug', LayoutAppender::generateDebugData([
                'url' => Helper::$debugGeneratedUrl,
                'view' => Helper::$debug_toolbar_view_errors]
            ));
        }
        $view->set('head_css', LayoutAppender::generateAppendedHeadCss());
        $view->set('footer_js', LayoutAppender::generateAppendedFooterJs());
        return $view->output();
    }
    
    private function renderSubmoduleInToPosition($submodules, $position){
        $renderedPositionContent = '';
        foreach ($submodules as $submodule){
            Helper::$modul = $submodule['module'];
            Helper::$controller = $submodule['controller'];
            Helper::$action = $submodule['action'];
            Helper::$view = $submodule['view'];
            $path = Helper::load('load_controller');
            //Validálni kéne hogy a positionben levő paraméterek léteznek e a modul configban talán esetleg
            if(!$path){
                return 'ERROR A submodule is not active or can\'t be found ['.$submodule['module'].'] </br>So it\'s can\'t be rendered in to ['.$position .'] position which is added in position config.';
            }
            //TODO jogosultság kezelés dinamikussá tétetele a submodule betöltése előtt
            if($submodule['permission'] == 'default'){
                $actionToCall = $submodule['action'] . 'Action';
                $renderedPositionContent .= (new $path())->$actionToCall();
            }
        }
        return $renderedPositionContent;
    }
    
    private function isMobile(){
        return 1 == preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4));
    }
}