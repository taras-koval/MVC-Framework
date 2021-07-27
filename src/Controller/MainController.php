<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class MainController extends Controller
{
    
    public function index(): Response
    {
        $route = '/articles/{slug<\d+>}/comments/{id}';
        
        /*$pattern = '~{[A-Za-z0-9]+}~';
        $pattern2 = '~<[\S]+>~';*/
        
        // $route = preg_replace('', '', $route);
        
        $matches = [];
        
        dump(preg_match_all('~{([^}.]+)}~', $route, $matches), $matches[1]);
        
        foreach ($matches[1] as $key => $val) {
            $matches[1][$key] = preg_replace('~{([a-zA-Z]+)<([^>.]+)>}~', 'xxx', $val);
        }
        
        dump($matches[1]);
        
        return $this->render('home');
    }
    
    public function contact(): Response
    {
        $this->setLayout('test');
        return $this->render('contact');
    }
    
    public function notFound(Request $request): Response
    {
        return $this->render('404', ['path' => $request->getPath()])->setStatusCode('404');
    }
    
    public function test(Request $request, $slug, $id) {
        dd($slug, $id);
    }
    
}