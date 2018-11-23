<?php
/**
 * Created by PhpStorm.
 * User: Jaeger <JaegerCode@gmail.com>
 * Date: 2017/9/30
 * Use PhantomJS to crawl Javascript dynamically rendered pages.
 */

namespace QL\Ext;


use o0o\PhantomJs\Http\RequestInterface;
use QL\Contracts\PluginContract;
use QL\QueryList;
use o0o\PhantomJs\Client;
use Closure;
use o0o\PhantomJs\DependencyInjection\ServiceContainer;

class PhantomJs implements PluginContract
{
    protected static $browser = null;

    public static function install(QueryList $queryList, ...$opt)
    {
        // PhantomJS bin path
        $phantomJsBin = $opt[0];
        $name = $opt[1] ?? 'browser';
        $queryList->bind($name,function ($request,$debug = false,$commandOpt = []) use($phantomJsBin){
            return PhantomJs::render($this,$phantomJsBin,$request,$debug,$commandOpt);
        });
        
    }

    public static function render(QueryList $queryList,$phantomJsBin,$url,$debug = false,$commandOpt = [])
    {
        $procedure_type = $commandOpt['procedure_type'] ?? false;
        if(isset($commandOpt['procedure_type'])) unset($commandOpt['procedure_type']);
        
        $client = self::getBrowser($phantomJsBin,$commandOpt);
        $request = $client->getMessageFactory()->createRequest();
        if($url instanceof Closure){
            $request = $url($request);
        }else{
            $request->setMethod('GET');
            $request->setUrl($url);
        }
        $procedure_type && $request->setType($procedure_type);
        
        $response = $client->getMessageFactory()->createResponse();
        if($debug) {
            $client->getEngine()->debug(true);
        }
        $client->send($request, $response);
        $queryList->console = $response->getConsole();

        if($debug){
            print_r($client->getLog());
            print_r($queryList->console);
        }
        
        $html = '<html>'.$response->getContent().'</html>';
        $queryList->setHtml($html);
        return $queryList;
    }

    protected static function getBrowser($phantomJsBin,$commandOpt = [])
    {
        $defaultOpt = [
           '--load-images' => 'false',
           '--ignore-ssl-errors'  => 'true'
        ];
        $unsets = [
        	'proc_cache_enabled',
        	'procedure_path',
        	'procedures'
        ];
        $procedures = [];
        $procedure_path = '';
        $cacheEnabled = $commandOpt['proc_cache_enabled'] ?? true;
        $procedure_path = $commandOpt['procedure_path'] ?? false;
        $procedures = $commandOpt['procedures'] ?? [];
        $procedures = is_array($procedures) ? $procedures : [$procedures];
        foreach ($unsets as $v) {
        	if(isset($commandOpt[$v])) unset($commandOpt[$v]);
        }
        $commandOpt = array_merge($defaultOpt,$commandOpt);
        
        if(self::$browser == null){
            self::$browser = Client::getInstance();
            self::$browser->getEngine()->setPath($phantomJsBin);
        }
        $cacheEnabled || self::$browser->getProcedureCompiler()->clearCache();//清除缓存.建议允许前进行清除
        $cacheEnabled && self::$browser->getProcedureCompiler()->enableCache();//允许缓存,建议开启
        $cacheEnabled || self::$browser->getProcedureCompiler()->disableCache();//禁止读取缓存

        
        $procedure_path && $serviceContainer = ServiceContainer::getInstance();
        $procedure_path && $procedureLoader = $serviceContainer->get('procedure_loader_factory')->createProcedureLoader($procedure_path);
        $procedureLoader && self::$browser->getProcedureLoader()->addLoader($procedureLoader);
        foreach ($procedures as $v) {
            self::$browser->setProcedure($v);
        }
        foreach ($commandOpt as $k => $v) {
            $str = sprintf('%s=%s',$k,$v);
            self::$browser->getEngine()->addOption($str);
        }
        
        return self::$browser;
    }

}